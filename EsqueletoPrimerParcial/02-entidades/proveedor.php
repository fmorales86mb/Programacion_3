<?php   
    class Proveedor{
        
        public $id;
        public $nombre;
        public $email;
        public $urlImagen;            
                
        public function __construct($strArray, $urlImagen = "-"){            
            $this->id = $strArray["id"];            
            $this->nombre = $strArray["nombre"];
            $this->email = $strArray["email"];
            $this->urlImagen = $urlImagen;            
        }        

        public function ToJson(){
            return json_encode($this);
        }

        public function ToTxt(){
            return "id:$this->id,nombre:$this->nombre,email:$this->email,urlImagen:$this->urlImagen,";
        }

        public function GetImageName($directorio){
            $url = "$directorio$this->id-$this->nombre";            
            return $url;
        }

        public function GetImageNameBackUp($directorio){
            $fecha = date("Y-m-d.H-i-s");
            $url = "$directorio$this->id.$fecha";            
            return $url;
        }
    }
?>