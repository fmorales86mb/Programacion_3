<?php
    include_once "./02-Entidades/Materia.php";
    include_once "./03-DAO/AccesoDatos.php";        

    class MateriaDAO {   
        const CLASSNAME = 'Materia';
        
        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = true;                       
            $query = "INSERT INTO `materia`(`nombre`, `cuatrimestre`, `cupos`) VALUES (:nombre, :cuatrimestre, :cupos)";                        

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':nombre',  $elemento->nombre, PDO::PARAM_STR);
                $sentencia->bindValue(':cuatrimestre',  $elemento->cuatrimestre, PDO::PARAM_INT); 
                $sentencia->bindValue(':cupos',  $elemento->cupos, PDO::PARAM_INT);                 
                
                $sentencia->execute();                                                                                                           
            } catch (PDOException $e) {
                $retorno = false;
            }
            
            return $retorno;
        }

        // Inscribe al alumno a la materia y modifica el cupo de la misma.
        public static function Inscribir($materia, $legajo){
            $retorno = false;                       
            $cupos = MateriaDAO::GetCupos($materia);
                        
            if($cupos > 0){
                $retorno = true;
                $cupoNuevo = $cupos - 1;
                
                $query = "UPDATE `materia` SET `cupos`= :cupo WHERE nombre= :materia";

                try{
                    $db = AccesoDatos::DameUnObjetoAcceso();                 
                    $sentencia = $db->RetornarConsulta($query);
                    $sentencia->bindValue(':materia',  $materia, PDO::PARAM_STR);
                    $sentencia->bindValue(':cupo',  $cupoNuevo, PDO::PARAM_INT);                                   
                    
                    $sentencia->execute();                                                                                                                 
                } catch (PDOException $e) {
                    $retorno = false;
                }

                $retorno = MateriaDAO::AddAlumnoToMateria($materia, $legajo);
            }
                        
            return $retorno;
        }
        
        //obtiene los cupos
        private static function GetCupos($materia){
            $retorno = false;                       
            $query = 
                "SELECT m.cupos 
                FROM materia as m 
                WHERE 
                    m.nombre = :materia";                                

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);   
                $sentencia->bindValue(':materia',  $materia, PDO::PARAM_STR); 
                                    
                $sentencia->execute();                     
                $retorno = $sentencia->fetchColumn();                                                                       
            } catch (PDOException $e) {
                $retorno = false;
            }
            
            return $retorno;
        }

        // Agrega un alumno a una matería en la db.
        private static function AddAlumnoToMateria($materia, $legajo){
            $retorno = true;                       
            $query = "INSERT INTO `materia_alumno`(`materia`, `alumno`) VALUES (:materia,:legajo)";

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);   
                $sentencia->bindValue(':materia',  $materia, PDO::PARAM_STR);
                $sentencia->bindValue(':legajo',  $legajo, PDO::PARAM_INT);                     
                
                $sentencia->execute();                                                                                                      
            } catch (PDOException $e) {
                $retorno = false;
            }
            
            return $retorno;
        }

        public static function AsociarMateriaProfesor($materia, $legajo){
            $retorno = true;                                                                           
            $query = "INSERT INTO `materia_profesor`(`materia`, `profesor`) VALUES (:materia, :legajo)";

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':materia',  $materia, PDO::PARAM_STR);
                $sentencia->bindValue(':legajo',  $legajo, PDO::PARAM_INT);                                   
                
                $sentencia->execute();                                                                                                            
            } catch (PDOException $e) {
                $retorno = false;
            }            
                        
            return $retorno;
        }

        // Trae la lista de todas las materias.
        public static function GetAll(){
            $retorno = array();           
            
            $query = "SELECT * FROM `materia`"; 

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                
                $sentencia->execute();                                 
                $retorno = $sentencia->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);                                                                                      
            } catch (PDOException $e) {
                $retorno = null;                 
            }
            
            return $retorno;
        }

        // Trae la lista de todas las materias.
        public static function GetMateriasAlumno($legajo){
            $retorno = array();           
            
            $query = 
            "SELECT m.nombre, m.cuatrimestre, m.cupos
             FROM materia_alumno as ma, materia as m
             WHERE 
                ma.alumno = :legajo AND
                m.nombre = ma.materia"; 

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':legajo',  $legajo, PDO::PARAM_INT);                                    
                
                $sentencia->execute();                                 
                $retorno = $sentencia->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);                                                                                      
            } catch (PDOException $e) {
                $retorno = null;                 
            }
            
            return $retorno;
        }

        // Trae la lista de todas las materias.
        public static function GetMateriasProfesor($legajo){
            $retorno = array();           
            
            $query = 
            "SELECT m.nombre, m.cuatrimestre, m.cupos
             FROM materia_profesor as mp, materia as m
             WHERE 
                mp.profesor = :legajo AND
                m.nombre = mp.materia"; 

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':legajo',  $legajo, PDO::PARAM_INT);
                
                $sentencia->execute();                                 
                $retorno = $sentencia->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);                                                                                      
            } catch (PDOException $e) {
                $retorno = null;                 
            }
            
            return $retorno;
        }

    }
?>