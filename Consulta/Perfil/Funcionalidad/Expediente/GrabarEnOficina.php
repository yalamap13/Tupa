<?php 
session_start();
if($_POST) {

	$Validador = array('success' => false, 'messages' => array());
    $ParametroId = $_SESSION['IdUsuario'];
    $Parametro0 = $_POST['TransferirId'];
	$Parametro3 = $_POST['TransferirNumero'];
	$Parametro4 = $_POST['TransferirAsunto'];
	$Parametro5 = $_POST['TransferirFolios'];
	$Parametro6 = $_POST['TransferirIdTipoExpediente'];
	$Parametro7 = $_POST['TransferirIdPatrocinado'];
	$Parametro8 = $_POST['TransferirIdOficina'];
	$Parametro9 = $_POST['TransferirIdProcedimiento'];

    include '../../../Conectar.php';
	$Validador = array('success' => false, 'messages' => array());
    $Consultar = $Conectar->query("CALL NumeroExpediente();");
	$Transferir = $Consultar->fetch_assoc(); 
    $Parametro1 = $Transferir['Correlativo'];
    $Conectar->close();
    
    include '../../../Conectar.php';
	$Consultar = $Conectar->
	query("SET NAMES 'utf8'");

	$Consultar = $Conectar->
	query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

	$NombreArchivo = utf8_encode($_FILES['TransferirExpedienteDigital']['name']);
	$Ruta = utf8_encode($_FILES['TransferirExpedienteDigital']['tmp_name']);
	$Nombre="./URL/".$NombreArchivo.""; 
	
	if ($Parametro4=='') {
        echo '1';
	}elseif ($Parametro5=='') {
        echo '1';	    
	} elseif ($Parametro6==0) {
        echo '1';
	} elseif($Parametro7==0){
        echo '1';
	} elseif($Parametro8==0){
        echo '1';	    
	} elseif($Parametro9==0){
        echo '1';
	} else {	    
    if ($NombreArchivo == '') {
	$Consultar = $Conectar->
	query("CALL GrabarExpediente ('$Parametro0',
	                             '$Parametro1',
	                             Null, 
    	                         '$Parametro3',
    	                         '$Parametro4',
    	                         '$Parametro5',
    	                         '$Parametro6',
    	                         '$Parametro7',
    	                         '$Parametro8',
    	                         '$Parametro9',
    	                         '1',
    	                         '$ParametroId')");
    }else{
        $Parametro2 = $NombreArchivo;
        move_uploaded_file($Ruta,$Nombre);
	$Consultar = $Conectar->
	query("CALL GrabarExpediente ('$Parametro0',
	                              '$Parametro1',
    	                          '$Parametro2',
    	                          '$Parametro3',
    	                          '$Parametro4',
    	                          '$Parametro5',
    	                          '$Parametro6',
    	                          '$Parametro7',
    	                          '$Parametro8',
    	                          '$Parametro9',
    	                          '1',
    	                          '$ParametroId')");        
    }
    $Conectar->close();
    
    include '../../../Conectar.php';
    $Consultar = $Conectar->
    query("SET NAMES 'utf8'");
    $Consultar = $Conectar->
    query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $Consultar = $Conectar->
    query("CALL CrearHistorialExpedientePorLlegar ('$Parametro1',
                                                   '$Parametro2',
                                                   '$Parametro3',
                                                   '$Parametro4',
                                                   '$Parametro5',
                                                   '$Parametro6',
                                                   '$Parametro7',
                                                   '$Parametro8',
                                                   '$Parametro9',
                                                   '1',
                    	                           '$ParametroId')");
    $Conectar->close();
    
	if($Consultar == true) {			
		echo '0';
	} else {		
		echo '1';
	}
	
	}	
}
?>