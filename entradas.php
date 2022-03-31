<?php

require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';


?>



<!--  DIV PRINCIPAL  -->

<div id="principal">

    <h1>Todas las entradas</h1>


    <?php

    $entradas = conseguirEntradas($conexion);

    if (!empty($entradas)) :

        while ($entrada = mysqli_fetch_array($entradas)) :

    ?>

            <article class="entrada">

                <a href="entrada.php?id=<?= $entrada['id'] ?>">

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
    endif;
    ?>

</div>

<!--DIV FIN PRINCIPAL-->



<?php require_once 'includes/pie.php'; ?>