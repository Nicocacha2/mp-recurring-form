<?php
require_once "lib/mercadopago.php";

$mp = new MP($_POST['client_id'], $_POST['client_secret']);

//Recibo las variables vía POST enviadas por el formulario

$end = $_POST ['end_date'];
if(empty($end))
{
    $end = NULL;
}

$start = $_POST ['start_date'];
if(empty($start))
{
    $start = NULL;
}

$preapprovalPayment = array(
    "payer_email" => $_POST['payer_email'],
    "back_url" => $_POST['backurl'],
    "reason" => $_POST['reason'],
    "external_reference" => $_POST['external_reference'],
    "auto_recurring" => array(
        "frequency" => $_POST['frequency'],
        "frequency_type" => $_POST['frequency_type'],
        "transaction_amount" => $_POST['transaction_amount'],
        "currency_id" => $_POST['currency_id'],
        "start_date" => $start,
		"end_date" => $end
    )
);

$preapprovalPaymentResult = $mp->create_preapproval_payment($preapprovalPayment);
?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago</title>
    </head>
    <body>
		<p>Envi&aacute; este link a la persona que se suscribir&aacute;</p>
       	<p><?php echo $preapprovalPaymentResult["response"]["init_point"]; ?></p>
    </body>
</html>