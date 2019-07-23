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

        public static function InsertLog($usuarioId, $fecha){
            $retorno = true;                                   
            $query = "INSERT INTO `log`(`fecha`, `usuario_id`) VALUES (:fecha, :id)";            

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':fecha',  $fecha, PDO::PARAM_STR);
                $sentencia->bindValue(':id',  $usuarioId, PDO::PARAM_INT); 
                
                $sentencia->execute();                                 
            } catch (PDOException $e) {
                $retorno = false;                  
            }
            
            return $retorno;
        }  
        
        public static function GetLogs(){
            $retorno = false;           
            $query = 
            "SELECT * FROM `log`";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query);                 
                
                $sentencia->execute();                 
                $retorno = $sentencia->fetchAll(PDO::FETCH_ASSOC);                                                   
            } catch (PDOException $e) {
                $retorno = false;                  
            }
            
            return $retorno;
        }
    }
?>