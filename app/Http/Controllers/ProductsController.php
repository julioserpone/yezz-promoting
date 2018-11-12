<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateDeviceRequest;

use App\Product;
use App\Device;
use App\DeviceTranslation;

class ProductsController extends YezzController
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

    public function showProducts(Request $request)
    {
        $this->data['data']=Product::all();
        return $this->view($request, 'products.manager');
    }

    public function showEditProduct(Request $request, $id = null)
    {
        $this->data['data']=$id?Product::findOrFail($id):$id;
        $this->data['brand']=Product::ShowDistinct('brand');
        $this->data['model']=Product::ShowDistinct('model');
        $this->data['features_list']=Device::all();
        
        return $this->view($request, 'products.edit');
    }

    public function showDevices(Request $request)
    {
        $this->data['data']=Device::all();
        return $this->view($request, 'products.dmanager');
    }

    public function showEditDevice(Request $request, $id = null)
    {
        $this->data['data']=$id?Device::findOrFail($id):$id;
        return $this->view($request, 'products.dedit');
    }

    public function updateProduct(UpdateProductRequest $request, $id = null)
    {
        $product=$id?Product::findOrFail($id):new Product;

        $product->brand=strtoupper($request->input('brand'));
        $product->model=strtoupper($request->input('model'));
        $product->name=$product->brand.' '.$product->model;
        $product->number_part=($request->input('number_part')) ? strtoupper($request->input('number_part')) : null;
        $product->is_yezz=(in_array(strtolower($request->input('brand')), trans('globals.brands_yezz'))) ? 1 : 0;

        //features
        $features_list = Device::all();
        $features = [];
        foreach ($features_list as $key => $value) {
            if ($request->get($value->code)) {
                $features += [
                    $value->code => $request->get($value->code)
                ];
            }
        }
        $product->features = json_encode($features);
        $product->save();
        
        return redirect('/products')->with('msg', trans('globals.success_alert_content'));
    }

    public function removeProduct(Request $request, $id)
    {
        $device=Product::findOrFail($id);
        $device->delete();
        
        return redirect('/products')->with('msg', trans('globals.success_alert_content'));
    }

    public function updateDevice(UpdateDeviceRequest $request, $id = null)
    {
        $values=array_filter($request->input('values'));
        /*if (!$values) {
            return back()->with('error', trans('product.noValuesDevices'));
        }*/

        $device=$id?Device::findOrFail($id):new Device;
        $device->code=$request->input('code');
        $device->type=$request->input('type');
        $device->description=($request->input('type')=='closed')?'["'.implode('","', $values).'"]' : null;
        $device->save();

        //traducciones
        foreach (trans('locale') as $key => $value) {
            $translations = DeviceTranslation::where('device_id',$device->id)->where('locale',$key)->first();
            $translations = $translations ? $translations : new DeviceTranslation;
            $translations->locale=$key;
            $translations->device_id=$device->id;
            $translations->name=$request->input('name_'.$key);
            $translations->save();
        }

        return redirect('/product/devices')->with('msg', trans('globals.success_alert_content'));
    }

    public function removeDevice(Request $request, $id)
    {
        $device=Device::findOrFail($id);
        $device->delete();
        
        return redirect('/product/devices')->with('msg', trans('globals.success_alert_content'));
    }

    public function search(Request $request, $product_id = null) {

        $q = trim($request->get('q'));
        $data = [];

        $query = Product::where('id', $product_id);

        if ($q != '') {
            $query->whereRaw("name like '%" . $q . "%'");
        }

        $state = $query->orderBy('name', 'asc')->get();

        $state->each(function ($item, $key) use (&$data) {
            $data[] = ['id' => $item->id, 'text' => $item->name, 'brand' => $item->brand, 'features' => $item->array_values];
        });

        return json_encode($data);
    }

    public function show(Request $request, $id)
    {
        $this->data['data']=Product::find($id);
        return $this->view($request, 'activities.productFeatures');
    }
}
