<?php 
include '../../../Conectar.php';

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

    $Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirNombres'];
	$Parametro3 = $_POST['TransferirDenominacion'];
	$Parametro4 = $_POST['TransferirIniciales'];
	$Parametro5 = $_POST['TransferirIdUnidadOrganica'];
	
	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

	$Consultar = $Conectar->
	query("CALL GrabarOficina ('$Parametro1',
	                           '$Parametro2',
	                           '$Parametro3',
	                           '$Parametro4',
	                           '$Parametro5')");

	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}

	$Conectar->close();

	echo json_encode($Validador);
}
?>