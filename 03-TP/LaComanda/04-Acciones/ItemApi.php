<?php
    include_once "./03-DAO/ItemDAO.php";
    require_once './02-Entidades/Item.php';
    require_once './05-Interfaces/IAccionesABM.php';

    class ItemApi implements IAccionesABM{
        
        // Retorna json del empleado.
        public function TraerUno($request, $response, $args) {
            $id = $args["id"];
            $obj = ItemDAO::GetById($id);            
            
            $response->write(json_encode($obj));        
            return $response;
        }

        // Retorna array json de todos los empleados.
        public function TraerTodos($request, $response, $args) {
            $lista = ItemDAO::GetAll();
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
            
            $elemento = new Item();
            $elemento->descripcion = isset($data["descripcion"])?$data["descripcion"]:null;
            $elemento->sector = isset($data["sector"])?$data["sector"]:null;
            $elemento->precio = isset($data["precio"])?$data["precio"]:null;                                   

            $response->write(ItemDAO::Insert($elemento));        
            return $response;
        }

        // Crea un Elemento y se lo pasa al DAO para que haga el Update.
        public function ModificarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
                        
            $elemento = new Item();
            $elemento->id = isset($data["id"])?$data["id"]:null;
            $elemento->descripcion = isset($data["descripcion"])?$data["descripcion"]:null;
            $elemento->sector = isset($data["sector"])?$data["sector"]:null;
            $elemento->precio = isset($data["precio"])?$data["precio"]:null; 
                        
            $response->write(ItemDAO::Update($elemento));        
            return $response;
        }

        // Elimina un Elemento por id.
        public function BorrarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            $id = isset($data["id"])?$data["id"]:null;
            
            $response->write(ItemDAO::Delete($id));        
            return $response;
        }
    }
?>