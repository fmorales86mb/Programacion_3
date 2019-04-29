<?php
    //include_once "./acciones/archivos.php";

    class Proveedor{
        
        public $id;
        public $nombre;
        public $email;
        public $urlImagen;
                
        private $fileUrlImage = "./data/imagenes/";
        
        public static $fileUrlTxt = "./data/proveedores.txt";

        function __construct($strArray, $urlImagen = "-"){
            $this->id = $strArray["id"];
            $this->nombre = $strArray["nombre"];
            $this->email = $strArray["email"];
            $this->urlImagen = $urlImagen;
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