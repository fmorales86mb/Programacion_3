<?php
include_once "./03-DAO/UsuarioDAO.php";

use \Firebase\JWT\JWT;

class AutenticacionAPI{    
    private const CLAVE = "claveSecreta";

    // Evalua la existencia de la tupla nombre-clave y retorna token o false.
    public function Login($request, $response, $next) {
        $data = $request->getParsedBody(); 
        
        $nombre = isset($data["nombre"])?$data["nombre"]:null;
        $clave = isset($data["clave"])?$data["clave"]:null;

        if($nombre !== null && $clave !== null){
            $token = $this->CrearToken($nombre, $clave);
            $response->write($token);
        }
        else{
            $response->write(false);
        }
        
        return $response;
    }

    // Valida el Token 
    public function ValidarSession($request, $response, $next) {        
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $esValido = $this->ValidarToken($token);
        
        if($esValido){
            $response = $next($request, $response);
            //$response->write("ok!");
            return $response;            
        }
        else{
            $response->write("inválido");
            return $response;
        }        
    }   

    private function CrearToken($nombre, $clave){
        $token = false;
        $ahora = time();

        if (UsuarioDAO::ConsultarUsuario($nombre, $clave)){
            $payload = array(
                'iat' => $ahora,
                //'exp' => $ahora + (300),
                'app' => "API FM"
            );
    
            $token = JWT::encode($payload, self::CLAVE);
        }
        
        return $token;
    } 

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

                if($decodificado !== null){
                    $valido = true;
                }
            }
            catch(Exception $ex)
            {                
                //throw $ex;                
            }
        }
        
        return $valido;
    }
}
?>