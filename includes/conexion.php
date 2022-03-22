<?php

$servidor='localhost';
$usuario='root';
$pass='';
$bbdd="blog";

$conexion=mysqli_connect($servidor,$usuario,$pass,$bbdd);

mysqli_set_charset($conexion, "utf8"); //Para que me reconozca todo tipo de caracter



//COMPROBACION DE CONEXION


//if(mysqli_connect_errno()){  // Devuelve el el error de la última conexión
//   echo "La conexión a la base de datos a fallado: " .mysqli_connect_error(); //nos imprime el en error que se produjo.
//}else{
//   echo "Conexión realizada correctamente!!!" ."<br>"."<br>";
//}

//Iniciamos la sesión 

session_start();


?>