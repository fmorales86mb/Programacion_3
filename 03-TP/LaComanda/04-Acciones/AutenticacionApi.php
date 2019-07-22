<?php
include_once "./03-DAO/UsuarioDAO.php";

use \Firebase\JWT\JWT;

// https://www.php-fig.org/psr/psr-7/

class AutenticacionAPI{    
    private const CLAVE = "claveSecreta";

    #region Métodos Públicos
    // Evalua la existencia de la tupla id-clave y retorna token o false.
    public function Login($request, $response, $next) {
        $data = $request->getParsedBody(); 
        
        $elemento = new Usuario();
        $elemento->nombre = isset($data["nombre"])?$data["nombre"]:null;
        $elemento->clave = isset($data["clave"])?$data["clave"]:null;     

        if($elemento->nombre != null && $elemento->clave != null){
            $token = $this->CrearToken($elemento);
            $JsonResponse = $response->withJson($token, 200);  
        }
        else{
            $JsonResponse = $response->withJson("error", 200);
        }
        
        return $JsonResponse;
    }       

    // Valida el Token rol Socio
    public function ValidarSessionSocio($request, $response, $next) {
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $deco = $this->ValidarToken($token);

        if($deco->rol == "socio"){
            $response = $next($request, $response);            
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }        
    } 

    // Valida el Token rol Mozo
    public function ValidarSessionMozo($request, $response, $next) {
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $deco = $this->ValidarToken($token);

        if($deco->rol == "mozo"){
            $response = $next($request, $response);            
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }        
    }
    
    // Valida el Token y pasa el tipo
    public function ValidarSessionPorTipo($request, $response, $next) {
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $deco = $this->ValidarToken($token);

        if($deco != false){ 
            // Agrego parametro id del usuario logeado. 
            $parametros = $request->getParsedBody();                                 
            $parametros["rol"] = $deco->rol;
            $parametros["id"] = $deco->UsuarioId;
            $parametros["sector"] = $deco->UsuarioSector;                         
            $request = $request->withParsedBody($parametros); 

            $response = $next($request, $response);            
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }               
    }  
    #endregion

    #region Métodos Privados
    // Crea un token asociado al rol del usuario logueado.
    private function CrearToken($elemento){
        $token = "no existe el usuario";
        $ahora = time();
        
        $usuario = UsuarioDAO::ConsultarUsuario($elemento);
        
        if ($usuario != null && $usuario->estado){        
            $payload = array(
                'iat' => $ahora,
                //'exp' => $ahora + (300),
                'app' => "API FM",
                'rol' => $usuario->rol,
                'UsuarioId' => $usuario->id,
                'UsuarioNombre' => $usuario->nombre,
                'UsuarioSector' => $usuario->sector,
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
    #endregion
}
?>