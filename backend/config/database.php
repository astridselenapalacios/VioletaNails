<?php

$host = "localhost";
$port = "5432";
$dbname = "violetanails";  // Cambia si tu base tiene otro nombre
$user = "postgres";        // Tu usuario
$pass = "1234";            // Tu contraseña

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $conexion = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

} catch (PDOException $e) {
    die("❌ Error al conectar a PostgreSQL: " . $e->getMessage());
}

?>
