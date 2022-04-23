<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>


<!--  CAJA PRINCIPAL  -->


<div id="principal">
    <h1>Crear entradas</h1>

    <p>
        Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.
    </p><br>

    <form action="guardar-entrada.php" method="post">

        <label for="titulo">Titulo: </label>
        <input type="text" name="titulo"><br>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION["errores_entrada"], 'titulo') : ' '; ?>

        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion" id="descripcion"></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION["errores_entrada"], 'descripcion') : ' '; ?>

        <label for="categoria">Categoria </label>
        <select name="categoria" id="categoria">

            <?php

            $categorias = conseguirCategorias($conexion);

            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) :

            ?>

                    <option value="<?= $categoria['id'] ?>">

                        <?= $categoria['nombre'] ?>

                    </option>

            <?php
                endwhile;
            endif;
            ?>

        </select><br>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION["errores_entrada"], 'categoria') : ' '; ?>

        <input type="submit" value="Guardar">

    </form>

    <?php borrarErrores(); ?>
    
</div>


<!--  FIN CAJA PRINCIPAL  -->




<?php require_once 'includes/pie.php'; ?>