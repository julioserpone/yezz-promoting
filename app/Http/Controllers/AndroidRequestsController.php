<?php
namespace App\Http\Controllers;

use App\Branch;
use App\BranchContact;
use App\Item;
use App\Localization;
use App\LogAction;
use App\LogActivityBranch;
use App\LogActivityBranchItem;
use App\LogSession;
use App\MediaFile;
use App\PersonData;
use App\Product;
use App\Profile;
use App\RouteDetails;
use App\Country;
use App\State;
use App\City;
use App\Township;
use App\User;
use App\TypeChannel;
use App\Chain;
use App\Category;
use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;
use Storage;

class AndroidRequestsController extends Controller
{
    public function __construct()
    {
        // $this->test();
        // dd('test');
    }

    public function androidLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 'active'])) {
            $user = Auth::user()->toArray();
            $country = Country::where('id', $user['country_id'])->first();
            $array = [
                'login' => true,
                'temp' => false,
                'person' => PersonData::find($user['person_id']),
                'date' => DB::table('users')->select(DB::raw('DATE(NOW()) as date'))->first()->date,
                'profile' => Profile::find($user['profile_id']),
                'numChains' => Chain::select('id')->get()->count(),
                'numBranchs' => Branch::select('id')->where('country_id', $country->id)->get()->count(),
                'numTypeChannels' => TypeChannel::select('id')->get()->count(),
                'numCategories' => Category::select('id')->get()->count(),
                'numContacts' => BranchContact::select('id')->get()->count(),
            ];
            unset($user['person_id']);
            unset($user['profile_id']);

            $this->setSession($user["id"], $request->input('device_info'), $request->input('device_serial'));
            return response()->json(array_merge($user, $array));
        } else {
            $user = User::where('email', $request->input('email'))->where('temp_password', $request->input('password'))->first();
            if ($user) {
                return response()->json(["login" => true, 'temp' => true]);
            }
        }
        return response()->json(["login" => false]);
    }

    private function setSession($user, $device, $serial)
    {
        $id = $this->checkSession($user, $serial);
        if ($id) {
            $this->closeSession($id->id);
        }
        $session = new LogSession;
        $session->user_id = $user;
        $session->serial = $serial;
        $session->devices = $device;
        $session->save();
    }

    private function checkSession($user, $serial)
    {
        return LogSession::select('id')->where(["user_id" => $user, "serial" => $serial])->first();
    }

    private function closeSession($id, $serial = null)
    {
        if (!$serial) {
            $session = LogSession::find($id);
            $session->status = "inactive";
            $session->save();
        } else {
            LogSession::where(["user_id" => $id, "serial" => $serial])
                ->update(["status" => "inactive"]);
        }
    }

    public function systemCache(Request $request)
    {
        if (!$this->checkSession($request->input("user_id"), $request->input("device_serial"))) {
            return response()->json(["login" => false]);
        }
        if ($request->input('cache')) {
            $array = [
                "cache"         => true,
                "login"         => true,
                "type_channels" => [],
                "chains"        => [],
                "branchs"       => [],
                "routes"        => [],
                'contacts'      => [],
                'categories'    => [],
                'states'        => [],
                'cities'        => [],
                'townships'     => [],
                'phoneBrands'   => [],
                'phoneModels'   => [],
            ];

            //Tipos de Canales (maestro)
            if ($request->input('type_channels')) {
                $temp = TypeChannel::all();
                $i = 0;
                $array['type_channels'] = $temp->toArray();
                foreach ($array['type_channels'] as $row) {
                    $array['type_channels'][$i++]['name'] = $temp->find($row['id'])->translate('es')->name;
                }
            }

            //Cadenas de Tienda (maestro)
            if ($request->input('chains')) {
                $temp = Chain::all();
                $i = 0;
                $array['chains'] = $temp->toArray();
                foreach ($array['chains'] as $row) {
                    $array['chains'][$i++]['name'] = $row['name_chain'];
                }
            }

            //Tiendas o Sucursales(filtradas por pais de origen del usuario)
            if ($request->input('branchs')) {
                //$user = User::select("country_id")->where('id', $request->input("user_id"))->first();
                //$array['branchs'] = Branch::where('country_id', $user->country_id)->get()->toArray();
                $user = User::where('id', $request->input("user_id"))->first();
                $array['branchs'] = Branch::ByUserSector($user)->get()->toArray();  //Tiendas del sector asignado al usuario
            }

            //Contactos (solo aquellos que esten asociados a los branchs que estaran disponibles para el promotor, segun su pais de origen)
            if ($request->input('contacts')) {
                if (isset($array['branchs']) && count($array['branchs']) > 0) {
                    $ids = [];
                    foreach ($array['branchs'] as $value) {
                        $ids[] = $value['contact_id'];
                    }

                    $array['contacts'] = DB::table('customers')
                        ->whereIn('id', $ids)
                        ->get();
                }
            }

            $array['categories'] = Category::where('status', 1)->get()->toArray();
            
            if ($request->input('country')) {
                $array['states'] = State::where('country_id', $request->input('country'))->get()->toArray();
                $totalStates = count($array['states']);
                if ($totalStates > 0) {
                    $cities = [];
                    foreach ($array['states'] as $state) {
                        $cities = array_merge($cities, City::where('state_id', $state['id'])->get()->toArray());
                    }
                    $array['cities'] = $cities;

                    $totalCities = count($cities);
                    if ($totalCities > 0) {
                        $townships = [];
                        foreach ($cities as $city) {
                            $townships = array_merge($townships, Township::where('city_id', $city['id'])->get()->toArray());
                        }
                        $array['townships'] = $townships;
                    }
                }
            }
            //Obtener los brands de los productos
            /*$array['phoneBrands'] = $this->getPhoneBrands();
            $array['phoneModels'] = $this->getPhoneModels();*/
            $array['phoneBrands'] = Product::GetPhoneBrands();
            $array['phoneModels'] = Product::GetPhoneModels();

            if (!empty($route)) {
                $array['routes'] = RouteDetails::select(
                    'branch_id',
                    DB::raw("'false' AS checked"),
                    DB::raw("NULL AS start"),
                    DB::raw("NULL AS end"),
                    DB::raw("'true' AS route")
                )->where('route_id', $route->route_id)->get()->toArray();
            }

            return response()->json($array);
        } else {
            return response()->json(["cache" => false]);
        }
    }

    public function synchronizeData(Request $request)
    {
        if (!$this->checkSession($request->input("user_id"), $request->input("device_serial"))) {
            return response()->json(["login" => false]);
        }
        $array = [
            "cache"         => true,
            "login"         => true,
            "chains"        => [],
            "branchs"       => [],
            "routes"        => [],
            'categories'    => [],
            'phoneBrands'   => [],
            'phoneModels'   => [],
        ];

        //Cadenas de Tienda (maestro)
        $temp = Chain::all();
        $i = 0;
        $array['chains'] = $temp->toArray();
        foreach ($array['chains'] as $row) {
             $array['chains'][$i++]['name'] = $row['name_chain'];
        }

        //Tiendas o Sucursales(filtradas por pais de origen del usuario)
        $user = User::where('id', $request->input("user_id"))->first();
        $array['branchs'] = Branch::ByUserSector($user)->get()->toArray();

        $array['categories'] = Category::where('status', 1)->get()->toArray();
            
        //Obtener los brands de los productos
        $array['phoneBrands'] = Product::GetPhoneBrands();
        $array['phoneModels'] = Product::GetPhoneModels();

        if (!empty($route)) {
            $array['routes'] = RouteDetails::select(
                'branch_id',
                DB::raw("'false' AS checked"),
                DB::raw("NULL AS start"),
                DB::raw("NULL AS end"),
                DB::raw("'true' AS route")
            )->where('route_id', $route->route_id)->get()->toArray();
        }

        return response()->json($array);

    }

    public function forgetPassword(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $data = [];
            $array = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'll', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
            $data['password'] = "";

            for ($i = 0; $i < 4; $i++) {
                $data['password'] .= $array[rand(0, 27)] . '' . rand(0, 9);
            }

            $data['date'] = DB::table('profiles')->select(DB::raw('ADDDATE(NOW(),INTERVAL 3 DAY) as date'))->first()->date;
            $data['user'] = $user->username;

            $user->due_date_temp_pass = $data['date'];
            $user->temp_password = $data['password'];
            $user->save();

            Mail::send('emails.forgetPasswordAndroid', $data, function ($m) use ($user) {
                $m->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
                $m->to($user->email, $user->name)->subject('Recuperar Contraseña!');
            });

            return response()->json(["email" => true]);
        } else {
            return response()->json(["email" => false]);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->input('email'))->where('temp_password', $request->input('password'))->first();
        if ($user) {
            $user->password = bcrypt($request->input('newPassword'));
            $user->temp_password = '';
            $user->due_date_temp_pass = '0000-00-00 00:00:00';
            $user->save();
            return response()->json(["login" => true]);
        } else {
            return response()->json(["login" => false]);
        }
    }

    public function synchronizeServer(Request $request)
    {
        $session = $this->checkSession($request->input("user_id"), $request->input("device_serial"));
        
        if (!$session) {
            return response()->json(["login"=>false]);
        }
        //file_put_contents(env('FOLDER_DUMP'), "\n\n".json_encode($request->input()), FILE_APPEND);

        $log = [];
        $return = ["login" => true, "chains" => [], "stores" => [], "branches" => [], "phones" => [], 'contacts' => [], 'cities' => [], 'townships' => []];

        if ($request->input('cities')) {
            $return["cities"] = [];
            $data = $this->getJson($request->input("cities"));
            $log["cities"] = ["data" => $data];
            foreach ($data as $row) {
                $city = new City;
                $cityId = substr(rand(), 5);
                $city->id = $cityId;
                $city->name = strtolower($row["name"]);
                $city->state_id = $row["state"];
                $city->save();
                $return["cities"][] = ["old" => $row["id"], "new" => $cityId];
            }
            $log["cities"] = ["result" => $return["cities"]];
        }

        if ($request->input('townships')) {
            $return["townships"] = [];
            $data = $this->getJson($request->input("townships"));
            $log["townships"] = ["data" => $data];
            foreach ($data as $row) {
                $township = new Township();
                $township->name = strtolower($row["name"]);
                $cityId = $this->getIdInstance($row["city"], $return["cities"], 'City');
                $township->city_id = $cityId;
                $township->save();
                $return["townships"][] = ["old" => $row["id"], "new" => $township->id];
            }
            $log["townships"] = ["result" => $return["townships"]];
        }
        
        if ($request->input("chains")) {
            $return["chains"] = [];
            $data = $this->getJson($request->input("chains"));
            $log["chains"] = ["data" => $data];
            foreach ($data as $row) {
                $chain = new Chain;
                $chain->name_chain = strtoupper($row["name"]);
                $chain->chain_country_id = $row["country"];
                $chain->chain_user_id = $request->input("user_id");
                $chain->save();
                $return["chains"][] = ["old" => $row["id"], "new" => $chain->id];
            }
            $log["chains"] = ["result" => $return["chains"]];
        }

        if ($request->input("contacts")) {
            $return["contacts"] = [];
            $data = $this->getJson($request->input("contacts"));
            $log["contacts"] = ["data" => $data];
            foreach ($data as $key => $row) {
                $data_contact = [
                    'name_customer' => strtoupper($row['name']),
                    'surname_customer' => strtoupper($row['surname']),
                    'store_position_customer' => strtoupper($row['store_position']),
                    'address_customer' => strtoupper($row['address']),
                    'email_customer' => strtolower($row['email']),
                    'phone_customer' => $row['phone'],
                ];
                $contact = BranchContact::where('email_customer', strtolower($row['email']))
                        ->where('name_customer', strtoupper($row['name']))
                        ->where('surname_customer', strtoupper($row['surname']))
                        ->where('phone_customer', $row['phone'])
                        ->first();
                if ($contact) {
                    $contact->fill($data_contact);
                    $contact->update();
                } else {
                    $contact = BranchContact::create($data_contact);
                }
                $return['contacts'][] = ['old' => $row['id'], 'new' => $contact->id];
            }
            $log["contacts"]=["result"=>$return["contacts"]];
        }

        if ($request->input("branches")) {
            $return["branches"] = [];
            $data = $this->getJson($request->input("branches"));
            $log["branches"] = ["data" => $data];
            foreach ($data as $row) {
                if ($row['status'] == 'new') {
                    $branch = new Branch;
                } else {
                    $branch = intval($row['id']) > 0 ? Branch::findOrFail($row['id']) : new Branch;
                }
                $branch->name = strtoupper($row["name"]);
                $branch->code = strtoupper($row["code"]);
                $branch->address = strtoupper($row["address"]);
                $branch->phone = $row["phone"];
                $branch->is_customer = $row["is_customer"];
                $branch->has_pop = $row["has_pop"];
                $branch->comments = strtoupper($row["comments"]);
                $branch->country_id = $row["country_id"];
                $branch->state_id = $row["state_id"];
                $branch->city_id = $this->getIdInstance($row["city_id"], $return["cities"], 'City');
                $branch->township_id = $this->getIdInstance($row["township_id"], $return["townships"], 'Township');
                $branch->type_id = $row["type_id"];
                $branch->chain_id = $this->getIdInstance($row["chain_id"], $return["chains"], 'Chain');
                $branch->category_id = (isset($row["category"])) ? $row["category"] : null;
                $contact_id = (isset($row["contact"])) ? $this->getIdInstance($row["contact"], $return["contacts"], 'Contacts') : null;
                $branch->contact_id = $contact_id;
                $branch->save();
                $return["branches"][] = ["old" => $row["id"], "new" => $branch->id];
            }
            $log["branches"] = ["result" => $return["branches"]];
        }

        if ($request->input("localization")) {
            $data = $this->getJson($request->input("localization"));
            foreach ($data as $key => $row) {
                $localization = new Localization;
                $localization->user_id = intval($row['user']);
                $localization->store_id = isset($row['store_id']) ? $this->getIdInstance($row['store_id'], $return["branches"], 'Branch') : null;
                $localization->longitude = $row['longitude'];
                $localization->latitude = $row['latitude'];
                $localization->registerOn = $row['created'];
                $localization->save();

                //Update geolocalizacion de tienda si esta fue guardada por el proceso de GPS
                if (isset($row['store_id']) && isset($row['longitude']) && isset($row['latitude'])) {
                    $branchId = $this->getIdInstance($row['store_id'], $return["branches"], 'Branch');
                    if (!is_null($branchId)) {
                        $brand_gps = Branch::find($branchId);
                        $brand_gps->longitude = $row['longitude'];
                        $brand_gps->latitude = $row['latitude'];
                        $brand_gps->save();
                    }
                }
            }
        }


        //Datos de la visita
        $data = $this->getJson($request->input('visitStore'));
        foreach ($data as $key => $log_activity_branch) {
            $brand_id = $this->getIdInstance($log_activity_branch['key'], $return["branches"], 'Branch');
            $logActivity = new LogActivityBranch;
            $logActivity->user_id        = $log_activity_branch["user"];
            $logActivity->branch_id      = $brand_id;
            $logActivity->comment        = isset($log_activity_branch["comment"]) ? $log_activity_branch["comment"] : '';
            $logActivity->entry_time     = $log_activity_branch['start'];
            $logActivity->departure_time = $log_activity_branch['date'];
            $logActivity->save();

            //Guardar foto evidencias de tienda (para esta visita)
            if ($request->input('mediaFiles')) {
                $data_photo_evidences = $this->getJson($request->input('mediaFiles'));
                //Esto es para verificar el json que viene asociado a mediaFiles
                //file_put_contents('/var/www/html/yezzclub-admin/'.time().'log.json', json_encode($request->input('mediaFiles')) ."\n\n\n", FILE_APPEND);
                foreach ($data_photo_evidences as $key => $photo_evidence) {
                    if ($photo_evidence['sourceId'] == $log_activity_branch['key']) {
                        $file = new MediaFile;
                        $file->type = 'image';
                        $file->code = $photo_evidence['code'];
                        $file->path = null;
                        $file->user_id = $photo_evidence["userId"];
                        /*$source_id = $this->getIdInstance($photo_evidence['sourceId'], $return["branches"], 'Branch');
                        if (is_null($source_id)) {
                            continue; 
                        };*/
                        //Anteriormente estaba guardando el Id de la tienda. Pero, si luego queria saber que fotos tomo de esa tienda en X visita, el sistema me trae todas las fotos de la tienda
                        //Ahora, asocio la fotografia a la Visita y no a la tienda
                        $file->source_id = $logActivity->id;
                        $file->comments = (empty($photo_evidence['comment'])) ? 'no comment' : $photo_evidence['comment'];
                        $file->origin =  $photo_evidence['origin'];
                        $file->save();
                    }
                }
            }
        }

        if ($request->input("phones")) {
            $return["phones"] = [];
            $data = $this->getJson($request->input("phones"));
            $log["phones"] = ["data" => $data];
            $array = [];
            $mediaArray = [];
            foreach ($data as $row) {
                if (!isset($array[$row["branch_id"]])) {
                    $array[$row["branch_id"]] = [];
                }
                $array[$row["branch_id"]][] = [
                    "id"             => $row["id"],
                    "brand"          => $row["brand"],
                    "model"          => $row["model"],
                    "stock"          => $row["stock"],
                    "exhibition"     => $row["exhibition"],
                    "sales"          => $row["sales"],
                    'purchase_price' => $row["sales"],
                    "sale_price"     => $row["sale_price"],
                    "parent"         => isset($row["parent"]) ? $row["parent"]: null,
                    "is_yezz"        => isset($row["parent"]) ? 0             : 1,
                    "created_date"   => date("Y-m-d H                         : i: s"),
                    "user"           => $row["user"],
                    "features"       => "",
                ];
                if (isset($row['exhibition_media']) && $row['exhibition_media']) {
                    $mediaArray[$row["id"]] = [
                        "exhibition_media" => $row["exhibition_media"],
                        "exhibition_media_comment" => $row["exhibition_media_comment"],
                    ];
                }
            }

            foreach ($array as $key => $value) {
                $id = $this->getIdInstance($key, $return["branches"], 'Branch');
                if (!$id) {
                    continue;
                }
                foreach ($value as $row) {
                    $product = Product::where("brand", strtolower($row["brand"]))->where("model", strtolower($row["model"]))->first();
                    if (!$product) {
                        $product = new Product;
                        $product->brand = strtoupper($row["brand"]);
                        $product->model = strtoupper($row["model"]);
                        $product->name  = strtoupper($row["brand"].' '.$row["model"]);
                        $product->is_yezz = $row['is_yezz'];
                        $product->save();
                    }
                    /*---- ESTE BLOQUE DE AQUI DEBERIAMOS ELIMINARLO. YA LA TABLA ITEMS NO SE ESTA UTILIZANDO ---*/
                    $item = Item::where("product_id", $product->id)->where("branch_id", $id)->first();
                    if (!$item) {
                        $item = new Item;
                        $item->product_id = $product->id;
                        $item->branch_id = $id;
                        $item->stock = $row["stock"];
                    }

                    $item->purchase_price =$row['purchase_price'];
                    $item->sale_price = $row['sale_price'];
                    $item->save();
                    /*--------------------------------------------------------------------------------------------*/

                    $activity = LogActivityBranchItem::select('id')
                    ->where('old_item_id', $row['id'])
                    ->where('log_activity_id', $logActivity->id)->first();
                    if (!$activity) {
                        $parent = $this->getIdInstance($row["parent"], $return["phones"], 'Products');
                        
                        $activity = new LogActivityBranchItem;
                        $activity->log_activity_id = $logActivity->id;
                        $activity->old_item_id = $row['id'];
                        $activity->product_id = $product->id;
                        $activity->product_id_reference = !empty($parent) ? $parent: null;
                        $activity->product_features = $row["features"];
                        $activity->stock = $row["stock"];
                        $activity->exhibition = $row["exhibition"];
                        $activity->sales = $row["sales"];
                        $activity->sale_price = $row["sale_price"];
                        $activity->purchase_price = $row["purchase_price"];
                        $activity->product_features = $product->features;
                        $activity->save();
                    }

                    $return["phones"][] = ["old" => $row["id"], "new" => $item->id, "logActivity" => $logActivity->id, "product" => $product->id, "item" => $item->id, "activity" => $activity->id];
                }
            }

            //Evidencia de productos (Proceso cuantitativo)
            foreach ($mediaArray as $key => $value) {
                $id = LogActivityBranchItem::select('id')->where('old_item_id', $key)->first();
                $file = MediaFile::select('id')->where('source_id', $id->id)->where('origin', 'LogActivityBranchItem')->first();

                if ($id && !$file) {
                    $file = new MediaFile;
                    $file->type = 'image';
                    $file->code = $value['exhibition_media'];
                    $file->path = null;
                    $file->user_id = $row["user"];
                    $file->source_id = $id->id;
                    $file->comments = $value['exhibition_media_comment'];
                    $file->origin = 'LogActivityBranchItem';
                    $file->save();
                }
                $id = null;
            }

            $log["phones"] = ["result" => $return["phones"]];
        }
        //enviamos una lista nueva de brand
        $return['phoneBrands'] = Product::GetPhoneBrands();
        $return['phoneModels'] = Product::GetPhoneModels();
        $this->addLogAction($session, [date('m/d/Y h:i:s a', time()) => ["synchronizeServer" => $log]]);
        return response()->json($return);
    }

    /**
     * Sincroniza la data de geolocalizacion de un usuario
     * devuelve los datos correctos pero no procesados
     * @param Request $request
     * @return json
     */
    public function syncGeolocalization(Request $request)
    {
        $response = ['status' => 'ok'];
        $unprocess = [];
        if ($request->input("localization")) {
            $data = $this->getJson($request->input("localization"));
            
            foreach ($data as $row) {
                $user = (!empty($row['user'])) ? User::find($row['user']) : null;
                if ($user && is_numeric($row['longitude']) && is_numeric($row['latitude'])) {
                    $localization = new Localization;
                    $localization->user_id = $user->id;
                    $localization->store_id = isset($row['store_id']) ? intval($row['store_id']) : null;
                    $localization->longitude = $row['longitude'];
                    $localization->latitude = $row['latitude'];
                    $localization->registerOn = $row['created'];
                    if ($localization->save() === false) {
                        $unprocess[] = $row['id'];
                    }
                }
            }
        }
        $response['unprocess'] = $unprocess;
        return response()->json($response);
    }

    private function addLogAction($session, $action)
    {
        $log = LogAction::where('log_session_id', $session->id)->first();
        if (!$log) {
            $log = new LogAction;
            $log->log_session_id = $session->id;
            $log->description = json_encode($action);
            $log->save();
            return $log;
        }
        $description = (array) $this->getJson($log->description);
        $description[key($action)] = $action[key($action)];
        $log->description = json_encode($description);
        $log->save();
        return $log;
    }

    private function getJson($data)
    {
        if (is_string($data)) {
            return $this->isJson($data) ? json_decode($data) : [];
        }
        return is_array($data) || is_object($data) ? $data : [];
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    private function getIdInstance($id, $otherId, $model)
    {
        $checked = null;
        foreach ($otherId as $row) {
            if ($id == $row["old"]) {
                $checked = ($model == 'Products') ? $row['product'] : $row["new"];
                break;
            }
        }
        if ($checked === null) {
            switch ($model) {
                case 'Branch':
                    $temp = Branch::find($id);
                    break;
                case 'Chain':
                    $temp = Chain::find($id);
                    break;
                case 'Item':
                    $temp = Item::find($id);
                    break;
                case 'Contacts':
                    $temp = BranchContact::find($id);
                    break;
                case 'City':
                    $temp = City::find($id);
                break;
                case 'Township':
                    $temp = Township::find($id);
                break;
                case 'Products':
                    $temp = Product::find($id);
                break;
            }
            if (isset($temp) && $temp) {
                $checked = $temp->id;
            }
        }
        return $checked;
    }

    public function toStorage($base64)
    {
        // requires php5
        $img = str_replace('data:image/png;base64,', '', $base64);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $png_url = "product-" . time() . ".png";

        \Storage::put('img/activities/' . $png_url, $data, 'public');

        //\Storage::disk('local')->put($png_url, $data);
        return 'img/activities/' . $png_url;
    }

    private function getPhoneBrands()
    {
        //Obtener los brands de los productos
        $temp = DB::table('products')
            ->select(DB::raw('brand, is_yezz'))
            ->groupBy('brand', 'is_yezz')
            ->get();

        $i = 0;
        $data = $temp->toArray();
        $format = [];
        foreach ($data as $row) {
            $format[$i]['name']    = $row->brand;
            $format[$i]['is_yezz'] = $row->is_yezz;
            $i++;
        }
        return $format;
    }

    private function getPhoneModels()
    {
        $temp = DB::table('products')
            ->select(DB::raw('brand, is_yezz, model,id'))
            ->groupBy('brand', 'is_yezz', 'model', 'id')
            ->get();

        $i = 0;
        $data = $temp->toArray();
        $format = [];
        foreach ($data as $row) {
            $format[$i]['brand']     = $row->brand;
            $format[$i]['is_yezz']   = $row->is_yezz;
            $format[$i]['name']      = $row->model;
            $format[$i]['productId'] = $row->id;
            $i++;
        }
        return $format;
    }
}
