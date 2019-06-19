<?php
    include_once "./02-Entidades/Identificadores.php";
    include_once "./02-Entidades/Empleado.php";
    include_once "./03-DAO/AccesoDatos.php";    
    include_once './05-Interfaces/IDaoABM.php';

    class EmpleadoDAO implements IDaoABM{   
        const CLASSNAME = 'Empleado';
        
        // Traigo Elemento por id.
        public static function GetById($id){
            $retorno = null;                       
            
            $query = "SELECT e.id, e.nombre, e.apellido, t.descripcion as tarea, s.descripcion as sector " ;
            $query .= "FROM empleado as e, tarea as t, sector as s ";
            $query .= "WHERE e.tarea_id = t.id AND t.sector_id = s.id AND e.id= :id";            

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
            
            $query = "SELECT e.id, e.nombre, e.apellido, t.descripcion as tarea, s.descripcion as sector " ;
            $query .= "FROM empleado as e, tarea as t, sector as s ";
            $query .= "WHERE e.tarea_id = t.id AND t.sector_id = s.id";
            
            var_dump($query);
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
            $retorno = false;           
            
            $query = "INSERT INTO `empleado`(`nombre`, `apellido`, `tarea_id`) ";
            $query .="VALUES (:nombre, :apellido, :tarea_id)"; 
            
            $tarea_id = isset(Indentificadores::$Tarea[$elemento->tarea]) ? Indentificadores::$Tarea[$elemento->tarea] : null;            
            
            if ($tarea_id !== null){
                try{
                    $db = AccesoDatos::DameUnObjetoAcceso();                 
                    $sentencia = $db->RetornarConsulta($query);
                    $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                    $sentencia->bindValue(':apellido',  $elemento->apellido, PDO::PARAM_STR); 
                    $sentencia->bindValue(':tarea_id',  $tarea_id, PDO::PARAM_INT);                     
                    
                    $sentencia->execute(); 
                    
                    $retorno = true;                                                                          
                } catch (PDOException $e) {
                    $retorno = false;
                }
            }

            return $retorno;
        }

        // Modifica los datos de un elemento en la DB por el id.
        public static function Update($elemento){
            $retorno = false;           
            
            $query = "UPDATE `empleado` ";
            $query .= "SET `nombre`= :nombre,`apellido`= :apellido,`tarea_id`= :tarea_id ";
            $query .= "WHERE id = :id";
            
            $tarea_id = isset(Indentificadores::$Tarea[$elemento->tarea]) ? Indentificadores::$Tarea[$elemento->tarea] : null; 
            
            if ($tarea_id !== null){
                try{
                    $db = AccesoDatos::DameUnObjetoAcceso();                 
                    $sentencia = $db->RetornarConsulta($query); 
                    $sentencia->bindValue(':id',  $elemento->id, PDO::PARAM_INT);
                    $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                    $sentencia->bindValue(':apellido',  $elemento->apellido, PDO::PARAM_STR); 
                    $sentencia->bindValue(':tarea_id',  $tarea_id, PDO::PARAM_INT);                  
                    
                    $sentencia->execute(); 
                    
                    $retorno = true;                                  
                } catch (PDOException $e) {
                    $retorno = false;
                }
            }
            
            return $retorno;
        }

        // Borra el registro de un elemento en DB por el id.
        public static function Delete($id){
            $retorno = false;           
            $query = "DELETE FROM `empleado` WHERE id = :id";
            
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
    }
?>