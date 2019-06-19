<?php
    include_once "./04-Acciones/UsuarioAPI.php";
    // include_once "./04-Acciones/ItemApi.php";
    // include_once "./04-Acciones/UsuarioApi.php";
    include_once "./04-Acciones/AutenticacionApi.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(['settings' => $config]);    
    
    // Login
    $app->post('/login', \AutenticacionApi::class . ':Login');

    // Usuario ABM
    $app->group('/usuarios', function () {

        $this->get('/{id}', \UsuarioApi::class . ':TraerUno');

        $this->get('/', \UsuarioApi::class . ':TraerTodos');

        $this->post('/', \UsuarioApi::class . ':CargarUno');

        $this->put('/', \UsuarioApi::class . ':ModificarUno');

        $this->delete('/', \UsuarioApi::class . ':BorrarUno');        
    })->add(\AutenticacionApi::class . ':ValidarSessionSocio');
    

    $app->run();
?>