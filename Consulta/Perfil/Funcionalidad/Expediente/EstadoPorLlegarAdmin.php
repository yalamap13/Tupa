<?php 
session_start();
    $Validador = array('success' => false, 'messages' => array());

    include '../../../Conectar.php';
    $Parametro1 = $_POST['TransferirId'];
    $ParametroId = $_SESSION['IdUsuario'];
	$Validador = array('success' => false, 'messages' => array());
    $Consultar = $Conectar->query("CALL LlamarExpedientePorLlegar('$Parametro1');");
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
    $Parametro11 = $Transferir['Estado'];
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
                                                   '$Parametro9',
                                                   '$Parametro10',
                                                   '1',
                                                   '$ParametroId')");
    $Conectar->close();
    
    include '../../../Conectar.php';
    $Consultar = $Conectar->query("CALL EstadoPorLlegarAdmin('$Parametro2');");
    $Conectar->close();
    
    if($Consultar == true) {
    	$Validador['success'] = true;
    } else {
    	$Validador['success'] = false;
    }
    
    $Validador['messages'] = $Parametro2;
    
    echo json_encode($Validador);
?>