<?php

// Desde el post paso en el body los parámetros para inicializar el objeto alumno, luego 
// devuelvo con el echo un json.

include_once "./Entidades/alumno.php";

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
$legajo = $_POST["legajo"];

$alumno1=new Alumno($nombre, $apellido, $dni, $legajo);

echo $alumno1->ToJson();

?>