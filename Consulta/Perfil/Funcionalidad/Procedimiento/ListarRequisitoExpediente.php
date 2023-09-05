<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());
$Parametro1 = $_POST['TransferirId'];
$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarProcedimientoRequisito('$Parametro1');");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

	$Enviar['data'][] = array(
		$Fila['Denominacion']
	);

	$Contar++;
	
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>