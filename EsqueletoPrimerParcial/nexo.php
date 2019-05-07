<?php
    //include_once "./entidades/proveedor.php";
    include_once "./04-acciones/post.php";
    include_once "./04-acciones/get.php";

    $solicitud = $_SERVER["REQUEST_METHOD"];    

    switch($solicitud){
        case "GET":             
            $caso = isset($_GET["caso"])?$_GET["caso"]:null;

            switch($caso){
                case "consultarProveedor":
                    if(isset($_GET["nombre"])){                
                        echo Get::GetProveedorByNombre($_GET["nombre"]);             
                    }
                    else{
                        echo "Error consultarProveedor";
                    }
                    break;
                case "proveedores":
                    echo Get::GetProveedores();                    
                    break;
                case "listarPedidos":
                    echo Get::GetPedidosProveedor();                     
                    break;
                case "pedidos":
                    echo Get::GetPedidos();
                    break;
                case "consultarProveedorPorId":
                    if(isset($_GET["id"])){                                        
                        echo Get::GetProveedorById($_GET["id"]);              
                    }
                    else{
                        echo "Error consultarProveedorPorId";
                    }                    
                    break;
                case "listarPedidoProveedor":
                    if(isset($_GET["id"])){                
                        echo Get::GetPedidosByIdProveedor($_GET["id"]);             
                    }
                    else{
                        echo "Error listarPedidoProveedor";
                    }
                    break;
                case "fotosBack":
                    echo Get::GetFotosBack();
                    break;
                default:
                    echo "Error Get entidad.";
                    break;
            }                      
            break;

        case "POST":     
            $caso = isset($_POST["caso"])?$_POST["caso"]:null;
       
            switch($caso){
                case "cargarProveedor":
                    echo Post::CargarProveedor($_POST, $_FILES);
                    break;
                case "hacerPedido":
                    echo Post::CargarPedido($_POST);
                    break;
                case "modificarProveedor":
                    echo Post::modificarProveedor($_POST, $_FILES);
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