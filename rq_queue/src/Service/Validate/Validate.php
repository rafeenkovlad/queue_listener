<?php

namespace App\RqQueue\Service\Validate;

use AllowDynamicProperties;
use App\RqQueue\Exception\ApiException;

#[AllowDynamicProperties] class Validate extends \stdClass implements ArrayValidateInterface, ValidateInterface
{
    protected static mixed $propertyValueValidate;
    protected static string $propertyNameValidate;

    public function __construct(parent $args)
    {
        foreach ($args as $name => $arg) {
            $this->{$name} = $arg;
        }
    }

    private function initFromArray(string $name, array $args): void
    {
        foreach ($args as $key => $arg) {
            if($arg instanceof parent) {
                $this->{$name}[$key] = new static($arg);
                continue;
            }

            $this->{$name}[$key] = $arg;
        }
    }

    public function setPropertyValidate(string $name): ValidateInterface
    {
        static::$propertyNameValidate = $name;
        static::$propertyValueValidate = &$this->{$name};

        return $this;
    }


    /**
     * @return ValidateInterface
     * @throws ApiException
     */
    public function notBlank(): ValidateInterface
    {
        static::$propertyValueValidate ?? throw ApiException::custom('parameter ' . static::$propertyNameValidate . ' will be not blank', 400);

        return $this;
    }

    /**
     * @return ValidateInterface
     * @throws ApiException
     */
    public function isString(): ValidateInterface
    {
        if(!is_string(static::$propertyValueValidate)) {
            throw ApiException::custom('parameter ' . static::$propertyNameValidate . ' is not string', 400);
        }

        return $this;
    }

    /**
     * @return ValidateInterface
     * @throws ApiException
     */
    public function isBool(): ValidateInterface
    {
        if(!is_bool(static::$propertyValueValidate)) {
            throw ApiException::custom('parameter ' . static::$propertyNameValidate . ' is not bool', 400);
        }

        return $this;
    }

    /**
     * @return ValidateInterface
     * @throws ApiException
     */
    public function isInt(): ValidateInterface
    {
        if(!is_int(static::$propertyValueValidate) || !is_float(static::$propertyValueValidate)) {
            throw ApiException::custom('parameter ' . static::$propertyNameValidate . ' is not integer', 400);
        }

        return $this;
    }

    /**
     * @return ArrayValidateInterface
     * @throws ApiException
     */
    public function isArray(): ArrayValidateInterface
    {
        if(!is_array(static::$propertyValueValidate)) {
            throw ApiException::custom('parameter ' . static::$propertyNameValidate . ' is not array', 400);
        }

        $this->initFromArray(static::$propertyNameValidate, static::$propertyValueValidate);

        return $this;
    }

    /**
     * @return ValidateInterface
     * @throws ApiException
     */
    public function isObject(): ValidateInterface
    {
        if(!is_object(static::$propertyValueValidate)) {
            throw ApiException::custom('parameter ' . static::$propertyNameValidate . ' is not object', 400);
        }

        $this->{static::$propertyNameValidate} = new static(static::$propertyValueValidate);

        return $this;
    }

    public function getValue(): mixed
    {
        return $this->{static::$propertyNameValidate};
    }

    /**
     * @param string|int $key
     * @return ValidateInterface
     */
    public function cursorOnKey(string|int $key): ValidateInterface
    {
        static::$propertyValueValidate = &$this->{static::$propertyNameValidate}[$key];
        static::$propertyNameValidate = $key;

        return $this;
    }

}