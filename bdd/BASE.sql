use music_and_talent

SELECT TABLE_NAME
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_TYPE = 'BASE TABLE';

select * from Usuarios

-- Tabla 1: USUARIOS
CREATE TABLE Usuarios (
    id_usuario INT IDENTITY(1,1) PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    tipo_usuario VARCHAR(20) NOT NULL CHECK (tipo_usuario IN ('candidato', 'empleador')),
    --fecha_registro DATETIME2 NOT NULL DEFAULT GETDATE()
);

-- Tabla 2: PERFILES
CREATE TABLE Perfiles (
    id_perfil INT IDENTITY(1,1) PRIMARY KEY,
    id_usuario INT NOT NULL,
    titulo_profesional VARCHAR(150),
    resumen VARCHAR(MAX),
    ubicacion VARCHAR(150),
    telefono VARCHAR(20),
    sitio_web VARCHAR(200),
    FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuario)
);

-- Tabla 3: EXPERIENCIAS
CREATE TABLE Experencias (
    id_experiencia INT IDENTITY(1,1) PRIMARY KEY,
    id_perfil INT NOT NULL,
    empresa VARCHAR(150),
    puesto VARCHAR(150),
    descripcion VARCHAR(MAX),
    fecha_inicio DATE,
    fecha_fin DATE NULL,
    FOREIGN KEY (id_perfil) REFERENCES PERFILES(id_perfil)
);

-- Tabla 4: EDUCACION
CREATE TABLE Educacion (
    id_educacion INT IDENTITY(1,1) PRIMARY KEY,
    id_perfil INT NOT NULL,
    institucion VARCHAR(150),
    titulo_obtenido VARCHAR(150),
    fecha_inicio DATE,
    fecha_fin DATE,
    FOREIGN KEY (id_perfil) REFERENCES PERFILES(id_perfil)
);

-- Tabla 5: HABILIDADES
CREATE TABLE Habilidades (
    id_habilidad INT IDENTITY(1,1) PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE
);

-- Tabla 6: PERFIL_HABILIDADES (muchos a muchos)
CREATE TABLE Perfil_Habilidades (
    id_perfil INT NOT NULL,
    id_habilidad INT NOT NULL,
    nivel VARCHAR(20) CHECK (nivel IN ('Básico', 'Intermedio', 'Avanzado')),
    PRIMARY KEY (id_perfil, id_habilidad),
    FOREIGN KEY (id_perfil) REFERENCES PERFILES(id_perfil),
    FOREIGN KEY (id_habilidad) REFERENCES HABILIDADES(id_habilidad)
);

-- Tabla 7: OFERTAS
CREATE TABLE Ofertas (
    id_oferta INT IDENTITY(1,1) PRIMARY KEY,
    id_usuario INT NOT NULL,
    titulo VARCHAR(150),
    descripcion VARCHAR(MAX),
    ubicacion VARCHAR(150),
    fecha_publicacion DATETIME2 DEFAULT GETDATE(),
    salario DECIMAL(12,2),
    tipo_contrato VARCHAR(50),
    FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuario)
);

-- Tabla 8: OFERTA_HABILIDADES (muchos a muchos)
CREATE TABLE Oferta_Habilidades (
    id_oferta INT NOT NULL,
    id_habilidad INT NOT NULL,
    nivel_requerido VARCHAR(20) CHECK (nivel_requerido IN ('Básico', 'Intermedio', 'Avanzado')),
    PRIMARY KEY (id_oferta, id_habilidad),
    FOREIGN KEY (id_oferta) REFERENCES OFERTAS(id_oferta),
    FOREIGN KEY (id_habilidad) REFERENCES HABILIDADES(id_habilidad)
);

-- Tabla 9: POSTULACIONES
CREATE TABLE Postulaciones (
    id_postulacion INT IDENTITY(1,1) PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_oferta INT NOT NULL,
    fecha_postulacion DATETIME2 DEFAULT GETDATE(),
    estado VARCHAR(20) CHECK (estado IN ('pendiente', 'revisado', 'rechazado', 'aceptado')),
    FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuario),
    FOREIGN KEY (id_oferta) REFERENCES OFERTAS(id_oferta)
);

-- Tabla 10: EVALUACIONES
CREATE TABLE Evaluaciones (
    id_evaluacion INT IDENTITY(1,1) PRIMARY KEY,
    id_postulacion INT NOT NULL,
    comentario VARCHAR(MAX),
    calificacion INT CHECK (calificacion BETWEEN 0 AND 5),
    fecha_evaluacion DATETIME2 DEFAULT GETDATE(),
    FOREIGN KEY (id_postulacion) REFERENCES POSTULACIONES(id_postulacion)
);

-- Tabla 11: MENSAJES
CREATE TABLE Mensajes (
    id_mensaje INT IDENTITY(1,1) PRIMARY KEY,
    id_remitente INT NOT NULL,
    id_destinatario INT NOT NULL,
    id_postulacion INT NULL,
    contenido VARCHAR(MAX),
    fecha_envio DATETIME2 DEFAULT GETDATE(),
    leido BIT DEFAULT 0,
    FOREIGN KEY (id_remitente) REFERENCES USUARIOS(id_usuario),
    FOREIGN KEY (id_destinatario) REFERENCES USUARIOS(id_usuario),
    FOREIGN KEY (id_postulacion) REFERENCES POSTULACIONES(id_postulacion)
);

-- Tabla 12: NOTIFICACIONES
CREATE TABLE Notificaciones (
    id_notificacion INT IDENTITY(1,1) PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo VARCHAR(20) CHECK (tipo IN ('mensaje', 'postulacion', 'evaluacion', 'oferta')),
    contenido VARCHAR(MAX),
    fecha DATETIME2 DEFAULT GETDATE(),
    leido BIT DEFAULT 0,
    FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuario)
);


