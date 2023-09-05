<?php 
include '../../../Conectar.php';
session_start();

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

	$Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirNombre'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

	$Consultar = $Conectar->
	query("CALL GrabarTipoExpediente ('$Parametro1','$Parametro2')");

	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}

	$Conectar->close();

	echo json_encode($Validador);
}
?>