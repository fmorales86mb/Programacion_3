<?php
    include_once "./04-Acciones/EmpleadoApi.php";
    include_once "./04-Acciones/AutenticacionApi.php";
    require_once '.\03-DAO\AutenticacionDAO.php';

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(['settings' => $config]);
    
$md= function ($request, $response, $next) {        
    $data = getallheaders();        
    $token = isset($data["token"])?$data["token"]:"";

    $valido = Autenticacion::ValidarToken($token);
    var_dump($token);
    if($valido){
        $response = $next($request, $response);
    }
    else{
        $response->write("inválido");
        return $response;
    }        
};

    // Empleados ABM
    $app->group('/empleados', function () {

        $this->get('/{id}', \EmpleadoApi::class . ':TraerUno');

        $this->get('/', \EmpleadoApi::class . ':TraerTodos');

        $this->post('/', \EmpleadoApi::class . ':CargarUno');

        $this->put('/', \EmpleadoApi::class . ':ModificarUno');

        $this->delete('/', \EmpleadoApi::class . ':BorrarUno');        

        // $this->post('/validar', \AutenticacionAPI::class . ':ValidarToken');
    })->add($md);
    
    $app->group('/login', function () {
        $this->post('/', \AutenticacionAPI::class . ':Login');
    });

    $app->run();
?>