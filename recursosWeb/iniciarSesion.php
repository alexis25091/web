<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión</title>
    <link type="text/css" rel="stylesheet" href="../estilos/template.css" />
    <link type="text/css" rel="stylesheet" href="../estilos/sesion.css" />
</head>

<body class="login-body">
    <div class="page-container">
        <form class="page-form" action="../script/login.php" method="POST">
            <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error-msg">❌ Correo o contraseña incorrectos</p>';
                }
                if (isset($_GET['success'])) {
                    echo '<p class="success-msg">✅ Registro exitoso. Ingresa para continuar.</p>';
                }
            ?>
            <a href="../index.html">
                <img src="../imagenes/logo.png" alt="Logo de la empresa" class="logo" />
            </a>
            <h2 class="form-title">Iniciar Sesión</h2>
            <input type="email" name="email" placeholder="Correo electrónico" required />
            <input type="password" name="password" placeholder="Contraseña" required />
            <button type="submit">Entrar</button>
            <a href="registrarse.html" class="page-link">¿No tienes cuenta? Regístrate</a>
            <a href="../index.html" class="page-link page-link-volver">⬅ Volver</a>
        </form>
    </div>
</body>

</html>