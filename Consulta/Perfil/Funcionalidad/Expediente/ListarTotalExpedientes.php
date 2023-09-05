<?php 
include '../../../Conectar.php';
session_start();
$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

$Parametro1 = $_SESSION['IdOficina'];
if($_SESSION['Perfil']=='Administrador'){
 $Consultar = $Conectar->query("CALL ListarTotalExpediente('')");   
} else {
 $Consultar = $Conectar->query("CALL ListarTotalExpediente('$Parametro1')");
}

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

	$Enviar['data'][] = array(
	    $Fila['NumeroExpediente'],
	    $Fila['Year'],
		$Fila['TipoExpediente'],
		$Fila['Numero'],
        $Fila['Asunto'],
        $Fila['Folios'],
        $Fila['Estado']
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>