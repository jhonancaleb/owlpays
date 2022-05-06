<?php
//esto es una prueba de envio de mensaje de watsaap
require_once ('vendor/autoload.php'); // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php

$token="eh6ky3jctvpecvcn"; // Ultramsg.com token
$instance_id="instance6274"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($token,$instance_id);

$to="+51993884118"; 
$body="hola"; 
$api=$client->sendChatMessage($to,$body);
print_r($api);
?>