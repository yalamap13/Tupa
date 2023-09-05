<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarUsuario");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

     if($Fila['Estado'] == 1)
     {
        $Estado = '<button type="button" style="width:100px;"
            class="btn btn-success btn-estado"
            onclick="Estado('.$Fila['IdUsuario'].')">
            Activo</i></button>';
     } else if($Fila['Estado'] == 2) {
        $Estado = '<button type="button" style="width:100px;"
            class="btn btn-warning btn-estado"
            onclick="Estado('.$Fila['IdUsuario'].')">
            Bloqueado</i></button>';
     } else {
        $Estado = '<button type="button" style="width:100px;"
            class="btn btn-danger btn-estado" 
            onclick="Estado('.$Fila['IdUsuario'].')">
            Inactivo</i></button>';
     }

    $Accion = '<div><button style="width:100px;" class="btn btn-info btn-estado" data-toggle="modal" data-target="#AbrirModal" 
                  onclick="Actualizar('.$Fila['IdUsuario'].')">
                  Actualizar
                  </button>&nbsp&nbsp&nbsp&nbsp&nbsp'.$Estado.'</div>';
                  
    if ($Fila['Imagen'] == '') {
                $Imagen = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalImagen" 
                  onclick="GuardarImagen('.$Fila['IdUsuario'].')" style="width:40%;height:120px;">
                  <img src="Funcionalidad/Usuario/Imagen/icono.png">
                </button>';
    } else {
                $Imagen = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalImagen" 
                  onclick="GuardarImagen('.$Fila['IdUsuario'].')" style="width:40%;height:120px;">
                  <img src="Funcionalidad/Usuario/Imagen/'.$Fila['Imagen'].'">
                </button>';
    }
                  
    $Formulario = '<div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="right" style="margin-bottom:-5px;">Trabajador</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Trabajador" value="'.$Fila['Trabajador'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="right" style="margin-bottom:-5px;">Usuario</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Usuario" value="'.$Fila['Usuario'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="right" style="margin-bottom:-5px;">Perfil</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Perfil" value="'.$Fila['Perfil'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal" data-success="right" style="margin-bottom:-5px;">DNI</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="DNI" value="'.$Fila['DNI'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal" data-success="right" style="margin-bottom:-5px;">Telefono</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Telefono" value="'.$Fila['Telefono'].'" class="form-control validate" readonly>
                    </div>';

	$Enviar['data'][] = array(
        $Imagen,
        0,
		$Formulario,
		$Accion
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>