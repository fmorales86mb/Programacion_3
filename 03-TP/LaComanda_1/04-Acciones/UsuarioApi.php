<?php
    include_once "./03-DAO/UsuarioDAO.php";
    require_once './02-Entidades/Usuario.php';
    require_once './05-Interfaces/IAccionesABM.php';

    class UsuarioApi implements IAccionesABM{
        
        // Retorna json del elemento.
        public function TraerUno($request, $response, $args) {
            // $id = $args["id"];
            // $obj = ItemDAO::GetById($id);            
            
            // $response->write(json_encode($obj));        
            // return $response;
        }

        // Retorna array json de todos los elementos.
        public function TraerTodos($request, $response, $args) {
            $lista = UsuarioDAO::GetAll();
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
            
            $elemento = new Usuario();
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $clave = isset($data["clave"])?$data["clave"]:null;                                             

            $response->write(UsuarioDAO::Insert($elemento, $clave));        
            return $response;
        }

        // Crea un Elemento y se lo pasa al DAO para que haga el Update.
        public function ModificarUno($request, $response, $args) {
            // $data = $request->getParsedBody();        
                        
            // $elemento = new Item();
            // $elemento->id = isset($data["id"])?$data["id"]:null;
            // $elemento->descripcion = isset($data["descripcion"])?$data["descripcion"]:null;
            // $elemento->sector_id = isset($data["sector_id"])?$data["sector_id"]:null;
            // $elemento->precio = isset($data["precio"])?$data["precio"]:null; 
                        
            // $response->write(ItemDAO::Update($elemento));        
            // return $response;
        }

        // Elimina un Elemento por id.
        public function BorrarUno($request, $response, $args) {
            // $data = $request->getParsedBody();        
            // $id = isset($data["id"])?$data["id"]:null;
            
            // $response->write(ItemDAO::Delete($id));        
            // return $response;
        }
    }
?>