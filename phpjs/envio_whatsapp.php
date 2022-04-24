<?php 
 $nombres=$_GET['name'];
 $prov=$_GET['prove'];
 $pla=$_GET['plan'];
 $pre=$_GET['precio'];
 $num=$_GET['numero'];

 $mensage="Hola ".$nombres."\nTe acabas de suscribir a ".$prov."\nPlan  : ".$pla.".\nPrecio: S/".$pre.".\nAtentamente OwlPays."; 


require_once 'twilio-php-main/src/Twilio/autoload.php'; 
 
use Twilio\Rest\Client; 
 
$sid    = "AC8e5947ff53d00c4eb365b23fce716ec1"; 
$token  = "9f15e1b24478adf54aa4030bc73b7c6f"; 
$twilio = new Client($sid, $token); 
 
$message = $twilio->messages 
                  ->create("whatsapp:+51".$num."", // to 
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