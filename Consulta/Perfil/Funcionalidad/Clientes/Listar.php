<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarCliente()");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

     if($Fila['Estado'] == '1')
     {
        $Estado = '<button type="button" 
            class="btn btn-success btn-estado"
            onclick="Estado('.$Fila['IdCliente'].')">
            Activo</i></button>';
     }
     else
     {
        $Estado = '<button type="button"
            class="btn btn-warning btn-estado" 
            onclick="Estado('.$Fila['IdCliente'].')">
            Inactivo</i></button>';
     }

     if($Fila['Sexo'] == 'M')
     {
        $Sexo = '<button type="button" 
            class="btn btn-primary" style="zoom:80%;">
            MASCULINO</i></button>';
     }
     else
     {
        $Sexo = '<button type="button"
            class="btn btn-warning" style="zoom:80%;background-color:#ef1f75;border-color:#ef1f75;">
            FEMENINO</i></button>';
     }

    $Actualizar = '<button class="btn btn-info btn-modificar" data-toggle="modal" data-target="#AbrirModal" 
                  onclick="Actualizar('.$Fila['IdCliente'].')">
                  <i class="fa fa-edit fa-fw icono-size"></i>
                  </button>';

	$Enviar['data'][] = array(
        $Actualizar,
        0,
		$Fila['Cliente'],
		$Fila['Descripcion'],
        $Fila['NumeroDocumento'],
        $Fila['Direccion'],
        $Fila['Telefono'],
        $Fila['CorreoElectronico'],
		$Estado
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>