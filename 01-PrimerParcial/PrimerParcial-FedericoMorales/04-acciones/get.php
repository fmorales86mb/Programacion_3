<?php
    include_once "./02-entidades/usuario.php";
    include_once "./02-entidades/producto.php";    
    include_once "./03-db/usuarioDb.php";
    include_once "./03-db/productoDb.php";    
    include_once "./01-fwk/directorios.php";   

    class Get{

        // Devuelve una lista de usuarios con determinado nombre en formato Json.
        public static function GetUsuariosByNombre($nombre){
            $lista = UsuarioDb::GetUsuariosByNombre($nombre);
            $strRespuesta;                              
  
            if(count($lista)<1){
                $strRespuesta = "No existe $nombre.";
            }
            else{
                for($i=0; $i<count($lista); $i++){
                    $strRespuesta[] = $lista[$i];
                }                
            }
            
            return json_encode($strRespuesta);
        }

        // Devuelve la lista de Productos en formato Json. 
        public static function GetProductos(){
            $lista = ProductoDb::GetProductos();
            return json_encode($lista);
        }

        // Devuelve el Producto o Usuario segun los datos pasado.
        public static function GetProductosOUsuarios($criterio, $valor){                        
            switch($criterio){
                case "producto":
                    return json_encode(ProductoDb::GetProductoById($valor));                    
                case "usuario":
                    return Get::GetUsuariosByNombre($valor);                    
                default:
                    return "Error GetProductosOUsuarios";                    
            }

            return json_encode($resultado);
        }
    }
?>