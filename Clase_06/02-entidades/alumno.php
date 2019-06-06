<?php   
    class Alumno{
        
        public $id;
        public $nombre;
        public $legajo;
        public $localidad;                            
                
        public function __construct($strArray){            
            // Para que el FETCH_ALL instancie correctamente.
            if($strArray !== null){ 
                $this->id = $strArray["id"];            
                $this->nombre = $strArray["nombre"];
                $this->legajo = $strArray["legajo"];     
                $this->localidad = $strArray["localidad"];         
            }            
        }        
    }
?>