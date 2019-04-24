<?php
    include_once "./entidades/proveedor.php";
    include_once "./acciones/post.php";
    include_once "./acciones/get.php";

    $solicitud = $_SERVER["REQUEST_METHOD"];    

    switch($solicitud){
        case "GET":            
            var_dump($_GET["nombre"]);
            echo Get::GetProveedorByNombre($_GET["nombre"]);
            break;
       case "POST":  
            var_dump($_POST);                                          
            Post::CargarProveedor($_POST);
            break;
    }
?>