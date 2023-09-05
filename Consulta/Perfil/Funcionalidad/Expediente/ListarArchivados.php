<?php 
include '../../../Conectar.php';
session_start();
$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

$Parametro1 = $_SESSION['IdOficina'];
if($_SESSION['Perfil']=='Administrador'){
 $Consultar = $Conectar->query("CALL ListarExpedienteArchivados('')");   
} else {
 $Consultar = $Conectar->query("CALL ListarExpedienteArchivados('$Parametro1')");
}

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

    $Accion = '<a class="btn btn-warning btn-modificar" target="_self"
                 href="Documento.php?Item='.$Fila['NumeroExpediente'].'"  title="Imprimir Seguimiento de Expediente"><i class="fa fa-list fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;';        

   
    if ($Fila['URL'] == '') {
    $Archivo = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalArchivo" 
            onclick="GuardarArchivo('.$Fila['IdExpediente'].')" title="Subir Documento">
                  <i class="fa fa-cloud-download fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;
               
                  <a class="btn btn-danger" style="zoom:75%;" target="_blank"
                   href="Funcionalidad/Expediente/URL/'.utf8_encode($Fila['URL']).'" title="Descargar Documento">Sin Documento</a>';        
    } else {
    $Archivo = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalArchivo" 
            onclick="GuardarArchivo('.$Fila['IdExpediente'].')" title="Subir Documento">
                  <i class="fa fa-cloud-download fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;
               
                  <a class="btn btn-primary" style="zoom:75%;"  target="_blank"
                   href="Funcionalidad/Expediente/URL/'.utf8_encode($Fila['URL']).'"  title="Descargar Documento">Descargar</a>';        
    }
    
	$Enviar['data'][] = array(
	    $Fila['Year'],
	    $Fila['NumeroExpediente'],
		$Fila['EstadoTramite'],
		$Fila['Numero'],
        $Fila['Asunto'],
        $Fila['Folios'],
        $Archivo,
		$Accion
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>