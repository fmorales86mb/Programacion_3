<?php    
    include_once "./Acciones/funcionesArch.php";
    include_once "./Entidades/alumno.php";

    // url del archivo.
    $fileUrl = "./Data/archivo.txt";
    $fileCsv = "./Data/archivo.csv";            
    
    $alum[0] = new alumno("Federico", "Morales", "32");
    $alum[1] = new alumno("Luis", "Moreno", "22");
    $alum[2] = new alumno("Marcelo", "Ventosa", "33");
    $alum[3] = new alumno("Guillermo", "Gutierrez", "56");
    
    foreach($alum as $item)
    {
        //EscribirLineaArch($fileCsv, $item->ToCsv());
    }
    
    echo LeerArch($fileCsv);
    echo $alum[0]->ToJson();
    
    // Leo el Array
    // for($j=0; $j < count($lista); $j++)
    // {
    //     for($x = 0; $x < count($lista[$j]); $x++)
    //     {
    //         echo ($lista[$j][$x]);
    //     }        
    // }
        
?>
