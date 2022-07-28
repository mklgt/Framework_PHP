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

// --------------- Paginación reservas ---------------
const paginacionTabla = document.getElementById('paginacion');
const numRegistros = document.querySelector('#registrosTotalesRealizados');
if (numRegistros && paginacionTabla) {
  let numeroTotalesRegistros = numRegistros.textContent;
  const pagination = document.querySelector('.pagination');
  let cantidadMaxima = 10;


  if (numeroTotalesRegistros > cantidadMaxima) {
    paginacionTabla.classList.remove('d-none')
    let totalPaginas = Math.ceil(numeroTotalesRegistros / cantidadMaxima);
    for (let p = 1; p <= totalPaginas; p++) {
      pagination.innerHTML += `<li class="page-item"><a class="page-link" href="#">${p}</a></li>`;
    }
  }

  pagination.addEventListener('click', (e) => {
    let pagina = e.target.textContent;
    let registroInicio = (cantidadMaxima * pagina) - cantidadMaxima + 1;
    let registroFinal = (cantidadMaxima * pagina);
    for (let k = registroInicio; k <= registroFinal; k++) {
      let idRegistro = `registroNum${k}`;
      let registro = document.getElementById(idRegistro)
      if (registro != null) {
        registro.classList.remove('d-none')
      }
    }

    for (let p = registroInicio - 1; p >= 1; p--) {
      let idRegistro = `registroNum${p}`;
      let registro = document.getElementById(idRegistro)
      registro.classList.add('d-none')  
    }

    let final = registroFinal + 1;
    for (let l = final; l <= numeroTotalesRegistros; l++) {
      let idRegistro = `registroNum${l}`;
      let registro = document.getElementById(idRegistro)
      registro.classList.add('d-none')  
    }
    numRegistros.remove()
  });
  numRegistros.remove()
}
// --------------- Deshabilitar horas reserva ---------------
let horaDesde = document.getElementById('hora-inicial');
let horaHasta = document.getElementById('hora-final');

if (horaDesde && horaHasta) {
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
}
