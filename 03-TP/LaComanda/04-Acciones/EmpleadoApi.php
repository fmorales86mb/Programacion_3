<?php
    include_once "./03-DAO/EmpleadoDAO.php";
    require_once './02-Entidades/Empleado.php';
    require_once './05-Interfaces/IAccionesABM.php';

    class EmpleadoApi implements IAccionesABM{
        
        public function TraerUno($request, $response, $args) {
            // $id = $args["id"];
            // $obj = AlumnoDAO::GetById($id);            
            // $objAlumno = json_encode($obj);

            // $response->write($objAlumno);
        
            // return $response;
        }

        public function TraerTodos($request, $response, $args) {
            
        }

        public function CargarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            
            $elemento = new Empleado();
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->apellido = isset($data["apellido"])?$data["apellido"]:null;
            $elemento->tarea = isset($data["tarea"])?$data["tarea"]:null;
            $elemento->sector = isset($data["sector"])?$data["sector"]:null;
            
            var_dump($elemento);

            $response->write(EmpleadoDAO::Insert($elemento));        
            return $response;
        }

        public function BorrarUno($request, $response, $args) {
            
        }

        public function ModificarUno($request, $response, $args) {
            
        }
    }
?>