<?php
require_once '.\03-DAO\AutenticacionDAO.php';

class AutenticacionAPI{
    
    public function Login($request, $response, $next) {
        $token = Autenticacion::CrearToken();
        $response->write($token);
        return $response;
    }

    public function ValidarToken($request, $response, $next) {        
        $data = getallheaders();        
        $token = isset($data["token"])?$data["token"]:"";

        $valido = Autenticacion::ValidarToken($token);
        
        if($valido){
            $response = $next($request, $response);
        }
        else{
            $response->write("inválido");
            return $response;
        }        
    }
}
?>