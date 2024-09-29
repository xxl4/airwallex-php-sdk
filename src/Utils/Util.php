<?php
namespace Nicelizhi\Airwallex\Util;

final class Utils {
    public static function isBlank($value) {
        return $value === null || $value === '';
    }

    public static function isNotBlank($value) {
        return !self::isBlank($value);
    }

    public static function isPositiveInteger($value) {
        return is_int($value) && $value > 0;
    }

    public static function isPositiveNumber($value) {
        return is_numeric($value) && $value > 0;
    }

    public static function isNonNegativeInteger($value) {
        return is_int($value) && $value >= 0;
    }

    public static function isNonNegativeNumber($value) {
        return is_numeric($value) && $value >= 0;
    }

    public static function isNonPositiveInteger($value) {
        return is_int($value) && $value <= 0;
    }

    public static function isNonPositiveNumber($value) {
        return is_numeric($value) && $value <= 0;
    }

    public static function isNegativeInteger($value) {
        return is_int($value) && $value < 0;
    }

    public static function isNegativeNumber($value) {
        return is_numeric($value) && $value < 0;
    }

    public static function isBoolean($value) {
        return is_bool($value);
    }

    public static function isString($value) {
        return is_string($value);
    }

    public static function isInteger($value) {
        return is_int($value);
    }

    public static function isNumber($value) {
        return is_numeric($value);
    }

    public static function isArray($value) {
        return is_array($value);
    }

    public static function isObject($value) {
        return is_object($value);
    }

    public static function isCallable($value) {
        return is_callable($value);
    }

    public static function isResource($value) {
        return is_resource($value);
    }

    public static function isScalar($value) {
        return is_scalar($value);
    }

    public static function isNull($value) {
        return is_null($value);
    }

    public static function isNotNull($value) {
        return !self::isNull($value);
    }

    public static function isEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}