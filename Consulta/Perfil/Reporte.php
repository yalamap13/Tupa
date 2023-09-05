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
                        <h5 style="font-weight: 700;">REPORTE DE EXPEDIENTE
			           	<table border="0" cellspacing="5" cellpadding="5" style="margin-top:25px;font-weight:100;">
                                <tbody>
                                <tr>
                                    <td>Fecha Inicio:</td>
                                    <td><input class="form-control validate" style="zoom:85%;margin-left:10px;" type="date" id="fini" name="fini"></td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td style="margin-left:10px;">Fecha Fin:</td>
                                    <td><input class="form-control validate" style="zoom:85%;margin-left:10px;" type="date" id="ffin" name="ffin"></td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                    <td style="margin-left:10px;">Oficina:</td>
                                    <td style="margin-left:10px;">                        
                                    <select style="zoom:85%;margin-left:10px;" class="form-control validate" id="FiltroIdOficina" name="FiltroIdOficina">
                                    <option value="">--Elegir Oficina--</option>
                                    <?PHP        
                                    include '../Conectar.php';
                                    $Consultar=mysqli_query($Conectar,"SET NAMES 'utf8'");        
                                    $Consultar=mysqli_query($Conectar,"SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content"); 
                                    $Consultar=mysqli_query($Conectar,"CALL ElegirOficina()");
                                    while ($fila=mysqli_fetch_row($Consultar)):
                                    echo '<option value="'.$fila['1'].'">'.$fila['1'].'</option>'; 
                                    endwhile;
                                    $Conectar->close();
                                    ?>
                                    </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>     
                        </h5>
			        </li>
			    </ul>
		</div>

        <div class="card-body text-default">
		<div style="padding: 15px;background: white;">
				<table width="100%" class="table table-striped table-bordered table-hover" id="LlenarTabla">         
				<thead> 
				        <th>Item</th>
                        <th>Número Expediente</th>
                        <th>Año Tupa</th>
                        <th>Oficina</th> 
				        <th>Tipo Expediente</th>  
				        <th>Número</th>
				        <th>Asunto</th>
				        <th>Folios</th>
				        <th>Fecha Hora Registro</th>
				        <th>Estado</th>
				</thead>
				</table>
    </div>
    </div>
</div>
</div>
</div>

<?php
 require_once'../Etiqueta/PieDePagina.php';
?>

</div>
</body>
</html>

<script type="text/javascript" src="Intermediario/Reporte.js"></script>