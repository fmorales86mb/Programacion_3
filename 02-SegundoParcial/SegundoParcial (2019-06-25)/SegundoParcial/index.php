<?php
    include_once "./04-Acciones/UsuarioApi.php";
    include_once "./04-Acciones/MateriaApi.php";
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
    $app->group('/usuario', function () {        
        $this->post('/', \UsuarioApi::class . ':CargarUno');
        $this->post('/{legajo}', \UsuarioApi::class . ':CargarDatosPorLegajo')
            ->add(\AutenticacionApi::class . ':ValidarSessionPorTipo');
        
    });
    
    // Materia ABM
    $app->group('/materia', function () {    
        $this->post('/', \MateriaApi::class . ':CargarUno')->add(\AutenticacionApi::class . ':ValidarSessionAdmin');        
    });

    $app->group('/materias', function () {            
        $this->get('/', \MateriaApi::class . ':GetMaterias')->add(\AutenticacionApi::class . ':ValidarSessionPorTipo');
    });

    // Inscripción
    $app->group('/inscripcion', function () {    
        $this->post('/{id}', \MateriaApi::class . ':Inscribir');
    })->add(\AutenticacionApi::class . ':ValidarSessionInscribir');

    $app->run();
?>