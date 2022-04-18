<?php
    $numero='993884118';
    $message="Hola Atentamente OwlPays."; 
    header('location:https://api.whatsapp.com/send?phone=051'.$numero.'&text='.$message);
?>