<?php 
include '../../../Conectar.php';
 
if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

    $Parametro1 = $_POST['TransferirIdRQM'];
	$Parametro2 = $_POST['TransferirIdRequisito'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

	$Consultar = $Conectar->
	query("CALL CrearProcedimientoRequisito ('$Parametro1',
    	                                     '$Parametro2')");

	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}
	
	$Validador['messages'] = $Parametro1;

	$Conectar->close();

	echo json_encode($Validador);
}
?>