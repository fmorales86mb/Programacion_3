<?php
    include_once "./acciones/archivos.php";

    class Proveedor{
        
        public $id;
        public $nombre;
        public $email;
                
        public static $directorio = "./imagenes";
        public static $fileUrl = "./data/proveedores.txt";

        function __construct($strArray){
            $this->id = $strArray["id"];
            $this->nombre = $strArray["nombre"];
            $this->email = $strArray["email"];            
        }        

        function ToJsonStr(){
            return json_encode($this);
        }
    }
?>