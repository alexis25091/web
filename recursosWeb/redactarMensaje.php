<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redactar Mensaje - Music & Talent</title>
    <link rel="stylesheet" href="../estilos/template.css">
    <link rel="stylesheet" href="../estilos/redactarMensaje.css">
</head>

<body onload="abrirFormulario()">
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
            <a href="#" class="profile-icon" title="Ver perfil">
                <img src="../imagenes/usuario.png" alt="usuario">
            </a>
        </nav>
    </header>

    <!-- Modal de redacción -->
    <main>
        <div class="formulario-contenedor" id="ventanaRedactar">
            <div class="formulario-header">
                <h2>Redactar mensaje</h2>
                <button class="cerrar-btn" onclick="cerrarVentana()">&times;</button>
            </div>

            <form action="procesarMensaje.php" method="POST" class="formulario-body">
                <label for="correo">Destinatario (correo):</label>
                <input type="email" name="correo" id="correo" required placeholder="correo@ejemplo.com">

                <label for="mensaje">Mensaje:</label>
                <textarea name="mensaje" id="mensaje" rows="6" required placeholder="Escribe tu mensaje..."></textarea>

                <button type="submit" class="enviar-btn">Enviar mensaje</button>
            </form>
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

    <script>
        function abrirFormulario() {
            document.getElementById("ventanaRedactar").style.display = "block";
        }
        function cerrarVentana() {
            window.location.href = "mensajes.php";
        }
    </script>
</body>

</html>
