<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $conn = conexion::conexionBD(); // llama al metodo estatico que retorna un PDO

        // Consulta segura con prepare (evita inyección SQL)
        $tsql = "SELECT * FROM Usuarios WHERE correo = :correo";
        $stmt = $conn->prepare($tsql);
        $stmt->execute([':correo' => $email]);

        // obtener al usuario de que se haya logueado
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        /*echo "<pre>";
        print_r($usuario);
        echo "</pre>";
        exit();*/



        if ($usuario && $password === $usuario['contraseña']) {
            $_SESSION['usuario_id'] = $usuario['id_usuario']; 
            $_SESSION['usuario'] = $usuario['correo'];
            $_SESSION['nombre'] = $usuario['nombre_completo'];
            $_SESSION['tipo'] = $usuario['tipo_usuario'];

            header("Location: ../recursosWeb/principal.php");
            exit();
        } else {
            header("Location: ../recursosWeb/iniciarSesion.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        die("error en la base de datos: " . $e->getMessage());
    }
}
