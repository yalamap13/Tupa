<?php 
include '../../../Conectar.php';

$Enviar = array('data' => array());

$Consultar = $Conectar->query("SET NAMES 'utf8'");
$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
$Consultar = $Conectar->query("CALL ListarParametro()");

$Contar = 1;
while ($Fila = $Consultar->fetch_assoc()):

     if($Fila['Estado'] == '1')
     {
        $Estado = '<button type="button" 
            class="btn btn-success btn-estado"
            onclick="Estado('.$Fila['IdParametro'].')">
            Activo</i></button>';
     }
     else
     {
        $Estado = '<button type="button"
            class="btn btn-warning btn-estado" 
            onclick="Estado('.$Fila['IdParametro'].')">
            Inactivo</i></button>';
     }

    $Accion = '<div><button style="width:100px;" class="btn btn-info btn-estado" data-toggle="modal" data-target="#AbrirModal" 
                  onclick="Actualizar('.$Fila['IdParametro'].')">
                  Actualizar
                  </button>&nbsp&nbsp&nbsp&nbsp&nbsp'.$Estado.'</div>';
                  
    if ($Fila['Slogan'] == '') {
                $Imagen = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalImagen" 
                  onclick="GuardarImagen('.$Fila['IdParametro'].')" style="width:40%;height:120px;">
                  <i class="fa fa-picture-o fa-fw icono-size"></i>
                </button>';
    } else {
                $Imagen = '<button class="btn btn-default btn-modificar" data-toggle="modal" data-target="#AbrirModalImagen" 
                  onclick="GuardarImagen('.$Fila['IdParametro'].')" style="width:40%;height:120px;">
                  <img src="Funcionalidad/Parametro/Imagen/'.$Fila['Slogan'].'">
                </button>';
    }
                  
    $Formulario = '<div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal" data-success="left" style="margin-bottom:-5px;">Año Para.</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Año Parametro" value="'.$Fila['YearParametro'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal" data-success="left" style="margin-bottom:-5px;">Año Tupa</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Año Tupa" value="'.$Fila['YearTupa'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="left" style="margin-bottom:-5px;">Empresa</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Empresa" value="'.$Fila['Empresa'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="left" style="margin-bottom:-5px;">Ruc</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Ruc" value="'.$Fila['Ruc'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="left" style="margin-bottom:-5px;">Dirección</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Dirección" value="'.$Fila['Direccion'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="left" style="margin-bottom:-5px;">IGV</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="IGV" value="'.$Fila['IGV'].'" class="form-control validate" readonly>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label data-error="wrong" class="label-modal" data-success="left" style="margin-bottom:-5px;">Ger. Encargado</label>
                        <input type="text" style="zoom:80%;margin-bottom:5px;width:100%;" placeholder="Gerente Encargado" value="'.$Fila['GerenteEncargado'].'" class="form-control validate" readonly>
                    </div>';

	$Enviar['data'][] = array(
        $Imagen,
		$Formulario,
		$Accion
	);

	$Contar++;
endwhile;

$Conectar->close();

echo json_encode($Enviar);
?>