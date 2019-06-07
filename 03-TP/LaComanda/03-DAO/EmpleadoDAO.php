<?php
    include_once "./02-Entidades/Identificadores.php";
    include_once "./02-Entidades/Empleado.php";
    include_once "./03-DAO/AccesoDatos.php";    

    class EmpleadoDAO{                 
        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){                                    
            $retorno = -1;           
            $query = "INSERT INTO `empleado`(`nombre`, `apellido`, `tarea_id`, `sector_id`) VALUES (:nombre, :apellido, :tarea_id, :sector_id)";            
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':apellido',  $elemento->apellido, PDO::PARAM_STR); 
                $sentencia->bindValue(':tarea_id',  $elemento->tarea, PDO::PARAM_INT); 
                $sentencia->bindValue(':sector_id',  $elemento->sector, PDO::PARAM_INT); 
                
                $sentencia->execute(); 
                
                $retorno = $sentencia->fetch();                 
                // $retorno = $sentencia->lastInsertId();                                         
            } catch (PDOException $e) {
                // $obj->Exito = FALSE;
                // $obj->Mensaje = "Error!!!\n" . $e->getMessage();
            }
            
            return $retorno;
        }

        // Borra el registro de un elemento en DB por el id.
        public static function Delete($data){            
            // $id = $data["id"];
            // $retorno = -1;           
            // $query = "DELETE FROM `alumno` WHERE id = :id";
            
            // try {
            //     $db = AccesoDatos::DameUnObjetoAcceso(); // obtengo instancia de conexion a db.                
            //     $sentencia = $db->RetornarConsulta($query); // preparo query.
            //     $sentencia->bindValue(':id',  $id, PDO::PARAM_INT); // bindeo datos a la query.
                
            //     $sentencia->execute(); // ejecuto la query.
                
            //     $retorno = $sentencia->fetch();                                          
            // } catch (PDOException $e) {
            //     // $obj->Exito = FALSE;
            //     // $obj->Mensaje = "Error!!!\n" . $e->getMessage();
            // }
            
            // return $retorno;
        }
        
        // Modifica los datos de un elemento en la DB.
        public static function Update($data){            
            // $elemento = new Alumno($data);            
            // $retorno = -1;           
            // $query = "UPDATE `alumno` SET `nombre`= :nombre,`legajo`= :legajo,`localidad`= :idLocalidad WHERE id = :id";
            
            // try{
            //     $db = AccesoDatos::DameUnObjetoAcceso(); // obtengo instancia de conexion a db.                
            //     $sentencia = $db->RetornarConsulta($query); // preparo query.
            //     $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR); // bindeo datos a la query.
            //     $sentencia->bindValue(':legajo',  $elemento->legajo, PDO::PARAM_INT); 
            //     $sentencia->bindValue(':idLocalidad',  $elemento->localidad, PDO::PARAM_INT); 
            //     $sentencia->bindValue(':id',  $elemento->id, PDO::PARAM_INT); 
                
            //     $sentencia->execute(); // ejecuto la query.
                
            //     $retorno = $sentencia->fetch();                                  
            // } catch (PDOException $e) {
            //     // $obj->Exito = FALSE;
            //     // $obj->Mensaje = "Error!!!\n" . $e->getMessage();
            // }
            
            // return $retorno;
        }

        // Traigo todos los registros de la DB.
        public static function GetAll(){                                  
            $retorno = array();           
            $query = "SELECT * FROM `empleado`";
            
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                
                $sentencia->execute(); 
                                
                $retorno = $sentencia->fetchAll(PDO::FETCH_CLASS, "Empleado");                                                                                      
            } catch (PDOException $e) {
                // $obj->Exito = FALSE;
                // $obj->Mensaje = "Error!!!\n" . $e->getMessage();
            }
            
            return $retorno;
        }

        // Traigo todos los registros de la DB.
        public static function GetById($id){                                  
            // $retorno = null;           
            // $query = "SELECT * FROM `alumno`  WHERE `id`= :id";
            
            // try{
            //     $db = AccesoDatos::DameUnObjetoAcceso();               
            //     $sentencia = $db->RetornarConsulta($query); 
            //     $sentencia->bindValue(':id',  $id, PDO::PARAM_INT); 
                
            //     $sentencia->execute(); 
                
            //     //atributos públicos, mismo orden, mismo nombre !
            //     $retorno = $sentencia->fetchObject("Alumno");                                    
                                                  
            // } catch (PDOException $e) {
            //     // $obj->Exito = FALSE;
            //     // $obj->Mensaje = "Error!!!\n" . $e->getMessage();
            // }
            
            // return $retorno;
        }        
    }
?>