<?php    
    include_once "./04-acciones/post.php";
    include_once "./04-acciones/get.php";

    $solicitud = $_SERVER["REQUEST_METHOD"];    

    switch($solicitud){
        case "GET":             
            $caso = isset($_GET["caso"])?$_GET["caso"]:null;

            switch($caso){
                case "listarUsuarios":
                    if(isset($_GET["nombre"])){                
                        echo Get::GetUsuariosByNombre($_GET["nombre"]);             
                    }
                    else{
                        echo "Error listarUsuarios";
                    }
                    break;
                case "listarProductos":
                    if(isset($_GET["criterio"]) && isset($_GET["valor"])){
                        echo Get::GetProductosOUsuarios($_GET["criterio"], $_GET["valor"]);
                    }
                    else if(count($_GET) == 1){
                        echo Get::GetProductos();
                    }
                    else{
                        echo "Error nexo.";
                    }                                        
                    break;                
                default:
                    echo "Error Get entidad.";
                    break;
            }                      
            break;

        case "POST":     
            $caso = isset($_POST["caso"])?$_POST["caso"]:null;
       
            switch($caso){
                case "crearUsuario":
                    echo Post::CrearUsuario($_POST);
                    break;
                case "login":
                    echo Post::Login($_POST);
                    break;
                case "cargarProducto":
                    echo Post::CargarProducto($_POST, $_FILES);
                    break;
                case "modificarProducto":
                    echo Post::modificarProducto($_POST, $_FILES);  
                    break;
                default:
                    echo "Error Post entidad.";
                    break;
            }
            break;
        
        default:
            echo "Defalut HTTP.";
            break;        
    }
?>