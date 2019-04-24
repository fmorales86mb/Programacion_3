<?php
    include_once "./entidades/proveedor.php";

    class Post{
        
        public static function CargarProveedor($data){
            $proveedor = new Proveedor($data);
            $txt = $proveedor->ToJsonStr();
            Archivos::EscribirLineaArch(Proveedor::$fileUrl, $txt);
        }
    }

?>