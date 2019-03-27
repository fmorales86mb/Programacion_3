<?php
    class Alumno{
        public $nombre;
        public $apellido;
        public $edad;

        public function __construct($nom, $ape, $ed)
        {
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->edad = $ed;
        }

        public function ToCsv()
        {
            return "$this->nombre; $this->apellido; $this->edad <br>";
        }

        public function ToJson()
        {
            return json_encode($this);
        }
    }
?>