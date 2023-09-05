<?php 
include '../../../Conectar.php';

if($_POST) {

	$Validador = array('success' => false, 'messages' => array());

	$Parametro1 = $_POST['TransferirId'];
	$Parametro2 = $_POST['TransferirDNI'];
	$Parametro3 = $_POST['TransferirUsuario'];
	$Parametro4 = $_POST['TransferirClave'];
	$Parametro5 = $_POST['TransferirPerfil'];
	$Parametro6 = $_POST['TransferirNombres'];
	$Parametro7 = $_POST['TransferirApellidoPaterno'];
	$Parametro8 = $_POST['TransferirApellidoMaterno'];
	$Parametro9 = $_POST['TransferirDireccion'];
	$Parametro10 = $_POST['TransferirTelefono'];
	$Parametro11 = $_POST['TransferirGenero'];
	$Parametro12 = $_POST['TransferirIdOficina'];
	$Parametro13 = $_POST['TransferirIdCargo'];

	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $NombreArchivo = utf8_encode($_FILES['TransferirFoto']['name']);
	if ($NombreArchivo == '') {
	$Consultar = $Conectar->
	query("CALL GrabarUsuario ('$Parametro1',
							   '$Parametro2',
							   '$Parametro3',
							   '$Parametro4',
							   '$Parametro5',
							   '$Parametro6',
							   '$Parametro7',
							   '$Parametro8',
							   '$Parametro9',
							   '$Parametro10',
							   '$Parametro11',
							   '$Parametro12',
							   '$Parametro13',
							   '')");
	}else{
	$Ruta = utf8_encode($_FILES['TransferirFoto']['tmp_name']);
	$Nombre="./URL/".$NombreArchivo.""; 
    $Parametro14 = $NombreArchivo;
    move_uploaded_file($Ruta,$Nombre);
	$Consultar = $Conectar->
	query("CALL GrabarUsuario ('$Parametro1',
							   '$Parametro2',
							   '$Parametro3',
							   '$Parametro4',
							   '$Parametro5',
							   '$Parametro6',
							   '$Parametro7',
							   '$Parametro8',
							   '$Parametro9',
							   '$Parametro10',
							   '$Parametro11',
							   '$Parametro12',
							   '$Parametro13',
							   '$Parametro14')");
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