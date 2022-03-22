<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Blog</title>
</head>

<body>

    <!--   CABECERA  -->

    <header id="cabecera">
        <div id="logo">

            <a href="index.php">
                Blog de Videojuegos
            </a>

        </div>

        <!--   MENU  -->


        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>

                <?php 

                $categorias=conseguirCategorias($conexion);
                
                while($categoria=mysqli_fetch_assoc($categorias)) : 
                
                ?>

                <li>
                    <a href="categoria.php?id=<?=$categoria['id']?>"> 
                        <?=$categoria['nombre']?>
                    </a>
                </li>


                <?php endwhile; ?>

                <li>
                    <a href="index.php">Sobre nosotros</a>
                </li>
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="contenedor">

