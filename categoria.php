<?php

require_once 'includes/conexion.php';
require_once 'includes/helpers.php';

 $categoria_actual=conseguirCategoria($conexion, $_GET['id']);

if(!isset($categoria_actual['id'])){
    header('Location: index.php');
}

require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';


?>



<!--  DIV PRINCIPAL  -->

<div id="principal">


    <h1>Entradas de <?=$categoria_actual['nombre']?></h1>
    

    <?php

    $entradas = conseguirEntradas($conexion, null, $_GET['id']);

    if (!empty($entradas) && mysqli_num_rows($entradas) >=1) :

        while ($entrada = mysqli_fetch_array($entradas)) :

    ?>

            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">

                    <h2>
                        <?= $entrada['titulo'] ?>
                    </h2>

                    <span class="fecha">
                        <?= $entrada['categoria'] . '|' . $entrada['fecha'] ?>
                    </span>

                    <p>
                        <?= substr($entrada['descripcion'], 0, 170) . "..." ?>
                    </p>

                </a>
            </article>

    <?php
        endwhile;
    else:
    ?>
    <div class="alerta">No hay entradas en esta categoría</div>

    <?php endif; ?>

</div>

<!--DIV FIN PRINCIPAL-->



<?php require_once 'includes/pie.php'; ?>