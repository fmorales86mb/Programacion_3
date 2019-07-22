<?php
    include_once "./03-DAO/EncuestaDAO.php";    
    require_once './02-Entidades/Encuesta.php';

    class EncuestaApi {
        public function Encuesta($request, $response, $args) {
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody();                       

            $elemento = new Encuesta();
            $elemento->codigo_mesa = isset($data["codigo_mesa"])?$data["codigo_mesa"]:null;
            $elemento->calif_mesa = isset($data["calif_mesa"])?$data["calif_mesa"]:null;
            $elemento->calif_restaurante = isset($data["calif_restaurante"])?$data["calif_restaurante"]:null;
            $elemento->calif_mozo = isset($data["calif_mozo"])?$data["calif_mozo"]:null;
            $elemento->calif_cocinero = isset($data["calif_cocinero"])?$data["calif_cocinero"]:null;
            $elemento->experiencia = isset($data["experiencia"])?$data["experiencia"]:null;            
            
            if(EncuestaDAO::Insert($elemento)){                      
                $JsonResponse = $response->withJson(true, 200); 
            }
            
            return $JsonResponse;
        }
    }
    ?>