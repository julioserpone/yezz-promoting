<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProductRequest extends Request
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
            'brand'         =>'required|max:255',
            'model'         =>'required|max:255',
            //'name'          =>'present|max:255',            
        ];
    }
}
