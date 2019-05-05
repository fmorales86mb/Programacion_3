<?php   
    class Proveedor{
        
        public $id;
        public $nombre;
        public $email;
        public $urlImagen;
                
        private $fileUrlImage = "./data/imagenes/";
        
        

        function __construct($strArray, $urlImagen = "-"){            
            $this->id = $strArray["id"];            
            $this->nombre = $strArray["nombre"];
            $this->email = $strArray["email"];
            $this->urlImagen = $urlImagen;
            //var_dump($this);
        }        

        function ToJsonStr(){
            return json_encode($this);
        }

        function ToTxt(){
            return "id:$this->id,nombre:$this->nombre,email:$this->email,urlImagen:$this->urlImagen,";
        }

        function GetImageName(){
            $p = "$this->fileUrlImage$this->id-$this->nombre";            
            return $p;
        }
    }
?>