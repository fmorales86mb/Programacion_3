<?php
    include_once "./04-Acciones/UsuarioApi.php";
    include_once "./04-Acciones/ComandaApi.php";
    include_once "./04-Acciones/AutenticacionApi.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(['settings' => $config]);    
        
    $app->post('/login', \AutenticacionApi::class . ':Login');
    
    $app->group('/usuario', function () {        
        $this->post('/', \UsuarioApi::class . ':CargarUno')-> add(\AutenticacionApi::class . ':ValidarSessionSocio');                   
    });

    $app->group('/comanda', function () {        
        $this->post('/', \ComandaApi::class . ':CargarComanda')-> add(\AutenticacionApi::class . ':ValidarSessionMozo');
        $this->put('/', \ComandaApi::class . ':UpdateEstadoComanda')-> add(\AutenticacionApi::class . ':ValidarSessionPorTipo');
        $this->get('/', \ComandaApi::class . ':GetComandas')-> add(\AutenticacionApi::class . ':ValidarSessionSocio');
    });
    
    $app->post('/foto', \ComandaApi::class . ':UpdateFotoComanda')-> add(\AutenticacionApi::class . ':ValidarSessionMozo');

    $app->get('/pendientes', \ComandaApi::class . ':PedidosPendientes')-> add(\AutenticacionApi::class . ':ValidarSessionPorTipo');  
    
    $app->get('/tiempoRestante', \ComandaApi::class . ':ObtenerTiempoRestante');

    $app->run();
?>