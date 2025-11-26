document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formCita');
    const mensaje = document.getElementById('mensaje');
    const trabajadorSelect = document.getElementById('trabajador');
    const horaSelect = document.getElementById('hora');
    const fechaInput = document.getElementById('fecha');

    // Función para cargar trabajadores
    const cargarTrabajadores = async () => {
        try {
            const res = await fetch('../api/obtener_datos.php');
            const data = await res.json();
            trabajadorSelect.innerHTML = '';
            data.trabajadores.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t;
                opt.textContent = t;
                trabajadorSelect.appendChild(opt);
            });
        } catch(err) {
            trabajadorSelect.innerHTML = '<option value="">Error al cargar</option>';
        }
    };

    // Función para cargar horas según trabajador y fecha
    const cargarHoras = async () => {
        const trabajador = trabajadorSelect.value;
        const fecha = fechaInput.value;
        if(!trabajador || !fecha) return;

        horaSelect.innerHTML = '<option value="">Cargando...</option>';
        try {
            const res = await fetch(`../api/obtener_datos.php?fecha=${fecha}&trabajador=${trabajador}`);
            const data = await res.json();
            horaSelect.innerHTML = '';
            if(data.horas.length === 0){
                horaSelect.innerHTML = '<option value="">No hay horas disponibles</option>';
            } else {
                data.horas.forEach(h => {
                    const opt = document.createElement('option');
                    opt.value = h;
                    opt.textContent = h;
                    horaSelect.appendChild(opt);
                });
            }
        } catch(err) {
            horaSelect.innerHTML = '<option value="">Error al cargar</option>';
        }
    };

    // Cargar trabajadores al inicio
    cargarTrabajadores();

    // Actualizar horas al cambiar trabajador o fecha
    trabajadorSelect.addEventListener('change', cargarHoras);
    fechaInput.addEventListener('change', cargarHoras);

    // Enviar formulario
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const cita = {
            nombre: document.getElementById('nombre').value,
            edad: document.getElementById('edad').value,
            servicio: document.getElementById('servicio').value,
            trabajador: trabajadorSelect.value,
            fecha: fechaInput.value,
            hora: horaSelect.value
        };
        try {
            const res = await fetch('../api/guardar_cita.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(cita)
            });
            const data = await res.json();
            mensaje.textContent = data.message;
            if(data.status === 'success') form.reset();
        } catch(err) {
            mensaje.textContent = 'Error al enviar la cita: ' + err;
        }
    });
});
