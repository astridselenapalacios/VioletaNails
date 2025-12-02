CREATE TABLE citas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    edad INT,
    servicio VARCHAR(50),
    trabajador VARCHAR(50),
    fecha DATE,
    hora VARCHAR(20)
);
