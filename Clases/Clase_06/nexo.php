<?php    
    include_once "./04-acciones/post.php";
    include_once "./04-acciones/get.php";

    $solicitud = $_SERVER["REQUEST_METHOD"];    

    switch($solicitud){
        case "GET":             
            $caso = isset($_GET["caso"])?$_GET["caso"]:null;

            switch($caso){
                case "ListaAlumnos":                            
                    echo Get::ListaAlumnos();             
                    break;   
                case "TraerAlumno":                            
                    echo Get::TraerAlumno($_GET["id"]);             
                    break;            
                default:
                    echo "Error Get entidad.";
                    break;
            }                      
            break;

        case "POST":     
            $caso = isset($_POST["caso"])?$_POST["caso"]:null;
       
            switch($caso){
                case "guardarAlumno":
                    echo Post::GuardarAlumno($_POST);
                    break;
                case "BajaAlumno":
                    echo Post::BorrarAlumno($_POST);
                    break;
                case "ModificarAlumno":
                    echo Post::ModificarAlumno($_POST);
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