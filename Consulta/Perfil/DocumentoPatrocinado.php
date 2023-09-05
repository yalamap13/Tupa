
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
  border: 1px solid #28435b;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #5e7d97;color:white;}

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
 
    include '../Conectar.php';
    @$Numero = $_POST['TransferirNumeroExpediente'];
    @$ApellidoPaterno = $_POST['TransferirApellidoPaterno'];
    @$ApellidoMaterno = $_POST['TransferirApellidoMaterno'];
    @$Nombre = $_POST['TransferirNombres'];
    $Consultar = $Conectar->query("SET NAMES 'utf8'");
    $Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
    $Consultar = $Conectar->query("CALL LlamarDocumentoExterno('$Numero','$ApellidoPaterno','$ApellidoMaterno','$Nombre');");
    $Transferir = $Consultar->fetch_assoc(); 
    @$Parametro1 = $Transferir['NumeroExpediente'];
    @$Parametro2 = $Transferir['TipoExpediente'];
    @$Parametro3 = $Transferir['Numero'];
    @$Parametro4 = $Transferir['Asunto'];
    @$Parametro5 = $Transferir['Folios'];
    @$Parametro6 = $Transferir['Oficina'];
    @$Parametro7 = $Transferir['Procedimiento'];
    @$Parametro8 = $Transferir['EstadoDocumento'];
    
    $Conectar->close();
    
