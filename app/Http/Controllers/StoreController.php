<?php

namespace App\Http\Controllers;

use App\Category;
use App\TypeChannel;
use App\Chain;
use App\Branch;
use App\BranchContact;
use App\Country;
use App\State;
use App\City;
use App\Township;
use App\Customer;
use App\Http\Requests\UpdateBranchRequest;
use Illuminate\Http\Request;

class StoreController extends YezzController
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

    public function showStore(Request $request)
    {
        //Solo los usuarios tipo 'administrator' y 'trademarketing' pueden ver todas las tiendas
        $isAdministrator = \Auth::user()->profile->isProfile(['administrator']);
        $this->data['data'] = ($isAdministrator) ? Branch::all() : Branch::ByUserSector(\Auth::user())->get(); 
        return $this->view($request, 'store.manager');
    }

    public function showStoreDetail(Request $request, $id)
    {
        $this->data['data'] = Branch::findOrFail($id);
        return $this->view($request, 'store.details');
    }

    public function showStoreEdit(Request $request, $id = null)
    {
        //Datos de la tienda
        $this->data['data'] = $id ? Branch::findOrFail($id) : null;

        //Listas
        $this->data['type_channels'] = TypeChannel::all();
        $this->data['categories'] = Category::all();
        $this->data['chains'] = Chain::all();
        $this->data['countries'] = Country::all();
        $this->data['states'] = ($this->data['data']) ? State::where('country_id', $this->data['data']->country_id)->get() : null;
        $this->data['cities'] = ($this->data['data']) ? City::where('state_id', $this->data['data']->state_id)->get() : null;
        $this->data['townships'] = ($this->data['data']) ? Township::where('city_id', $this->data['data']->city_id)->get() : null;

        return $this->view($request, 'store.edit');
    }

    public function showBranches(Request $request)
    {
        $this->data['data'] = Branch::paginate(10);
        return $this->view($request, 'store.bmanager');
    }

    public function showBranchDetail(Request $request, $id)
    {
        $this->data['data'] = Branch::findOrFail($id);
        return $this->view($request, 'store.bdetails');
    }

    public function showBranchContactDetail(Request $request, $id)
    {
        $this->data['data'] = BranchContact::findOrFail($id);
        return $this->view($request, 'store.bcontactdetails');
    }

    public function showBranchEdit(Request $request, $id = null)
    {
        $this->data['stores'] = Store::all();
        $this->data['categories'] = StoreCategory::all();
        $this->data['data'] = $id ? Branch::findOrFail($id) : null;
        return $this->view($request, 'store.bedit');
    }

    private function generateCodeChain($text, $band = null)
    {
        if (!$band) {
            $text = strtolower(strlen($text) > 50 ? substr($text, 0, 50) : $text);
        } else {
            $text = substr($text, 0, -2) . '' . rand(10, 99);
        }
        if ($this->exist(Chain::where('code', $text))) {
            return $this->generateCodeChain($text, true);
        }
        return $text;
    }

    public function updateStore(UpdateBranchRequest $request, $id = null)
    {
        
        //Gestion de la cadena
        $chain = Chain::where('name_chain', $request->get('name_chain'))->first();
        $data_chain = [
            'chain_country_id' => $request->get('chain_country_id'),
            'name_chain' => strtoupper($request->get('name_chain')),
            'identification_chain' => strtoupper($request->get('identification_chain')),
            'address_chain' => strtoupper($request->get('address_chain')),
            'phone_chain' => $request->get('phone_chain'),
            'email_chain' => $request->get('email_chain'),
        ];
        
        if ($request->get('is_chain') == 'on') {
            if ($chain) {
                $chain->fill($data_chain);
                $chain->update();
            } else {
                $data_chain['chain_user_id'] = \Auth::user()->id;
                $chain = Chain::create($data_chain);
            }
        }

        //Gestion del contacto
        $data_customer = [
            'name_customer' => strtoupper($request->get('name_customer')),
            'surname_customer' => strtoupper($request->get('surname_customer')),
            'store_position_customer' => strtoupper($request->get('store_position_customer')),
            'address_customer' => strtoupper($request->get('address_customer')),
            'email_customer' => strtolower($request->get('email_customer')),
            'phone_customer' => $request->get('phone_customer'),
        ];

        if ($request->get('contact_id'))
        {
            $customer = BranchContact::find($request->get('contact_id'));
            $customer->fill($data_customer);
            $customer->update();  
        }
        else
        {
            //Busco al contacto para verificar que no existe ya algun contacto con estos datos. Si existe, le asigno el mismo ID, para no duplicarlos
            $customer = BranchContact::where('email_customer', strtolower($request->get('email_customer')))
                        ->where('name_customer', strtoupper($request->get('name_customer')))
                        ->where('surname_customer', strtoupper($request->get('surname_customer')))
                        ->where('phone_customer', $request->get('phone_customer'))
                        ->first();

            if ($customer) {
                $customer->fill($data_customer);
                $customer->update();
            } else {
                $customer = BranchContact::create($data_customer);
            }
        }

        //Gestion de la tienda
        $store = $id ? Branch::findOrFail($id) : new Branch;
        $data_store = [
            'code' => strtoupper($request->get('code')),
            'name' => strtoupper($request->get('name')),
            'address' => strtoupper($request->get('address')),
            'phone' => ($request->get('phone')) ? : null,
            'zip_code' => ($request->get('zip_code')) ? : null,
            'type_id' => $request->get('type_id'),
            'chain_id' => ($request->get('is_chain') == 'on') ? $chain->id : null,
            'country_id' => ($request->get('country_id')) ? : null,
            'state_id' => ($request->get('state_id')) ? : null,
            'city_id' => ($request->get('city_id')) ? : null,
            'township_id' => ($request->get('township_id')) ? : null,
            'category_id' => ($request->get('category_id')) ? : null,
            'is_customer' => ($request->get('is_customer') == 'on') ? 1 : 0,
            'has_pop' => ($request->get('has_pop') == 'on') ? 1 : 0,
            'contact_id' => ($customer) ? $customer->id : null,
        ];
        
        //dd($chain, $data_store, $data_chain, $data_customer);
        $store->fill($data_store);
        $store->save();

        return redirect('store/store')->with('msg', trans('globals.success_alert_content'));
    }

    public function removeStore(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect('store/store')->with('msg', trans('globals.success_alert_content'));
    }

    public function removeBranch(Request $request, $id)
    {
        $store = Branch::findOrFail($id);
        $store->delete();
        return redirect('store/branch')->with('msg', trans('globals.success_alert_content'));
    }
}
