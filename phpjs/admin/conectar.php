<?php
// Declara las variables para la conexión
$db_server = 'localhost';
$db_username = 'root';
$db_password = '';
$db_database = 'olwpays';
// Conexión a la base de datos
$db_connect = new mysqli($db_server, $db_username, $db_password, $db_database);
$db_connect -> query("SET NAMES 'utf8'");
// Error al no poder conectar a la base de datos
if ($db_connect -> connect_error){
die ('Conexión fallida: ' . $db_connect -> connect_error);
}
// Reseteo de las variables de conexión
$db_server = null;
$db_username = null;
$db_password = null;
$db_database = null;
?>