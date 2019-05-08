<?php   
    class Producto{
        
        public $id;
        public $nombre;
        public $precio;
        public $usuario;
        public $urlImagen;            
                
        public function __construct($strArray, $urlImagen = "-"){            
            $this->id = $strArray["id"];            
            $this->nombre = $strArray["nombre"];
            $this->precio = $strArray["precio"];
            $this->usuario = $strArray["usuario"];
            $this->urlImagen = $urlImagen;            
        }        

        public function ToTxt(){
            return "id:$this->id,nombre:$this->nombre,precio:$this->precio,usuario:$this->usuario,urlImagen:$this->urlImagen,";
        }

        public function GetImageName($directorio){
            $url = "$directorio$this->id-$this->nombre";            
            return $url;
        }

        public function GetImageNameBackUp($directorio){
            $fecha = date("Y-m-d");
            $url = "$directorio$this->id.$fecha";            
            return $url;
        }
    }
?>