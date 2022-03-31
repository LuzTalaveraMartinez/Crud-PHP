<!--   BARRA LATERAL  -->


<aside id="sidebar">


    <!-- Comprobamos si existe el usuario -->

    <?php if (isset($_SESSION['usuario'])) : ?>


        <div id="usuario-logueado" class="bloque">
            <h3>
                Hola, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos']; ?>
            </h3>

            <!-- BOTONES -->


            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categoria</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar-sesion.php" class="boton boton-rojo">Cerrar sesión</a>

        </div>


    <?php endif; ?>


    <!--HACEMOS UNA CONDICIONAL GENERAL-->


    <?php if (!isset($_SESSION['usuario'])) : ?>
        <!-- COMPROBAMOS QUE EXISTA UNA SESION Y si es asi no se muestra la sessión de REGISTRARSE-->


        <div id="login" class="bloque">

            <h3>Ingresar</h3>

            <?php if (isset($_SESSION['error_login'])) : ?>

                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?>
                </div>

            <?php endif; ?>

            <form action="login.php" method="POST">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Ingrese su email"><br>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña"><br>

                <input type="submit" value="Entrar" />

            </form>

        </div>


        <div id="register" class="bloque">

            <h3>Registrarme</h3>

            <!-- MOSTRAR ERRORES -->

            <?php if (isset($_SESSION['completado'])) : ?>

                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado']; ?>
                </div>

            <?php elseif (isset($_SESSION['errores']['general'])) :  ?>

                <div class=" alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>

            <?php endif; ?>

            <form action="registro.php" method="POST">

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre"><br>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION["errores"], 'nombre') : ' '; ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" placeholder="Ingrese su apellidos"><br>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION["errores"], 'apellidos') : ' '; ?>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Ingrese su email"><br>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION["errores"], 'email') : ' '; ?>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingrese su contraseña"><br>
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION["errores"], 'password') : ' '; ?>

                <input type="submit" value="Registrar" name="submit" />

            </form>
            <?php borrarErrores(); ?>
        </div>

    <?php
    endif;
    ?>

    <!--FIN DE LA CONDICIONAL GENERAL-->

</aside>