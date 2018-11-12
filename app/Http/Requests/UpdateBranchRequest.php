<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateBranchRequest extends Request
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
            "type_id"       =>"required|numeric|exists:type_channels,id",
            "country_id"    =>"required|numeric|exists:countries,id",
            "state_id"      =>"required|numeric|exists:states,id",
            "city_id"       =>"required|numeric|exists:cities,id",
            "category_id"   =>"required|numeric|exists:categories,id",
            "name"          =>"required|max:255",
            "code"          =>"required|max:255",
            "address"       =>"required",

        ];
    }
}
