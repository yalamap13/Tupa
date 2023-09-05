<?php 
include '../../../Conectar.php';

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

    $Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirNumeroDocumento'];
	$Parametro3 = $_POST['TransferirNombres'];
	$Parametro4 = $_POST['TransferirApellidos'];
	$Parametro5 = $_POST['TransferirSexo'];
	$Parametro6 = $_POST['TransferirCelular'];
	$Parametro7 = $_POST['TransferirTelefono'];
	$Parametro8 = $_POST['TransferirDireccion'];
	$Parametro9 = $_POST['TransferirCorreoElectronico'];
	$Parametro10 = $_POST['TransferirIdTipoDocumento'];
	$Parametro11 = $_POST['TransferirResponsable'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

	$Consultar = $Conectar->
	query("CALL GrabarCliente ('$Parametro1',
	                            '$Parametro2',
	                            '$Parametro3',
	                            '$Parametro4',
	                            '$Parametro5',
	                            '$Parametro6',
	                            '$Parametro7',
	                            '$Parametro8',
	                            '$Parametro9',
	                            '$Parametro10',
	                            '$Parametro11')");

	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}

	$Conectar->close();

	echo json_encode($Validador);
}
?>