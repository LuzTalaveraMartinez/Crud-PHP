<?php


session_start();

    // COMPROBAMOS SI HAY SESIONES

 if(isset($_SESSION['usuario'])){

    // LAS DESTRUIMOS 

    session_destroy();

    // Y REDIRIGIMOS A INDEX.PHP

    header("Location: index.php");
 }