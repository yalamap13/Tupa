<?php 
include '../../../Conectar.php';
session_start();
$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");

$Parametro1 = $_SESSION['IdOficina'];
if($_SESSION['Perfil']=='Administrador'){
 $Consultar = $Conectar->query("CALL ListarExpedientePorLlegar('')");   
} else {
 $Consultar = $Conectar->query("CALL ListarExpedientePorLlegar('$Parametro1')");
}

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

    if($_SESSION['Perfil']=='Administrador'){
        
    if ($Fila['URL'] == '') {
    $Accion = '<a class="btn btn-warning btn-modificar" target="_self"
                 href="Documento.php?Item='.$Fila['NumeroExpediente'].'" title="Imprimir Seguimiento de Expediente"><i class="fa fa-list fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                
                <button class="btn btn-default btn-modificar" data-toggle="modal" onclick="EstadoPorLlegarAdmin('.$Fila['NumeroExpediente'].')" title="Derivar a Oficina">
                  <i class="fa fa-check-square-o  fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;';        
    } else {
    $Accion = '<a class="btn btn-warning btn-modificar" target="_self"
                 href="Documento.php?Item='.$Fila['NumeroExpediente'].'" title="Imprimir Seguimiento de Expediente"><i class="fa fa-list fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                
                <button class="btn btn-default btn-modificar" data-toggle="modal" onclick="EstadoPorLlegarAdmin('.$Fila['NumeroExpediente'].')"  title="Derivar a Oficina">
                  <i class="fa fa-check-square-o  fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;';                         
    }
    
    } else {

        
    if ($Fila['URL'] == '') {
    $Accion = '<a class="btn btn-warning btn-modificar" target="_self"
                 href="Documento.php?Item='.$Fila['NumeroExpediente'].'" title="Imprimir Seguimiento de Expediente"><i class="fa fa-list fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                
                <button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirEnOficina" onclick="EstadoPorLlegarArea('.$Fila['NumeroExpediente'].')" title="Derivar a Oficina">
                  <i class="fa fa-check-square-o  fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;';        
    } else {
    $Accion = '<a class="btn btn-warning btn-modificar" target="_self"
                 href="Documento.php?Item='.$Fila['NumeroExpediente'].'" title="Imprimir Seguimiento de Expediente"><i class="fa fa-list fa-fw icono-size"></i></a>&nbsp;&nbsp;&nbsp;
                
                <button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirEnOficina" onclick="EstadoPorLlegarArea('.$Fila['NumeroExpediente'].')"  title="Derivar a Oficina">
                  <i class="fa fa-check-square-o  fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;';                         
    }
    
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