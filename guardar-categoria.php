<?php

if (isset($_POST)) {

    //CONEXION A LA BASE DE DATOS

    require_once 'includes/conexion.php';

    $nombre = isset($_POST["nombre"]) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;

    //GENERAMOS UNA VARIABLE ARRAY
    $errores = array(); // Para ir guardando los errores
    //     VALIDAMOS LOS DATOS ANTES DE GUARDALOS EN LA BASE DE DATOS
    //     VALIDAMOS EL NOMBRE
    if (!empty($nombre)  && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)) {  // CHEQUEAMOS QUE NO VENGA VACIO, NI QUE SEA NÚMERICO, COMPROBAMOS QUE NO SE CUMPLE LA FUNCION REGULAR PARA CHEQUEAR QUE NO SEA NUMERO DEL 0 AL 9
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    if(count($errores)== 0){
        $sql= "INSERT INTO categorias VALUES(null, '$nombre')";
        $guardar= mysqli_query($conexion, $sql);
    }

}


header("Location: index.php");