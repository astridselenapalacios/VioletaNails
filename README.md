--GUIA PASO HA PASO PARA IMPLEMENTAR LA BASE DE DATOS AL PROYECTO Y QEU FUNCIONE 

--NOTA: creamos la base de datos en PgAdmin - PostgreSQL
CREATE DATABASE violeta_nails;

--1. creamos la tabla de servicios 
CREATE TABLE servicios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio INT NOT NULL, -- O DECIMAL(10, 2) si planeas usar céntimos
    imagen VARCHAR(255) -- Columna esencial para guardar el nombre del archivo de imagen
);

--Codigos alternos para visualizar 
select *from servicios;
TRUNCATE TABLE servicios;

--2.Creamos la tabla de estilistas
CREATE TABLE estilistas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    cedula VARCHAR(20) UNIQUE,
    profesion VARCHAR(100),
    edad INT,
    activo BOOLEAN DEFAULT TRUE
);

--Codigo para visualizar los estilistas
select *from estilistas;

--3.Creamos la tabla de  los serivicios que ofrece cada estilista
CREATE TABLE servicios_estilistas (
    id SERIAL PRIMARY KEY,
    id_servicio INT REFERENCES servicios(id),
    id_estilista INT REFERENCES estilistas(id)
);

--Codigo para visualizar los estilistas
select *from servicios_estilistas;

--4.Creamos la tabla de citas
CREATE TABLE citas (
    id SERIAL PRIMARY KEY,
    nombre_cliente VARCHAR(100),
    edad_cliente INT,
    telefono_cliente VARCHAR(20),
    id_servicio INT REFERENCES servicios(id),
    id_estilista INT REFERENCES estilistas(id),
    fecha DATE,
    hora VARCHAR(20)
);

--Codigo para visualizar las citas
select *from citas;
-- Codigo para agregarle la columna de atendida en la tabla citas
ALTER TABLE citas ADD COLUMN atendida BOOLEAN DEFAULT FALSE; 


--5.Codigo para crear la tabla de usuaarios la cual se va ha logear el estilista con su cedula y contraseña para poder ver que citas tiene 
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    id_estilista INT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso TIMESTAMP NULL,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_estilista) REFERENCES estilistas(id) ON DELETE CASCADE
);

--Codigo para inserta el usuario para poder logearlo con contraseña hashear
INSERT INTO usuarios (cedula, contrasena, id_estilista)
VALUES ('1000331353', '$2y$10$wJHCQhSTycrh/q/ek1kumOc/AC0Qt/so7lHl5g.Yn.rAFaa0JAnNW', 3);

INSERT INTO usuarios (cedula, contrasena, id_estilista)
VALUES ('0000', '$2y$10$5mJnPvNJGIQfvNCi0O3t6uiUuDTHWeAVPUU5HOGZhmYfOsT3b1ZGu', 1);

--Codigo para visualizar los usuarios registrados 
--Nota: Solo los puede ver el administrador
select *from usuarios;

--Luego de haber hecho todo eso nos vamos al admin.php donde vamos ha registrar los servicios y los estilistas y ademas en la ventana servicios.php 
--colocaremos los servicios disponibles 

--Accedemos al archivo hashear.php que se encuentra en el frontend en la carpeta estilistas,
--Colocaremos una contraseña el cual le daremos al estilista y la vamos ha convertir en hashear es decir mas segura 

--Ya tendremos un estilista el cual se puede loguear con su cedula y la contraseña para que pueda ver las citas que tiene
