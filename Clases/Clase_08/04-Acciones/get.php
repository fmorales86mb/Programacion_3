<?php
    include_once "./02-Entidades/alumno.php";
    include_once "./03-DAO/alumnoDAO.php";

    class Get{

        // Devuelve la lista de alumnos en formato Json.
        public static function ListaAlumnos(){
            $lista = AlumnoDAO::GetAll();
            $strRespuesta;                              
  
            if(count($lista)<1){
                $strRespuesta = "No existen registros.";
            }
            else{
                for($i=0; $i<count($lista); $i++){
                    $strRespuesta[] = $lista[$i];
                }                
            }
            
            return json_encode($strRespuesta);
        }        

        // Devuelve un elemento por id en formato Json.
        public static function TraerAlumno($id){
            $obj = AlumnoDAO::GetById($id);            
            return json_encode($obj);
        }        
    }
?>