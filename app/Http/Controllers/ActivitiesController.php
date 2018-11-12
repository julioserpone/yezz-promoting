<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Branch;
use App\LogActivityBranch;
use App\LogActivityBranchItem;
use App\Product;
use App\MediaFile;
use App\Http\Requests\UpdateActivityRequest;
use Carbon\Carbon;

class ActivitiesController extends YezzController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showActivities(Request $request)
    {
        $user = \Auth::user();
        if (in_array($user->profile->code, ['promotor','seller']))
        {
            $this->data['data']=LogActivityBranch::where('user_id', $user->id)->get();
        }
        else {
            //Listar las visitas del sector que esta liderizando
            if (in_array($user->profile->code, ['leader_pdv','leader_agency','trademarketing'])) {
                $branch_ids = Branch::ByUserSector(\Auth::user())->select('id')->get()->toArray();
                $this->data['data']=LogActivityBranch::whereIn('branch_id', $branch_ids)->get();
            } else {
                //Todas las visitas
                if ($user->profile->code == 'administrator') {
                    $this->data['data']=LogActivityBranch::all();
                }
            }
        }
        return $this->view($request,'activities.index');
    }

    public function showEditActivity(Request $request, $id = null)
    {
        $this->data['data']=$id?LogActivityBranch::findOrFail($id):$id;
        $this->data['products']=Product::all();
        $this->data['products_yezz']=Product::ThisCompany()->get();
        $this->data['branchs']=Branch::ByUserSector(\Auth::user())->get();
        
        session()->forget('products_list');
        $products_list = [];
        if ($this->data['data']) {
            $products_list_temp = LogActivityBranchItem::where('log_activity_id', $this->data['data']->id)->get();
            if ($products_list_temp) {
                foreach ($products_list_temp as $key => $value) {
                    $products_list[$key] = [
                        'product_id' =>$value->product_id,
                        'product_id_reference' => $value->product_id_reference,
                        'product' => Product::where('id',$value->product_id)->first()->name,
                        'product_reference' => ($value->product_id_reference) ? Product::where('id', $product['product_id_reference'])->first()->name : '',
                        'stock' => $value->stock,
                        'exhibition' => $value->exhibition,
                        'purchase_price' => $value->purchase_price,
                        'sale_price' => $value->sale_price,
                    ];
                }
            }
        }

        session()->put('products_list', $products_list);

        return $this->view($request, 'activities.edit');
    }

    public function showFeatures(Request $request,$idlog)
    {
        $this->data['data']=LogActivityBranchItem::findOrFail($idlog);
        return $this->view($request,'activities.productFeatures');
    }

    public function showPhoto(Request $request,$idlog)
    {
        $this->data['item']=LogActivityBranchItem::find($idlog);
        $this->data['data']=MediaFile::where('source_id',$idlog)->where('origin','LogActivityBranchItem')->first();
        
        if ($this->data['data']) {
            if (!$this->data['data']->path || !\Storage::exists($this->data['data']->path)){
                $this->data['data']->imagen();
            }
        }
        return $this->view($request,'activities.productPhoto');
    }

    public function showEvidence(Request $request, $idlog)
    {
        $logActivity = LogActivityBranch::findOrFail($idlog);
        $evidences = $logActivity->photo_evidences;

        foreach ($evidences as $foto) {
            if (!$foto->path || !\Storage::exists($foto->path)) {
                $foto->imagen();
            }
        }
        $this->data['evidences']=$evidences;
        $this->data['data']=$logActivity;

        return $this->view($request,'activities.fotoEvidences');
    }

    public function showBranchItems(Request $request, $idlog)
    {
        $log_activity = LogActivityBranch::find($idlog);
        $this->data['data']=$log_activity;
        return $this->view($request,'activities.branchItemsModal');
    }

    public function updateActivity(Request $request, $id = null)
    {
    
        $v = \Validator::make($request->all(), ['branch_id' => 'required']);

        $products_list = $this->prepareListResources($request);
        session()->forget('products_list');
        session()->put('products_list', $products_list);
        $request->merge(['products_list' => $products_list]);

        if ($v->fails()) 
        {
            return back()->with('error', trans('activities.errors.required.branch_id'))->withInput($request->all());
        }

        $user = \Auth::user();
        $branch = Branch::find($request->get('branch_id'));
        $timezone = trans('localization.time_zones.'.$branch->country->sortname);
        $data = $request->only('branch_id','comment');
        $data['entry_time'] = Carbon::now($timezone);
        $data['departure_time'] = Carbon::now($timezone);
        $data['user_id'] = \Auth::user()->id;

        if (!$id) {
            //new
            $log_activity = LogActivityBranch::create($data);

            if ($log_activity) {
                foreach ($products_list as $product) {
                    LogActivityBranchItem::create([
                        'log_activity_id'=> $log_activity->id,
                        'product_id' => $product['product_id'],
                        'product_id_reference' => ($product['product_id_reference'])? : null,
                        'product_features' => Product::where('id', $product['product_id'])->first()->features,
                        'sales' => $product['sales'],
                        'stock' => $product['stock'],
                        'exhibition' => $product['exhibition'],
                        'purchase_price' => $product['purchase_price'],
                        'sale_price' => $product['sale_price'],
                    ]);
                }
            }
        } else {
            $log_activity = LogActivityBranch::find($id);

            if ($log_activity) {

                LogActivityBranchItem::where('log_activity_id', $log_activity->id)->forceDelete();
                foreach ($products_list as $product) {
                    LogActivityBranchItem::update([
                        'log_activity_id'=> $log_activity->id,
                        'product_id' => $product['product_id'],
                        'product_id_reference' => $product['product_id_reference'],
                        'product_features' => Product::where('id', $product['product_id'])->first()->features,
                        'sales' => $product['sales'],
                        'stock' => $product['stock'],
                        'exhibition' => $product['exhibition'],
                        'purchase_price' => $product['purchase_price'],
                        'sale_price' => $product['sale_price'],
                    ]);
                }
            }
        }

        return redirect('activities')->with('msg', trans('globals.success_alert_content'));
    }

    public function downloadPhotoByEvidence(Request $request, $id) {

        $evidence = MediaFile::find($id);
        
        $url = getenv('S3_FOLDER_BASE').$evidence->path;
        $filename = pathinfo($url, PATHINFO_FILENAME).'.'.pathinfo($url, PATHINFO_EXTENSION);
        header("Content-disposition:attachment; filename=$filename");
        return readfile($url);
    }

    public function prepareListResources($request) {

        $products_list_temp = $request->get('products_list') ? : '';
        $products = [];

        if ($products_list_temp) {
            foreach ($products_list_temp as $key => $value) {
                $items = explode(',', $value);
                $products[$key] = [
                    'product_id' => $items[0], 
                    'product_id_reference' => $items[1],
                    'product' => $items[2],
                    'product_reference' => $items[3],
                    'stock' => $items[4],
                    'sales' => $items[5],
                    'exhibition' => $items[6],
                    'purchase_price' => $items[7],
                    'sale_price' => $items[8]
                ];
            }
        }

        return $products;
    }
}
