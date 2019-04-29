<?php
    //include_once "./entidades/proveedor.php";
    include_once "./acciones/post.php";
    include_once "./acciones/get.php";

    $solicitud = $_SERVER["REQUEST_METHOD"];    

    switch($solicitud){
        case "GET":            
            // Trae item por nombre.
            if(count($_GET) != 0){                
                echo Get::GetProveedorByNombre($_GET["nombre"]);                
            }
            // Trae lista de items.
            else{
                echo Get::GetProveedores();
            }            
            break;

       case "POST":
            // Agrega item.
            //var_dump($_POST);  
            //var_dump($_FILES);                                        
            Post::CargarProveedor($_POST, $_FILES);
            break;
    }
?>