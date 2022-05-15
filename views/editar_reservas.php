<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
?>

<div class='bg-secundario mt-4 rounded w-75 mx-auto p-3 fs-6 mb-5'>
    <p class="h3 text-center">Reservas realizadas</p>
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Aula</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora inicio</th>
            <th scope="col">Hora fin</th>
            <th scope="col">Motivo</th>
            </tr>
        </thead>
        <tbody>
<?php
    foreach ($reservasUsuario as $reserva) {
        $datos = array();
        foreach ($reserva as $dato) {
            if (!in_array($dato, $datos)) {
                $datos[] = $dato; 
            }
        }
        echo "<tr>";
        foreach ($datos as $valor) {
            echo "<td>$valor</td>";
        }
        echo '<td><button type="button" class="btn btn-danger" id="btnEliminar" onclick="mostrarEliminar(this)">Eliminar</button></td>';
        echo "</tr>";
    }
?>
        </tbody>
    </table>
    </div>

    <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="confirmarEliminar">
        <div> 
            <form action="index.php" method="post">
                ¿Eliminar reserva?
                <input type="text" id="idReserva" name="idReserva" class="d-none">
                <input type="submit" class="btn btn-danger mx-2" name="eliminar" value="Eliminar" onclick="eliminarReserva()">
                <input type="button" class="btn btn-secondary" value="Cancelar" onclick="cancelarEliminar()">
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>