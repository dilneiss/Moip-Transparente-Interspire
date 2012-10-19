<?php
/////////////////////////////////////
include "../../../init.php";
///// inicio do retorno moip ////////
function status($id){


if($id==1) {
return 'Aprovado';
}else if($id==2) {
return 'Iniciado';
}else if($id==3) {
return 'Boleto Impresso';
}else if($id==4) {
return 'Concluida';
}else if($id==5) {
return 'Cancelada';
}else if($id==6) {
return 'Em Analise';
}else if($id==9) {
return 'Reembolsado no Moip';
}
}
/////////////////////////
if(!empty($_POST['cod_moip'])){
/////////////////////////////////////
$ped = $_POST['id_transacao'];
$pedido = ereg_replace("[^0-9]", "", $ped);
$status = $_POST['status_pagamento'];
$forma = $_POST['forma_pagamento'];
$tipo = $_POST['tipo_pagamento'];
$codigo = $_POST['cod_moip'];
$valor = $_POST['valor'];
$email = $_POST['email_consumidor'];
switch($status) {
case '1';
@UpdateOrderStatus($pedido, ORDER_STATUS_AWAITING_SHIPMENT);
$msg =  "-----------------
\n## Aprovada (Verificar no Moip Manualmente) ##
\nTransação: ".$codigo." 
\nStatus : ".status($status)."
\nData : ".date('d/m/Y')."
\nForma de Pagamento: ".$tipo."
\nEmail: ".$email."
\nTotal: ".$valor."
tel: ".$telfone = $fetch_order['ordbillphone']."
\n----------------";
$query = "UPDATE [|PREFIX|]orders SET 
ordcustmessage = '".$msg."' where orderid = '".$pedido."'";
$GLOBALS['ISC_CLASS_DB']->Query($query);
break;

case '2';
@UpdateOrderStatus($pedido, ORDER_STATUS_CANCELLED);
$msg =  "-----------------
\n## Iniciado ##
\nTransação: ".$codigo." 
\nStatus : ".status($status)."
\nData : ".date('d/m/Y')."
\nForma de Pagamento: ".$tipo."
\nEmail: ".$email."
\nTotal: ".$valor."
tel: ".$telfone = $fetch_order['ordbillphone']."
\n----------------";
$query = "UPDATE [|PREFIX|]orders SET 
ordcustmessage = '".$msg."' where orderid = '".$pedido."'";
$GLOBALS['ISC_CLASS_DB']->Query($query);
$query2 = "select * from [|PREFIX|]orders where orderid = '".$pedido."'";
break;

case '3';
@UpdateOrderStatus($pedido, ORDER_STATUS_AWAITING_FULFILLMENT);
$msg =  "-----------------
\n## Boleto Impresso ##
\nTransação: ".$codigo." 
\nStatus : ".status($status)."
\nData : ".date('d/m/Y')."
\nForma de Pagamento: ".$tipo."
\nEmail: ".$email."
\nTotal: ".$valor."
tel: ".$telfone = $fetch_order['ordbillphone']."
\n----------------";
$query = "UPDATE [|PREFIX|]orders SET 
ordcustmessage = '".$msg."' where orderid = '".$pedido."'";
$GLOBALS['ISC_CLASS_DB']->Query($query);
break;

case '4';
$msg =  "-----------------
\n## Concluido (Verificar no Moip Manualmente) ##
\nTransação: ".$codigo." 
\nStatus : ".status($status)."
\nData : ".date('d/m/Y')."
\nForma de Pagamento: ".$tipo."
\nEmail: ".$email."
\nTotal: ".$valor."
tel: ".$telfone = $fetch_order['ordbillphone']."
\n----------------";
break;

case '5';
@UpdateOrderStatus($pedido, ORDER_STATUS_CANCELLED);
$msg =  "-----------------
\n## Cancelado ##
\nTransação: ".$codigo." 
\nStatus : ".status($status)."
\nData : ".date('d/m/Y')."
\nForma de Pagamento: ".$tipo."
\nEmail: ".$email."
\nTotal: ".$valor."
tel: ".$telfone = $fetch_order['ordbillphone']."
\n----------------";
$query = "UPDATE [|PREFIX|]orders SET 
ordcustmessage = '".$msg."' where orderid = '".$pedido."'";
$GLOBALS['ISC_CLASS_DB']->Query($query);
break;

case '6';
@UpdateOrderStatus($pedido, ORDER_STATUS_PENDING);
$msg =  "-----------------
\n## Pendente ##
\nTransação: ".$codigo." 
\nStatus : ".status($status)."
\nData : ".date('d/m/Y')."
\nForma de Pagamento: ".$tipo."
\nEmail: ".$email."
\nTotal: ".$valor."
tel: ".$telfone = $fetch_order['ordbillphone']."
\n----------------";
$query = "UPDATE [|PREFIX|]orders SET 
ordcustmessage = '".$msg."' where orderid = '".$pedido."'";
$GLOBALS['ISC_CLASS_DB']->Query($query);
break;

case '9';
@UpdateOrderStatus($pedido, ORDER_STATUS_PARTIALLY_SHIPPED);
$msg =  "-----------------
\n## Pendente ##
\nTransação: ".$codigo." 
\nStatus : ".status($status)."
\nData : ".date('d/m/Y')."
\nForma de Pagamento: ".$tipo."
\nEmail: ".$email."
\nTotal: ".$valor."
tel: ".$telfone = $fetch_order['ordbillphone']."
\n----------------";
$query = "UPDATE [|PREFIX|]orders SET 
ordcustmessage = '".$msg."' where orderid = '".$pedido."'";
$GLOBALS['ISC_CLASS_DB']->Query($query);
$text = urlencode("Mundo Cult: Pagamento aguardando aprovação.");
break;

}
//////////////////////////////////////

} else {
	
@header("Location: ../../../notificacult.php?pedido=".$trans."&status=".$statusped."");
}

?>