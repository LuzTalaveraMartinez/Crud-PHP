<?php

if(!isset($_POST['busqueda'])){
    header('Location: index.php');
}


require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';


?>



<!--  DIV PRINCIPAL  -->

<div id="principal">


    <h1>Busqueda: <?=$_POST['busqueda']?></h1>
    

    <?php

    $entradas=conseguirEntradas($conexion, null, null, $_POST['busqueda']);

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
                        <?= substr($entrada['descripcion'], 0, 180) . "..." ?>
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