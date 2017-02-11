<?php

namespace Enum;

abstract class Enum {

    protected $value;
    protected static $valuesCache = [];

    public function __construct($value = null) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public static function listOptions() {
        if (!isset(self::$valuesCache[static::class])) {
            $reflect = new \ReflectionClass(static::class);
            self::$valuesCache[static::class] = $reflect->getConstants();
        }

        return self::$valuesCache[static::class];
    }

    public static function listKeys() {
        return array_keys(self::listOptions());
    }

    public static function listValues() {
        return array_values(self::listOptions());
    }

}
