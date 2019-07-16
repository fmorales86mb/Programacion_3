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
    
    // 2
    $app->post('/login', \AutenticacionApi::class . ':Login');

    // 1 y 4
    $app->group('/usuario', function () {        
        $this->post('/', \UsuarioApi::class . ':CargarUno');
        $this->post('/{legajo}', \UsuarioApi::class . ':CargarDatosPorLegajo')
            ->add(\AutenticacionApi::class . ':ValidarSessionPorTipo');        
    });
    
    // 3
    $app->group('/materia', function () {    
        $this->post('/', \MateriaApi::class . ':CargarUno')->add(\AutenticacionApi::class . ':ValidarSessionAdmin');        
    });

    // 6 y 7
    $app->group('/materias', function () {            
        $this->get('/', \MateriaApi::class . ':GetMaterias')->add(\AutenticacionApi::class . ':ValidarSessionPorTipo');
        $this->get('/{materia}', \UsuarioApi::class . ':GetAlumnosByMateria')->add(\AutenticacionApi::class . ':ValidarSessionAdminProfesor');
    });

    // 5
    $app->group('/inscripcion', function () {    
        $this->post('/{id}', \MateriaApi::class . ':Inscribir');
    })->add(\AutenticacionApi::class . ':ValidarSessionInscribir');

    $app->run();
?>