<!DOCTYPE html>
<html lang="es">

<?php
 include '../Etiqueta/Encabezado.php';
 include '../Etiqueta/MenuGeneral.php'; 
 
    include '../Conectar.php';
	$Validador = array('success' => false, 'messages' => array());
    $Consultar = $Conectar->query("CALL NumeroExpediente();");
	$Transferir = $Consultar->fetch_assoc(); 
    $Correlativo = $Transferir['Correlativo'];
    $Conectar->close();
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
                         <h5 style="font-weight: 700;"> EXPEDIENTE EN OFICINA
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
                        <th>Año</th>
                        <th>Expediente</th>
                        <th>Tipo Expediente</th>
                        <th>Número</th>
				        <th>Asunto</th>
                        <th>Folios</th>
				        <th>Acción</th>  
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
        	<form class="form-horizontal" action="Funcionalidad/Expediente/Grabar.php" method="post" id="Formulario" name="Formulario" enctype="multipart/form-data">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Ingresar Expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">N° Expediente</label>
                    <input type="text" id="TransferirNroExpediente" name="TransferirNroExpediente" placeholder="Nr° Expediente" value="<?php echo $Correlativo; ?>" class="form-control validate" readonly="readonly"> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Expediente Digital</label>
                    <input type="file" id="TransferirExpedienteDigital" name="TransferirExpedienteDigital" placeholder="Expediente Digital" class="form-control validate"> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Tipo Expediente</label>
                        <select class="form-control validate" id="TransferirIdTipoExpediente" name="TransferirIdTipoExpediente" required>
                        <option value="">--Elegir Tipo Expediente--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirExpediente()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Número</label>
                    <input type="text" id="TransferirNumero" name="TransferirNumero" maxlength="15" placeholder="Número" class="form-control validate" required> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Asunto</label>
                    <input type="text" id="TransferirAsunto" name="TransferirAsunto" placeholder="Asunto" class="form-control validate" required>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-3 col-md-3">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Folios</label>
                    <input type="number" id="TransferirFolios" maxlength="10" name="TransferirFolios" placeholder="Folios" class="form-control validate" required>
                    </div>
                    <div class="col-xs-6 col-sm-9 col-md-9">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Patrocinado</label>
                        <select class="form-control validate" id="TransferirIdPatrocinado" name="TransferirIdPatrocinado" required>
                        <option value="">--Elegir Patrocinado--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirPatrocinado()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-12 col-sm-12 col-md-12">
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
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Procedimiento</label>
                        <select class="form-control validate" id="TransferirIdProcedimiento" name="TransferirIdProcedimiento" required>
                        <option value="">--Elegir Procedimiento--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirProcedimiento()");
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

<div class="modal fade" id="AbrirModalDerivar" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form class="form-horizontal" action="Funcionalidad/Expediente/Grabar.php" method="post" id="FormularioDerivar" name="FormularioDerivar">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Derivar Expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">N° Expediente</label>
                    <input type="text" id="TransferirNroExpediente" name="TransferirNroExpediente" placeholder="Nr° Expediente" class="form-control validate" readonly="readonly"> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Tipo Expediente</label>
                        <select class="form-control validate" id="TransferirTipoExpediente" name="TransferirTipoExpediente" required>
                        <option value="">--Elegir Tipo Expediente--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirExpediente()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Número</label>
                    <input type="number" id="TransferirNumero" name="TransferirNumero" placeholder="Número" class="form-control validate" required> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Observación</label>
                    <input type="number" id="TransferirObservacion" name="TransferirObservacion" placeholder="Observación" class="form-control validate" required>
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

<script type="text/javascript" src="Intermediario/PorLlegar.js"></script>