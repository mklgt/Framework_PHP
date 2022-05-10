const btnEliminar = document.querySelector("#btnEliminar");
const btnEditar = document.querySelector("#btnEditar");
const btnCancelar = document.querySelector("#btnCancelar");

let reserva = "Active";
let reservaEditar;

let mostrarEliminar = (btn) => {
  if (reserva == "Active") {
    reserva = btn.parentNode.parentNode;
    reserva.classList.add("bg-secondary");
    const confirmarEliminar = document.querySelector("#confirmarEliminar");
    confirmarEliminar.classList.remove("d-none");
  }
};

// --------------- Eliminar reservas ---------------
let cancelarEliminar = () => {
  reserva.classList.remove("bg-secondary");
  const confirmarEliminar = document.querySelector("#confirmarEliminar");
  confirmarEliminar.classList.add("d-none");
  reserva = "Active";
};

let eliminarReserva = () => {
    const id = document.querySelector('#idReserva');
    id.value = reserva.firstChild.textContent;
}

// --------------- Editar reservas ---------------
let editarReserva = (btn) => {
  const tablaReservas = document.querySelector('#reservasRealizadas');
  const formEditar = document.querySelector('#formEditar');
  tablaReservas.classList.add('d-none');
  formEditar.classList.remove('d-none');
  reservaEditar = btn.parentNode.parentNode.firstChild.textContent;
}

let confirmarCambios = () => {
  const id = document.querySelector('#idReservaCambio');
    id.value = reservaEditar;
}
