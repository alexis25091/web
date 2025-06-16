<?php
    session_start();
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $tsql = "SELECT * FROM Usuarios WHERE correo = ?";
        $params = [$email];
        $stmt = sqlsrv_query($conn, $tsql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $usuario = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Verifica si existe el usuario y si la contraseña coincide
        if ($usuario && $password == $usuario['contraseña']) {
            $_SESSION['usuario'] = $usuario['correo'];
            $_SESSION['nombre'] = $usuario['nombre_completo'];
            $_SESSION['tipo'] = $usuario['tipo_usuario'];

            // Redirige al panel principal
            header("Location: ../recursosWeb/principal.php");
            exit();
        } else {
            // Redirige con error si falla el login
            header("Location: ../recursosWeb/iniciarSesion.php?error=1");
            exit();
        }
    }
?>