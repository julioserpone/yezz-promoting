<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateClientRequest extends Request
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
            "name"          =>"required|max:255",
            "surname"       =>"required|max:255",
            "address"       =>"present",
            "store_position"=>"present|max:255",
            "phone"         =>"present|max:255",
            "email"         =>"present|max:255",
        ];
    }
}
