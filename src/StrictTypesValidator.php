<?php

declare(strict_types=1);

namespace TrueIfNotFalse\LumenStrictValidation;

class StrictTypesValidator
{
    protected const NATIVE_TYPE_INT    = 'integer';
    protected const NATIVE_TYPE_FLOAT  = 'double';
    protected const NATIVE_TYPE_BOOL   = 'boolean';
    protected const NATIVE_TYPE_STRING = 'string';
    protected const NATIVE_TYPE_ARRAY  = 'array';

    public const TYPE_MAP = [
        'int'     => self::NATIVE_TYPE_INT,
        'integer' => self::NATIVE_TYPE_INT,
        'float'   => self::NATIVE_TYPE_FLOAT,
        'double'  => self::NATIVE_TYPE_FLOAT,
        'bool'    => self::NATIVE_TYPE_BOOL,
        'boolean' => self::NATIVE_TYPE_BOOL,
        'string'  => self::NATIVE_TYPE_STRING,
        'array'   => self::NATIVE_TYPE_ARRAY,
    ];

    /**
     * @param string $attribute
     * @param mixed  $value
     * @param mixed  $parameters
     *
     * @return bool
     */
    public function validate($attribute, $value, $parameters): bool
    {
        if (empty($parameters)) {
            return false;
        }

        $valueType    = gettype($value);
        $requiredType = $parameters[0];

        return $valueType === static::TYPE_MAP[$requiredType];
    }
}
