<?php
    require_once "./03-DAO/EmpleadoDAO.php";
    require_once './02-Entidades/Empleado.php';
    require_once './05-Interfaces/IAccionesABM.php';    

    class EmpleadoApi implements IAccionesABM{
        
        // Retorna json del empleado.
        public function TraerUno($request, $response, $args) {
            $id = $args["id"];
            $obj = EmpleadoDAO::GetById($id);            
            
            $response->write(json_encode($obj));        
            return $response;
        }

        // Retorna array json de todos los empleados.
        public function TraerTodos($request, $response, $args) {
            $lista = EmpleadoDAO::GetAll();
            $strRespuesta;                              
  
            if(count($lista)<1){
                $strRespuesta = "No existen registros.";
            }
            else{
                for($i=0; $i<count($lista); $i++){
                    $strRespuesta[] = $lista[$i];
                }                
            }
            
            $response->write(json_encode($strRespuesta));
            return $response; 
        }

        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function CargarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            
            $elemento = new Empleado();
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->apellido = isset($data["apellido"])?$data["apellido"]:null;
            $elemento->tarea_id = isset($data["tarea_id"])?$data["tarea_id"]:null;
            $elemento->sector_id = isset($data["sector_id"])?$data["sector_id"]:null;                        

            $response->write(EmpleadoDAO::Insert($elemento));        
            return $response;
        }

        // Crea un Elemento y se lo pasa al DAO para que haga el Update.
        public function ModificarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
                        
            $elemento = new Empleado();
            $elemento->id = isset($data["id"])?$data["id"]:null;
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->apellido = isset($data["apellido"])?$data["apellido"]:null;
            $elemento->tarea_id = isset($data["tarea_id"])?$data["tarea_id"]:null;
            $elemento->sector_id = isset($data["sector_id"])?$data["sector_id"]:null;  
                        
            $response->write(EmpleadoDAO::Update($elemento));        
            return $response;
        }

        // Elimina un Elemento por id.
        public function BorrarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            $id = isset($data["id"])?$data["id"]:null;
            
            $response->write(EmpleadoDAO::Delete($id));        
            return $response;
        }        
    }
?>