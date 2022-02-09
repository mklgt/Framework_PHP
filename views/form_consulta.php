<?php
include "helper/Utilidades.php";
include "helper/Input.php";
include "header.php";
?>


<form id="formConsulta" action="index.php" method="post">
    <div>
        <div class='uno'>
            <div class="horario">
                <label for="fecha">
                    Fecha:
                    <input type="date" id="fecha" name="fecha">
                </label>
                <br />
                <div class="horas">
                    <label for="fecha">
                        Clase:
                        <select name='aula'>
                            <?php
                            $aulas = ["A01", "A02", "A03", "A04", "A05", "A06"];
                            foreach ($aulas as $aula) {
                                echo "<option id='aula' value=$aula ";
                                echo Utilidades::verificarSelect(Input::get('aula'), $aula) . ">";
                                echo "$aula </option>";
                            }
                            ?>
                        </select>
                    </label>
                </div>
            </div>
        </div>
        <input id="submit" type="submit" name="enviar" />
    </div>

</form>



<?php
include "footer.php"
?>