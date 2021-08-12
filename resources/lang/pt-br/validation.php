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

    'email' => 'O campo ":attribute" precisa ser um e-mail válido.',
    'present' => 'O campo ":attribute" precisa estar presente.',
    'required' => 'O campo ":attribute" precisa ser preenchido.',
    'string' => 'O campo ":attribute" precisa ser do tipo texto.',
    'numeric' => 'O campo ":attribute" precisa ser um número.',
    'integer' => 'O campo ":attribute" precisa ser um número inteiro.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'nome do vendedor',
        'seller_id' => 'identificação do vendedor',
        'sale_value' => 'valor da venda'
    ],
];
