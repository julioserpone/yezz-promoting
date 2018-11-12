<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Este campo debe ser aceptada.',
    'active_url'           => 'Este campo no es una URL valida.',
    'after'                => 'Este campo debe ser una fecha despues del :date.',
    'alpha'                => 'Este campo solo puede contener letras.',
    'alpha_dash'           => 'Este campo solo puede contener letras, numeros y guiones.',
    'alpha_num'            => 'Este campo solo puede contener letras y numeros.',
    'alpha_space'          => 'Este campo solo puede contener letras y espacios en blanco.',
    'array'                => 'Este campo debe ser un array.',
    'before'               => 'Este campo debe ser una fecha antes del :date.',
    'between'              => [
        'numeric' => 'Este campo debe estár entre :min y :max.',
        'file'    => 'Este campo debe pesar entre :min y :max kilobytes.',
        'string'  => 'Este campo debe contener entre :min y :max caracteres.',
        'array'   => 'Este campo debe contener entre :min y :max elementos.',
    ],
    'boolean'              => 'Este campo debe ser verdadero o falso.',
    'confirmed'            => 'Este campo no coincide la confirmación.',
    'date'                 => 'Este campo no es una fecha valida.',
    'date_format'          => 'Este campo no coincide con el formato :format.',
    'different'            => 'Este campo y :other deben ser diferentes.',
    'digits'               => 'Este campo debe contener :digits digitos.',
    'digits_between'       => 'Este campo debe contener entre :min y :max digitos.',
    'distinct'             => 'Este campo tiene un valor duplicado.',
    'email'                => 'Este campo debe ser un correo electronico valido.',
    'exists'               => 'Este campo seleccionado es inválido.',
    'filled'               => 'Este campo es requerido.',
    'image'                => 'Este campo debe ser una imagen.',
    'in'                   => 'Este campo seleccionado es inválido.',
    'in_array'             => 'Este campo no existe en :other.',
    'integer'              => 'Este campo debe ser un entero.',
    'ip'                   => 'Este campo debe ser una dirección IP valida.',
    'json'                 => 'Este campo debe ser un JSON valido.',
    'max'                  => [
        'numeric' => 'Este campo no puede ser mayor que :max.',
        'file'    => 'Este campo no puede pesar más de :max kilobytes.',
        'string'  => 'Este campo no puede contener más de :max caracteres.',
        'array'   => 'Este campo no puede tener más de :max elementos.',
    ],
    'mimes'                => 'Este campo de ser un archivo tipo type: :values.',
    'min'                  => [
        'numeric' => 'Este campo al menos debe ser :min.',
        'file'    => 'Este campo al menos debe pesar :min kilobytes.',
        'string'  => 'Este campo al menos debe tener :min caracteres.',
        'array'   => 'Este campo al menos debe tener :min elementos.',
    ],
    'not_in'               => 'Este campo seleccionado es inválido.',
    'numeric'              => 'Este campo debe ser un numero.',
    'present'              => 'Este campo debe estar presente.',
    'regex'                => 'Este campo es inválido.',
    'required'             => 'Este campo es requerido.',
    'required_if'          => 'Este campo es requerido cuando :other es :value.',
    'required_unless'      => 'Este campo es requerido a no ser que :other está en :values .',
    'required_with'        => 'Este campo es requerido cuando :values está presente.',
    'required_with_all'    => 'Este campo es requerido cuando :values estan presente.',
    'required_without'     => 'Este campo es requerido cuando :values no está presente.',
    'required_without_all' => 'Este campo es requerido cuando ninguno de estos valores :values estan presente.',
    'same'                 => 'Este campo y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'Este campo deber ser :size.',
        'file'    => 'Este campo debe pesar :size kilobytes.',
        'string'  => 'Este campo debe tener :size caracteres.',
        'array'   => 'Este campo debe contener :size elementos.',
    ],
    'string'               => 'Este campo debe ser un string.',
    'timezone'             => 'Este campo debe ser un zona valida.',
    'unique'               => 'Este campo existe.',
    'url'                  => 'Este campo es invalido.',

    // 'accepted'             => 'El campo :attribute debe ser aceptada.',
    // 'active_url'           => 'El campo :attribute no es una URL valida.',
    // 'after'                => 'El campo :attribute debe ser una fecha despues del :date.',
    // 'alpha'                => 'El campo :attribute solo puede contener letras.',
    // 'alpha_dash'           => 'El campo :attribute solo puede contener letras, numeros y guiones.',
    // 'alpha_num'            => 'El campo :attribute solo puede contener letras y numeros.',
    // 'array'                => 'El campo :attribute debe ser un array.',
    // 'before'               => 'El campo :attribute debe ser una fecha antes del :date.',
    // 'between'              => [
    //     'numeric' => 'El campo :attribute debe estár entre :min y :max.',
    //     'file'    => 'El campo :attribute debe pesar entre :min y :max kilobytes.',
    //     'string'  => 'El campo :attribute debe contener entre :min y :max caracteres.',
    //     'array'   => 'El campo :attribute debe contener entre :min y :max elementos.',
    // ],
    // 'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    // 'confirmed'            => 'El campo :attribute no coincide la confirmación.',
    // 'date'                 => 'El campo :attribute no es una fecha valida.',
    // 'date_format'          => 'El campo :attribute no coincide con el formato :format.',
    // 'different'            => 'El campo :attribute y :other deben ser diferentes.',
    // 'digits'               => 'El campo :attribute debe contener :digits digitos.',
    // 'digits_between'       => 'El campo :attribute debe contener entre :min y :max digitos.',
    // 'distinct'             => 'El campo :attribute tiene un valor duplicado.',
    // 'email'                => 'El campo :attribute debe ser un correo electronico valido.',
    // 'exists'               => 'El campo :attribute seleccionado es inválido.',
    // 'filled'               => 'El campo :attribute es requerido.',
    // 'image'                => 'El campo :attribute debe ser una imagen.',
    // 'in'                   => 'El campo :attribute seleccionado es inválido.',
    // 'in_array'             => 'El campo :attribute no existe en :other.',
    // 'integer'              => 'El campo :attribute debe ser un entero.',
    // 'ip'                   => 'El campo :attribute debe ser una dirección IP valida.',
    // 'json'                 => 'El campo :attribute debe ser un JSON valido.',
    // 'max'                  => [
    //     'numeric' => 'El campo :attribute may not be greater than :max.',
    //     'file'    => 'El campo :attribute may not be greater than :max kilobytes.',
    //     'string'  => 'El campo :attribute may not be greater than :max characters.',
    //     'array'   => 'El campo :attribute may not have more than :max items.',
    // ],
    // 'mimes'                => 'El campo :attribute must be a file of type: :values.',
    // 'min'                  => [
    //     'numeric' => 'El campo :attribute al menos debe ser :min.',
    //     'file'    => 'El campo :attribute al menos debe pesar :min kilobytes.',
    //     'string'  => 'El campo :attribute al menos debe tener :min caracteres.',
    //     'array'   => 'El campo :attribute al menos debe tener :min elementos.',
    // ],
    // 'not_in'               => 'El campo :attribute seleccionado es inválido.',
    // 'numeric'              => 'El campo :attribute debe ser un numero.',
    // 'present'              => 'El campo :attribute debe estar presente.',
    // 'regex'                => 'El campo :attribute es inválido.',
    // 'required'             => 'El campo :attribute es requerido.',
    // 'required_if'          => 'El campo :attribute es requerido cuando :other es :value.',
    // 'required_unless'      => 'El campo :attribute es requerido a no se que :other está en :values.',
    // 'required_with'        => 'El campo :attribute es requerido cuando :values está presente.',
    // 'required_with_all'    => 'El campo :attribute es requerido cuando :values estan presente.',
    // 'required_without'     => 'El campo :attribute es requerido cuando :values no está presente.',
    // 'required_without_all' => 'El campo :attribute es requerido cuando ninguno de estos valores :values estan presente.',
    // 'same'                 => 'El campo :attribute y :other deben coincidir.',
    // 'size'                 => [
    //     'numeric' => 'El campo :attribute deber ser :size.',
    //     'file'    => 'El campo :attribute debe pesar :size kilobytes.',
    //     'string'  => 'El campo :attribute debe tener :size caracteres.',
    //     'array'   => 'El campo :attribute debe contener :size elementos.',
    // ],
    // 'string'               => 'El campo :attribute debe ser un string.',
    // 'timezone'             => 'El campo :attribute debe ser un zona valida.',
    // 'unique'               => 'El campo :attribute existe.',
    // 'url'                  => 'El campo :attribute es invalido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'servicesUser' => [
            'required_if'   => 'Este campo es requerido cuando el destinatario es un tercero',
            'email'         => 'Este campo debe ser un email valido',
            'exists'        => 'Este usuario no existe en nuestro sistema',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
