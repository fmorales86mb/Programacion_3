<?php
    include_once "./acciones/archivos.php";
    include_once "./entidades/proveedor.php";
    include_once "./acciones/imagenes.php";

    class ProveedorDb{
        private static $fileUrlTxt = "./data/proveedores.txt";

        // Devuelve una lista de objetos Proveedor.
        public static function GetProveedores(){
            $objArray = Archivos::ExtraerMatizArchCsv(ProveedorDb::$fileUrlTxt);            
            $listaProveedores = array();            
            
            for($i =0; $i<count($objArray); $i++){                          
                $proveedor = new Proveedor($objArray[$i], $objArray[$i]["urlImagen"]);              
                $listaProveedores[] = $proveedor;         
            }
  
            return $listaProveedores;
        }

        // Devuelve una lista de objetos Proveedor por nombre.
        public static function GetProveedoresByNombre($nombre){
            $objArray = Archivos::ExtraerMatizArchCsv(ProveedorDb::$fileUrlTxt);   
            $listaProveedores = array();                                         

            for($i =0; $i<count($objArray); $i++){                          
                $proveedor = new Proveedor($objArray[$i], $objArray[$i]["urlImagen"]);  
                if($proveedor->nombre == $nombre){
                    $listaProveedores[] = $proveedor;                    
                }
            }
            
            return $listaProveedores;
        }

        // Devuelve un objeto Proveedor por id.
        public static function GetProveedorById($id){            
            $objArray = Archivos::ExtraerMatizArchCsv(ProveedorDb::$fileUrlTxt);   
            $proveedor;                     

            for($i =0; $i<count($objArray); $i++){                          
                $proveedorAux = new Proveedor($objArray[$i], $objArray[$i]["urlImagen"]);  
                if($proveedorAux->id == $id){
                    $proveedor = $proveedorAux;
                    break;
                }
            }

            return $proveedor;
        }

        public static function GuardarProveedor($data, $file){
            $proveedor = new Proveedor($data);                        
            $imageUrl = Imagenes::GuardarImagen($file["imagen"], $proveedor->GetImageName());      
            $proveedor->urlImagen = $imageUrl;                  
            return Archivos::EscribirLineaArch(ProveedorDb::$fileUrlTxt, $proveedor->ToTxt());
        }
    }
?>