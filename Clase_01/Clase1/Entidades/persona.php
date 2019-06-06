<?php
include_once "./Entidades/humano.php";

class Persona extends Humano {
    public $dni;
    
    function __construct($nombre, $apellido, $dni_)
    {
        parent :: __construct($nombre, $apellido);
        $this->dni = $dni_;
    }

    function ToJson()
    {
        return json_encode($this);
    }
}
?>