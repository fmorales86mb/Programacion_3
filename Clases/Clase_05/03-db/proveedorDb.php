<?php
    include_once "./01-fwk/archivos.php";
    include_once "./01-fwk/imagenes.php";
    include_once "./02-entidades/proveedor.php";
    
    class ProveedorDb{        
        private static $fileUrlTxt = "./05-data/proveedores.txt";
        private static $fileUrlImage = "./05-data/imagenes/";
        private static $fileUrlImageBackUp = "./05-data/backUpFotos/";

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
            $proveedor = null;                     

            for($i =0; $i<count($objArray); $i++){                          
                $proveedorAux = new Proveedor($objArray[$i], $objArray[$i]["urlImagen"]);  
                if($proveedorAux->id == $id){
                    $proveedor = $proveedorAux;
                    break;
                }
            }

            return $proveedor;
        }

        // Guarda un proveedor y su imagen. Retorna el registro guardado en txt.
        public static function GuardarProveedor($data, $file){
            $proveedor = new Proveedor($data);                        
            
            $imageUrl = Imagenes::GuardarImagen(
                $file["imagen"], 
                $proveedor->GetImageName(ProveedorDb::$fileUrlImage), 
                $proveedor->GetImageNameBackUp(ProveedorDb::$fileUrlImageBackUp)
            );      
            
            $proveedor->urlImagen = $imageUrl;                  
            return Archivos::EscribirLineaArch(ProveedorDb::$fileUrlTxt, $proveedor->ToTxt());
        }

        // Actualiza Provedor por id.
        public static function UpdateProveedor($data, $file){
            $lista = ProveedorDB::GetProveedores();
            $proveedor = new Proveedor($data); 
            $strLista = "";           

            for($i = 0; $i<count($lista); $i++){
                if($lista[$i]->id == $proveedor->id){     
                    // backup de imagen               
                    Imagenes::BackUpImagen($lista[$i]->urlImagen, $lista[$i]->GetImageNameBackUp(ProveedorDb::$fileUrlImageBackUp));

                    $lista[$i]->nombre = $proveedor->nombre;
                    $lista[$i]->email = $proveedor->email; 
                    // reemplazo imagen.
                    $url = Imagenes::GuardarImagen($file["imagen"], $lista[$i]->GetImageName(ProveedorDb::$fileUrlImage));
                    $lista[$i]->urlImagen = $url;                   
                }

                $strLista .= $lista[$i]->ToTxt()."\n";
            }

            return Archivos::SobreEscribirArchivo(ProveedorDb::$fileUrlTxt, $strLista);
        }
    }
?>