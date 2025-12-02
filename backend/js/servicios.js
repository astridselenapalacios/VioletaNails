// Objeto con trabajadores por servicio
const trabajadoresPorServicio = {
    "Manicure Profesional": ["Violeta", "Sara"],
    "Uñas Acrílicas": ["Andrea", "Sara"],
    "Pedicure Spa": ["Violeta", "Andrea"],
    "Decoración de Uñas": ["Sara", "Andrea"]
};

// Botones de agendar cita
const btnAgendar = document.querySelectorAll(".btn-agendar");

// Al hacer click en agendar, redirige a citas.html pasando el servicio
btnAgendar.forEach(btn => {
    btn.addEventListener("click", () => {
        const servicio = btn.parentElement.getAttribute("data-servicio");
        // Guardamos el servicio en localStorage para usarlo en citas.php
        localStorage.setItem("servicioSeleccionado", servicio);
        // Redirige a citas.php
        window.location.href = "citas.php";
    });
});
