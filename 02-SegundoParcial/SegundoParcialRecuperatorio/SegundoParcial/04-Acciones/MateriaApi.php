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
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody();        
                        
            $materia = isset($args["id"])?$args["id"]:null;
            $legajo = isset($data["legajo"])?$data["legajo"]:null;
                        
            if(MateriaDAO::Inscribir($materia, $legajo)){
                $JsonResponse = $response->withJson(true, 200);     
            }
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }
            
            return $JsonResponse;
        }

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
    }
?>