<?php
    include_once "./04-Acciones/alumnoApi.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require './vendor/autoload.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(['settings' => $config]);
    
    $app->group('/alumno', function () {

        $this->get('/{id}', \AlumnoApi::class . ':TraerUno');

        $this->get('/', \AlumnoApi::class . ':TraerTodos');

        $this->post('/', function (Request $request, Response $response) {
            $data = $request->getParsedBody();        
            $nombre = $data["name"];
            $response->write("Post $nombre");
        
            return $response;
        });

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