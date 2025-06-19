<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = conexion::conexionBD();

    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $tipo_usuario = $_POST['user_type'] ?? '';

    try {
        // Verificar si el correo ya existe
        $verificar = $conn->prepare("SELECT COUNT(*) FROM Usuarios WHERE correo = ?");
        $verificar->execute([$email]);
        $existe = $verificar->fetchColumn();

        if ($existe > 0) {
            // Redirige con error
            header("Location: ../recursosWeb/registrarse.html?error=correo");
            exit();
        }

        // Insertar nuevo usuario
        $insert = $conn->prepare("INSERT INTO Usuarios (nombre_completo, correo, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)");
        $insert->execute([$nombre, $email, $password, $tipo_usuario]);

        $id_usuario = $conn->lastInsertId();

        // Crear perfil
        $crearPerfil = $conn->prepare("INSERT INTO Perfiles (id_usuario) VALUES (?)");
        $crearPerfil->execute([$id_usuario]);

        // Redirige al login
        header("Location: ../recursosWeb/iniciarSesion.php?success=1");
        exit();

    } catch (PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }
}
?>
