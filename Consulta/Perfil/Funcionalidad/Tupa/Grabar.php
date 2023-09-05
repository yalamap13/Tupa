<?php 
include '../../../Conectar.php';

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

    $Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirYear'];
	$Parametro3 = $_POST['TransferirDenominacion'];
	$Parametro4 = $_POST['TransferirUIT'];
	$Parametro5 = $_POST['TransferirResolucion'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

    $NombreArchivo = utf8_encode($_FILES['TransferirDocumento']['name']);
    if ($NombreArchivo == '') {
	$Consultar = $Conectar->
	query("CALL GrabarTupa ('$Parametro1',
	                        '$Parametro2',
	                        '$Parametro3',
	                        '$Parametro4',
	                        '$Parametro5',
	                        '')");
    } else {
	$Ruta = utf8_encode($_FILES['TransferirDocumento']['tmp_name']);
	$Nombre="./Archivo/".$NombreArchivo.""; 
    $Parametro6 = $NombreArchivo;
    move_uploaded_file($Ruta,$Nombre);
	$Consultar = $Conectar->
	query("CALL GrabarTupa ('$Parametro1',
	                        '$Parametro2',
	                        '$Parametro3',
	                        '$Parametro4',
	                        '$Parametro5',
	                        '$Parametro6')");        
    }

	if($Consultar == true) {			
		$Validador['success'] = true;
	} else {		
		$Validador['success'] = false;
	}

	$Conectar->close();

	echo json_encode($Validador);
}
?>