<?php 
include '../../../Conectar.php';
session_start();
$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

$Parametro1 = $_SESSION['IdOficina'];
if($_SESSION['Perfil']=='Administrador'){
 $Consultar = $Conectar->query("CALL ListarExpedienteEnOficina('')");   
} else {
 $Consultar = $Conectar->query("CALL ListarExpedienteEnOficina('$Parametro1')");
}

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

    if ($Fila['URL'] == '') {
    $Accion = '<a class="btn btn-info btn-modificar"  target="_self"
                 href="DocumentoExpediente.php?Item='.$Fila['NumeroExpediente'].'" title="Imprimir Detalles de Expediente"><i class="fa fa-print fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                 
                <a class="btn btn-warning btn-modificar" target="_self"
                 href="Documento.php?Item='.$Fila['Numero'].'" title="Imprimir Seguimiento de Expediente"><i class="fa fa-list fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                 
                <button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalDerivarOficina" 
            onclick="DerivarOficina('.$Fila['NumeroExpediente'].')" title="Derivar Expediente">
                  <i class="fa fa-share fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;
   
                     <button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalDerivarArchivo" 
            onclick="DerivarArchivo('.$Fila['NumeroExpediente'].')" title="Archivar Expediente">
                  <i class="fa fa-archive fa-fw icono-size"></i>
                  </button>';        
    } else {
    $Accion = '<a class="btn btn-info btn-modificar"  target="_self"
                 href="DocumentoExpediente.php?Item='.$Fila['NumeroExpediente'].'" title="Imprimir Detalles de Expediente"><i class="fa fa-print fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                 
                <a class="btn btn-warning btn-modificar"  target="_self"
                 href="Documento.php?Item='.$Fila['Numero'].'" title="Imprimir Seguimiento de Expediente"><i class="fa fa-list fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                
                <button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalDerivarOficina" 
            onclick="DerivarOficina('.$Fila['NumeroExpediente'].')" title="Derivar Expediente">
                  <i class="fa fa-share fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;
                  
                  <button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalDerivarArchivo" 
            onclick="DerivarArchivo('.$Fila['NumeroExpediente'].')"  title="Archivar Expediente">
                  <i class="fa fa-archive fa-fw icono-size"></i>
                  </button>';        
    }
   

	$Enviar['data'][] = array(
	    $Fila['NumeroExpediente'],
	    $Fila['Year'],
		$Fila['TipoExpediente'],
		$Fila['Numero'],
        $Fila['Asunto'],
        $Fila['Folios'],
		$Accion
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>