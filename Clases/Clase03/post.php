<?php

function TomarDatosPost(){
    $apellidoAlumno = $_POST["apellido"];
    $legajoAlumno = $_POST["legajo"];
    $fileName = "$apellidoAlumno.$legajoAlumno";
    $datosFile = $_FILES;
    $directorio = "./img";

    GuardarArchivo($datosFile, $directorio, $fileName);
}

function GuardarArchivo ($datosFile, $directorio, $fileName){                   
    // devuelve un array de strings
    $extension = explode("/", $datosFile["imagen"]["type"]);
    $destino = "$directorio/$fileName.$extension[1]";  
    $fecha=date("Y-m-d.H-i-s");

    $urlBackup = "./img/backup/$fileName.$fecha.$extension[1]";
    // tmp_name es el nombre de la url donde se guarda el archivo temporalmente
    $origen = $datosFile["imagen"]["tmp_name"];  
    
    //$estampa = imagecreatefromjpeg("C:\xampp\htdocs\Clase3\estampa.jpg");
    $im = imagecreatefromjpeg($origen);
    //AgregarMarcaDeAgua($im);
    
    if(file_exists($destino))
    {        
        copy($destino, $urlBackup);
    }
    // guarda la imagen solo con post y en url temporales
    return move_uploaded_file($origen, $destino); 
}

function AgregarMarcaDeAgua ($im){
    // Cargar la estampa y la foto para aplicarle la marca de agua
    $estampa = imagecreatefromjpeg("./estampa.jpg");
    //$im = imagecreatefromjpeg('foto.jpeg');

    // Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
    $margen_dcho = 10;
    $margen_inf = 10;
    $sx = imagesx($estampa);
    $sy = imagesy($estampa);

    // Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
    // ancho de la foto para calcular la posición de la estampa. 
    imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

    // Imprimir y liberar memoria
    //header('Content-type: image/png');
    //imagepng($im);
    //imagedestroy($im);
}

?>