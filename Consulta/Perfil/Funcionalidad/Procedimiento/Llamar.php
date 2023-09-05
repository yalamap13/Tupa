<?php 
include '../../../Conectar.php';

$Consultar = $Conectar->
query("SET NAMES 'utf8'");

$Consultar = $Conectar->
query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

$Parametro1 = $_POST['TransferirId'];

$Consultar = $Conectar->
query("CALL LlamarProcedimiento ('$Parametro1')");

$Resultado = $Consultar->fetch_assoc();

$Conectar->close();

echo json_encode($Resultado);
?>