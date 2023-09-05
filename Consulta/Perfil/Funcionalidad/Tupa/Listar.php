<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarTupa()");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

     if($Fila['Estado'] == '1')
     {
        $Estado = '<button type="button" 
            class="btn btn-success btn-estado"
            onclick="Estado('.$Fila['IdTupa'].')">
            Activo</i></button>';
     }
     else
     {
        $Estado = '<button type="button"
            class="btn btn-warning btn-estado" 
            onclick="Estado('.$Fila['IdTupa'].')">
            Inactivo</i></button>';
     }

    if ($Fila['Archivo'] == '') {
    $Archivo = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalArchivo" 
            onclick="GuardarArchivo('.$Fila['IdTupa'].')">
                  <i class="fa fa-cloud-download fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;
               
                  <a class="btn btn-danger" style="zoom:75%;" target="_blank"
                   href="Funcionalidad/Tupa/Archivo/'.utf8_encode($Fila['Archivo']).'">Sin Documento</a>';        
    } else {
    $Archivo = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalArchivo" 
            onclick="GuardarArchivo('.$Fila['IdTupa'].')">
                  <i class="fa fa-cloud-download fa-fw icono-size"></i>
                  </button>&nbsp;&nbsp;&nbsp;
               
                  <a class="btn btn-primary" style="zoom:75%;"  target="_blank"
                   href="Funcionalidad/Tupa/Archivo/'.utf8_encode($Fila['Archivo']).'">Descargar</a>';        
    }
        
    $Actualizar = '<button class="btn btn-info btn-modificar" data-toggle="modal" data-target="#AbrirModal" 
                  onclick="Actualizar('.$Fila['IdTupa'].')">
                  <i class="fa fa-edit fa-fw icono-size"></i>
                  </button>';

	$Enviar['data'][] = array(
        $Actualizar,
		$Fila['Year'],
        $Fila['Denominacion'],
        $Fila['UIT'],
        $Fila['Resolucion'],
        $Archivo,
		$Estado
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>