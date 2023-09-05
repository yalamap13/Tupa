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
                        </h5>
                    </li>
                </ul>
        </div>

        <div class="card-body text-default">
        <div style="padding: 15px;background: white;">
				<table width="100%" class="table table-striped table-bordered table-hover" id="LlenarTabla">         
				<thead> 
				        <th>N° Expediente</th>
                        <th>Año Tupa</th>
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
        	<form class="form-horizontal" action="Funcionalidad/Expediente/GrabarEnOficina.php" method="post" id="Formulario" name="Formulario" enctype="multipart/form-data">
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
                    <input type="text" id="TransferirNroExpediente" name="TransferirNroExpediente" maxlength="15" placeholder="Nr° Expediente" value="<?php echo $Correlativo; ?>" class="form-control validate" readonly="readonly"> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Expediente Digital</label>
                    <input type="file" id="TransferirExpedienteDigital" name="TransferirExpedienteDigital" placeholder="Expediente Digital" accept=".doc,.docx,.pdf" class="form-control validate"> 
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
                    <input type="text" id="TransferirNumero" name="TransferirNumero" maxlength="30" placeholder="Número" class="form-control validate" required> 
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
                    <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Procedimiento</label>
                        <select class="form-control validate" id="TransferirIdProcedimiento" onclick="FiltrarRequisito();" name="TransferirIdProcedimiento" required>
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

            <div class="card-body text-default">
            <div style="padding: 15px;background: white;overflow:scroll;height:200px;">
    				<table width="100%" class="table table-striped table-bordered table-hover" id="LlenarTablaRequisito">         
    				<thead> 
                            <th>Requisito</th>
    				</thead>
        			</table>
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

<div class="modal fade" id="AbrirModalDerivarOficina" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form class="form-horizontal" action="Funcionalidad/Expediente/GrabarDerivarEnOficina.php" method="post" id="FormularioDerivar" name="FormularioDerivar">
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
                    <input type="text" id="TransferirNroExpedienteDerivar" name="TransferirNroExpedienteDerivar" placeholder="Nr° Expediente" class="form-control validate" readonly> 
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
                    <input type="number" id="TransferirNumero" name="TransferirNumero" maxlength="30" placeholder="Número" class="form-control validate" required> 
                </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Observación</label>
                    <input type="text" id="TransferirObservacion" name="TransferirObservacion" placeholder="Observación" class="form-control validate" required>
                    </div>
                    <div class="col-xs-6 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Oficina</label>
                    <select class="form-control validate" id="TransferirIdOficinaDerivar" name="TransferirIdOficinaDerivar">
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

<div class="modal fade" id="AbrirModalDerivarArchivo" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form class="form-horizontal" action="Funcionalidad/Expediente/GrabarDerivarArchivo.php" method="post" id="FormularioArchivo" name="FormularioArchivo">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Archivar Expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">N° Expediente</label>
                    <input type="text" id="TransferirNroExpedienteDerivarArchivo" name="TransferirNroExpedienteDerivarArchivo" placeholder="Nr° Expediente" class="form-control validate" readonly> 
                </div>
            
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Estado Tramite</label>
                        <select class="form-control validate" id="TransferirIdTipoExpedienteArchivo" name="TransferirIdTipoExpedienteArchivo" required>
                        <option value="">--Elegir Estado Tramite--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirEstadoTramite()");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Observación</label>
                    <input type="text" id="TransferirObservacionArchivo" name="TransferirObservacionArchivo" placeholder="Observación" class="form-control validate" required>
                    </div>
                </div>                
                <div class="col-xs-6 col-sm-6 col-md-6" style="visibility: hidden;height:0px;">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Número</label>
                    <input type="number" id="TransferirNumeroArchivo" name="TransferirNumeroArchivo" placeholder="Número" class="form-control validate" value="0"> 
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

<script type="text/javascript" src="Intermediario/EnOficina.js"></script>