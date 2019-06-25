<?php
    include_once "./02-Entidades/Identificadores.php";
    include_once "./02-Entidades/Log.php";
    include_once "./03-DAO/AccesoDatos.php"; 
    include_once './05-Interfaces/IDaoABM.php';   

    class LogDAO {   
        const CLASSNAME = 'Log';
        
        #region Métodos
        // Guarda un elemento. Retorna true siempre - ver
        public static function Insert($elemento){
            $retorno = false;           
            
            $query = "INSERT INTO `log`(`usuario`, `metodo`, `ruta`) VALUES (:usuario, :metodo, :ruta)";

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':usuario',  $elemento->articulo, PDO::PARAM_STR);                 
                $sentencia->bindValue(':metodo',  $elemento->precio, PDO::PARAM_STR);                 
                $sentencia->bindValue(':ruta',  $elemento->usuarioId, PDO::PARAM_STR); 

                $sentencia->execute();                     
                $retorno = true;                                                                          
            } catch (PDOException $e) {
                $retorno = false;
            }
            
            return $retorno;
        }
        #endregion
        
        #region
        /*

                // Traigo todos los Elementos de la DB.
        public static function GetAllByRol($rol){
            $retorno = array();           
            
            $queryAdmin =
            "SELECT c.articulo, c.fecha_compra as fecha, c.precio 
            FROM compra as c";
           
           $queryUsuario =
            "SELECT c.articulo, c.fecha_compra as fecha, c.precio 
            FROM compra as c, usuario as u 
            WHERE
                c.usuario_id = u.id AND
                u.perfil = :rol"; 
            
            $query = $rol === "admin"? $queryAdmin : $queryUsuario;
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':rol',  $rol, PDO::PARAM_STR);

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
            
            $query = "SELECT id, nombre, rol_encargado as rolEncargado, precio FROM `producto` WHERE id= :id";
            
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
        
        

        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = false;           
            
            $query = "INSERT INTO `producto`(`nombre`, `rol_encargado`, `precio`) VALUES (:nombre, :rol, :precio)";                        

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':rol',  $elemento->rolEncargado, PDO::PARAM_INT); 
                $sentencia->bindValue(':precio',  $elemento->precio, PDO::PARAM_INT);                 
                
                $sentencia->execute();                     
                $retorno = true;                                                                          
            } catch (PDOException $e) {
                $retorno = false;
            }
            
            return $retorno;
        }

        // Modifica los datos de un elemento en la DB por el id.
        public static function Update($elemento){
            $retorno = null;           
            $query = "UPDATE `producto` SET `nombre`= :nombre, `rol_encargado`= :rol, `precio`= :precio WHERE id = :id";                    
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':id',  $elemento->id, PDO::PARAM_INT);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':rol',  $elemento->rolEncargado, PDO::PARAM_INT); 
                $sentencia->bindValue(':precio',  $elemento->precio, PDO::PARAM_INT);   
                
                $sentencia->execute();                     
                $retorno = true;                
            } catch (PDOException $e) {
                $retorno = -1;
            }
            
            return $retorno;
        }

        // Borra el registro de un elemento en DB por el id.
        public static function Delete($id){
            $retorno = null;           
            $query = "DELETE FROM `producto` WHERE id = :id";
            
            try {
                $db = AccesoDatos::DameUnObjetoAcceso(); 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':id',  $id, PDO::PARAM_INT);
                
                $sentencia->execute();             
                $retorno = true;
            } catch (PDOException $e) {
                $retorno = -1;
            }
            
            return $retorno;
        }
        */
        #endregion
    }
?>