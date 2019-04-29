<?php
    include_once "./entidades/proveedor.php";
    include_once "./acciones/imagenes.php";

    class Post{
        
        public static function CargarProveedor($data, $file){            
            $proveedor = new Proveedor($data);            
            $imageUrl = Imagenes::GuardarImagen($file["imagen"], $proveedor->GetImageName());      
            $proveedor->urlImagen = $imageUrl;                  
            Archivos::EscribirLineaArch(Proveedor::$fileUrlTxt, $proveedor->ToTxt());
        }
    }

?>