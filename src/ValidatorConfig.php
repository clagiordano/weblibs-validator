<?php

namespace clagiordano\weblibs\validator;

/**
 *
 */
class ValidatorConfig
{
    public static $allowedValidator = [
        'required' => 'Required',
        'minlenght' => 'Minlenght',
        'maxlenght' => 'Maxlenght',
        'email' => 'Email',
        'alnum' => 'Alphanumeric',
        'match' => 'Match',
        //'unique' => 'Unique',
        'regexp' => 'Regexp',
    ];
}
