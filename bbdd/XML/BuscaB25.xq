for $b in doc("bbdd.xml")//aulas/aula
return <aula>{data($b/nombre)}</aula>