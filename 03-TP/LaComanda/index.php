<?php
    include_once "./04-Acciones/EmpleadoApi.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(['settings' => $config]);
    
    $app->group('/empleados', function () {

        $this->get('/{id}', \EmpleadoApi::class . ':TraerUno');

        $this->get('/', \EmpleadoApi::class . ':TraerTodos');

        $this->post('/', \EmpleadoApi::class . ':CargarUno');

        $this->put('/', function (Request $request, Response $response) {
            $data = $request->getParsedBody();        
            $nombre = $data["name"];
            $response->write("Put $nombre");
        
            return $response;
        });

        $this->delete('/', function (Request $request, Response $response) {
            $data = $request->getParsedBody();        
            $nombre = $data["name"];
            $response->write("Delete $nombre");
        
            return $response;
        });        
    });

    $app->run();
?>