?>
<body style="background-color:#28435b;">
        <br/>
            <div class="col-xs-12" style="background-color:#28435b;text-align:center;">
                       <br/>
                        <form style="display:contents;" method="POST" id="Formulario" name="Formulario" action="DocumentoPatrocinado.php" >
                            <div class="col-lg-10" style="text-align:center;display:inline-flex;">
                                <select class="form-control validate" id="TransferirIdTipoDocumento" onchange="carg(this);" name="TransferirIdTipoDocumento" placeholder="Tipo Documento">
                                            <option value="">Elegir..</option>
                                            <option value="1">N° Expediente</option>
                                            <option value="2">DN</option>                        
                                            <option value="3">RUC</option>                        
                                </select>
                                <input class="form-control validate" style="border:0px;margin-left:10px;" id="TransferirNumeroExpediente" name="TransferirNumeroExpediente" placeholder="N° de Documento" required disabled>
                                <input class="form-control validate" style="border:0px;margin-left:10px;" id="TransferirApellidoPaterno" name="TransferirApellidoPaterno" placeholder="Apellido Paterno">
                                <input class="form-control validate" style="border:0px;margin-left:10px;" id="TransferirApellidoMaterno" name="TransferirApellidoMaterno" placeholder="Apellido Materno">
                                <input class="form-control validate" style="border:0px;margin-left:10px;" id="TransferirNombres" name="TransferirNombres" placeholder="Nombres">
                       <button type="submit" class="btn btn-default validate" style="margin-left:15px;text-align:left;" id="visibilityHidden2">Buscar<i class="fa fa-search fa-fw icono-size"></i></button>
                       </form>
                       <button type="button" class="btn btn-default validate" style="margin-left:15px;text-align:left;" onclick="Imprimir('DivImprimir')">Imprimir<i class="fa fa-print fa-fw icono-size"></i></button>
                       
                        </div>
                        <br/>
                        <div class="col-lg-12" style="background-color:#28435b;" id="DivImprimir">
                        <br/>
                        <?php if($Parametro1=='' ) { } else { if ($Parametro8=='Archivado') {} else { ?>
                        <form class="form-horizontal" style="background-color:white;display:inline-table;" action="DocumentoPatrocinado.php?Item=<?php echo $buscar; ?>" style="display:flex;" method="POST" id="buscar_formulario" name="buscar_formulario">
                            <div class="md-form mb-5 col-lg-12" style="border:2px solid #000;padding:5px;width:800px;background-color:white;">
                                <div style="display:flex;">
                                <div class="md-form mb-5 col-lg-8" style="border:1px solid #ccc;width:500px;">
                                    <div class="md-form mb-5 col-lg-12">
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Nro Expediente:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirSenores" name="TransferirSenores" value="<?php echo ''.$Parametro1.''; ?>" placeholder="Nro Expediente" required readonly>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Tipo Expediente:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro2.''; ?>" placeholder="Tipo Expediente" required readonly>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Número:</label>
                                            <input class="form-control validate" maxlength="15" style="border:0px;" id="TransferirRuc" value="<?php echo ''.$Parametro3.''; ?>" name="TransferirRuc" placeholder="Número" required readonly>
                                        </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Asunto:</label>
                                            <input class="form-control validate" maxlength="15" style="border:0px;" id="TransferirTelefono" value="<?php echo ''.$Parametro4.''; ?>" name="TransferirTelefono" placeholder="Asunto" required readonly>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="col-lg-4"   style="width:280px;">
                                    <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Folios:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirFechaEmision" value="<?php echo ''.$Parametro5.''; ?>" name="TransferirFechaEmision" placeholder="Folios" required readonly>
                                            </input>
                                    </div>
                                    <br/>
                                    <div>
                                         <button class="btn btn-success validate" style="margin-left:15px;text-align:left;" onclick="mostrar()">Ver Tramites<i class="fa fa-search fa-fw icono-size"></i></button>
                                    </div>
                                    <br/>
                                </div>
                                </div>
                                <div class="md-form mb-5 col-lg-12" style="border:1px solid #ccc;padding:5px;display:flex;">
                                    <div class="md-form mb-5 col-lg-12">
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Oficina:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDependencia" name="TransferirDependencia" value="<?php echo ''.$Parametro6.''; ?>" placeholder="Dependencia" required readonly>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Procedimiento:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirFacturaNombreDe" name="TransferirFacturaNombreDe" value="<?php echo ''.$Parametro7.''; ?>" placeholder="Factura a Nombre de" required readonly>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="md-form mb-5 col-lg-12" style="display:flex;margin-top:20px;visibility: hidden;"  id="hide-me">
                                    <div class="md-form mb-5 col-lg-12">
                                        <div style="display:flex;">
                                        <table id="customers" style="width:740px;margin-bottom:15px;font-size:11.5px;">
                                        <tr>
                                                <th>N° Expediente</th>
                                                <th>Oficina </th>
                                                <th>Tipo Documento</th>
                                                <th>Número</th>
                                                <th>Fecha Hora</th>
                                                <th>Estado</th>
                                              </tr>
                                              <?php 
                                                include '../Conectar.php';
                                            	$Consultar = $Conectar->query("SET NAMES 'utf8'");
                                                $Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
                                                $Consultar = $Conectar->query("CALL LlamarExpedienteDocumentoExterno('$Numero');");
                                                while ($Fila = $Consultar->fetch_assoc()){
                                              ?>
                                              <tr>
                                                <td><?php echo $Fila['Item']; ?></td>
                                                <td><?php echo $Fila['Oficina']; ?></td>
                                                <td><?php echo $Fila['TipoDocumento']; ?></td>
                                                <td><?php echo $Fila['Numero']; ?></td>
                                                <td><?php echo $Fila['FechaHoraRegistro']; ?></td>
                                                <td><?php echo $Fila['EstadoDocumento']; ?></td>
                                              </tr>
                                                <?php 
                                              }
                                                $Conectar->close();
                                              ?>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                        </form>
                        <?php }} ?>
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

function mostrar(){
    event.preventDefault();
    document.getElementById('hide-me').style.visibility = 'visible';
}

var input = document.getElementById('TransferirNumeroExpediente');

function carg(elemento) {
  d = elemento.value;
  
  if(d == "1"){
    input.disabled = false;
  }else if(d == "2"){
    input.disabled = false;
  }else if(d == "3"){
    input.disabled = false;
  } else {
    input.disabled = true;
  }
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