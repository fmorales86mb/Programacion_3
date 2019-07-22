<?php    
    include_once "./02-Entidades/Usuario.php";
    include_once "./03-DAO/AccesoDatos.php";  
    include_once "./01-Fwk/imagenes.php";   

    class UsuarioDAO{   
        const CLASSNAME = 'Usuario';
        
        #region Métodos
        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = true;           
            
            $query = 
            "INSERT INTO `usuario`(`nombre`, `clave`, `rol`, `sector`) 
             VALUES (:nombre, :clave, :rol, :sector)";                         
                             
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':clave',  $elemento->clave, PDO::PARAM_STR); 
                $sentencia->bindValue(':rol',  $elemento->rol, PDO::PARAM_STR);                 
                $sentencia->bindValue(':sector',  $elemento->sector, PDO::PARAM_STR);                                    
                
                $sentencia->execute();                                                                           
            } catch (PDOException $e) {
                $retorno = false;
            }
        
            return $retorno;
        }

        // Consulta usuario
        public static function ConsultarUsuario($elemento){
            $retorno = false;           
            $query = 
            "SELECT u.id, u.rol, u.nombre, u.estado, u.sector
            FROM usuario as u
            WHERE                 
                u.nombre = :nombre AND
                u.clave = :clave";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':clave',  $elemento->clave, PDO::PARAM_STR); 
                
                $sentencia->execute();                 
                $retorno = $sentencia->fetchObject(self::CLASSNAME);                                                   
            } catch (PDOException $e) {
                $retorno = false;                  
            }
            
            return $retorno;
        }

        public static function GetById($id){
            $retorno = null;                                   
            $query = 
            "SELECT u.legajo, u.nombre, u.clave, u.tipo
            FROM usuario as u
            WHERE                 
                u.legajo = :legajo";            

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':legajo',  $id, PDO::PARAM_INT); 
                
                $sentencia->execute();                 
                $retorno = $sentencia->fetchObject(self::CLASSNAME);                                                                                      
            } catch (PDOException $e) {
                $retorno = -1;                  
            }
            
            return $retorno;
        }   

        // Agrega email y urlFoto en la db y guarda la foto en carpeta local.
        public static function UpdateAlumno($elemento, $imagen){
            $retorno = true;                       
            $query = "UPDATE usuario set usuario.email = :email, usuario.url_imagen = :foto WHERE usuario.legajo = :legajo"; 
            
            // guardo imagen
            $imageUrl = Imagenes::GuardarImagen(
                $imagen, 
                "./05-Img/$elemento->legajo");      
            
            $foto = $imageUrl;  

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':legajo',  $elemento->legajo, PDO::PARAM_INT);
                $sentencia->bindValue(':foto',  $foto, PDO::PARAM_STR); 
                $sentencia->bindValue(':email',  $elemento->email, PDO::PARAM_STR);                                    
                
                $sentencia->execute();                                                                                                          
            } catch (PDOException $e) {
                $retorno = false;
            }

            return $retorno;
        }

        // Agrega email en la db.
        public static function UpdateProfesor($legajo, $email){
            $retorno = true;                       
            $query = "UPDATE usuario set usuario.email = :email WHERE usuario.legajo = :legajo";                         
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':legajo',  $legajo, PDO::PARAM_INT);                
                $sentencia->bindValue(':email',  $email, PDO::PARAM_STR);                                    
                
                $sentencia->execute();                                                                                                          
            } catch (PDOException $e) {
                $retorno = false;
            }

            return $retorno;
        }

        // Traigo todos los alumnos por materia.
        public static function GetAlumnosByMateria($materia){
            $retorno = array();           
            
            $query = 
            "SELECT u.legajo, u.nombre, u.tipo, u.email, u.url_imagen as urlFoto
             FROM usuario as u, materia_alumno as ma
             WHERE
                ma.materia = :materia AND
                ma.alumno = u.legajo";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':materia',  $materia, PDO::PARAM_STR);

                $sentencia->execute(); 
                                
                $retorno = $sentencia->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);                                                                                      
            } catch (PDOException $e) {
                $retorno = -1;                 
            }
            
            return $retorno;
        }
        #endregion
    }
?>