<?php
// 
function ExtraerArrayArchCsv($urlFile)
{
    $file = fopen($urlFile, "r");
    $lista = array();
   
    // Cargo el array
    if($file != NULL && $file != false)
    {        
        for($i = 0; !feof($file); $i++)
        {
            $lista[$i]=explode(";", fgets($file));        
        }
    }    
    
    // Cierro archivo
    fclose($file);

    return $lista;
}

// Abre si existe el archivo, lo crea sino, y escribe una línea al final. 
function EscribirLineaArch($fileUrl, $line)
{
    $file = fopen($fileUrl, "a");

    if($file != NULL && $file != false)
    {
        fwrite($file, $line);
    }

    fclose($file);
}

//
function SobreEscribirArch ($fileUrl, $txt)
{
    $file = fopen($fileUrl, "w");

    if($file != NULL && $file != false)
    {
        fwrite($file, $txt);
    }

    fclose($file);
}

// Devuelve la lectura de todo el archivo.
function LeerArch ($fileUrl)
{
    $file = fopen($fileUrl, "r");

    if($file != NULL && $file != false)
    {
        return fread($file, filesize($fileUrl));
    }

    fclose($file);
}
?>