<?php
    $serverName = "DESKTOP-TI91AFN\\SQLEXPRESS"; // Nombre correcto de tu servidor
    $connectionOptions = [
        "Database" => "music_and_talent",
        "TrustServerCertificate" => true, // Evita errores de certificados
        "CharacterSet" => "UTF-8"         // Codificación
    ];

    // Conexión con autenticación de Windows
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
?>
