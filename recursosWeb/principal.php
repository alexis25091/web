<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music & Talent</title>
    <link type="text/css" rel="stylesheet" href="../estilos/template.css">
    <link type="text/css" rel="stylesheet" href="../estilos/principal.css">
    <?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit();
    }
    ?>

</head>

<body>
    <!-- Header -->
    <header class="navbar">
        <a href="../recursosWeb/principal.php">
            <img src="../imagenes/logo.png" alt="Logo de la empresa" class="logo">
        </a>
        <nav class="nav-links">
            <a href="nosotros.html">Nosotros</a>
            <a href="servicios.html">Servicios</a>
            <a href="publicarEmpleo.html">Publicar Empleo</a>
            <a href="mensajes.php">Mensajes</a>
            <a href="notificaciones.html">Notificaciones</a>
            <a href="" class="profile-icon" title="Ver perfil">
                <img src="../imagenes/usuario.png" alt="usuario">
            </a>
        </nav>
    </header>

    <!-- Pantalla principal -->
    <main id="contenido-principal" class="principal">
        <div class="seccion-bienvenida">
            <img src="../imagenes/bienvenida.jpg" alt="Bienvenida" class="welcome-image">
            <div class="texto-bienvenida">
                <h1>¡Bienvenido a Music & Talent!</h1>
                <p>En esta página lograrás conocer a personas que pueden ayudarte a cumplir tus sueños al formar una
                    nueva banda.</p>

            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-left">
            <a href="../recursosWeb/principal.php">
                <img src="../imagenes/logo.png" alt="Logo de la empresa" class="logo-footer">
            </a>
        </div>
        <div class="footer-right">
            <a href="../recursosWeb/terminosYCondiciones.html">Términos y condiciones</a>
            <a href="../recursosWeb/politicas.html">Políticas</a>
        </div>
    </footer>
</body>

</html>
