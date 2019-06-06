<?php
    include_once "./02-entidades/usuario.php";
    include_once "./03-db/usuarioDb.php";
    include_once "./03-db/productoDb.php";
    include_once "./04-acciones/get.php";

    class Post{
        
        public static function CrearUsuario($data){                                 
            return UsuarioDb::GuardarUsuario($data);
        }   
        
        public static function Login($data){
            return UsuarioDb::EvalLogin($data)? "true": "false";
        }

        public static function CargarProducto($data, $file){                                 
            return ProductoDb::GuardarProducto($data, $file);
        }  

        public static function modificarProducto($data, $file){
            return ProductoDb::UpdateProducto($data, $file);
        }
    }

?>