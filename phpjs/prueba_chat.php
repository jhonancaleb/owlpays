<?php
    //prueba de envio de mensaje a whatsapp
    require_once ('vendor/autoload.php'); // if you use Composer
    //require_once('ultramsg.class.php'); // if you download ultramsg.class.php
    
    $ultramsg_token="qb5599mtgmahb6tt"; // Ultramsg.com token
    $instance_id="instance5222"; // Ultramsg.com instance id
    $client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);
    
    $to="51993884118";
    $message="HOLA CALEB"; 
    $body=$message; 
    $api=$client->sendChatMessage($to,$body);
    print_r($api); //PRUEBA DE PULLLLLLLL jhonan caleb muñoz carrillo
?>
