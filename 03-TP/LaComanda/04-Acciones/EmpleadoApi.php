<?php
    include_once "./03-DAO/EmpleadoDAO.php";
    require_once './02-Entidades/Empleado.php';
    require_once './05-Interfaces/IAccionesABM.php';

    class EmpleadoApi implements IAccionesABM{
        
        // Retorna json del empleado.
        public function TraerUno($request, $response, $args) {
            $id = $args["id"];
            $obj = EmpleadoDAO::GetById($id);            
            
            $JsonResponse = $response->withJson($obj, 200);        
            return $JsonResponse;
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
            
            $JsonResponse = $response->withJson($strRespuesta, 200);                    
            return $JsonResponse; 
        }

        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function CargarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            
            $elemento = new Empleado();
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->apellido = isset($data["apellido"])?$data["apellido"]:null;
            $elemento->tarea = isset($data["tarea"])?$data["tarea"]:null;                                   
               
            if(EmpleadoDAO::Insert($elemento)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }
            
            return $JsonResponse;
        }

        // Crea un Elemento y se lo pasa al DAO para que haga el Update.
        public function ModificarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
                        
            $elemento = new Empleado();
            $elemento->id = isset($data["id"])?$data["id"]:null;
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->apellido = isset($data["apellido"])?$data["apellido"]:null;
            $elemento->tarea = isset($data["tarea"])?$data["tarea"]:null; 
                
            if(EmpleadoDAO::Update($elemento)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }

            return $JsonResponse;
        }

        // Elimina un Elemento por id.
        public function BorrarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            $id = isset($data["id"])?$data["id"]:null;
            
            if(EmpleadoDAO::Delete($id)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }

            return $JsonResponse;
        }
    }
?>