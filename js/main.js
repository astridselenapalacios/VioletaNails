document.addEventListener("DOMContentLoaded", () => {

    const btnAgregar = document.getElementById("btn-agendar");
    const modal = document.getElementById("modal-agregar");
    const cerrarModal = document.getElementById("cerrar-modal");
    const guardarCita = document.getElementById("guardar-cita");

    const listaPendientes = document.getElementById("lista-citas");
    const listaRealizadas = document.getElementById("lista-realizadas");

    // Mostrar modal
    btnAgregar.addEventListener("click", () => {
        modal.style.display = "flex";
    });

    // Cerrar modal
    cerrarModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Guardar la cita (nick = nombre del cliente)
    guardarCita.addEventListener("click", () => {

        let nick = document.getElementById("nick").value;
        let servicio = document.getElementById("servicio").value;
        let fecha = document.getElementById("fecha").value;
        let hora = document.getElementById("hora").value;

        if (nick.trim() === "" || servicio.trim() === "" || fecha === "" || hora === "") {
            alert("Completa todos los campos.");
            return;
        }

        let li = document.createElement("li");
        li.textContent = `${nick} – ${servicio} – ${fecha} – ${hora}`;

        // Cuando se hace clic: pasa a realizadas y viceversa
        li.addEventListener("click", function() {
            if (li.classList.contains("realizada")) {
                listaPendientes.appendChild(li);
                li.classList.remove("realizada");
            } else {
                listaRealizadas.appendChild(li);
                li.classList.add("realizada");
            }
        });

        listaPendientes.appendChild(li);
        modal.style.display = "none";

        document.getElementById("nick").value = "";
        document.getElementById("servicio").value = "";
        document.getElementById("fecha").value = "";
        document.getElementById("hora").value = "";
    });

});
