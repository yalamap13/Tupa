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
                         <h5 style="font-weight: 700;"> PATROCINADO
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
                        <th>Patrocinado</th>
                        <th>Tipo Documento</th>
				        <th>Documento</th>
                        <th>Dirección</th>  
                        <th>Teléfono | Celular</th>
                        <th>Correo Electronico</th>
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
        	<form class="form-horizontal" action="Funcionalidad/Clientes/Grabar.php" method="post" id="Formulario" name="Formulario">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Ingresar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Tipo Documento</label>
                        <select class="form-control validate" id="TransferirIdTipoDocumento" onChange="PersonaOnChange(this)" name="TransferirIdTipoDocumento" placeholder="&Aacute;rea">
                        <option value="">--Elegir Tipo Documento--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirTipoDocumento");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>
                </div>  
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label id="inpNumDoc" data-error="wrong" class="label-modal label-top-modal" data-success="right">Número Documento</label>
                    <label id="inpRuc" style="display:none;" data-error="wrong" class="label-modal label-top-modal" data-success="right">Ruc</label>
                    <input type="text" id="TransferirNumeroDocumento" name="TransferirNumeroDocumento" maxlength="20" placeholder="Documento Identidad" class="form-control validate" required> 
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right" id="NombreRazonSocial" name="NombreRazonSocial" ></label>
                    <input type="text" id="TransferirNombres" name="TransferirNombres" placeholder="Nombres" maxlength="50" class="form-control validate" required> 
                </div>
                <div id="divApellido" class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Apellido</label>
                    <input type="text" id="TransferirApellidos" name="TransferirApellidos" placeholder="Apellidos" maxlength="50" class="form-control validate"> 
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div id="divSexo" class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Sexo</label> 
                    <select class="form-control validate" id="TransferirSexo" name="TransferirSexo" placeholder="Genero">
                            <option value="">--Seleccionar Genero--</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Celular</label>
                    <input type="text" id="TransferirCelular" name="TransferirCelular" placeholder="Celular" maxlength="15" class="form-control validate"> 
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Teléfono</label>
                    <input type="text" id="TransferirTelefono" name="TransferirTelefono" placeholder="Teléfono" maxlength="15" class="form-control validate"> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Correo Electronico</label>
                    <input type="text" id="TransferirCorreoElectronico" name="TransferirCorreoElectronico" maxlength="100" placeholder="Correo Electronico" class="form-control validate">                     
                </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-12 col-sm-6 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Dirección</label>
                    <input type="text" id="TransferirDireccion" name="TransferirDireccion" placeholder="Dirección" maxlength="100" class="form-control validate"> 
                </div>
                
                <div id="divResponsable"  class="col-xs-12 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Responsable</label>
                    <input type="text" id="TransferirResponsable" name="TransferirResponsable" placeholder="Responsable" maxlength="100" class="form-control validate"> 
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
<script>
function PersonaOnChange(sel) {
      var texto = $(TransferirIdTipoDocumento).find('option:selected').text();
      if (texto == "RUC"){

           diva = document.getElementById("divApellido");
           divs = document.getElementById("divSexo");
           divn = document.getElementById("inpNumDoc");
           divr = document.getElementById("inpRuc");
           divp = document.getElementById("divResponsable");
           diva.style.display = "none";
           divs.style.display = "none";
           divn.style.display = "none";
           divr.style.display = "";
           divp.style.display = "";
           document.querySelector('#NombreRazonSocial').innerText = 'Razón Social';
      }else{

           diva = document.getElementById("divApellido");
           divs = document.getElementById("divSexo");
           divn = document.getElementById("inpNumDoc");
           divr = document.getElementById("inpRuc");
           divp = document.getElementById("divResponsable");
           diva.style.display = "";
           divs.style.display = "";
           divn.style.display = "";
           divr.style.display = "none";
           divp.style.display = "none";
           document.querySelector('#NombreRazonSocial').innerText = 'Nombres';
      }
}
</script>
<?php
 require_once'../Etiqueta/PieDePagina.php';
?>

</div>
</body>
</html>

<script type="text/javascript" src="Intermediario/Clientes.js"></script>