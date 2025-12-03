<?php include "../../backend/config/database.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Agendar Cita - Violeta Nails</title>
<link rel="stylesheet" href="../css/citas.css">
<style>
/* Grid para las horas */
#horas {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    margin-top: 15px;
}

.hora-item {
    position: relative;
}

.hora-item input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.hora-label {
    display: block;
    padding: 15px 10px;
    text-align: center;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    font-size: 1em;
}

.hora-label.disponible {
    background: #f8f9fa;
    color: #333;
}

.hora-label.disponible:hover {
    background: #e8f5e9;
    border-color: #4caf50;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
}

.hora-item input[type="radio"]:checked + .hora-label.disponible {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: #667eea;
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.hora-label.ocupada {
    background: #ffebee;
    color: #c62828;
    border-color: #ef5350;
    cursor: not-allowed;
    opacity: 0.6;
}

.hora-ocupada-badge {
    display: block;
    font-size: 0.75em;
    margin-top: 5px;
    font-weight: 600;
}
</style>
<script>
// Evitar fechas pasadas
window.onload = function () {
    let hoy = new Date().toISOString().split("T")[0];
    document.getElementById("fecha").setAttribute("min", hoy);
}

// Cargar estilistas según el servicio
function cargarEstilistas() {
    let idServicio = document.getElementById("servicio").value;
    fetch("../../backend/ajax/get_estilistas.php?id_servicio=" + idServicio)
    .then(res => res.json())
    .then(data => {
        let s = document.getElementById("estilista");
        s.innerHTML = "<option value=''>Seleccione...</option>";
        data.forEach(e => {
            s.innerHTML += `<option value="${e.id}">${e.nombre} - ${e.profesion}</option>`;
        });
    });
}

// Cargar horas disponibles según fecha y estilista
function cargarHoras() {
    let fecha = document.getElementById("fecha").value;
    let estilista = document.getElementById("estilista").value;

    if (!fecha || !estilista) return;

    fetch(`../../backend/ajax/get_horas.php?fecha=${fecha}&id_estilista=${estilista}`)
    .then(res => res.json())
    .then(data => {
        let cont = document.getElementById("horas");
        cont.innerHTML = "";
        const horas = ["08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00"];
        
        function convertirAMPM(hora) {
            let [h, m] = hora.split(':');
            let hNum = parseInt(h);
            let periodo = hNum >= 12 ? 'PM' : 'AM';
            let h12 = hNum > 12 ? hNum - 12 : (hNum === 0 ? 12 : hNum);
            return `${h12}:${m} ${periodo}`;
        }
        
        horas.forEach(h => {
            let horaFormato = convertirAMPM(h);
            if (data.ocupadas.includes(h)) {
                cont.innerHTML += `
                    <div class='hora-item'>
                        <span class='hora-label ocupada'>
                            ${horaFormato}
                            <span class='hora-ocupada-badge'>OCUPADA</span>
                        </span>
                    </div>
                `;
            } else {
                cont.innerHTML += `
                    <div class='hora-item'>
                        <input type="radio" name="hora" value="${h}" id="hora_${h.replace(':','')}" required>
                        <label for="hora_${h.replace(':','')}" class='hora-label disponible'>${horaFormato}</label>
                    </div>
                `;
            }
        });
    });
}
</script>
</head>
<body>

<h1>Agendar Cita</h1>

<form action="../../backend/crear_cita.php" method="POST">
    <label>Nombre Completo</label>
    <input type="text" name="nombre" required>

    <label>Edad</label>
    <input type="number" name="edad" min="5" max="70" required>

    <label>Teléfono</label>
    <input type="tel" name="telefono" placeholder="Ej: 3001234567" required>

    <label>Servicio</label>
    <select id="servicio" name="servicio" onchange="cargarEstilistas()" required>
        <option value="">Seleccione...</option>
        <?php
        $q = $conexion->query("SELECT * FROM servicios ORDER BY nombre");
        while($row = $q->fetch(PDO::FETCH_ASSOC)){
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
        ?>
    </select>

    <label>Estilista</label>
    <select id="estilista" name="estilista" onchange="cargarHoras()" required>
        <option value="">Seleccione un servicio primero</option>
    </select>

    <label>Fecha</label>
    <input type="date" id="fecha" name="fecha" onchange="cargarHoras()" required>

    <label>Hora</label>
    <div id="horas"></div>

    <button type="submit">Reservar Cita</button>
</form>

</body>
</html>
