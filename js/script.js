const btnEliminar = document.querySelector("#btnEliminar");
const btnEditar = document.querySelector("#btnEditar");
const btnCancelar = document.querySelector("#btnCancelar");
let reserva = "Active";
let mostrarEliminar = (btn) => {
  if (reserva == "Active") {
    reserva = btn.parentNode.parentNode;
    reserva.classList.add("bg-secondary");
    const confirmarEliminar = document.querySelector("#confirmarEliminar");
    confirmarEliminar.classList.remove("d-none");
  }
};
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
