<?php
    include_once "./03-DAO/ComandaDAO.php";
    include_once "./03-DAO/PedidoDAO.php";
    require_once './02-Entidades/Comanda.php';
    require_once './02-Entidades/Pedido.php';

    class ComandaApi {
        
        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function CargarComanda($request, $response, $args) {
            $data = $request->getParsedBody(); 
            $fecha=date("YmdHis");            
            $codigo = "COM$fecha";                        

            $elemento = new Comanda();
            $elemento->codigo = $codigo;
            $elemento->mesa = isset($data["mesa"])?$data["mesa"]:null; 
            $elemento->tiempo_estimado = isset($data["tiempo_estimado"])?$data["tiempo_estimado"]:null; 
            
            $productos = isset($data["productos"])?json_decode($data["productos"]):null; 
            
            if(ComandaDAO::Insert($elemento)){                
                for($i = 0; $i<count($productos); $i++){     
                    $productoId = $productos[$i]->id;
                    $pedido = new Pedido();
                    $pedido->producto = $productoId;
                    $pedido->comanda = $codigo;
                    PedidoDAO::Insert($pedido);                                    
                }      
                $JsonResponse = $response->withJson(true, 200); 
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }
            
            return $JsonResponse;
        }

        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function UpdateEstadoComanda($request, $response, $args) {
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody();        
                        
            $estado = isset($data["estado"])?$data["estado"]:null;
            $comanda = isset($data["comanda"])?$data["comanda"]:null;
            $rol = isset($data["rol"])?$data["rol"]:null;
                        
            switch($rol){
                case "socio":
                if(ComandaDAO::UpdateEstado("cerrado", $comanda)){
                    $JsonResponse = $response->withJson(true, 200);
                }
                break;

                case "mozo":
                if(ComandaDAO::UpdateEstado($estado, $comanda)){
                    $JsonResponse = $response->withJson(true, 200);
                }
                break;

                default:
                break;
            }
            
            return $JsonResponse;
        }

        public function GetComandas($request, $response, $args) {
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody();
            
            $lista = ComandaDAO::GetAll();
            if($lista!=null && count($lista)>0){
                for($i=0; $i<count($lista); $i++){
                    $strRespuesta[] = $lista[$i];
                }
                $JsonResponse = $response->withJson($strRespuesta, 200);     
            }
                  
            return $JsonResponse; 
        }

        public function UpdateFotoComanda($request, $response, $args){
            $JsonResponse = $response->withJson(false, 400);

            $data = $request->getParsedBody(); 
            $comanda = isset($data["comanda"])?$data["comanda"] : null;
            $imagen = isset($_FILES["foto"]) ? $_FILES["foto"] : null;
            
            if($comanda != null){
                if(ComandaDAO::UpdateFotoComanda($imagen, $comanda)){
                    $JsonResponse = $response->withJson(true, 200);
                }
            }
            
            return $JsonResponse; 
        }

        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function PedidosPendientes($request, $response, $args) {
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody();        
                                    
            $sector = isset($data["sector"])?$data["sector"]:null;            
            
            $lista = ComandaDAO::GetPendientes($sector);
            if($lista!=null && count($lista)>0){
                for($i=0; $i<count($lista); $i++){
                    $strRespuesta[] = $lista[$i];
                }
                $JsonResponse = $response->withJson($strRespuesta, 200);     
            }                          
            
            return $JsonResponse;
        }

        public function ObtenerTiempoRestante($request, $response, $args) {
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody();
            
            $comanda = isset($data["comanda"])?$data["comanda"]:null;
            $mesa = isset($data["mesa"])?$data["mesa"]:null;

            $tiempos = this.ObtenerDatosTiempo($comanda, $mesa);
            // falta esto
            $lista = ComandaDAO::GetAll();
            if($lista!=null && count($lista)>0){
                for($i=0; $i<count($lista); $i++){
                    $strRespuesta[] = $lista[$i];
                }
                $JsonResponse = $response->withJson($strRespuesta, 200);     
            }
                  
            return $JsonResponse; 
        }

        private function ObtenerDatosTiempo($comanda, $mesa){

        }
        /*
        public function GetMaterias($request, $response, $args) {
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody();
            $rol = isset($data["tipo"])?$data["tipo"]:null;
            $legajo = isset($data["legajo"])?$data["legajo"]:null;
            
            switch($rol){
                case "admin":
                    $lista = MateriaDAO::GetAll();
                    if($lista!=null && count($lista)>0){
                        for($i=0; $i<count($lista); $i++){
                            $strRespuesta[] = $lista[$i];
                        }
                        $JsonResponse = $response->withJson($strRespuesta, 200);     
                    }
                break;

                case "alumno":
                    $lista = MateriaDAO::GetMateriasAlumno($legajo);
                        if($lista!=null && count($lista)>0){
                        for($i=0; $i<count($lista); $i++){
                            $strRespuesta[] = $lista[$i];
                        }
                        $JsonResponse = $response->withJson($strRespuesta, 200);     
                    }
                break;

                case "profesor":
                    $lista = MateriaDAO::GetMateriasProfesor($legajo);
                        if($lista!=null && count($lista)>0){
                        for($i=0; $i<count($lista); $i++){
                            $strRespuesta[] = $lista[$i];
                        }
                        $JsonResponse = $response->withJson($strRespuesta, 200);     
                    }
                break;

                default:
                break;
            }
                  
            return $JsonResponse; 
        }
        */
    }
?>