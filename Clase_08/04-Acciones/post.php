<?php
    include_once "./02-Entidades/alumno.php";
    include_once "./03-DAO/alumnoDAO.php";

    class Post{
        public static function GuardarAlumno($data){                                            
            return AlumnoDAO::Insert($data);
        }  
        
        public static function BorrarAlumno($data){                                            
            return AlumnoDAO::Delete($data);
        }  

        public static function ModificarAlumno($data){                                            
            return AlumnoDAO::Update($data);
        }  
    }

?>