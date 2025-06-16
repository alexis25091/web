<?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tipo_usuario = $_POST['user_type'];

        // IMPORTANTE: aquí NO ciframos la contraseña por ahora
        $password_guardar = $password;

        // Si quisieras cifrarla, reemplaza la línea de arriba por esta:
        // $password_guardar = password_hash($password, PASSWORD_DEFAULT);

        // Verificar si el correo ya existe
        $tsql = "SELECT * FROM Usuarios WHERE correo = ?";
        $params = [$email];
        $stmt = sqlsrv_query($conn, $tsql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_has_rows($stmt)) {
            echo "⚠️ El correo ya está registrado.";
        } else {
            $insertSql = "INSERT INTO Usuarios (nombre_completo, correo, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)";
            $insertParams = [$nombre, $email, $password_guardar, $tipo_usuario];
            $stmt2 = sqlsrv_query($conn, $insertSql, $insertParams);

            if ($stmt2 === false) {
                die(print_r(sqlsrv_errors(), true));
            } else {
                //  Redirige al login
                header("Location: ../recursosWeb/iniciarSesion.php?success=1");
                exit();
            }
        }
    }
?>
