<?php

namespace App\RqQueue\Service\Validate;

interface ArrayValidateInterface
{
    public function cursorOnKey(string|int $key): ValidateInterface;
}