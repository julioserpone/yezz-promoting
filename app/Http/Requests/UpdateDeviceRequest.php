<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class UpdateDeviceRequest extends Request
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
        
        $rules = [
            "code"=>"required|max:255",
            "type"=>"required",
        ];

        foreach (trans('locale') as $key => $value) {
            $rules['name_'.$key]="required|max:255";
        }

        //Verifica que exista al menos un valor en el array de valores para la caracteristica que se esta modificando
        //Para laravel, las validaciones para los tipos Array requieres devolver un error por cada valor del array
        if (!count(array_filter($this->input('values')))) {
            $rules['values[]']="required_if:type,closed|array";   
        }

        return $rules;
    }

    protected function formatErrors(Validator $validator)
    {
        $errors = parent::formatErrors($validator);
        //Para el caso de los Array, debo formatear o renombrar el arreglo para que Blade pueda reconocerlo. Por algun motivo, cuando se busca
        //el mensaje de error para la variable tipo Array (values[]), blade no la consigue. Esta hipotesis es un 80% segura. Hay que investigar mas a fondo porque del error
        //Quizas sea un mal uso de la validacion para este tipo de Array donde no todos los valores son obligatorios
        foreach ($errors as $attribute => $eachError) {
            if ($attribute == 'values[]') {
                $errors['feature_values'] =  $eachError;
            }
        }

        return $errors;
    }
}
