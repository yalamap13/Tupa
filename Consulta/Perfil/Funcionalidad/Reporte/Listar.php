<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarReporte");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):
    
    $FechaHora = date("Y-m-d", strtotime($Fila['FechaHoraRegistro']));

    $fecha = new DateTime($Fila['FechaHoraRegistro']);
    $FechaHora = $fecha->format('Y-m-d');


	$Enviar['data'][] = array(
        0,
		$Fila['NumeroExpediente'],
		$Fila['Tupa'],
		$Fila['Oficina'],
		$Fila['TipoExpediente'],
		$Fila['Numero'],
		$Fila['Asunto'],
		$Fila['Folios'],
		$FechaHora,
		$Fila['EstadoDocumento']
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>