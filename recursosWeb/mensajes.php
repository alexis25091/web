<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciarSesion.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes - Music & Talent</title>
    <link type="text/css" rel="stylesheet" href="../estilos/template.css">
    <link type="text/css" rel="stylesheet" href="../estilos/mensajes.css">
</head>

<body onload="abrirVentana()">
    <!-- Header -->
    <header class="navbar">
        <a href="../recursosWeb/principal.php">
            <img src="../imagenes/logo.png" alt="Logo de la empresa" class="logo">
        </a>
        <nav class="nav-links">
            <a href="nosotros.html">Nosotros</a>
            <a href="servicios.html">Servicios</a>
            <a href="publicarEmpleo.html">Publicar Empleo</a>
            <a href="mensajes.html" id="btnMensajes">Mensajes</a>
            <a href="notificaciones.html">Notificaciones</a>
            <a href="" class="profile-icon" title="Ver perfil">
                <img src="../imagenes/usuario.png" alt="usuario">
            </a>
        </nav>
    </header>

    <main>
        <div class="contenedor-principal">

            <div class="mensaje-contenedor" id="ventanaMensajes">

                <div class="mensaje-header">
                    <h2>Mis mensajes</h2>

                    <div>
                        <button class="redactar-btn" onclick="abrirRedactor()">Redactar</button>
                        <button class="cerrar-btn" onclick="cerrarVentana()">&times;</button>
                    </div>

                </div>

                <div class="mensaje-body" id="contenidoMensajes">

                    <?php
                    include("../script/conexion.php");
                    $conexion = conexion::conexionBD();
                    $id_usuario = $_SESSION['usuario_id'];

                    $sql = "SELECT M.contenido, M.fecha_envio, U.nombre_completo AS remitente
            FROM Mensajes M
            INNER JOIN Usuarios U ON M.id_remitente = U.id_usuario
            WHERE M.id_destinatario = :id
            ORDER BY M.fecha_envio DESC";

                    $stmt = $conexion->prepare($sql);
                    $stmt->bindParam(':id', $id_usuario);
                    $stmt->execute();

                    $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($mensajes) {
                        foreach ($mensajes as $mensaje) {
                            echo "<div class='mensaje-item'>";
                            echo "<p><strong>De:</strong> " . htmlspecialchars($mensaje['remitente']) . "</p>";
                            echo "<p>" . nl2br(htmlspecialchars($mensaje['contenido'])) . "</p>";

                            $fecha = new DateTime($mensaje['fecha_envio']);
                            echo "<p class='fecha-mensaje'>" . $fecha->format('d/m/Y H:i') . "</p>";


                            echo "</div>";
                        }
                    } else {
                        echo "<p>No tienes mensajes nuevos.</p>";
                    }
                    ?>
                </div>

            </div>
        </div>
    </main>

    <?php if (isset($_GET['enviado']) && $_GET['enviado'] == 1): ?>
        <div class="mensaje-exito">
            Mensaje enviado correctamente.
            <a href="principal.php" class="boton-inicio">Volver al inicio</a>
        </div>
    <?php endif; ?>


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
        function abrirVentana() {
            document.getElementById("ventanaMensajes").style.display = "block";
        }

        function cerrarVentana() {
            document.getElementById("ventanaMensajes").style.display = "none";
        }

        function abrirRedactor() {
            window.location.href = "redactarMensaje.php";
        }
    </script>
</body>

</html>