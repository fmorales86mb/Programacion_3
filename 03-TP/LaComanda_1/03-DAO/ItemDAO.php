<?php
    include_once "./02-Entidades/Identificadores.php";
    include_once "./02-Entidades/Item.php";
    include_once "./03-DAO/AccesoDatos.php"; 
    include_once './05-Interfaces/IDaoABM.php';   

    class ItemDAO implements IDaoABM{   
        const CLASSNAME = 'Item';
        
        // Traigo Elemento por id.
        public static function GetById($id){
            $retorno = null;           
            
            $query = "SELECT i.id, i.descripcion, s.descripcion as sector, i.precio ";            
            $query .= "FROM item as i, sector as s WHERE i.sector_id = s.id "; 
            $query .= "AND i.id= :id";
            
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
            
            $query = "SELECT i.id, i.descripcion, s.descripcion as sector, i.precio ";            
            $query .= "FROM item as i, sector as s WHERE i.sector_id = s.id "; 

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
            
            $query = "INSERT INTO `item`(`descripcion`, `sector_id`, `precio`) ";            
            $query .= "VALUES (:descripcion, :sector_id, :precio)";

            $sector_id = isset(Indentificadores::$Sector[$elemento->sector]) ? Indentificadores::$Sector[$elemento->sector] : null;            
            
            if ($sector_id !== null){
                try{
                    $db = AccesoDatos::DameUnObjetoAcceso();                 
                    $sentencia = $db->RetornarConsulta($query);
                    $sentencia->bindValue(':descripcion',  $elemento->descripcion, PDO::PARAM_STR);
                    $sentencia->bindValue(':sector_id',  $sector_id, PDO::PARAM_INT); 
                    $sentencia->bindValue(':precio',  $elemento->precio, PDO::PARAM_INT);                 
                    
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
            $retorno = null;           
            $query = "UPDATE `item` SET `descripcion`= :descripcion,`sector_id`= :sector_id,`precio`= :precio WHERE id = :id";            
            
            $sector_id = isset(Indentificadores::$Sector[$elemento->sector]) ? Indentificadores::$Sector[$elemento->sector] : null;            
            
            if ($sector_id !== null){
                try{
                    $db = AccesoDatos::DameUnObjetoAcceso();                 
                    $sentencia = $db->RetornarConsulta($query); 
                    $sentencia->bindValue(':id',  $elemento->id, PDO::PARAM_INT);
                    $sentencia->bindValue(':descripcion',  $elemento->descripcion, PDO::PARAM_STR);
                    $sentencia->bindValue(':sector_id',  $sector_id, PDO::PARAM_INT); 
                    $sentencia->bindValue(':precio',  $elemento->precio, PDO::PARAM_INT);   
                    
                    $sentencia->execute();                     
                    $retorno = $sentencia->fetch();                                  
                } catch (PDOException $e) {
                    $retorno = -1;
                }
            }
            return $retorno;
        }

        // Borra el registro de un elemento en DB por el id.
        public static function Delete($id){
            $retorno = null;           
            $query = "DELETE FROM `item` WHERE id = :id";
            
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