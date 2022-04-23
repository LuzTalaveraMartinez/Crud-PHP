<?php

if (isset($_POST)) {

    //CONEXION A LA BASE DE DATOS

    require_once 'includes/conexion.php';

    $titulo = isset($_POST["titulo"]) ? mysqli_real_escape_string($conexion, $_POST['titulo']) : false;
    $descripcion = isset($_POST["descripcion"]) ? mysqli_real_escape_string($conexion, $_POST['descripcion']) : false;
    $categoria = isset($_POST["categoria"]) ?  (int)$_POST['categoria'] : false;
    $usuario= $_SESSION['usuario']['id']; //RECOGEMOS EL ID CREADO POR LA SESIONES

    // VALIDACIÓN

    //GENERAMOS UNA VARIABLE ARRAY

    $errores = array(); // Para ir guardando los errores

    //     VALIDAMOS LOS DATOS ANTES DE GUARDALOS EN LA BASE DE DATOS
    //     VALIDAMOS EL NOMBRE

    if (empty($titulo)){
        $errores['titulo']= 'El título no es válido';
    }
    
    if (empty($descripcion)){
        $errores['descripcion']= 'La descripción no es válida';
    }

    if (empty($categoria) && !is_numeric($categoria)){
        $errores['categoria']= 'La categoria no es válida';
    }

    if(count($errores)== 0){

        if(isset($_GET['editar'])){

            $entrada_id=$_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];

            $sql= "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria ".
                " WHERE id= $entrada_id AND usuario_id =$usuario_id";         
        }else{
            $sql= "INSERT INTO entradas VALUES(null, '$usuario', '$categoria', '$titulo', '$descripcion', CURDATE());"; 
        }

        $guardar= mysqli_query($conexion, $sql);
        header("Location: index.php"); // Una vez aguardados mis datos

    }else{
        
        $_SESSION['errores_entrada'] = $errores; // Acá creamos una sesión de errores en el caso de que no nos deje guardar los datos

        if(isset($_GET['editar'])){
            header("Location: editar-entradas.php?id=".$_GET['editar']);
        }
        header("Location: crear-entradas.php");

}

}
