<?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = conexion::conexionBD(); // aquí llamas a tu método de conexión

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tipo_usuario = $_POST['user_type'];
        $password_guardar = $password;

        // Verificar si el correo ya existe
        $tsql = "SELECT * FROM Usuarios WHERE correo = ?";
        $stmt = $conn->prepare($tsql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "⚠️ El correo ya está registrado.";
        } else {
            $insertSql = "INSERT INTO Usuarios (nombre_completo, correo, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->execute([$nombre, $email, $password_guardar, $tipo_usuario]);

            // Redirige al login
            header("Location: ../recursosWeb/iniciarSesion.php?success=1");
            exit();
        }
    }
?>
