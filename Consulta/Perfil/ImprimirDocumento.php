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
    $Conectar->close();
    
?>
        <br/>
        <div id="page-wrapper" style="background-color:white;" style="display: -webkit-box;">
            <div class="col-xs-12">
                    <div class="col-lg-12" style="margin-left:-20px;background-color:#ffffff;">
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <form class="form-horizontal" action="Documento.php?Item=<?php echo $buscar; ?>" style="display:flex;" method="POST" id="buscar_formulario" name="buscar_formulario">
                            <div class="md-form mb-5 col-lg-12" style="border:1px solid #ccc;padding:5px;width:800px;">
                                <div style="display:flex;">
                                <div class="md-form mb-5 col-lg-8" style="border:1px solid #ccc;width:500px;">
                                    <div class="md-form mb-5 col-lg-12">
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Nro Expediente:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirSenores" name="TransferirSenores" value="<?php echo ''.$Parametro1.''; ?>" placeholder="Nro Expediente" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Tipo Expediente:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDireccion" name="TransferirDireccion" value="<?php echo ''.$Parametro2.''; ?>" placeholder="Tipo Expediente" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Número:</label>
                                            <input class="form-control validate" maxlength="15" style="border:0px;" id="TransferirRuc" value="<?php echo ''.$Parametro3.''; ?>" name="TransferirRuc" placeholder="Número" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Asunto:</label>
                                            <input class="form-control validate" maxlength="15" style="border:0px;" id="TransferirTelefono" value="<?php echo ''.$Parametro4.''; ?>" name="TransferirTelefono" placeholder="Asunto" required>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="col-lg-4"   style="width:280px;">
                                    <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Folios:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirFechaEmision" value="<?php echo ''.$Parametro5.''; ?>" name="TransferirFechaEmision" placeholder="Folios" required>
                                            </input>
                                    </div>
                                </div>
                                </div>
                                <div class="md-form mb-5 col-lg-12" style="border:1px solid #ccc;padding:5px;display:flex;">
                                    <div class="md-form mb-5 col-lg-12">
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Oficina:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirDependencia" name="TransferirDependencia" value="<?php echo ''.$Parametro6.''; ?>" placeholder="Dependencia" required>
                                            </input>
                                        </div>
                                        <div style="display:flex;">
                                            <label data-error="wrong" class="label-modal" data-success="right" style="margin-right:10px;width:135px;">Procedimiento:</label>
                                            <input class="form-control validate" style="border:0px;" id="TransferirFacturaNombreDe" name="TransferirFacturaNombreDe" value="<?php echo ''.$Parametro7.''; ?>" placeholder="Factura a Nombre de" required>
                                            </input>
                                        </div>
                                    </div>
                                </div>
                                <div class="md-form mb-5 col-lg-12" style="display:flex;margin-top:20px;">
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
                                                $Consultar = $Conectar->query("CALL LlamarExpedienteDocumento('$Id');");

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

                        <script type="text/javascript">
                            var refrescar_tabla;

                            $(document).ready(function() {
                                        refrescar_tabla = $("#llenar_datos").DataTable({
                                            "ajax": "DocumentoOrden.php",
                                            "order": []
                                        });

                                        function buscar(id = null) {
                                            if (id) {
                                                $.ajax({
                                                    url: 'DocumentoOrden.php',
                                                    type: 'post',
                                                    data: {
                                                        txtBuscar: id
                                                    },
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        if (response.success == true) {

                                                            refrescar_tabla.ajax.reload(null, false);

                                                        } else {

                                                        }
                                                    }
                                                });
                                            } else {
                                                alert('Error Al Refrescar Pagina');
                                            }
                                        }
                        </script>
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
</script>
</div>
</body>
</html>