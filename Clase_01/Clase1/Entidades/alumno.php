<?php
include_once "./Entidades/persona.php"; //Se agrega la ruta del archivo desde donde se ejecuta.

class Alumno extends Persona{
    public $legajo;

    function __constrcut($nombre, $apellido, $dni, $leg)
    {
        parent::__constrcut($nombre, $apellido, $dni);
        $this->legajo = $leg;
    }

    public function ToJson()
    {
        return json_encode($this);
    }
}
?>