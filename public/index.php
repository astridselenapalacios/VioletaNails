<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Violeta Nails - Inicio</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header class="header">
    <div class="logo">💅 Violeta Nails</div>

    <nav class="menu">
        <!-- Cambié .html por .php para que todo funcione en PHP -->
        <a href="../frontend/pages/servicios.php" >Servicios</a>
        <a href="#contacto" >Contacto</a>
    </nav>
</header>

<section class="hero" style="background-image: url('../img/A1.jpeg'); background-size: cover; background-position: center;">
    <div class="hero-content">
        <h1>Tu Belleza, Nuestra Pasión</h1>
        <p>Agenda tus citas fácilmente y disfruta de la mejor experiencia en uñas y estética.</p>
    </div>
</section>

<section class="servicios-preview">
    <h2>🌸 Servicios Destacados</h2>

    <div class="servicios-grid">
        <div class="card">
            <img src="../img/imagen1.png" alt="Uñas acrílicas">
            <h3>Uñas Acrílicas</h3>
            <p>Diseños personalizados y de larga duración.</p>
        </div>

        <div class="card">
            <img src="../img/pie.png" alt="Pedicure Spa">
            <h3>Spa de Manos</h3>
            <p>Relajación y cuidado profesional.</p>
        </div>

        <div class="card">
            <img src="../img/imagen2.png" alt="Decoración premium">
            <h3>Decoración Premium</h3>
            <p>Brillos, pedrería y arte exclusivo.</p>
        </div>
    </div>

    <div style="text-align:center; margin-top:20px;">
        <a href="../frontend/pages/servicios.php" class="btn-secondary">Ver Todos los Servicios</a>
    </div>




</section>

<footer id="contacto" class="footer">
    <p>© 2025 Violeta Nails – Tu belleza, nuestra pasión 💖</p>
    <p>📍 Dirección: Calle 123, Tumaco Nariño</p>
    <p>📞 Teléfono: 300 123 4567</p>
</footer>

</body>
</html>
