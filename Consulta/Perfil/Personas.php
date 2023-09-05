<!DOCTYPE html>
<html lang="es">

<?php
 include '../Etiqueta/Encabezado.php';
 include '../Etiqueta/MenuGeneral.php'; 
?>

<div id="page-wrapper">
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="col-xs-12">
      <div class="card border-default mb-12">
        <div class="card-header bg-transparent border-default">
              <ul class="breadcrumb">
                    <li>
                         <h5 style="font-weight: 700;">MANTENIMIENTO DE PERSONAS
                        <button type="button" class="btn btn-primary btn-agregar" 
                        style="float: right;margin-top: -7px;margin-right:5px;" 
                        data-toggle="modal" data-target="#AbrirModal" onclick="Crear()"> 
                        Crear<i class="fa fa-plus fa-fw icono-size"></i>
                        </button>
                        </h5>
                    </li>
                </ul>
        </div>

        <div class="card-body text-default">
        <div style="padding: 15px;background: white;">
				<table width="100%" class="table table-striped table-bordered table-hover" id="LlenarTabla">         
				<thead> 
                        <th>Actualizar</th>
                        <th>Documento de Identidad</th>
				        <th>Nombres</th>
                        <th>Dirección</th>  
                        <th>Teléfono</th>
                        <th>Área</th></th>
				        <th>Estado</th>  
				</thead>
				</table>
    </div>
    </div>
</div>
</div>
</div>	
<div class="modal fade" id="AbrirModal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form class="form-horizontal" action="Funcionalidad/Personas/Grabar.php" method="post" id="Formulario" name="Formulario">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Ingresar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Documento Identidad</label>
                    <input type="text" id="TransferirDocumentoIdentidad" name="TransferirDocumentoIdentidad" placeholder="Documento Identidad" class="form-control validate" required> 
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Nombres</label>
                    <input type="text" id="TransferirNombres" name="TransferirNombres" placeholder="Nombres" class="form-control validate" required> 
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Direcci&oacute;n</label>
                    <input type="text" id="TransferirDireccion" name="TransferirDireccion" placeholder="Direcci&oacute;n" class="form-control validate" required> 
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Tel&eacute;fono</label>
                    <input type="text" id="TransferirTelefono" name="TransferirTelefono" placeholder="Tel&eacute;fono" class="form-control validate" required> 
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">&Aacute;rea</label>
                 <select class="form-control validate" id="TransferirIdArea" name="TransferirIdArea" placeholder="&Aacute;rea">
                        <option value="">--Elegir Area--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirArea");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                  </select>
                </div>
                <div class="md-form mb-5">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Detalles</label>
                    <input type="text" id="TransferirDetalles" name="TransferirDetalles" placeholder="Detalles" class="form-control validate"> 
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center color-modal AbrirModal">
                <button type="submit" class="btn btn-default cerrar-modal">
                Grabar<i class="fa fa-save fa-fw icono-size"></i>
                </button>
            </div>
            </form>
        </div>
        </div>
</div>

<?php
 require_once'../Etiqueta/PieDePagina.php';
?>

</div>
</body>
</html>

<script type="text/javascript" src="Intermediario/Personas.js"></script>