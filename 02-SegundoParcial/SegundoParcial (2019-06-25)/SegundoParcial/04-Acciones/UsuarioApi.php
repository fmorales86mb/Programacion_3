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

            $rol = isset($data["tipo"])?$data["tipo"]:null;
            
            $elemento = UsuarioDAO::GetById(isset($args["legajo"])? $args["legajo"]:0);
            $elemento->email = isset($data["email"])?$data["email"]:null;                                                
            
            $imagen = isset($_FILES["foto"]) ? $_FILES["foto"] : null;
            $materias = isset($data["materias"])?json_decode($data["materias"]):null;

            switch($rol){
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
                            if(UsuarioDAO::UpdateProfesor($elemento)){
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
                        MateriaDAO::AsociarMateriaProfesor($nombreMateria, $elemento->legajo);                                     
                    }   
                    if(UsuarioDAO::UpdateProfesor($elemento)){
                        $JsonResponse = $response->withJson(true, 200);
                    }              
                break;

                default:
                break;
            }                       
            
            return $JsonResponse;
        }
        #endregion

        #region Sin Uso
        /*
        // Retorna json del empleado.
        public function TraerUno($request, $response, $args) {
            $id = $args["id"];
            $obj = UsuarioDAO::GetById($id);            
            
            $JsonResponse = $response->withJson($obj, 200);        
            return $JsonResponse;
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
            
            $JsonResponse = $response->withJson($strRespuesta, 200);                    
            return $JsonResponse; 
        }


        // Crea un Elemento y se lo pasa al DAO para que haga el Update.
        public function ModificarUno($request, $response, $args) {
            $data = $request->getParsedBody();        
                        
            $elemento = new Usuario();   
            $elemento->id = isset($data["id"])?$data["id"]:null;
            $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;         
            $clave = isset($data["clave"])?$data["clave"]:null;
            $elemento->rol = isset($data["rol"])?$data["rol"]:null;
                
            if(UsuarioDAO::Update($elemento, $clave)){
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
            
            if(UsuarioDAO::Delete($id)){
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