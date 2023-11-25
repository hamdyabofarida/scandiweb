<?php

namespace Model;

class Validation
{

    private static $errors = [];

    public static function required($attr, $args)
    {
        if (empty($_POST[$attr]) || $_POST[$attr] == 'undifiend' || $_POST[$attr] == 'DefaultType') {
            self::$errors[$attr] = $attr . ' is required';
        }
    }
    public static function digits($attr, $args)
    {
        if (!empty($_POST[$attr]) && !is_numeric($_POST[$attr])) {
            self::$errors[$attr] = $attr . ' must be number';
        }
    }
    public static function unique($attr, $args)
    {
        $result = Db::query("SELECT * FROM $args[0] WHERE $attr=:data", [':data' => $_POST[$attr]]);
        if (!empty($_POST[$attr]) && !empty($result)) {
            self::$errors[$attr] = $attr . ' that you entered is already exist';
        }
    }

    // Custom validation rules

    public static function validate($rules)
    {
        foreach ($rules as $attrName => $fArr) {
            foreach ($fArr as $fName => $fValue) {
                self::$fName($attrName, $fValue);
            }
        }
    }

    public static function getErrors(): array
    {
        return self::$errors;
    }
}
