<?php
$mensaje = "";

// ⬅️ Importar conexión a PostgreSQL
include "../../backend/config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Capturar datos del formulario
    $nombre     = $_POST["nombre"] ?? "";
    $edad       = $_POST["edad"] ?? "";
    $servicio   = $_POST["servicio"] ?? "";
    $trabajador = $_POST["trabajador"] ?? "";
    $fecha      = $_POST["fecha"] ?? "";
    $hora       = $_POST["hora"] ?? "";

    // Validación simple
    if ($nombre !== "" && $edad !== "" && $servicio !== "" &&
        $trabajador !== "" && $fecha !== "" && $hora !== "") {

        try {

            // INSERT a PostgreSQL
            $sql = "INSERT INTO citas (nombre, edad, servicio, trabajador, fecha, hora)
                    VALUES (:nombre, :edad, :servicio, :trabajador, :fecha, :hora)";

            $stmt = $conexion->prepare($sql);

            $stmt->execute([
                ":nombre" => $nombre,
                ":edad" => $edad,
                ":servicio" => $servicio,
                ":trabajador" => $trabajador,
                ":fecha" => $fecha,
                ":hora" => $hora
            ]);

            $mensaje = "<p style='color:green'>✅ Cita reservada con éxito</p>";

        } catch (PDOException $e) {

            $mensaje = "<p style='color:red'>❌ Error al guardar la cita: " . $e->getMessage() . "</p>";
        }

    } else {
        $mensaje = "<p style='color:red'>❌ Todos los campos son obligatorios</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendar Cita - Violeta Nails</title>
<link rel="stylesheet" href="../css/citas.css">
</head>
<body>

<header>
    <div class="logo">💅 Violeta Nails</div>
    <nav>
        <a href="../../public/index.php">Inicio</a>
        <a href="../pages/servicios.php" class="btn-secondary">Ver Todos los Servicios</a>
    </nav>
</header>

<h1>Agendar Cita</h1>

<?php echo $mensaje; ?>

<form method="POST" action="citas.php">

    <label>Nombre Completo</label>
    <input type="text" name="nombre" required>

    <label>Edad</label>
    <input type="number" name="edad" required>

    <label>Servicio</label>
    <select name="servicio" required>
        <option value="">Seleccione un servicio</option>
        <option value="manicure">Manicure Básico  $45.000</option>
        <option value="pedicure">Pedicure Spa   $50.000</option>
        <option value="acrilicas">Uñas Acrílicas  $85.000</option>
        <option value="decoracion">Decoración de Uñas  $90.000</option>
        <option value="esmaltado">Esmaltado Permanente  $100.000</option>
    </select>

    <label>Estilista</label>
    <select name="trabajador" required>
        <option value="">Seleccione un estilista</option>
        <option value="andrea">Andrea</option>
        <option value="camila">Camila</option>
        <option value="valeria">Valeria</option>
        <option value="sofia">Sofía</option>
    </select>

    <label>Fecha</label>
    <input type="date" name="fecha" required>

    <label>Hora</label>
    <select name="hora" required>
        <option value="">Seleccione una hora</option>
        <option value="08:00-09:00">08:00 AM - 09:00 AM</option>
        <option value="09:00-10:00">09:00 AM - 10:00 AM</option>
        <option value="10:00-11:00">10:00 AM - 11:00 AM</option>
        <option value="11:00-12:00">11:00 AM - 12:00 PM</option>
        <option value="12:00-13:00">12:00 PM - 01:00 PM</option>
        <option value="13:00-14:00">01:00 PM - 02:00 PM</option>
        <option value="14:00-15:00">02:00 PM - 03:00 PM</option>
        <option value="15:00-16:00">03:00 PM - 04:00 PM</option>
        <option value="16:00-17:00">04:00 PM - 05:00 PM</option>
        <option value="17:00-18:00">05:00 PM - 06:00 PM</option>
        <option value="18:00-19:00">06:00 PM - 07:00 PM</option>
        <option value="19:00-20:00">07:00 PM - 08:00 PM</option>
        <option value="20:00-21:00">08:00 PM - 09:00 PM</option>
    </select>

    <button type="submit">Reservar Cita</button>
</form>

</body>
</html>
