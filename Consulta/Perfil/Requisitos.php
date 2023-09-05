<!DOCTYPE html>
<html lang="es">

<?php
 include '../Etiqueta/Encabezado.php';
 include '../Etiqueta/MenuGeneral.php'; 
?>
<div id="page-wrapper" style="display: -webkit-box;">
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="col-xs-12">
      <div class="card border-default mb-3">
        <div class="card-header bg-transparent border-default">
              <ul class="breadcrumb">
                    <li>
                         <h5 style="font-weight: 700;"><label style="color:#2e6da4;"></label>REQUISITO
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
				        <th>Código</th>
				        <th>Denominación</th>
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
        	<form class="form-horizontal" action="Funcionalidad/Requisito/Grabar.php" method="post" id="Formulario" name="Formulario">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Ingresar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Código</label>
                    <input type="text" id="TransferirCodigo" name="TransferirCodigo" maxlength="20" placeholder="Documento Identidad" class="form-control validate" required> 
                </div>
                <div class="col-xs-6 col-sm-9 col-md-9">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Denominación</label>
                    <input type="text" id="TransferirDenominacion" name="TransferirDenominacion" maxlength="300" placeholder="Denominación" class="form-control validate" required> 
                </div>
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

<script type="text/javascript" src="Intermediario/Requisito.js"></script>