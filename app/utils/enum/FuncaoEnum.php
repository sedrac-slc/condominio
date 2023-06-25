<?php

namespace App\Utils\Enum;

class FuncaoEnum{

    public  static function listAll() : array {
        $default = FuncaoEnum::default();
        return [
            $default->key => $default->value,
            "SECRETARIO" => "Secretário",
            "DIRECTOR" => "Director",
        ];
    }

    public  static function listAllNotDef() : array {
        $array = FuncaoEnum::listAll();
        array_shift($array);
        return $array;
    }

    public static function keys(): array{
        return array_keys(FuncaoEnum::listAll());
    }

    public static function values(): array{
        $array = [];
        foreach(FuncaoEnum::listAll() as $item)
            array_push($array,$item);
        return $array;
    }

    public static function default(): object{
        return (Object)[
            "key" => "NONE",
            "value" => "NONE"
        ];
    }

    public static function defaultKey(): string{
        return FuncaoEnum::default()->key;
    }

    public static function get($key) : string{
        return FuncaoEnum::listAll()[$key];
    }

}
