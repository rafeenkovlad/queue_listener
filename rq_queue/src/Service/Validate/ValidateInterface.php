<?php

namespace App\RqQueue\Service\Validate;

interface ValidateInterface
{
    public function notBlank(): ValidateInterface;

    public function isString(): ValidateInterface;

    public function isBool(): ValidateInterface;

    public function isInt(): ValidateInterface;

    public function isObject(): ValidateInterface;

    public function getValue(): mixed;
}
