<?php
session_start();
include("../script/conexion.php");
$conexion = conexion::conexionBD();

// Validar sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: iniciarSesion.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Obtener id_perfil
$sqlPerfil = $conexion->prepare("SELECT id_perfil FROM Perfiles WHERE id_usuario = :id");
$sqlPerfil->bindParam(':id', $id_usuario);
$sqlPerfil->execute();
$perfil = $sqlPerfil->fetch(PDO::FETCH_ASSOC);

$experiencias = [];

if ($perfil) {
    $id_perfil = $perfil['id_perfil'];

    // Obtener experiencias laborales
    $sqlExp = $conexion->prepare("SELECT * FROM Experencias WHERE id_perfil = :id_perfil ORDER BY fecha_inicio DESC");
    $sqlExp->bindParam(':id_perfil', $id_perfil);
    $sqlExp->execute();
    $experiencias = $sqlExp->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habilidades</title>
    <link rel="stylesheet" href="../estilos/template.css">
    <link rel="stylesheet" href="../estilos/habilidades.css">
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
        <a href="perfil.php" class="profile-icon" title="Ver perfil">
            <img src="../imagenes/usuario.png" alt="usuario">
        </a>
    </nav>
</header>

<!-- Experiencias -->
<main>
    <section class="experiencia-wrapper">
        <h1 class="titulo-exp">Mi Experiencia Laboral</h1>

        <div class="experiencias">
            <?php foreach ($experiencias as $exp): ?>
                <div class="tarjeta-experiencia">
                    <h2><?= htmlspecialchars($exp['empresa']) ?></h2>
                    <p><strong>Puesto:</strong> <?= htmlspecialchars($exp['puesto']) ?></p>
                    <p><strong>Funciones:</strong> <?= htmlspecialchars($exp['descripcion']) ?></p>
                    <p><strong>Periodo:</strong>
                        <?= date("M Y", strtotime($exp['fecha_inicio'])) ?> -
                        <?= $exp['fecha_fin'] ? date("M Y", strtotime($exp['fecha_fin'])) : "Actualidad" ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
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