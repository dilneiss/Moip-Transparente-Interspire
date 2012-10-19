<?php

	/**
	* Show a blank top template, which can be used to integrate the store's design into
	* other applications, specifically Sistema de Ajuda
	*/

	require_once(dirname(__FILE__)."/init.php");
	$GLOBALS["ISC_CLASS_TEMPLATE"]->SetTemplate("top");
	$GLOBALS["ISC_CLASS_TEMPLATE"]->ParseTemplate();
	
	?>

<!--[if lt IE 8]>
		<script src ="https://ie7-js.googlecode.com/svn/version/2.1(beta2)/IE8.js"></script>
	<![endif]-->
<!--JQuery-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
<link href="./moip/css/retorno_o2ti.css" media="all" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="script.js"></script>
<?php 
$codmp = $_GET['codmp'];
$situacao =  $_GET['status'];
$refazer = $_GET['refazer'];
$refazer = substr($refazer, 1);
if ($refazer != ""){
	?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Seu pedido foi recebido com sucesso, caso não tenha liberado o popup do navegador, verifique abaixo o link:</h2>
    <div class="notification success">
        <span></span>
        <p><strong> <a href="https://w<?php echo($refazer) ?>" target="_new">Link para Pagamento</a></strong> Transação processada por Moip S/A.</p>
    </div>
	
<?php
};
switch ($situacao) {
case "Autorizado" :
$estadonovo = "Pagamento Autorizado";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
    <div class="notification success">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	Seu pagamento foi confirmado e prosseguiremos com o envio de seu pedido.
	Qualquer dúvida, entre em contato conosco.
<?php
break;

case "Iniciado" :
$estadonovo = "Pagamento iniciado";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification message">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
	</div>
	Seu pagamento foi iniciado, porém sem confirmação de finalização até o momento.
	Por gentileza aguarde até que a transação seja aprovada. Você receberá um comunicado por e-mail.
	Qualquer dúvida, entre em contato conosco.
<?php
break;

case "BoletoImpresso" :
$estadonovo = "Boleto Impresso";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification tip">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	Seu boleto foi gerado. Por gentileza queira pagar até o vencimento.
	Após essa data o pedido é automaticamente cancelado.
	Qualquer dúvida, entre em contato conosco.
<?php
break;

case "Concluido" :
$estadonovo = "Concluída";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification success">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	NAO PRINTA
<?php
break;

case "Cancelado" :
$estadonovo = "Cancelada";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification error">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	Sua transação não foi aprovada. Pedimos que por gentileza verifique os dados do cartão e tente novamente.
	Caso o erro persista entre em contato com a banco emissor para verificar o motivo da recusa.
	Qualquer dúvida, entre em contato conosco.
<?php
break;

case "EmAnalise" :
$estadonovo = "Pagamento em análise de risco";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification warning">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	Sua transação foi processada e está em análise aguardando aprovação.
	Por gentileza aguarde confirmação via e-mail.
	Qualquer dúvida, entre em contato conosco.
<?php
break;

case "Estornado" :
$estadonovo = "Pagamento estornado";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification success">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	NAO PRINTA
<?php
break;

case "EmRevisao" :
$estadonovo = "Pagamento em revisão pelo Moip";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification warning">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	NAO PRINTA
<?php
break;

case "Reembolsado" :
$estadonovo = "Reembolsado";
?>
    <h1>Obrigado pelo seu pedido.</h1>
	<h2>Verifique abaixo o status da transação</h2>
	<div class="notification success">
        <span></span>
        <p><strong><?php echo($estadonovo) ?></strong> Transação processada por Moip</p>
    </div>
	NAO PRINTA
<?php
break;
}
?>

    <?
	$GLOBALS['ISC_CLASS_TEMPLATE']->SetTemplate("bottom");
	$GLOBALS['ISC_CLASS_TEMPLATE']->ParseTemplate();
	