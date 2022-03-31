<?php

// VERIFICAMOS QUE NOS VENGAS DATOS POR POST


if (isset($_POST)) {


    // CONEXION A LA BASE DE DATOS

    require_once 'includes/conexion.php';


    // RECOGEMOS LOS VALORES DEL FORMULARIO PARA ACTUALIZAR DATOS DEL USUARIO


    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conexion, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($conexion, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conexion, trim($_POST['email'])) : false; // Hacemos un trim para guardar el email sin espacios


    //  GENERAMOS UNA VARIABLE ARRAY

    $errores = array(); // Para ir guardando los errores



    //  VALIDAMOS LOS DATOS ANTES DE GUARDALOS EN LA BASE DE DATOS


    // VALIDAMOS EL NOMBRE


    if (!empty($nombre)  && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)) {  // CHEQUEAMOS QUE NO VENGA VACIO, NI QUE SEA NÚMERICO, COMPROBAMOS QUE NO SE CUMPLE LA FUNCION REGULAR PARA CHEQUEAR QUE NO SEA NUMERO DEL 0 AL 9
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }


    // VALIDAMOS LOS APELLIDOS


    if (!empty($apellidos)  && !is_numeric($apellidos) && !preg_match('/[0-9]/', $apellidos)) {  // CHEQUEAMOS QUE NO VENGA VACIO, NI QUE SEA NÚMERICO, COMPROBAMOS QUE NO SE CUMPLE LA FUNCION REGULAR PARA CHEQUEAR QUE NO SEA NUMERO DEL 
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son válido";
    }


    // VALIDAMOS EL EMAIL


    if (!empty($email)  && filter_var($email, FILTER_VALIDATE_EMAIL)) {  // CHEQUEAMOS QUE NO VENGA VACIO Y FILTRAMOS QUE SEA REALMENTE UN FORMATO EMAIL
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es válido";
    }



    // CREAMOS UNA VARIABLE


    $guardar_usuario = false;

    if (count($errores) == 0) {   //CUANDO LOS ERRORES SEAN IGUAL A 0 

        $guardar_usuario = true;
        $usuario = $_SESSION['usuario'];


        // COMPROBAMOS SI EL EMAIL YA EXISTE

        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($conexion, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if ($isset_user['id'] == $usuario['id'] || empty($isset_user)){


            // ACTUALIZAR EL USUARIO EN LA BASE DE DATOS EN LA TABLA DE USUARIOS


            $sql = "UPDATE usuarios SET " .
                "nombre = '$nombre', " .
                "apellidos = '$apellidos', " .
                "email = '$email' " .
                "WHERE id=" . $usuario['id'];

            $guardar = mysqli_query($conexion, $sql);

            //var_dump(mysqli_error($conexion)); CON ESTA SENTENCIA PODER VER LOS ERRORES PRODUCIDOS Y DARLE UN STOP con die
            //die();

            if ($guardar) {

                //Le damos un nuevo valor en la sesion de USUARIO por los datos recientemente ACTUALIZADOS

                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Los datos se actualizaron correctamente.";
            }
            else
            {
                $_SESSION['errores']['general'] = "Se ha producido un error en la actualización de los datos!";
            }
        }else{
            $_SESSION['errores']['general'] = "El usuario ya existe!!";
            }
    }
}else{
    $_SESSION['errores'] = $errores;
}

// REDIRECCIONAMOS AL INDEX.PHP

header('Location: mis-datos.php');
