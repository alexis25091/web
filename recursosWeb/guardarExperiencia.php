<?php
session_start();
include("../script/conexion.php");
$conexion = conexion::conexionBD();

if (!isset($_SESSION['usuario_id'])) {
    die("Usuario no autenticado.");
}

$id_usuario = $_SESSION['usuario_id'];
$compania = $_POST['compania'];
$puesto = $_POST['puesto'];
$funciones = $_POST['funciones'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'] ?: null;

try {
    $conexion = conexion::conexionBD();

    // 1. Obtener el id_perfil del usuario
    $consultaPerfil = $conexion->prepare("SELECT id_perfil FROM Perfiles WHERE id_usuario = :id_usuario");
    $consultaPerfil->bindParam(':id_usuario', $id_usuario);
    $consultaPerfil->execute();

    $perfil = $consultaPerfil->fetch(PDO::FETCH_ASSOC);

    if (!$perfil) {
        die("No se encontró un perfil asociado al usuario.");
    }

    $id_perfil = $perfil['id_perfil'];

    $insertar = $conexion->prepare("
        INSERT INTO Experencias (id_perfil, empresa, puesto, descripcion, fecha_inicio, fecha_fin)
        VALUES (:id_perfil, :empresa, :puesto, :descripcion, :fecha_inicio, :fecha_fin)
    ");

    $insertar->bindParam(':id_perfil', $id_perfil);
    $insertar->bindParam(':empresa', $compania);
    $insertar->bindParam(':puesto', $puesto);
    $insertar->bindParam(':descripcion', $funciones);
    $insertar->bindParam(':fecha_inicio', $fecha_inicio);
    $insertar->bindParam(':fecha_fin', $fecha_fin);

    if ($insertar->execute()) {
        header("Location: experiencia.html?guardado=1");
        exit();
    } else {
        echo "Error al guardar la experiencia.";
    }
} catch (PDOException $e) {
    die("Error en la base de datos: " . $e->getMessage());
}
