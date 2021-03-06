<?php
include_once "./03-DAO/UsuarioDAO.php";
include_once "./03-DAO/LogDAO.php";

use \Firebase\JWT\JWT;

// https://www.php-fig.org/psr/psr-7/

class AutenticacionAPI{    
    private const CLAVE = "claveSecreta";

    // Evalua la existencia de la tupla nombre-clave y retorna token o false.
    public function Login($request, $response, $next) {
        $data = $request->getParsedBody(); 
        
        $elemento = new Usuario();
        $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
        $elemento->clave = isset($data["clave"])?$data["clave"]:null; 
        $elemento->perfil = isset($data["perfil"])?$data["perfil"]:null; 
        $elemento->sexo = isset($data["sexo"])?$data["sexo"]:null; 

        if($elemento !== null){
            $token = $this->CrearToken($elemento);
            $JsonResponse = $response->withJson($token, 200);  
        }
        else{
            $JsonResponse = $response->withJson(false, 200);
        }
        
        return $JsonResponse;
    }

    // Valida el Token 
    public function ValidarSession($request, $response, $next) {        
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $deco = $this->ValidarToken($token);
                
        if($deco != false){ 
            // Agrego parametro id del usuario logeado. 
            $parametros = $request->getParsedBody(); 
            $parametros["usuarioId"] = $deco->UsuarioId; 
            $request = $request->withParsedBody($parametros); 

            $response = $next($request, $response);            
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }        
    }   

    // Valida el Token rol Admin
    public function ValidarSessionAdmin($request, $response, $next) {
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $deco = $this->ValidarToken($token);

        if($deco->rol == "admin"){
            $response = $next($request, $response);            
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }        
    } 

    // Valida el Token rol Admin
    public function ValidarSessionGetCompra($request, $response, $next) {
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $deco = $this->ValidarToken($token);

        if($deco != false){ 
            // Agrego parametro id del usuario logeado. 
            $parametros = $request->getParsedBody(); 
            $parametros["rol"] = $deco->rol; 
            $request = $request->withParsedBody($parametros); 

            $response = $next($request, $response);            
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }     
          
    }   
    
    public function ValidarTokenYLog($request, $response, $next) {
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $deco = $this->ValidarToken($token);

        if($deco != false){ 
            
            // Log            
            $parametros = $request->getParsedBody(); 
            $parametros["usuario"] = $deco->UsuarioId;
            $parametros["metodo"] = $request->getMethod();
            $parametros["ruta"] = $deco->getRequestTarget();            
            
            $request = $request->withParsedBody($parametros); 
            $response = $next($request, $response);            
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }     
          
    }   

    // Crea un token asociado al rol del usuario logueado.
    private function CrearToken($elemento){
        $token = false;
        $ahora = time();
        
        $usuario = UsuarioDAO::ConsultarUsuario($elemento);
        
        if ($usuario != null){        
            $payload = array(
                'iat' => $ahora,
                //'exp' => $ahora + (300),
                'app' => "API FM",
                'rol' => $usuario["perfil"],
                'UsuarioId' => $usuario["id"]
            );
    
            $token = JWT::encode($payload, self::CLAVE);
        }
        
        return $token;
    } 

    // Verifica que el token sea vàlido y lo retorna como un objeto.
    private function ValidarToken($token){
        $valido = false;        

        if(empty($token) || $token === ""){
            //throw new Exception("Token vacio.");            
        }
        else
        {
            try
            {
                $decodificado = JWT::decode(
                    $token,
                    self::CLAVE,
                    ['HS256']
                );

                if($decodificado !== null && $decodificado != ""){
                    $valido = $decodificado;
                }
            }
            catch(Exception $ex)
            {                
                $valido = false;                
            }
        }
        
        return $valido;
    }
}
?>