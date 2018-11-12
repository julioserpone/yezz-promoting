<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LocalizationController extends YezzController
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

    public function showMap(Request $request, $module = null)
    {
        $this->data['users'] = User::all();
        return $this->view($request, 'localization.manager');
    }

    public function getHours(Request $request, $id, $date)
    {
        $data = ['data' => false];

        if ($id != 'null' && intval($id) > 0) {

            $hours = DB::table('localization_log as L')
                ->leftJoin('branchs', 'L.store_id', '=', 'branchs.id')
                ->select(
                    'L.latitude as latitude', 
                    'L.longitude as longitude', 
                    DB::raw("concat(branchs.name,' - ',DATE_FORMAT(L.registerOn,'%H:%i:%s %p')) as info"),
                    DB::raw("DATE_FORMAT(L.registerOn,'%H:%i:%s %p') as time")
                )
                ->where('L.user_id', $id)
                ->whereRaw("DATE(L.registerOn) = '".Carbon::parse($date)->format('Y-m-d')."'")
                ->get();

            if ($hours) {
                $data['data'] = $hours;
            }
        }
        return response()->json($data);
    }
}
