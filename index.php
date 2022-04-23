<?php

require_once 'includes/cabecera.php';
require_once 'includes/lateral.php';


?>



<!--  DIV PRINCIPAL  -->

<div id="principal">
    <h1>Ultímas entradas</h1>


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
            }


            


    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
</div>

<!--DIV FIN PRINCIPAL-->



<?php require_once 'includes/pie.php'; ?>