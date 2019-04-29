<?php
    class Imagenes{
        
        public static function GuardarImagen($fileData, $destino){
            $extension = explode("/", $fileData["type"]);
            $origen = $fileData["tmp_name"];             
            $retorno = "Error.";

            if(move_uploaded_file($origen, "$destino.$extension[1]")){
                $retorno = "$destino.$extension[1]";
            }

            return $retorno;
        }
    }

?>