<?php
    include_once "./04-Acciones/EmpleadoApi.php";
    include_once "./04-Acciones/ItemApi.php";
    include_once "./04-Acciones/UsuarioApi.php";
    include_once "./04-Acciones/AutenticacionApi.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(['settings' => $config]);    
    
    // Login
    $app->post('/login', \AutenticacionApi::class . ':Login');

    // Empleados ABM
    $app->group('/empleados', function () {

        $this->get('/{id}', \EmpleadoApi::class . ':TraerUno');

        $this->get('/', \EmpleadoApi::class . ':TraerTodos');

        $this->post('/', \EmpleadoApi::class . ':CargarUno');

        $this->put('/', \EmpleadoApi::class . ':ModificarUno');

        $this->delete('/', \EmpleadoApi::class . ':BorrarUno');        
    })->add(\AutenticacionApi::class . ':ValidarSession');

    // Items ABM
    $app->group('/items', function () {

        $this->get('/{id}', \ItemApi::class . ':TraerUno');

        $this->get('/', \ItemApi::class . ':TraerTodos');

        $this->post('/', \ItemApi::class . ':CargarUno');

        $this->put('/', \ItemApi::class . ':ModificarUno');

        $this->delete('/', \ItemApi::class . ':BorrarUno');        
    })->add(\AutenticacionApi::class . ':ValidarSession');

    // Usuarios ABM
    $app->group('/usuarios', function () {

        //$this->get('/{id}', \ItemApi::class . ':TraerUno');

        $this->get('/', \UsuarioApi::class . ':TraerTodos');

        $this->post('/', \UsuarioApi::class . ':CargarUno');

        //$this->put('/', \ItemApi::class . ':ModificarUno');

        //$this->delete('/', \ItemApi::class . ':BorrarUno');        
    });

    $app->run();
?>