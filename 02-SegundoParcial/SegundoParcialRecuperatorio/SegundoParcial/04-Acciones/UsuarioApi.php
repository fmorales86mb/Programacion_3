<?php
    include_once "./03-DAO/UsuarioDAO.php";
    require_once './02-Entidades/Usuario.php';    

    class UsuarioApi{
        
        #region Métodos
        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function CargarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
            
            $elemento = new Usuario();
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
            $elemento->clave = isset($data["clave"])?$data["clave"]:null; 
            $elemento->tipo = isset($data["tipo"])?$data["tipo"]:null;  
            
            if($elemento->tipo == "alumno" || $elemento->tipo == "profesor" || $elemento->tipo == "admin"){
                if(UsuarioDAO::Insert($elemento)){
                    $JsonResponse = $response->withJson(true, 200);     
                }
                else{
                    $JsonResponse = $response->withJson(false, 400);                    
                }
            }                        
            else{
                $JsonResponse = $response->withJson(false, 400);                    
            }
            
            return $JsonResponse;
        }

        // Recibe datos en el body y pasa objeto al DAO para insertarlo. 
        public function CargarDatosPorLegajo($request, $response, $args) {
            $JsonResponse = $response->withJson(false, 400);
            $data = $request->getParsedBody(); 

            $usuarioRol = isset($data["tipo"])?$data["tipo"]:null;
            $usuarioLegajo = isset($data["legajo"])?$data["legajo"]:null;
            $email = isset($data["email"])?$data["email"]:null;
            
            $elemento = UsuarioDAO::GetById(isset($args["legajo"])? $args["legajo"]:0);
            $elemento->email = isset($data["email"])?$data["email"]:null;                                                
            
            $imagen = isset($_FILES["foto"]) ? $_FILES["foto"] : null;
            $materias = isset($data["materias"])?json_decode($data["materias"]):null;

            switch($usuarioRol){
                case "admin":
                    switch($elemento->tipo){
                        case "alumno":
                            if(UsuarioDAO::UpdateAlumno($elemento, $imagen)){
                                $JsonResponse = $response->withJson(true, 200);
                            }
                        break;

                        case "profesor":                                        
                            for($i = 0; $i<count($materias); $i++){     
                                $nombreMateria = $materias[$i]->nombre;
                                MateriaDAO::AsociarMateriaProfesor($nombreMateria, $elemento->legajo);                                    
                            }   
                            if(UsuarioDAO::UpdateProfesor($elemento->legajo, $email)){
                                $JsonResponse = $response->withJson(true, 200);
                            }              
                        break;

                        default:
                        break;
                    }                                        
                break;

                case "alumno":
                    if(UsuarioDAO::UpdateAlumno($elemento, $imagen)){
                        $JsonResponse = $response->withJson(true, 200);
                    }
                break;

                case "profesor":                                        
                    for($i = 0; $i<count($materias); $i++){     
                        $nombreMateria = $materias[$i]->nombre;
                        MateriaDAO::AsociarMateriaProfesor($nombreMateria, $usuarioLegajo);                                  
                    }   
                    if(UsuarioDAO::UpdateProfesor($usuarioLegajo, $email)){
                        $JsonResponse = $response->withJson(true, 200);
                    }              
                break;

                default:
                break;
            }                       
            
            return $JsonResponse;
        }

        // Trae lista de alumno por matería.
        public function GetAlumnosByMateria($request, $response, $args){
            $JsonResponse = $response->withJson(false, 400);
                        
            $materia = isset($args["materia"])?$args["materia"]:null;
            
            if($materia != null){
                
                $lista  = UsuarioDao::GetAlumnosByMateria($materia);

                if(count($lista)<1){
                    $strRespuesta = "No existen registros.";
                }
                else{
                    for($i=0; $i<count($lista); $i++){
                        $strRespuesta[] = $lista[$i];
                    }                
                }

                $JsonResponse = $response->withJson($strRespuesta, 200);
            }
           
            return $JsonResponse;
        }
        #endregion
    }
?>