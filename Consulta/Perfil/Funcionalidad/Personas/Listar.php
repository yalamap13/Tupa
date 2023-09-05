<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarPersonas");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

     if($Fila['EstadoPersona'] == '1')
     {
        $Estado = '<button type="button" 
            class="btn btn-success btn-estado"
            onclick="Estado('.$Fila['IdPersonas'].')">
            Activo</i></button>';
     }
     else
     {
        $Estado = '<button type="button"
            class="btn btn-warning btn-estado" 
            onclick="Estado('.$Fila['IdPersonas'].')">
            Inactivo</i></button>';
     }

     if($Fila['Area'] == ''){
         $Area = '<label style="color:blue;">PROVEEDOR</label>';
     } else {
         $Area = $Fila['Area'];
     }
    $Actualizar = '<button class="btn btn-info btn-modificar" data-toggle="modal" data-target="#AbrirModal" 
                  onclick="Actualizar('.$Fila['IdPersonas'].')">
                  <i class="fa fa-edit fa-fw icono-size"></i>
                  </button>';

	$Enviar['data'][] = array(
        $Actualizar,
		$Fila['DocumentoIdentidad'],
        $Fila['Nombres'],
        $Fila['Direccion'],
        $Fila['Telefono'],
        $Area,
		$Estado
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>