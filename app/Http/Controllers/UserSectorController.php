<?php

namespace App\Http\Controllers;

use App\UserSector;
use App\Country;
use App\State;
use App\City;
use App\Township;
use App\User;
use App\Http\Requests\UpdateUserSectorRequest;
use Illuminate\Http\Request;

class UserSectorController extends YezzController
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

    public function showUserSectors(Request $request) {

    	$this->data['data']=UserSector::all();
        return $this->view($request, 'user_sectors.manager');
    }

    public function editUserSector(Request $request, $id = null) {

    	//Datos de la sectorizacion
        $this->data['data'] = $id ? UserSector::findOrFail($id) : null;

        //Listas
        $this->data['users'] = User::all();
        $this->data['countries'] = Country::all();
        $this->data['states'] = ($this->data['data']) ? State::where('country_id', $this->data['data']->country_id)->get() : null;
        $this->data['cities'] = ($this->data['data']) ? City::where('state_id', $this->data['data']->state_id)->get() : null;
        $this->data['townships'] = ($this->data['data']) ? Township::where('city_id', $this->data['data']->city_id)->get() : null;

        return $this->view($request, 'user_sectors.edit');
    }

    public function updateUserSector(UpdateUserSectorRequest $request, $id = null) 
    {
    	$user_sector=$id?UserSector::findOrFail($id):new UserSector;

    	if (!$id) 
    	{
    		$search = UserSector::where('user_id', $request->get('user_id'))
    						->where('country_id', $request->get('country_id') ? : null)
    						->where('state_id', $request->get('state_id') ? : null)
    						->where('city_id', $request->get('city_id') ? : null)
    						->where('township_id', $request->get('township_id') ? : null)->first();
                            
    		if ($search) {
    			return back()->with('error', trans('user_sector.user_sector_exist'))->withInput($request->all());
    		}
    	}

    	$user_sector->user_id = $request->get('user_id');
    	$user_sector->country_id = ($request->get('country_id')) ? : null;
    	$user_sector->state_id = ($request->get('state_id')) ? : null;
    	$user_sector->city_id = ($request->get('city_id')) ? : null;
    	$user_sector->township_id = ($request->get('township_id')) ? : null;
    	$user_sector->save();

    	return redirect('user/sectors')->with('msg', trans('globals.success_alert_content'));
    }

    public function removeUserSector(Request $request, $id) 
    {
    	$user_sector=UserSector::findOrFail($id);
        $user_sector->delete();
        
        return redirect('/user/sectors')->with('msg', trans('globals.success_alert_content'));
    }
}
