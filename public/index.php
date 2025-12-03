<?php
// =========================================================================
// LÓGICA DEL CONTADOR DE VISITAS
// ESTE BLOQUE SE EJECUTA Y SUMA 1 EN CADA VISITA A ESTA PÁGINA (index.php)
// =========================================================================

// La ruta es '../contador_visitas.txt' (un nivel arriba de 'public/')
$archivo_contador = "../contador_visitas.txt";

// 1. Asegúrate de que el archivo exista. Si no existe, lo crea con el valor "0".
if (!file_exists($archivo_contador)) {
    file_put_contents($archivo_contador, "0");
}

// 2. Lee el valor actual
// Usamos file_get_contents para leer todo el contenido del archivo (el número)
$contador_actual = (int)file_get_contents($archivo_contador);

// 3. Incrementa el valor
$contador_nuevo = $contador_actual + 1;

// 4. Escribe el nuevo valor en el archivo, sobrescribiendo el anterior
// Esto actualiza el archivo con el contador + 1
file_put_contents($archivo_contador, $contador_nuevo);

// =========================================================================
// FIN DE LA LÓGICA DEL CONTADOR
// =========================================================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Violeta Nails - Tu belleza, nuestra pasión. Servicios profesionales de uñas y estética en Tumaco, Nariño.">
    <title>Violeta Nails - Inicio</title>
    <link rel="stylesheet" href="../frontend/css/style.css">
</head>

<body>

<!-- ========================================================================= -->
<!-- HEADER / NAVEGACIÓN -->
<!-- ========================================================================= -->
<header class="header">
    <div class="logo">💅 Violeta Nails</div>

    <nav class="menu">
        <a href="../frontend/pages/servicios.php">Servicios</a>
        <a href="#contacto">Contacto</a>
    </nav>
</header>

<!-- ========================================================================= -->
<!-- HERO SECTION -->
<!-- ========================================================================= -->
<section class="hero" style="background-image: url('/violetaNails/backend/img/logo.png'); background-size: cover; background-position: center;">
    <div class="hero-content">
        <h1>Tu Belleza, Nuestra Pasión</h1>
        <p>Agenda tus citas fácilmente y disfruta de la mejor experiencia en uñas y estética.</p>
    </div>
</section>

<!-- ========================================================================= -->
<!-- SERVICIOS DESTACADOS -->
<!-- ========================================================================= -->
<section class="servicios-preview">
    <h2>🌸 Servicios Destacados</h2>

    <div class="servicios-grid">
        <!-- Card 1: Uñas Acrílicas -->
        <div class="card">
            <img src="/violetaNails/backend/img/uñas.png" alt="Uñas acrílicas - Diseños personalizados">
            <h3>Uñas Acrílicas</h3>
            <p>Diseños personalizados y de larga duración para que luzcas espectacular.</p>
        </div>

        <!-- Card 2: Spa de Manos -->
        <div class="card">
            <img src="/violetaNails/backend/img/pie.png" alt="Spa de manos - Cuidado profesional">
            <h3>Spa de Manos</h3>
            <p>Relajación y cuidado profesional con productos premium de alta calidad.</p>
        </div>

        <!-- Card 3: Decoración Premium -->
        <div class="card">
            <img src="/violetaNails/backend/img/uñas2.png" alt="Decoración premium con brillos y pedrería">
            <h3>Decoración Premium</h3>
            <p>Brillos, pedrería y arte exclusivo para ocasiones especiales.</p>
        </div>
    </div>

    <!-- Botón para ver todos los servicios -->
    <div class="text-center mt-20">
        <a href="../frontend/pages/servicios.php" class="btn-secondary">Ver Todos los Servicios</a>
    </div>
</section>

<!-- ========================================================================= -->
<!-- FOOTER / CONTACTO -->
<!-- ========================================================================= -->
<footer id="contacto" class="footer">
    <p>© 2025 Violeta Nails – Tu belleza, nuestra pasión 💖</p>
    <p>📍 Dirección: Calle 123, Tumaco Nariño</p>
    <p>📞 Teléfono: 300 123 4567</p>
</footer>

</body>
</html>
