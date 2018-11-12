<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username"      => "required|max:255",
            "email"         => "required|email|max:255",
            "country"       => "required|exists:countries,id",
            "firstName"     => "required|max:255",
            "lastName"      => "required|max:255",
            "personCountry" => "present|exists:countries,id",
            "code"          => "present|max:50",
            "address"       => "present",
            "birthdate"     => "present|date_format:d-m-Y",
            "gender"        => "present|in:".implode(",",array_keys(trans('profile.arrayGender'))),
            "description"   => "present",
        ];
    }
}
