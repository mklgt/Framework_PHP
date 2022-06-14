for $b in doc("bbdd.xml")//marcoHorario/tramo
let $dia:= $b/dia
let $indice:= $b/indice
return
(: Para el lunes día 0:)
if ($dia=0)
 then <tramo>{concat('día=',$dia ,",",'horas=', $indice ,",", $b/horaEntrada ,",",$b/horaSalida)}
 </tramo>
else()