<?php

require_once 'includes/conexion.php';


if(isset($_SESSION['usuario']) && isset($_GET['id'])){

    $categoria_id=$_GET['id'];
    $usuario_id=$_SESSION['usuario']['id'];

    $sql= "DELETE FROM categorias WHERE nombre = $usuario_id AND id = $categoria_id";
    $borrar= mysqli_query($conexion, $sql);

}

header("Location: index.php");

?>