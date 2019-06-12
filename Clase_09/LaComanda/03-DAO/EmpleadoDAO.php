<?php
    include_once "./02-Entidades/Identificadores.php";
    include_once "./02-Entidades/Empleado.php";
    include_once "./03-DAO/AccesoDatos.php";    

    class EmpleadoDAO{   
        const CLASSNAME = 'Empleado';
        
        // Traigo Elemento por id.
        public static function GetById($id){
            $retorno = null;           
            $query = "SELECT * FROM `empleado`  WHERE `id`= :id";
            
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
        
        // Traigo todos los Elementos de la DB.
        public static function GetAll(){
            $retorno = array();           
            $query = "SELECT * FROM `empleado`";
            
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

        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = null;           
            $query = "INSERT INTO `empleado`(`nombre`, `apellido`, `tarea_id`, `sector_id`) VALUES (:nombre, :apellido, :tarea_id, :sector_id)";            
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':apellido',  $elemento->apellido, PDO::PARAM_STR); 
                $sentencia->bindValue(':tarea_id',  $elemento->tarea_id, PDO::PARAM_INT); 
                $sentencia->bindValue(':sector_id',  $elemento->sector_id, PDO::PARAM_INT); 
                
                $sentencia->execute(); 
                
                $retorno = $sentencia->fetch();                                                                          
            } catch (PDOException $e) {
                $retorno = -1;
            }
            
            return $retorno;
        }

        // Modifica los datos de un elemento en la DB por el id.
        public static function Update($elemento){
            $retorno = null;           
            $query = "UPDATE `empleado` SET `nombre`= :nombre,`apellido`= :apellido,`tarea_id`= :tarea_id, `sector_id`= :sector_id WHERE id = :id";            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':id',  $elemento->id, PDO::PARAM_INT);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':apellido',  $elemento->apellido, PDO::PARAM_STR); 
                $sentencia->bindValue(':tarea_id',  $elemento->tarea_id, PDO::PARAM_INT); 
                $sentencia->bindValue(':sector_id',  $elemento->sector_id, PDO::PARAM_INT);  
                
                $sentencia->execute(); 
                
                $retorno = $sentencia->fetch();                                  
            } catch (PDOException $e) {
                $retorno = -1;
            }
            
            return $retorno;
        }

        // Borra el registro de un elemento en DB por el id.
        public static function Delete($id){            
            $retorno = null;           
            $query = "DELETE FROM `empleado` WHERE id = :id";
            
            try {
                $db = AccesoDatos::DameUnObjetoAcceso(); 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':id',  $id, PDO::PARAM_INT);
                
                $sentencia->execute(); 
                
                $retorno = $sentencia->fetch();                                          
            } catch (PDOException $e) {
                $retorno = -1;
            }
            
            return $retorno;
        }
    }
?>