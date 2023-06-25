<?php

namespace App\Utils;

class AlertMessage{
    private $type;
    private $message;

    function __construct($type, $message){
        $this->type = $type;
        $this->message = $message;
    }

    function __get($name){
        return $this->$name;
    }

    public static function CREATE() : AlertMessage{
        return new AlertMessage('messagem','operação realizada com sucesso');
    }

    public static function WARNING() : AlertMessage{
        return new AlertMessage('aviso','actualizado com successo');
    }

    public static function SUCCESS() : AlertMessage{
        return new AlertMessage('realizado','operação reaizada com successo');
    }

    public static function DANGER() : AlertMessage{
        return new AlertMessage('erro','operação não realizada');
    }


}
