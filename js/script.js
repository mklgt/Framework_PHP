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



// --------------- Deshabilitar horas reserva ---------------
let horaDesde = document.getElementById('hora-inicial');
let horaHasta = document.getElementById('hora-final');

horaDesde.addEventListener('click', () => {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();

  today = yyyy + "-" + mm + "-" + dd;
  let fechaReserva = document.getElementById('fecha').value;
  let listaHorasDesde = horaDesde.childNodes;
  let horaActual = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  if (fechaReserva == today) {
    listaHorasDesde.forEach((hora) => {
      if (hora.value < horaActual) {
        hora.setAttribute('disabled', 'disabled');
      }
    })
  } else {
    listaHorasDesde.forEach((hora) => {
      if (hora.value != undefined) {
        hora.removeAttribute('disabled', 'disabled');
      }
      
    })
  }
})

horaHasta.addEventListener('click', () => {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();

  today = yyyy + "-" + mm + "-" + dd;
  let fechaReserva = document.getElementById('fecha').value;
  let listaHorasHasta = horaHasta.childNodes;
  let horaActual = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  if (fechaReserva == today) {
    listaHorasHasta.forEach((hora) => {
      if (hora.value < horaActual) {
        hora.setAttribute('disabled', 'disabled');
      }
    })
  } else {
    listaHorasHasta.forEach((hora) => {
      if (hora.value != undefined) {
        hora.removeAttribute('disabled', 'disabled');
      }
      
    })
  }
})