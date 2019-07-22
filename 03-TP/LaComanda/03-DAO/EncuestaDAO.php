<?php    
    include_once "./02-Entidades/Encuesta.php";
    include_once "./03-DAO/AccesoDatos.php";    

    class EncuestaDAO{   
        const CLASSNAME = 'Encuesta';
                
        // Guarda un elemento. 
        public static function Insert($elemento){
            $retorno = true;           
            
            $query = 
            "INSERT INTO `encuesta`(`calif_mesa`, `calif_restaurante`, `calif_mozo`, `calif_cocinero`, `experiencia`, `codigo_mesa`) 
            VALUES (:calMesa, :calRest, :calMozo, :calCocinero, :exper, :mesa)";                         
                             
            try{
                $db = AccesoDatos::DameUnObjetoAcceso();                 
                $sentencia = $db->RetornarConsulta($query);
                $sentencia->bindValue(':calMesa',  $elemento->calif_mesa, PDO::PARAM_INT);
                $sentencia->bindValue(':calRest',  $elemento->calif_restaurante, PDO::PARAM_INT); 
                $sentencia->bindValue(':calMozo',  $elemento->calif_mozo, PDO::PARAM_INT);                 
                $sentencia->bindValue(':calCocinero',  $elemento->calif_cocinero, PDO::PARAM_INT);
                $sentencia->bindValue(':exper',  $elemento->experiencia, PDO::PARAM_STR);
                $sentencia->bindValue(':mesa',  $elemento->codigo_mesa, PDO::PARAM_STR);                                    
                
                $sentencia->execute();                                                                           
            } catch (PDOException $e) {
                $retorno = false;
            }
        
            return $retorno;
        }
        
    }
?>