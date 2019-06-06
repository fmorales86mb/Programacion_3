
<?php

/*
// Variables
echo "Variables <br>";
// Siempre con $ y ;
$nombre = "mario";
$legajo = "111";
echo $nombre;
echo "<br>";
echo $nombre.$legajo;
echo "<br>";
// nos permite imprimir objetos y arrays
var_dump($legajo); // tipo, valor, extensión  
var_dump($nombre);

// Arrays
echo "<br> Arrays <br>";
$heroes = array(1,2,3); // igual a $heroe[0]=1; $heroe[1]=2; etc Le estoy pasando el índice
$heroes[10]=22;//agrega indice y valor, nada máss
$heroes[]=13; //se lo asigna al siguiente del último

var_dump($heroes);  

//otro tipo de array
$heroe2 = array("nombre"=>"batman", "superpoder"=>"batipoder");
var_dump($heroe2);

// recorrer el arrary
foreach($heroes as $item){
    echo $item; //muestra el valor
}
echo "<br>";
foreach($heroes as $clave => $valor){
    echo "$clave - $valor";
}
echo "<br>";
*/

// Variables SuperGlobales

//var_dump($_GET); // se le pasa como parametros en el postman. Es como un array
//var_dump($_POST); // para el post se mandan los parametros en el body con el "index.php" en la url
/*
$lista=array(1,2,3,4,5,6,7,8,9,10);

shuffle($lista);    // desordena
//var_dump($lista);

// creo una variable que toma el valor del parametro pasado en el get
$orden = $_GET["orden"];

// ordena de menor a mayor
if($orden == 1)
    asort($lista);

// ordena al revés
if($orden == 0)
 arsort($lista); 

// muestro
foreach($lista as $val)
{
    echo $val;
    echo "<br>";
}
*/

$persona = array("name" => "pepe");
var_dump($persona);

echo $persona['name'];
echo "<br>";

// Objetos
$personaO = (object) $persona;
var_dump($personaO);
echo "<br>";

//
$personaO->name='mario';
var_dump($personaO);

$personaStd= new stdClass();
$personaStd->name = 'asdf';
var_dump($personaStd);

?>