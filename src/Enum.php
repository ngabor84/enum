<?php

namespace Enum;

abstract class Enum {

    protected $value;

    protected static $optionsCache = [];

    public function __construct($value = null) {
        if ($value !== null) {
            $this->setValue($value);
        }
    }

    public function __toString() {
        return (string) $this->value;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        static::validateValue($value);
        $this->value = $value;
    }

    public function isEqualTo(Enum $enum) : bool {
        return $this->value == $enum->getValue();
    }

    protected static function validateValue($value) {
        if (!static::isValidValue($value)) {
            throw new \InvalidArgumentException($value . ' is not a valid value!');
        }
    }

    public static function isValidValue($value) : bool {
        return in_array($value, static::listValues());
    }

    public static function isValidKey($key) {
        return in_array($key, static::listKeys());
    }

    public static function getKeyByValue($value) : string {
        static::validateValue($value);

        return array_search($value, static::listOptions());
    }

    public static function listOptions() : array {
        if (!isset(self::$optionsCache[static::class])) {
            $reflect = new \ReflectionClass(static::class);
            self::$optionsCache[static::class] = $reflect->getConstants();
        }

        return self::$optionsCache[static::class];
    }

    public static function listKeys() : array {
        return array_keys(self::listOptions());
    }

    public static function listValues() : array {
        return array_values(self::listOptions());
    }

    public static function getDefaultValue() {
        $values = self::listValues();

        return !empty($values) ? $values[0] : null;
    }

    public static function isDefaultValue($value) {
        return $value == self::getDefaultValue();
    }

}
