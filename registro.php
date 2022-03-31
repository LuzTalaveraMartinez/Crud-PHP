<?php

    //      VERIFICAMOS QUE NOS VENGAS DATOS POR POST


    if (isset($_POST)) {

    //CONEXION A LA BASE DE DATOS

    require_once 'includes/conexion.php';

    //      GENERAMOS UNA SESIÓN

    if(!isset($_SESSION)){ //Cuando no existe $_SESSION la creamos y la sesion se iniciaria si no la hubieramos iniciado
        session_start();
    }


    //      RECOGEMOS LOS VALORES DEL FORMULARIO DE REGISTRO

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false; // Hacemos un trim para guardar el email sin espacios
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conexion, $_POST['password']) : false;


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


    //     VALIDAMOS LOS APELLIDOS

    if (!empty($apellidos)  && !is_numeric($apellidos) && !preg_match('/[0-9]/', $apellidos)) {  // CHEQUEAMOS QUE NO VENGA VACIO, NI QUE SEA NÚMERICO, COMPROBAMOS QUE NO SE CUMPLE LA FUNCION REGULAR PARA CHEQUEAR QUE NO SEA NUMERO DEL 
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son válido";
    }


    //     VALIDAMOS EL EMAIL

    if (!empty($email)  && filter_var($email, FILTER_VALIDATE_EMAIL)) {  // CHEQUEAMOS QUE NO VENGA VACIO Y FILTRAMOS QUE SEA REALMENTE UN FORMATO EMAIL
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es válido";
    }


    //      VALIDAMOS LA CONTRASEÑA

    if (!empty($password)) {  // CHEQUEAMOS QUE NO VENGA VACIA
        $password_validado = true;
    } else {
        $password_validado = false;
        $errores['password'] = "La contraseña está vacia";
    }



    // CREAMOS UNA VARIABLE

    $guardar_usuario = false;

    if (count($errores) == 0) {   //CUANDO LOS ERRORES SEAN IGUAL A 0 

        $guardar_usuario = true;

        //CIFRAMOS LA CONTRASEÑA

        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        //var_dump($password);
        //var_dump($password_segura);
        //var_dump(password_verify($password, $password_segura));
        //die();

        // INSERTAMOS EL USUARIO EN LA BASE DE DATOS EN LA TABLA DE USUARIOS 

        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($conexion, $sql);

        //var_dump(mysqli_error($conexion)); CON ESTA SENTENCIA PODER VER LOS ERRORES PRODUCIDOS Y DARLE UN STOP con die
        //die();

        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha realizado con éxito.";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }

    //var_dump($errores); // Van aparecer los errores  encontrados
}

        // REDIRECCIONAMOS AL INDEX.PHP

header('Location: index.php');
