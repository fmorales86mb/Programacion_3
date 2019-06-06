<?php
    include_once "./01-fwk/archivos.php";
    include_once "./02-entidades/usuario.php";
    
    class UsuarioDb{        
        private static $fileUrlTxt = "./05-data/usuarios.txt";

        // Devuelve una lista de objetos.
        public static function GetUsuarios(){
            $objArray = Archivos::ExtraerMatizArchCsv(UsuarioDb::$fileUrlTxt);            
            $lista = array();            
            
            for($i =0; $i<count($objArray); $i++){                          
                $usuario = new Usuario($objArray[$i]);              
                $lista[] = $usuario;         
            }
  
            return $lista;
        }

        // Guarda un usuario. Retorna el registro guardado en txt.
        public static function GuardarUsuario($data){
            $usuario = new Usuario($data);   
            if(UsuarioDb::EvalNameUsuario($usuario->nombre)){
                return "Usuario ya existe.";
            }               
            else{
                return Archivos::EscribirLineaArch(UsuarioDb::$fileUrlTxt, $usuario->ToTxt());
            }                               
        }

        // True si ya existe el nombre, false en caso contrario.
        public static function EvalNameUsuario($nombre){
            $list = UsuarioDb::GetUsuarios();
            $existe = false;
            
            foreach($list as $item){
                if($item->nombre == $nombre){
                    $existe = true;
                    break;
                }
            }

            return $existe;
        }

        // Devuelve una lista de objetos Usuario por nombre.
        public static function GetUsuariosByNombre($nombre){
            $objArray = Archivos::ExtraerMatizArchCsv(UsuarioDb::$fileUrlTxt);   
            $lista = array();                                         

            for($i =0; $i<count($objArray); $i++){                          
                $elemento = new Usuario($objArray[$i]);  
                if (strcasecmp($elemento->nombre, $nombre) == 0){
                //if($elemento->nombre == $nombre){
                    $lista[] = $elemento;                    
                }
            }
            
            return $lista;
        }

        // Evalua si usuario y contraseña son correctos.
        public static function EvalLogin($data){
            $list = UsuarioDb::GetUsuarios();
            $usuario = new Usuario($data);
            $login = false;

            foreach($list as $item){
                if($item->nombre == $usuario->nombre &&
                    $item->clave == $usuario->clave){
                        $login = true;
                        break;
                    }                    
            }
            
            return $login;
        }

        
    }
?>