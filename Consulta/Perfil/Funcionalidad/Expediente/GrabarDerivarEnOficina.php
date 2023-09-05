<?php 
session_start();
if($_POST) {

	$Validador = array('success' => false, 'messages' => array());
	$Parametro1x = $_POST['TransferirNroExpedienteDerivar'];
	$Parametro2x = $_POST['TransferirObservacion'];
	$Parametro3x = $_POST['TransferirIdOficinaDerivar'];
	$Parametro4x = $_POST['TransferirIdTipoExpediente'];

    include '../../../Conectar.php';
    $ParametroId = $_SESSION['IdUsuario'];
	$Validador = array('success' => false, 'messages' => array());
    $Consultar = $Conectar->query("CALL LlamarExpedientePorLlegar('$Parametro1x');");
	$Transferir = $Consultar->fetch_assoc(); 
    $Parametro2 = $Transferir['NumeroExpediente'];
    $Parametro3 = $Transferir['URL'];
    $Parametro4 = $Transferir['Numero'];
    $Parametro5 = $Transferir['Asunto'];
    $Parametro6 = $Transferir['Folios'];
    $Parametro7 = $Transferir['IdTipoExpediente'];
    $Parametro8 = $Transferir['IdPatrocinado'];
    $Parametro9 = $Transferir['IdOficina'];
    $Parametro10 = $Transferir['IdProcedimiento'];
    $Conectar->close();
	
	include '../../../Conectar.php';
    $Consultar = $Conectar->
    query("SET NAMES 'utf8'");
    $Consultar = $Conectar->
    query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $Consultar = $Conectar->
    query("CALL CrearHistorialExpedientePorLlegar ('$Parametro2',
                                                   '$Parametro3',
                                                   '$Parametro4',
                                                   '$Parametro5',
                                                   '$Parametro6',
                                                   '$Parametro7',
                                                   '$Parametro8',
                                                   '$Parametro3x',
                                                   '$Parametro10',
                                                   '4',
                                                   '$ParametroId')");
    $Conectar->close();
    
    include '../../../Conectar.php';
    $Consultar = $Conectar->
    query("SET NAMES 'utf8'");
    $Consultar = $Conectar->
    query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $Consultar = $Conectar->
    query("CALL CrearDerivarArchivo ('$Parametro1x',
                                     '$Parametro2x',
                                     '$Parametro3x',
                                     '$Parametro4x')");
    $Conectar->close();
    
        include '../../../Conectar.php';
    $Consultar = $Conectar->
    query("SET NAMES 'utf8'");
    $Consultar = $Conectar->
    query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $Consultar = $Conectar->
    query("CALL DerivarEnOficina ('$Parametro2',
                                  '$Parametro3x')");
    $Conectar->close();
    /*
    include '../../../Conectar.php';
    $Consultar = $Conectar->query("CALL EstadoArchivado('$Parametro1x');");
    $Conectar->close();
    */
	if($Consultar == true) {			
		echo '0';
	} else {		
		echo '1';
	}
	
}
?>