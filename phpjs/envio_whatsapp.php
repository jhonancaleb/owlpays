<?php 
 $nombres=$_GET['name'];
 $prov=$_GET['prove'];
 $pla=$_GET['plan'];
 $pre=$_GET['precio'];

 $mensage="Hola ".$nombres."\nTe acabas de suscribir a ".$prov."\nPlan  : ".$pla.".\nPrecio: S/".$pre.".\nAtentamente OwlPays."; 


require_once 'twilio-php-main/src/Twilio/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "AC8e5947ff53d00c4eb365b23fce716ec1"; 
$token  = "fac6476666e25eaef329947fe20e3c0a"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("whatsapp:+51993884118", // to 
                           array( 
                               "from" => "whatsapp:+14155238886",       
                               "body" => $mensage 
                           ) 
                  ); 
 
//print($message->sid);
?>
<script>
    top.location.reload();
</script>