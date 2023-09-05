<?php 
include '../../../Conectar.php';

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

	$Parametro1 = $_POST['TransferirId'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

    $NombreArchivo = utf8_encode($_FILES['TransferirArchivo']['name']);
	$Ruta = utf8_encode($_FILES['TransferirArchivo']['tmp_name']);
	$Nombre="./Archivo/".$NombreArchivo.""; 
	
    $Parametro2 = $NombreArchivo;
    move_uploaded_file($Ruta,$Nombre);
	$Consultar = $Conectar->
	query("CALL GuardarArchivo ('$Parametro1','$Parametro2')");
	
	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}

	$Conectar->close();

	echo json_encode($Validador);
}
?>