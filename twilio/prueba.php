<?php 
 
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once 'twilio-php-main/src/Twilio/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "AC8e5947ff53d00c4eb365b23fce716ec1"; 
$token  = "9a8611d6817f13dd7649ddbbb2cba12e"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("whatsapp:+51993884118", // to 
                           array( 
                               "from" => "whatsapp:+14155238886",       
                               "body" => "Hello!esto esfgdfgdfd una prueba twilio" 
                           ) 
                  ); 
 
print($message->sid);