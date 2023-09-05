<?php 
include '../../../Conectar.php';

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

    $Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirDocumentoIdentidad'];
	$Parametro3 = $_POST['TransferirNombres'];
	$Parametro4 = $_POST['TransferirDireccion'];
	$Parametro5 = $_POST['TransferirTelefono'];
	$Parametro6 = $_POST['TransferirDetalles'];
	$Parametro7 = $_POST['TransferirIdArea'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

	$Consultar = $Conectar->
	query("CALL GrabarPersonas ('$Parametro1',
	                            '$Parametro2',
	                            '$Parametro3',
	                            '$Parametro4',
	                            '$Parametro5',
	                            '$Parametro6',
	                            '$Parametro7')");

	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}

	$Conectar->close();

	echo json_encode($Validador);
}
?>