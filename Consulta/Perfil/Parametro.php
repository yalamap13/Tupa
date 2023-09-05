<!DOCTYPE html>
<html lang="es">

<?php
 include '../Etiqueta/Encabezado.php';
 include '../Etiqueta/MenuGeneral.php'; 
?>
<style>

    .table-bordered>thead>tr>th,.table-bordered>tbody>tr>th,.table-bordered>tfoot>tr>th,.table-bordered>thead>tr>td,.table-bordered>tbody>tr>td,.table-bordered>tfoot>tr>td{
            /*border:1px solid #dddddd;*/
            text-align:center;
    }
    
    table.dataTable tbody tr{
      border-bottom: 1px solid #c7c7c7;
    }
    table.cards {
        background-color: transparent;
    }

    .cards tbody img {
        height: 30%;
        width: 50%;
    }
    .cards tbody tr {
       float: left;
       position: relative;
       width: 20%;
       /*border: 1px solid #aaa;*/
       box-shadow: 3px 3px 6px rgba(0,0,0,0.25);
       background-color: white;
    }
    .cards tbody td {
       display: block;
       overflow: hidden;
       text-align: left;
       left: 10px;
       right: 10px;
       top: 10px;
       bottom: 10px;
    }

    .table {
        background-color: #fff;
    }
    .table tbody label {
        display: none;
        margin-right: 5px;
        width: 50px;
    }   
    .table .glyphicon {
        font-size: 20px;
    }

    .cards .glyphicon {
        font-size: 15px;
    }

    .cards tbody label {
        display: inline;
        position: relative;
        font-size: 85%;
        font-weight: normal;
        top: -5px;
        left: -3px;
        float: left;
        color: #808080;
    }
    .cards tbody td:nth-child(1) {
        text-align: center;
    }
    @media only screen and (max-width : 480px) {
       .cards tbody tr {
          width: 100%;
          padding-bottom: 0%;
       }
    }
    @media only screen and (max-width : 650px) and (min-width : 481px) {
       .cards tbody tr {
          width: 100%;
          padding-bottom: 0%;
       }
    }
    table.table-bordered th:last-child, table.table-bordered td:last-child{
      border-right-width:1px;
    }
    @media only screen and (max-width : 1050px) and (min-width : 651px) {
       .cards tbody tr {
          width: 50%;
          padding-bottom: 0%;
       }
    }
    @media only screen and (max-width : 1290px) and (min-width : 1051px) {
       .cards tbody tr {
          width: 50%;
          padding-bottom: 0%;
       }
    }
    @media only screen and (max-width : 1366px) and (min-width : 1290px) {
       .cards tbody tr {
          width: 25%;
          padding-bottom: 0%;
       }
    }
</style>
<div id="page-wrapper" style="display:flex;">
    <div class="col-xs-12" style="margin-top:70px;">
      <div class="card border-default mb-12">
        <div class="card-header bg-transparent border-default">
              <ul class="breadcrumb">
                    <li>
                         <h5 style="font-weight: 700;"> GESTIONAR PARAMETROS
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
				<table width="100%" class="table table-striped table-bordered table-hover cards" id="LlenarTabla">         
				<thead style="display:none;"> 
                        <th></th>
				        <th></th>
				        <th></th>
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
        	<form class="form-horizontal" action="Funcionalidad/Parametro/Grabar.php" method="post" id="Formulario" name="Formulario" enctype="multipart/form-data">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Ingresar Parametro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3" style="display: flow-root;">
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Año</label>
                    <input type="text" id="TransferirYear" maxlength="4" name="TransferirYear" onkeypress="return NumCheck(event, this)" placeholder="Año" class="form-control validate" required> 
                </div>
                <div id="divApellido" class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Tupa</label>
                        <select class="form-control validate" id="TransferirIdTupa" name="TransferirIdTupa" placeholder="Tupa">
                        <option value="">--Elegir Tupa--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirTupa");
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
                    <label id="inpNumDoc" data-error="wrong" class="label-modal label-top-modal" data-success="right">Entidad</label>
                    <input type="text" id="TransferirEmpresa" name="TransferirEmpresa" placeholder="Entidad" class="form-control validate" required> 
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Ruc</label>
                    <input type="text" id="TransferirRuc" name="TransferirRuc" maxlength="15" onkeypress="return NumCheck(event, this)" placeholder="Ruc" class="form-control validate" required> 
                </div>
                <div class="col-xs-9 col-sm-9 col-md-9">
                    <label id="inpNumDoc" data-error="wrong" class="label-modal label-top-modal" data-success="right">Dirección</label>
                    <input type="text" id="TransferirDireccion" name="TransferirDireccion" placeholder="Dirección" class="form-control validate" required> 
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <label id="inpNumDoc" data-error="wrong" class="label-modal label-top-modal" data-success="right">I.G.V</label>
                    <input type="text" id="TransferirIGV" name="TransferirIGV" placeholder="I.G.V" class="form-control validate" required> 
                </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Encargado</label>
                    <input type="text" id="TransferirEncargado" name="TransferirEncargado" placeholder="Encargado" class="form-control validate"> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Oficina</label>
                        <select class="form-control validate" id="TransferirIdOficina" name="TransferirIdOficina" placeholder="Oficina">
                        <option value="">--Elegir Oficina--</option>
                        <?PHP        
                        include '../Conectar.php';
                        $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                        $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                        $Consultar=mysqli_query($Conectar,"CALL ElegirOficina");
                        while ($fila=mysqli_fetch_row($Consultar)):
                        echo '<option value="'.$fila['0'].'">'.$fila['1'].'</option>'; 
                        endwhile;
                        $Conectar->close();
                        ?>
                        </select>                   
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Nombre Slogan</label>
                    <input type="text" id="TransferirNombreSlogan" name="TransferirNombreSlogan" maxlength="150" placeholder="Nombre Slogan" class="form-control validate" required> 
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" id="DivImagen">
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Slogan</label>
                    <input type="file" id="TransferirSlogan" name="TransferirSlogan" placeholder="Slogan" accept="image/png, image/jpeg" class="form-control validate"> 
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

<div class="modal fade" id="AbrirModalImagen" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<form class="form-horizontal" action="Funcionalidad/Parametro/GuardarSlogan.php" method="post" id="FormularioImagen" name="FormularioImagen" enctype="multipart/form-data">
            <div class="modal-header text-center color-modal">
                <h5 class="modal-title w-100 font-weight-bold">Elegir Imagen</h5>
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
                    <label data-error="wrong" class="label-modal label-top-modal" data-success="right">Imagen</label>
                    <input type="file" id="TransferirImagen" name="TransferirImagen" placeholder="Imagen" accept="image/png, image/jpeg" class="form-control validate"> 
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
<?php
 require_once'../Etiqueta/PieDePagina.php';
?>

</div>
</body>
</html>

<script type="text/javascript" src="Intermediario/Parametro.js"></script>