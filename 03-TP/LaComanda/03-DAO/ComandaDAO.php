<?php
    include_once "./02-Entidades/Comanda.php";
    include_once "./03-DAO/AccesoDatos.php";   
    include_once "./01-Fwk/imagenes.php";     

    class ComandaDAO {   
        const CLASSNAME = 'Comanda';
        
        // Guarda un elemento. Retorna el id guardado. (retorna false ahora).
        public static function Insert($elemento){
            $retorno = true;                       
            $query = "INSERT INTO `comanda`(`codigo`, `codigo_mesa`,`tiempo_estimado`) VALUES (:codigo, :mesa, :tiempo)";

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':codigo',  $elemento->codigo, PDO::PARAM_STR);
                $sentencia->bindValue(':mesa',  $elemento->mesa, PDO::PARAM_STR); 
                $sentencia->bindValue(':tiempo',  $elemento->tiempo_estimado, PDO::PARAM_STR);                 
                
                $sentencia->execute();                                                                                                           
            } catch (PDOException $e) {
                $retorno = false;
            }
            
            return $retorno;
        }

        // Actualiza el estado de la comanda.
        public static function UpdateEstado($estado, $comanda){
            $retorno = true;                
            $query = "UPDATE comanda SET comanda.estado = :estado WHERE comanda.codigo = :codigo";

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':estado',  $estado, PDO::PARAM_STR);
                $sentencia->bindValue(':codigo',  $comanda, PDO::PARAM_STR);                                   
                
                $sentencia->execute();                                                                                                                 
            } catch (PDOException $e) {
                $retorno = false;
            }            
                                    
            return $retorno;
        }

        // Trae la lista de todas las materias.
        public static function GetAll(){
            $retorno = array();           
            
            $query = "SELECT comanda.estado, comanda.codigo FROM comanda"; 

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
        
        public static function UpdateFotoComanda($imagen, $comanda){
            $retorno = true;                
            $query = "UPDATE comanda SET comanda.foto = :foto WHERE comanda.codigo = :codigo";

            // guardo imagen
            $imageUrl = Imagenes::GuardarImagen(
                $imagen, 
                "./05-Img/foto-$comanda");      
            
            $foto = $imageUrl;  

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':foto',  $foto, PDO::PARAM_STR);
                $sentencia->bindValue(':codigo',  $comanda, PDO::PARAM_STR);                                   
                
                $sentencia->execute();                                                                                                                 
            } catch (PDOException $e) {
                $retorno = false;
            }            
                                    
            return $retorno;
        }

        // Trae la lista de todas las materias.
        public static function GetPendientes($sector){
            $retorno = array(); 
            $estado = "en preparacion";

            $query = 
            "SELECT pe.id, p.nombre, p.sector, m.codigo
            FROM comanda as c, producto as p, pedido as pe, mesa as m 
            WHERE 
                c.estado = :estado AND
                c.codigo = pe.codigo_comanda AND
                m.codigo = c.codigo_mesa AND
                p.id = pe.producto_id AND
                p.sector = :sector"; 

            try{
                $db = AccesoDatos::DameUnObjetoAcceso();               
                $sentencia = $db->RetornarConsulta($query); 
                $sentencia->bindValue(':estado',  $estado, PDO::PARAM_STR);
                $sentencia->bindValue(':sector',  $sector, PDO::PARAM_STR);

                $sentencia->execute();                                 
                $retorno = $sentencia->fetchAll(PDO::FETCH_ASSOC);                                                                                      
            } catch (PDOException $e) {
                $retorno = null;                 
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