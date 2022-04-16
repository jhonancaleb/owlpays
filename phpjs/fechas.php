<?php
    echo"HORARIO DE ESPAÑA <BR>";
    echo date('d/m/y h:i:a');
    echo "<hr>";

    echo "HORARIO DE PERÚ <BR>";
    ini_set('date.timezone','America/Lima');
    echo date('d-m-Y h:i:a');
?>