<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarTramite");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

     if($Fila['Estado'] == '1')
     {
        $Estado = '<button type="button" 
            class="btn btn-success btn-estado"
            onclick="Estado('.$Fila['IdEstadoTramite'].')">
            Activo</i></button>';
     }
     else
     {
        $Estado = '<button type="button"
            class="btn btn-warning btn-estado" 
            onclick="Estado('.$Fila['IdEstadoTramite'].')">
            Inactivo</i></button>';
     }

    $Actualizar = '<button class="btn btn-info btn-modificar" data-toggle="modal" data-target="#AbrirModal" 
                  onclick="Actualizar('.$Fila['IdEstadoTramite'].')">
                  <i class="fa fa-edit fa-fw icono-size"></i>
                  </button>';

	$Enviar['data'][] = array(
        $Actualizar,
        0,
		$Fila['Nombre'],
		$Estado
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>