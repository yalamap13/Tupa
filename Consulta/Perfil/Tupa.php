<!DOCTYPE html>
<html lang="es">

<?php
 include '../Etiqueta/Encabezado.php';
 include '../Etiqueta/MenuGeneral.php'; 
?>

<div id="page-wrapper" style="display:flex;">
    <div class="col-xs-12" style="margin-top:70px;">
      <div class="card border-default mb-12">
        <div class="card-header bg-transparent border-default">
              <ul class="breadcrumb">
                    <li>
                         <h5 style="font-weight: 700;"> TUPA
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
                        <th>Año</th>
				        <th>Denominación</th>
                        <th>U.I.T</th>
                        <th>Resolución</th>
                        <th>Archivo</th>
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
        	<form class="form-horizontal" action="Funcionalidad/Tupa/Grabar.php" method="post" id="Formulario" name="Formulario">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Ingresar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-3">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Año</label>
                    <input type="text" id="TransferirYear" name="TransferirYear" maxlength="4"  placeholder="Año" onkeypress="return NumCheck(event, this)" class="form-control validate" required> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Denominación</label>
                    <input type="text" id="TransferirDenominacion" name="TransferirDenominacion" maxlength="100" placeholder="Denominación" class="form-control validate" required> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">U.I.T</label>
                    <input type="text" id="TransferirUIT" name="TransferirUIT" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="UIT" class="form-control validate" required> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Resolución</label>
                    <input type="text" id="TransferirResolucion" name="TransferirResolucion" placeholder="Resolución" class="form-control validate" required> 
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" id="DivArchivo">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Documento</label>
                    <input type="file" id="TransferirDocumento" name="TransferirDocumento" placeholder="Documento" class="form-control validate"> 
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

<div class="modal fade" id="AbrirModalArchivo" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form class="form-horizontal" action="Funcionalidad/Tupa/GuardarArchivo.php" method="post" id="FormularioArchivo" name="FormularioArchivo" enctype="multipart/form-data">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Elegir Archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12" style="visibility:hidden">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Id</label>
                    <input type="text" id="TransferirId" name="TransferirId" placeholder="Id" class="form-control validate"> 
                </div>                
                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:-40px;">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Archivo</label>
                    <input type="file" id="TransferirArchivo" name="TransferirArchivo" accept=".doc,.docx,.pdf" placeholder="Archivo" class="form-control validate"> 
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center color-modal AbrirModal">
                <button type="submit" class="btn btn-default cerrar-modal">
                Guardar<i class="fa fa-save fa-fw icono-size"></i>
                </button>
            </div>
            </form>
        </div>
    	</div>
</div>

<script type="text/javascript">
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which
  // backspace
  if (key == 8) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    regexp = /.[0-9]{12}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false
}
</script>
<?php
 require_once'../Etiqueta/PieDePagina.php';
?>

</div>
</body>
</html>

<script type="text/javascript" src="Intermediario/Tupa.js"></script>