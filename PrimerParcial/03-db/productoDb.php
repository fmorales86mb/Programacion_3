<?php
    include_once "./01-fwk/archivos.php";
    include_once "./01-fwk/imagenes.php";
    include_once "./02-entidades/producto.php";
    include_once "./03-db/usuarioDb.php";

    class ProductoDb{            
        public static $fileUrlTxt = "./05-data/productos.txt";
        private static $fileUrlImage = "./05-data/imagenes/";
        private static $fileUrlImageBackUp = "./backUpFotos/";
        
        // Devuelve una lista de objetos Producto.
        public static function GetProductos(){
            $objArray = Archivos::ExtraerMatizArchCsv(ProductoDb::$fileUrlTxt);            
            $lista = array();            
            
            for($i =0; $i<count($objArray); $i++){                          
                $item = new Producto($objArray[$i], $objArray[$i]["urlImagen"]);              
                $lista[] = $item;         
            }
    
            return $lista;
        }

        // Guarda un producto y su imagen. Retorna el registro guardado en txt.
        public static function GuardarProducto($data, $file){
            $elemento = new Producto($data);  
            $respuesta = "No existe el Usuario.";
            
            if (UsuarioDb::EvalNameUsuario($elemento->usuario)){
                $imageUrl = Imagenes::GuardarImagen(
                    $file["imagen"], 
                    $elemento->GetImageName(ProductoDb::$fileUrlImage));      
                
                $elemento->urlImagen = $imageUrl;                  
                $respuesta = Archivos::EscribirLineaArch(ProductoDb::$fileUrlTxt, $elemento->ToTxt());                
            }

            return $respuesta;
        }

        // Devuelve un objeto Producto por id.
        public static function GetProductoById($id){            
            $lista = ProductoDb::GetProductos();
            $elemento = null;                     

            foreach($lista as $item){
                if($item->id == $id){
                    $elemento = $item;
                    break;
                }
            }

            return $elemento;
        }

        // Actualiza Producto por id.
        public static function UpdateProducto($data, $file){
            $lista = ProductoDb::GetProductos();
            $producto = new Producto($data); 
            $strLista = "";
            $respuesta = "No existe el Usuario.";

            if (UsuarioDb::EvalNameUsuario($producto->usuario)){
                for($i = 0; $i<count($lista); $i++){
                    if($lista[$i]->id == $producto->id){     
                        // backup de imagen               
                        Imagenes::BackUpImagen($lista[$i]->urlImagen, $lista[$i]->GetImageNameBackUp(ProductoDb::$fileUrlImageBackUp));
    
                        $lista[$i]->nombre = $producto->nombre;
                        $lista[$i]->precio = $producto->precio; 
                        $lista[$i]->usuario = $producto->usuario; 
                        // reemplazo imagen.
                        $url = Imagenes::GuardarImagen($file["imagen"], $lista[$i]->GetImageName(ProductoDb::$fileUrlImage));
                        $lista[$i]->urlImagen = $url;                   
                    }
    
                    $strLista .= $lista[$i]->ToTxt()."\n";
                }
    
                $respuesta = Archivos::SobreEscribirArchivo(ProductoDb::$fileUrlTxt, $strLista);
            }
            
            return $respuesta;
        }
    }
?>