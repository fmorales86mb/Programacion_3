<?php   
    class Usuario{
        
        public $clave;
        public $nombre;            
                
        public function __construct($strArray){            
            $this->clave = $strArray["clave"];            
            $this->nombre = $strArray["nombre"];           
        }        

        public function ToTxt(){
            return "clave:$this->clave,nombre:$this->nombre,";
        }
    }
?>