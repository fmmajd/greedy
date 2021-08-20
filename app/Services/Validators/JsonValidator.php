<?php

namespace App\Services\Validators;

interface JsonValidator
{
    public function validate(array $json): void;
}
