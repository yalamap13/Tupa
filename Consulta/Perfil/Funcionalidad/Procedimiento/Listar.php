<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarProcedimiento()");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

     if($Fila['EstadoProcedimiento'] == '1')
     {
        $Estado = '<button type="button" 
            class="btn btn-success btn-estado"
            onclick="Estado('.$Fila['IdProcedimiento'].')">
            Activo</i></button>';
     }
     else
     {
        $Estado = '<button type="button"
            class="btn btn-warning btn-estado" 
            onclick="Estado('.$Fila['IdProcedimiento'].')">
            Inactivo</i></button>';
     }

    $Actualizar = '<button class="btn btn-info btn-modificar" data-toggle="modal" data-target="#AbrirModal" 
                  onclick="Actualizar('.$Fila['IdProcedimiento'].')">
                  <i class="fa fa-edit fa-fw icono-size"></i>
                  </button>';
                  
    $Requisitos = '<button class="btn btn-warning btn-modificar" data-toggle="modal" data-target="#AbrirModalRequisito" 
                  onclick="Requisito('.$Fila['IdProcedimiento'].')">
                  <i class="fa fa-list fa-fw icono-size"></i>
                  </button>';

	$Enviar['data'][] = array(
        $Actualizar,
        0,
        $Fila['Tupa'],
		$Fila['Codigo'],
		$Fila['NombreProcedimiento'],
        $Fila['UIT'],
        $Fila['DerechoTramite'],
        $Fila['Valor'],
        $Fila['DiasTramite'],
        $Requisitos,
		$Estado
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>