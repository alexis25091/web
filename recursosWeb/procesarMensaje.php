<?php
session_start();
include("../script/conexion.php");

if (!isset($_SESSION['usuario_id'])) {
    die("Usuario no autenticado.");
}
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
exit();*/

$conexion = conexion::conexionBD();

$remitente_id = $_SESSION['usuario_id'];
$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];

// Buscar ID del destinatario por correo
$consulta = "SELECT id_usuario FROM Usuarios WHERE correo = :correo";
$stmt = $conexion->prepare($consulta);
$stmt->bindParam(':correo', $correo);
$stmt->execute();

if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $destinatario_id = $fila['id_usuario'];

    // Insertar el mensaje
    $insertar = $conexion->prepare("
    INSERT INTO Mensajes (id_remitente, id_destinatario, contenido, fecha_envio)
    VALUES (:rem, :dest, :msj, GETDATE())
");
    $insertar->bindParam(':rem', $remitente_id);
    $insertar->bindParam(':dest', $destinatario_id);
    $insertar->bindParam(':msj', $mensaje);


    if ($insertar->execute()) {
        header("Location: mensajes.php?enviado=1");
        exit();
    } else {
        echo "Error al guardar el mensaje.";
    }
} else {
    echo "El correo ingresado no pertenece a ningún usuario.";
}
