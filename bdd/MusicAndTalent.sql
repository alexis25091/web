CREATE DATABASE music_and_talent;

USE music_and_talent;

CREATE TABLE Usuarios (
    id_usuario INT IDENTITY(1,1) PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    correo VARCHAR(50) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    tipo_usuario VARCHAR(20) CHECK (tipo_usuario IN ('candidato', 'empleador')) NOT NULL
);

/*Ver la tabla*/
SELECT name FROM sys.tables;
EXEC sp_help 'usuarios';
SELECT * FROM Usuarios;

DELETE FROM Usuarios
WHERE id_usuario = 4;







