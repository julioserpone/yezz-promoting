<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class YezzController extends Controller
{
	protected $data=[];

	protected function view(Request $request,$module)
	{
		if ($request->user()){
			$this->data['user']=$request->user();
		}
		return view($module,$this->data);		
	}

    protected function sqlDate($date)
    {
        return date('Y-m-d',strtotime($date));
    }

    protected function exist($build)
    {
        return !$build?null:$build->select('id')->first();
    }

    protected function filter($build,$request,$array)
    {
        
        return !$build?null:$build->select('id')->first();
    }


    // private function view($request, $content)
    // {
    //     $this->data['content']=$content;
    //     switch ($this->data["user"]->status) {       
    //         case 'active':
    //             $this->data['profilePercentage']=$this->getProfilePercentage($request);
    //             if (isset($this->data["temp-user"])){
    //                 $this->data["user"]=$this->data["temp-user"];
    //                 unset($this->data["temp-user"]);
    //             }
    //             if ($request->ajax()) {
    //                 return view('templateModal', $this->data);
    //             } else {
    //                 return view('templateView', $this->data);
    //             }
    //         case 'pending':
    //         case 'interview':
    //             return view('profile.validateEmail', $this->data);
            
    //         case 'pending-interview':
    //             return view('profile.pendingInterview', $this->data);

    //         case 'terms-conditions':
    //             $this->data['termsAndconditions']=env('TERMS_AND_CONDITIONS_ID')?SystemContent::find(env('TERMS_AND_CONDITIONS_ID')):null;
    //             return view('profile.termsConditions', $this->data);
    //         case 'inactive':
    //             return redirect('/logout')->with('error', trans('dashboard.inactiveStatus'));
    //     }
    // }
}
