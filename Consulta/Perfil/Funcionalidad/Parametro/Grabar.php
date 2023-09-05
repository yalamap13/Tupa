<?php 
include '../../../Conectar.php';

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

    $Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirYear'];
	$Parametro3 = $_POST['TransferirEmpresa'];
	$Parametro5 = $_POST['TransferirDireccion'];
	$Parametro6 = $_POST['TransferirIGV'];
	$Parametro7 = $_POST['TransferirEncargado'];
	$Parametro8 = $_POST['TransferirIdTupa'];
	$Parametro9 = $_POST['TransferirIdOficina'];
    $Parametro10 = $_POST['TransferirRuc'];
    $Parametro11 = $_POST['TransferirNombreSlogan'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $NombreArchivo = utf8_encode($_FILES['TransferirSlogan']['name']);
	if ($NombreArchivo == '') {
	$Consultar = $Conectar->
	query("CALL GrabarParametro ('$Parametro1',
	                             '$Parametro2',
	                             '$Parametro3',
	                             '',
	                             '$Parametro5',
	                             '$Parametro6',
	                             '$Parametro7',
	                             '$Parametro8',
	                             '$Parametro9',
	                             '$Parametro10',
	                             '$Parametro11')");
	}else{
	$Ruta = utf8_encode($_FILES['TransferirSlogan']['tmp_name']);
	$Nombre="./Imagen/".$NombreArchivo.""; 
    $Parametro4 = $NombreArchivo;
    move_uploaded_file($Ruta,$Nombre);
 	$Consultar = $Conectar->
	query("CALL GrabarParametro ('$Parametro1',
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