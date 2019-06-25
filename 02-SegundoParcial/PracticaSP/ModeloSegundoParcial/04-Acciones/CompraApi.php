<?php
    include_once "./03-DAO/CompraDAO.php";
    require_once './02-Entidades/Compra.php';
    require_once './05-Interfaces/IAccionesABM.php';

    class CompraApi {
        
        #region Métodos
        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function CargarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            
            $elemento = new Compra();
            $elemento->articulo = isset($data["articulo"])?$data["articulo"]:null;
            $elemento->precio = isset($data["precio"])?$data["precio"]:null;
            $elemento->usuarioId = isset($data["usuarioId"])?$data["usuarioId"]:null;
            
            if(CompraDAO::Insert($elemento)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }
            
            return $JsonResponse;
        }

        // Retorna array json de todos los elementos por rol.
        public function TraerTodos($request, $response, $args) {
            $data = $request->getParsedBody();
            $rol = isset($data["rol"])?$data["rol"]:null;
            
            var_dump($request->getUri());
            
            $lista = CompraDAO::GetAllByRol($rol);
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
            //return $JsonResponse; 
        }        
        #endregion

        #region
        /*
        // Retorna json del elemento.
        public function TraerUno($request, $response, $args) {
            $id = $args["id"];
            $obj = ProductoDAO::GetById($id);            
            
            $JsonResponse = $response->withJson($obj, 200);        
            return $JsonResponse;
        }

        

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