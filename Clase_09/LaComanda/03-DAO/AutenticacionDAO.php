<?php
use \Firebase\JWT\JWT;
//namespace firebase\JWT;

class Autenticacion{

    private const CLAVE = "claveSecreta";

    public static function CrearToken(){
        $ahora = time();
        

        $payload = array(
            'iat' => $ahora,
            'exp' => $ahora + (30),
            'app' => "API FM"
        );

        $token = JWT::encode($payload, "claveSecreta");

        return $token;
    } 

    public static function ValidarToken($token){
        $valido = false;        
        var_dump($token);
        if(empty($token) || $token === ""){
            //throw new Exception("Token vacio.");            
        }
        else
        {
            try
            {
                $decodificado = JWT::decode(
                    $token,
                    "claveSecreta",
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