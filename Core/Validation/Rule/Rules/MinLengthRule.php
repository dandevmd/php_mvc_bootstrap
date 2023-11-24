<?php

namespace app\Core\Validation\Rule\Rules;

use app\Core\Validation\Rule\Rule;

class MinLengthRule extends Rule
{
    private $minLength;

    public function __construct($minLength)
    {
        parent::__construct('minLength', "Must be at least $minLength characters");
        $this->minLength = $minLength;
    }

    public function validate($fieldValue): bool
    {
        return strlen($fieldValue) >= $this->minLength;
    }
}