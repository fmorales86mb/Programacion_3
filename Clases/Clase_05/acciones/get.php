<?php
    include_once "./entidades/proveedor.php";
    include_once "./acciones/archivos.php";

    class Get{

        // Devuelve una lista de proveedores con determinado nombre.
        public static function GetProveedorByNombre($nombre){            
            $objArray = Archivos::ExtraerMatizArchCsv(Proveedor::$fileUrlTxt);   
            $listaProveedores = array();           
            $strRespuesta = "Error";                  

            for($i =0; $i<count($objArray); $i++){                          
                $proveedor = new Proveedor($objArray[$i], $objArray[$i]["urlImagen"]);  
                if($proveedor->nombre == $nombre){
                    $listaProveedores[] = $proveedor;
                }
            }
  
            if(count($listaProveedores)<1){
                $strRespuesta = "No existe proveedor $nombre.";
            }
            else{
                $strRespuesta = json_encode($listaProveedores);
            }

            return $strRespuesta;
        }

        // Devuelve la lista de proveedores. 
        public static function GetProveedores(){
            $objArray = Archivos::ExtraerMatizArchCsv(Proveedor::$fileUrlTxt);            
            $listaProveedores;            
            
            for($i =0; $i<count($objArray); $i++){                          
                $proveedor = new Proveedor($objArray[$i], $objArray[$i]["urlImagen"]);              
                $listaProveedores[] = $proveedor;         
            }
  
            return json_encode($listaProveedores);
        }

    }
?>