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

        $this->post('/{legajo}/{email}', \UsuarioApi::class . ':CargarDatosPorLegajo')
            ->add(\AutenticacionApi::class . ':ValidarSessionPorTipo');
        
    });
    
    // Materia ABM
    $app->group('/materia', function () {    
        $this->post('/', \MateriaApi::class . ':CargarUno');
        $this->get('/', \MateriaApi::class . ':GetMaterias');
    })->add(\AutenticacionApi::class . ':ValidarSessionAdmin');

    // Materia ABM
    $app->group('/inscripcion', function () {    
        $this->post('/{id}', \MateriaApi::class . ':Inscribir');
    })->add(\AutenticacionApi::class . ':ValidarSessionInscribir');

#region
    // Compra ABM
    $app->group('/compra', function () {
        //$this->get('/{id}', \ProductoApi::class . ':TraerUno');

        $this->get('/', \CompraApi::class . ':TraerTodos')->add(\AutenticacionApi::class . ':ValidarSessionGetCompra');

        $this->post('/', \CompraApi::class . ':CargarUno');    

        //$this->put('/', \ProductoApi::class . ':ModificarUno');

        //$this->delete('/', \ProductoApi::class . ':BorrarUno'); 

    })->add(\AutenticacionApi::class . ':ValidarSession');

    // Producto ABM
    // $app->group('/productos', function () {
    //     $this->get('/{id}', \ProductoApi::class . ':TraerUno');

    //     $this->get('/', \ProductoApi::class . ':TraerTodos');

    //     $this->post('/', \ProductoApi::class . ':CargarUno');    

    //     $this->put('/', \ProductoApi::class . ':ModificarUno');

    //     $this->delete('/', \ProductoApi::class . ':BorrarUno'); 

    // })->add(\AutenticacionApi::class . ':ValidarSessionSocio');

    // Mesa ABM
    // $app->group('/mesas', function () {
    //     $this->get('/', \MesaApi::class . ':TraerTodos');

    //     $this->put('/', \MesaApi::class . ':ModificarUno');

    // })->add(\AutenticacionApi::class . ':ValidarSessionSocio');

    // // Comanda ABM
    // $app->group('/comandas', function () {
    //     $this->get('/{id}', \ComandaApi::class . ':TraerUno');

    //     $this->get('/', \ComandaApi::class . ':TraerTodos');

    //     $this->post('/', \ComandaApi::class . ':CargarUno');    

    //     $this->put('/', \ComandaApi::class . ':ModificarUno');

    //     $this->delete('/', \ComandaApi::class . ':BorrarUno'); 

    // })->add(\AutenticacionApi::class . ':ValidarSessionSocio');

    // // Pedido ABM
    // $app->group('/pedidos', function () {
    //     $this->get('/{rol}/{estado}', \PedidoApi::class . ':TraerPorRolYEstado');

    //     $this->post('/', \PedidoApi::class . ':CargarUno');    

    // })->add(\AutenticacionApi::class . ':ValidarSessionSocio');
#endregion

    $app->run();
?>