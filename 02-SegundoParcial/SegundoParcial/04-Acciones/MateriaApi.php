<?php
    include_once "./03-DAO/MateriaDAO.php";
    require_once './02-Entidades/Materia.php';    

    class MateriaApi {
        
        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function CargarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            
            $elemento = new Materia();
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->cuatrimestre = isset($data["cuatrimestre"])?$data["cuatrimestre"]:null; 
            $elemento->cupos = isset($data["cupos"])?$data["cupos"]:null; 
               
            if(MateriaDAO::Insert($elemento)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }
            
            return $JsonResponse;
        }

        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function Inscribir($request, $response, $args) {
            $data = $request->getParsedBody();        
                        
            $materia = isset($args["id"])?$args["id"]:null;
            $legajo = isset($data["legajo"])?$data["legajo"]:null;
            
            //var_dump($materia, $legajo);
            if(MateriaDAO::Inscribir($materia, $legajo)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }
            
            return $JsonResponse;
        }

        public function GetMaterias($request, $response, $args) {
            $lista = ProductoDAO::GetAll();
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

        #region
        /*
        // Retorna json del elemento.
        public function TraerUno($request, $response, $args) {
            $id = $args["id"];
            $obj = ProductoDAO::GetById($id);            
            
            $JsonResponse = $response->withJson($obj, 200);        
            return $JsonResponse;
        }

        // Retorna array json de todos los elementos.


        

        // Crea un Elemento y se lo pasa al DAO para que haga el Update.
        public function ModificarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
                        
            $elemento = new Producto();
            $elemento->id = isset($data["id"])?$data["id"]:null;
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->rolEncargado = isset($data["rolEncargado"])?$data["rolEncargado"]:null; 
            $elemento->precio = isset($data["precio"])?$data["precio"]:null; 
                
            if(ProductoDAO::Update($elemento)){
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
            
            if(ProductoDAO::Delete($id)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }

            return $JsonResponse;
        }
        */
        #endregion
    }
?>