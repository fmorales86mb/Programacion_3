<?php
    include_once "./03-DAO/alumnoDAO.php";
    require_once './02-Entidades/alumno.php';
    require_once './05-Interfaces/IAccionesAlumno.php';

    class AlumnoApi implements IAccionesAlumno{
        
        public function TraerUno($request, $response, $args) {
            $id = $args["id"];
            $obj = AlumnoDAO::GetById($id);            
            $objAlumno = json_encode($obj);

            $response->write($objAlumno);
        
            return $response;
        }

        public function TraerTodos($request, $response, $args) {
            
        }

        public function CargarUno($request, $response, $args) {
            
        }

        public function BorrarUno($request, $response, $args) {
            
        }

        public function ModificarUno($request, $response, $args) {
            
        }
    }
?>