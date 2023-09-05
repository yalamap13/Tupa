<?php 

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

    $Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirNombre'];
	$Parametro3 = $_POST['TransferirUIT'];
	$Parametro4 = $_POST['TransferirValor'];
	$Parametro5 = $_POST['TransferirDiasTramite'];
	$Parametro6 = $_POST['TransferirIdOficina'];
	$Parametro7 = $_POST['TransferirIdTupa'];
    $Parametro8 = $_POST['TransferirDerechoTramite'];

    include '../../../Conectar.php';
	$Validador = array('success' => false, 'messages' => array());
    $Consultar = $Conectar->query("CALL CorrelativoProcedimiento();");
	$Transferir = $Consultar->fetch_assoc(); 
    $Correlativo = $Transferir['Correlativo'];
    $Conectar->close();
    
    include '../../../Conectar.php';
	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

	$Consultar = $Conectar->
	query("CALL GrabarProcedimiento ('$Parametro1',
    	                            '$Parametro2',
    	                            '$Parametro3',
    	                            '$Parametro4',
    	                            '$Parametro5',
    	                            '$Parametro6',
    	                            '$Correlativo',
    	                            '$Parametro7',
    	                            '$Parametro8')");

	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}

	$Conectar->close();

	echo json_encode($Validador);
}
?>