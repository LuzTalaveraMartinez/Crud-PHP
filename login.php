<?php

        //   INICIAMOS LA SESION  Y LA CONEXÍON A LA BD

        require_once 'includes/conexion.php';

        if(isset($_POST)){

        // BORRAR ERROR ANTIGUO

            if(isset($_SESSION['error_login'])){ // SI EXISTE LO BORRAMOS UN EL UNSET
                unset($_SESSION['error_login']);
            } 

            
        //   RECOGEMOS LOS DATOS DEL FORMULARIO


        $email=trim($_POST['email']);
        $password=$_POST['password'];


        //   CONSULTA PARA COMPROBAR LAS CREDENCIALES DEL USUARIO



        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login= mysqli_query($conexion, $sql);

        if($login && mysqli_num_rows($login) == 1){

        $usuario = mysqli_fetch_assoc($login); // CREAMOS UNA VARIABLE QUE SEA USUARIO Y CON FETCH_ASSOC ME SACA DATOS ASOCIATIVOS



        //COMPROBAMOS Y CIFRAMOS LA CONTRASEÑA



        $verificada= password_verify($password, $usuario['password']);

            if($verificada){

            //   UTILIZAR UNA SESIÓN PARA GUARDAR LOS DATOS DEL USUARIO LOGUEADO

                $_SESSION['usuario'] = $usuario; // SINO ME CREO UNA SESION 


            }else{

            //   SI ALGO FALLA ENVIAR UNA SESIÓN CON EL FALLO
            $_SESSION['error_login'] = "Usuario incorrecto!!!";

            }

        }else{
          
            // MENSAJE  DE ERROR
            $_SESSION['error_login'] = "Usuario incorrecto!!!";

        }

    }

        //   REDIRIGIR AL INDEX.PHP

        header('Location: index.php'); 
