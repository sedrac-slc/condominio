<?php

namespace App\Utils\Enum;

class MesEnum{


    public  static function listAll() : array {
        return [
            'JANEIRO' => 'Janeiro', 'FEVEREIRO' => 'Fevereiro', 'MARCO' => 'Março',
            'ABRIL' => 'Abril', 'MAIO' => 'Maio','JUNHO' => 'Junho',
            'JULHO' => 'Julho','AGOSTO' => 'Agosto', 'SETEMBRO' => 'Setembro',
            'OUTUBRO' => 'Outubro','NOVEMBRO' => 'Novembro', 'DEZEMBRO' => 'Dezembro'
        ];
    }

    public static function keys(): array{
        return array_keys(MesEnum::listAll());
    }

    public static function get($key) : string{
        return MesEnum::listAll()[$key];
    }

}
