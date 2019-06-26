<?php    
    include_once "./02-Entidades/Usuario.php";
    include_once "./03-DAO/AccesoDatos.php";  
    include_once "./01-Fwk/imagenes.php";   

    class UsuarioDAO{   
        const CLASSNAME = 'Usuario';
        
        #region Métodos
        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = false;           
            
            $query = "INSERT INTO `usuario`(`nombre`, `clave`, `tipo`) ";
            $query .="VALUES (:nombre, :clave, :tipo)";                         
                        
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':clave',  $elemento->clave, PDO::PARAM_STR); 
                $sentencia->bindValue(':tipo',  $elemento->tipo, PDO::PARAM_STR);                                    
                
                $sentencia->execute(); 
                
                $retorno = true; //retorna true si no inserta también.                                                                          
            } catch (PDOException $e) {
                $retorno = false;
            }
        
            return $retorno;
        }

        // Consulta usuario
        public static function ConsultarUsuario($elemento){
            $retorno = false;           
            $query = 
            "SELECT u.legajo, u.nombre, u.clave, u.tipo
            FROM usuario as u
            WHERE                 
                u.legajo = :legajo AND
                u.clave = :clave";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':legajo',  $elemento->legajo, PDO::PARAM_INT);
                $sentencia->bindValue(':clave',  $elemento->clave, PDO::PARAM_STR); 
                
                $sentencia->execute();                 
                $retorno = $sentencia->fetch();                                     
            } catch (PDOException $e) {
                $retorno = false;                  
            }
            
            return $retorno;
        }

        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function InsertAlumno($elemento){
            $retorno = false;           
            
            $query = "UPDATE usuario set usuario.email = :email, usuario.foto = :foto WHERE usuario.legajo = :legajo"; 
            
            //guardo imagen
            // $imageUrl = Imagenes::GuardarImagen(
            //     $file["foto"], 
            //     "./img/$elemento->legajo");      
            
            // $foto = $imageUrl;  
                        
            $foto = "foto";

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':legajo',  $elemento->legajo, PDO::PARAM_INT);
                $sentencia->bindValue(':foto',  $foto, PDO::PARAM_STR); 
                $sentencia->bindValue(':email',  $elemento->email, PDO::PARAM_STR);                                    
                
                $sentencia->execute(); 
                
                $retorno = true; //retorna true si no inserta también.                                                                          
            } catch (PDOException $e) {
                $retorno = false;
            }

            return $retorno;
        }

        #endregion
         
        

        #region Métodos Sin Usar
        /*

        

        // Traigo todos los Elementos de la DB.
        public static function GetAll(){
            $retorno = array();           
            
            $query = "SELECT * FROM `usuario`";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                
                $sentencia->execute(); 
                                
                $retorno = $sentencia->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);                                                                                      
            } catch (PDOException $e) {
                $retorno = -1;                 
            }
            
            return $retorno;
        }
        
        // Traigo Elemento por id.
        public static function GetById($id){
            $retorno = null;                       
            
            $query = "SELECT `id`, `nombre`, `rol` FROM `usuario` WHERE `id` = :id";            

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':id',  $id, PDO::PARAM_INT); 
                
                $sentencia->execute(); 
                
                $retorno = $sentencia->fetchObject(self::CLASSNAME);                                    
                                                  
            } catch (PDOException $e) {
                $retorno = -1;                  
            }
            
            return $retorno;
        }   
        
                

        // Modifica los datos de un elemento en la DB por el id.
        public static function Update($elemento, $clave){
            $retorno = false;           
            
            $query = "UPDATE `usuario` SET `nombre`= :nombre, `clave`= :clave, `rol`=:rol WHERE `id`= :id";                        
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':id',  $elemento->id, PDO::PARAM_INT);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':clave',  $clave, PDO::PARAM_STR); 
                $sentencia->bindValue(':rol',  $elemento->rol, PDO::PARAM_INT);                  
                
                $sentencia->execute(); 
                
                $retorno = true;                                  
            } catch (PDOException $e) {
                $retorno = false;
            }        
            
            return $retorno;
        }

        // Borra el registro de un elemento en DB por el id.
        public static function Delete($id){
            $retorno = false;           
            $query = "DELETE FROM `usuario` WHERE id = :id";
            
            try {
                $db = AccesoDatos::DameUnObjetoAcceso(); 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':id',  $id, PDO::PARAM_INT);
                
                $sentencia->execute(); 
                
                $retorno = true;                                          
            } catch (PDOException $e) {
                $retorno = false;
            }
            
            return $retorno;
        }

        
        */
        #endregion

    }
?>