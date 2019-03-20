<?php
class Humano{
    public $nombre;
    public $apellido;

    function __construct($nom, $ape)
    {
        $this ->nombre = $nom;
        $this->apellido = $ape;
    }

    function ToJson()
    {
        return json_encode($this);
    }
}
?>