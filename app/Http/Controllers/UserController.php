<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateProfilePictureRequest;
use App\Http\Requests\UpdateContactRequest;

use App\User;
use App\PersonData;
use App\MediaFile;
use App\ContactData;
use App\Country;
use Storage;

class UserController extends YezzController
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

    public function showProfile(Request $request,$id=null)
    {
        $this->data['data']=$id?User::findOrfail($id):$request->user();
        $this->data['countries']=Country::all()->pluck('name', 'id');
        return $this->view($request,'profile.profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user=User::find($request->user()->id);
        
        if ($user->email!=$request->input('email') && 
            $this->exist(User::where('email',$request->input('email')))){
            return back()->withErrors(['email'=>trans('validation.unique')])->withInput();
        }
        if ($user->username!=$request->input('username') && 
            $this->exist(User::where('username',$request->input('username')))){
            return back()->withErrors(['username'=>trans('validation.unique')])->withInput();
        }

        $user->email    =$request->input('email');
        $user->username =$request->input('username');
        $user->country_id  =$request->input('country');
        $user->save();

        $person=PersonData::find($user->person_id);
        $person->identity_code  =$request->input('code');
        $person->first_name     =$request->input('firstName');
        $person->last_name      =$request->input('lastName');
        $person->birthdate      =$this->sqlDate($request->input('birthdate'));
        $person->description    =$request->input('description');
        $person->country_id     =$request->input('personCountry');
        $person->gender         =$request->input('gender');
        $person->address        =$request->input('address');
        $person->save();
        return back()->with('msg',trans('globals.success_alert_content'));
    }

    public function updateProfilePicture(UpdateProfilePictureRequest $request)
    {
        $file=$this->uploadFile($request);
        $person=PersonData::find($request->user()->person_id);
        $person->pic_url=$file->path;
        $person->save();
        return back()->with('msg',trans('globals.success_alert_content'));
    }

    private function uploadFile($request)
    {
        $varName='profile_'.md5(microtime()).'.jpg';
        
        Storage::put(
            'img/profile/'.$varName,
            file_get_contents($request->file('file')->getRealPath()),
            'public'
        );

        $file_old = MediaFile::where('user_id', $request->user()->id)
            ->where('source_id', $request->user()->id)
            ->where('origin', 'picture')
            ->first();
            
        if ($file_old) {
            //Eliminar de Amazon y tambien del registro de media_files
            
            Storage::disk('s3')->delete($file_old->path);
            $file_old->delete();    
        }

        $file=new MediaFile;
        $file->type='image';
        $file->code=$varName;
        $file->path='img/profile/'.$varName;
        $file->user_id=$request->user()->id;
        $file->source_id=$request->user()->id;
        $file->comments='';
        $file->origin='picture';
        $file->save();
        
        return $file;
    }

    public function updateContact(UpdateContactRequest $request)
    {
        ContactData::where('origin','user')->where('source_id',$request->user()->person_id)->delete();
        foreach (trans('profile.arrayContact') as $key => $value) {
            if ($request->input($key)){
                foreach ($request->input($key) as $row) {
                    $contact=new ContactData;
                    $contact->data=$row;
                    $contact->type=$key;
                    $contact->origin='user';
                    $contact->source_id=$request->user()->person_id;
                    $contact->save();
                }
            }
        }
        
        return back()->with('msg',trans('globals.success_alert_content'));
    }
}
