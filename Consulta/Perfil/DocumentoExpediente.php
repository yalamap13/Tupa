<style>
input:focus, input.form-control:focus {

    outline:none !important;
    outline-width: 0 !important;
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
}    
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #73767b;
  color: white;
}
@media handheld, only screen and (max-width: 767px) {
.ls-container {
display:none;
}
}

@media only screen and (max-width: 1023px) {
.ls-container {
display:none;
}
}
</style>

<?php
session_start();
 include '../Etiqueta/Encabezado.php';
 include '../Etiqueta/MenuGeneral.php'; 
 
    include '../Conectar.php';
    @$Id = $_GET['Item'];
	$Consultar = $Conectar->query("SET NAMES 'utf8'");
    $Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $Consultar = $Conectar->query("CALL LlamarDocumento('$Id');");
    $Transferir = $Consultar->fetch_assoc(); 
    @$Parametro1 = $Transferir['NumeroExpediente'];
    @$Parametro2 = $Transferir['TipoExpediente'];
    @$Parametro3 = $Transferir['Numero'];
    @$Parametro4 = $Transferir['Asunto'];
    @$Parametro5 = $Transferir['Folios'];
    @$Parametro6 = $Transferir['Oficina'];
    @$Parametro7 = $Transferir['Procedimiento'];
    @$Parametro8 = $Transferir['FechaHoraRegistro'];
    @$Parametro9 = $Transferir['FechaHoraActualizacion'];
    @$Parametro10 = $Transferir['PatrocinadoRazonSocial'];
    @$Parametro11 = $Transferir['NumeroDocumento'];
    @$Parametro12 = $Transferir['Procedimiento'];
    @$Parametro13 = $Transferir['Observacion'];
    @$Parametro14 = $Transferir['Empresa'];
    @$Parametro15 = $Transferir['SloganImagen'];
    date_default_timezone_set("America/Lima");
    $time = time();
    
    $Conectar->close();
    
?>
        <br/>
        <div id="page-wrapper" style="background-color:white;" style="display: -webkit-box;">
            <div class="col-xs-12">
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                       <button type="button" style="margin-left:15px" onclick="Imprimir('DivImprimir')">Imprimir<i class="fa fa-print fa-fw icono-size"></i></button>
                        <br/>
                        <div class="col-lg-12" style="background-color:#ffffff;" id="DivImprimir">
                        <br/>
                        <form class="form-horizontal" action="Documento.php?Item=<?php echo $buscar; ?>" style="width:700px;" method="POST" id="buscar_formulario" name="buscar_formulario">
                            <div class="md-form mb-5 col-lg-6" style="border:1px solid #ccc;padding:2px;width:100%;">
                                <div style="display:flex;">
                                <div class="md-form mb-12 col-lg-12" style="border:1px solid #ccc;width:100%;">
                                    <div class="md-form mb-12 col-lg-12">
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="font-size:18px;margin-top:15px;"><?php echo ''.$Parametro14.''; ?></label>
                                            <img src="Funcionalidad/Parametro/Imagen/<?php echo ''.$Parametro15.''; ?>" style="zoom:20%;padding:50px;"/>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div style="display:inline-flex;">
                            <div class="md-form mb-6 col-lg-6" style="border:1px solid #ccc;padding:2px;width:60%;">
                                <div style="display:flex;">
                                <div class="md-form mb-5 col-lg-8" style="border:1px solid #ccc;width:100%;">
                                    <div class="md-form mb-5 col-lg-12">
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:135px;">Patrocinado/Razón Social:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirSenores" name="TransferirSenores" value="<?php echo ''.$Parametro10.''; ?>" placeholder="Patrocinado/Razon Social" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:135px;">DNI/RUC:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro11.''; ?>" placeholder="DNI/Ruc" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:135px;">Asunto:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro4.''; ?>" placeholder="Asunto" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:135px;">Destino:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro6.''; ?>" placeholder="Dirección" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:135px;">Procedimiento:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro12.''; ?>" placeholder="Procedimiento" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:135px;">Observación:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro13.''; ?>" placeholder="Observación" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:135px;">Fecha Hora Print:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.date("d-m-Y (H:i:s)", $time).''; ?>" placeholder="Fecha Hora Print" required>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="md-form mb-6 col-lg-6" style="border:1px solid #ccc;padding:2px;width:40%;">
                                <div>
                                <div class="md-form mb-6 col-lg-8" style="border:1px solid #ccc;width:100%;">
                                    <div class="md-form mb-5 col-lg-12">
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:200px;">Nro Expediente:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirSenores" name="TransferirSenores" value="<?php echo ''.$Parametro1.''; ?>" placeholder="Nro Expediente" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:200px;">Folios</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro5.''; ?>" placeholder="Folios" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="width:200px;">Fecha Hora Registro:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro9.''; ?>" placeholder="Fecha Hora Registro" required>
                                            </input>
                                        </div>
                                    </div>
                                </div>
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
    regexp = /.[0-9]{15}$/
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

function Imprimir(x){
     var contenido= document.getElementById(x).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
</script>
</div>
</body>
</html>