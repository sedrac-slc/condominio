<?php

namespace App\Utils\Enum;

class UserTypeEnum{


    public  static function listAll() : array {
        return [
            "MORADOR" => "Morador",
            "MEMBRO" => "Membro (comissão)",
        ];
    }

    public static function keys(): array{
        return array_keys(UserTypeEnum::listAll());
    }

    public static function get($key) : string{
        return UserTypeEnum::listAll()[$key];
    }

}
