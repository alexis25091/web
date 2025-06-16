<?php
  session_start();      // Iniciar o continuar sesión
  session_unset();      // Limpiar todas las variables de sesión
  session_destroy();    // Destruir la sesión
  header("Location: /index.html");  // Redirigir a la página principal
  exit();



  /* Donde se implemente la salida de sesion (perfil)

  <form action="../script/cerrarSesion.php" method="POST">
    <button type="submit">Cerrar sesión</button>
  </form>

  o

  <a href="../script/cerrarSesion.php">Cerrar sesión</a>


  */

?>