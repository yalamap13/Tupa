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
                         <h5 style="font-weight: 700;"> PROCEDIMIENTO
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
                        <th>Item</th>
                        <th>Tupa</th>
                        <th>Código</th>
                        <th>Denominación</th>
				        <th>U.I.T</th>
                        <th>Derecho Tramite</th>
                        <th>Valor</th>
                        <th>Días Tramite</th>  
                        <th>Requisito</th>
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
        	<form class="form-horizontal" action="Funcionalidad/Procedimiento/Grabar.php" method="post" id="Formulario" name="Formulario">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Ingresar Procedimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Nombre</label>
                    <input type="text" id="TransferirNombre" name="TransferirNombre" maxlength="100" placeholder="Nombre" class="form-control validate" required> 
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">U.I.T</label>
                    <input type="text" id="TransferirUIT" name="TransferirUIT" placeholder="UIT" maxlength="10" onkeypress="return NumCheck(event, this)" class="form-control validate" readonly> 
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Derecho Tramite</label>
                    <input type="text" id="TransferirDerechoTramite" name="TransferirDerechoTramite" maxlength="10" onkeyup="return CalcularValorUp()" onkeypress="return CalcularValor(event, this)" placeholder="Valor %" class="form-control validate" required> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Valor S/</label>
                    <input type="text" id="TransferirValor" name="TransferirValor" placeholder="Valor" maxlength="15" onkeypress="return NumCheck(event, this)" class="form-control validate" readonly> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Días Tramite</label>
                    <input type="number" id="TransferirDiasTramite" name="TransferirDiasTramite" maxlength="4" placeholder="Días Tramite" class="form-control validate" required> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Tupa</label>
                        <select class="form-control validate" id="TransferirIdTupa" onclick="FiltrarUIT();" name="TransferirIdTupa" required>
                        <option value="">--Elegir Tupa--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirTupa()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Oficina</label>
                        <select class="form-control validate" id="TransferirIdOficina" name="TransferirIdOficina" required>
                        <option value="">--Elegir Oficina--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirOficina()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
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

<div class="modal fade" id="AbrirModalRequisito" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form class="form-horizontal" action="Funcionalidad/Procedimiento/AgregarRequisito.php" method="post" id="FormularioRequisito" name="FormularioRequisito">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Configuración de Requisitos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="TransferirIdRQM" id="TransferirIdRQM"/>
                <div class="col-xs-6 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Procedimiento</label>
                    <input type="text" id="TransferirNombreRQ" name="TransferirNombreRQ" placeholder="Nombre" class="form-control validate" disabled> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">U.I.T</label>
                    <input type="text" id="TransferirUITRQ" name="TransferirUITRQ" placeholder="UIT" class="form-control validate" disabled> 
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Valor S/</label>
                    <input type="text" id="TransferirValorRQ" name="TransferirValorRQ" placeholder="Valor" class="form-control validate" disabled> 
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Días Tramite</label>
                    <input type="text" id="TransferirDiasTramiteRQ" name="TransferirDiasTramiteRQ" placeholder="Días Tramite" class="form-control validate" disabled> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Tupa</label>
                        <select class="form-control validate" id="TransferirIdTupaRQ" name="TransferirIdTupaRQ" disabled>
                        <option value="">--Elegir Tupa--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirTupaLista()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Oficina</label>
                        <select class="form-control validate" id="TransferirIdOficinaRQ" name="TransferirIdOficinaRQ" disabled>
                        <option value="">--Elegir Oficina--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirOficina()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                    </div> 
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-8 col-sm-8 col-md-8" style="margin-top:18px;">
                        <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Requisito</label>
                        <select class="selectpicker" data-show-subtext="true" data-live-search="true"  id="TransferirIdRequisito" name="TransferirIdRequisito" required>
                        <option value="">--Buscar Requisito--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirRequisito()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                    </div> 
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <button type="submit" style="margin-top:25px;zoom:85%;float:left;" class="btn btn-success">
                        Agregar Requisito&nbsp;<i class="fa fa-angle-double-down fa-fw icono-size"></i>
                        </button>
                    </div> 
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center color-modal AbrirModal" style="display:inline-table;width:100%;background-color:#d6d6d6;color:black;padding:5px;">
            <div class="card-body text-default">
            <div style="padding: 15px;background: white;overflow:scroll;height:250px;">
    				<table width="100%" class="table table-striped table-bordered table-hover" id="LlenarTablaRequisito">         
    				<thead> 
                            <th>Requisito</th>
    				        <th>Quitar</th>  
    				</thead>
        			</table>
            </div>
            </div>                
            </div>
            </form>
        </div>
        </div>
</div>

<?php
 require_once'../Etiqueta/PieDePagina.php';
?>
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

</div>
</body>
</html>

<script type="text/javascript" src="Intermediario/Procedimiento.js"></script>