<?php 
   session_start();
   ?>
<style>
   .card{
   position:relative;
   display:block;
   margin-bottom:.75rem;
   background-color:#fff;
   border:1px solid #e5e5e5;
   border-radius:.25rem
   }
   .card-block{
   padding:1.25rem
   }
   .card-title{
   margin-bottom:.75rem
   }
   .card-subtitle{
   margin-top:-.375rem;
   margin-bottom:0
   }
   .card-text:last-child{
   margin-bottom:0
   }
   .card-link:hover{
   text-decoration:none
   }
   .card-link+.card-link{
   margin-left:1.25rem
   }
   .card>.list-group:first-child .list-group-item:first-child{
   border-radius:.25rem .25rem 0 0
   }
   .card>.list-group:last-child .list-group-item:last-child{
   border-radius:0 0 .25rem .25rem
   }
   .card-header{
   padding:.75rem 1.25rem;
   background-color:#f5f5f5;
   border-bottom:1px solid #e5e5e5
   }
   .card-header:first-child{
   border-radius:.25rem .25rem 0 0
   }
   .card-footer{
   padding:.75rem 1.25rem;
   background-color:#f5f5f5;
   border-top:1px solid #e5e5e5
   }
   .card-footer:last-child{
   border-radius:0 0 .25rem .25rem
   }
   .card-primary{
   background-color:#0275d8;
   border-color:#0275d8
   }
   .card-success{
   background-color:#5cb85c;
   border-color:#5cb85c
   }
   .card-info{
   background-color:#5bc0de;
   border-color:#5bc0de
   }
   .card-warning{
   background-color:#f0ad4e;
   border-color:#f0ad4e
   }
   .card-danger{
   background-color:#d9534f;
   border-color:#d9534f
   }
   .card-primary-outline{
   background-color:transparent;
   border-color:#0275d8
   }
   .card-secondary-outline{
   background-color:transparent;
   border-color:#ccc
   }
   .card-info-outline{
   background-color:transparent;
   border-color:#5bc0de
   }
   .card-success-outline{
   background-color:transparent;
   border-color:#5cb85c
   }
   .card-warning-outline{
   background-color:transparent;
   border-color:#f0ad4e
   }
   .card-danger-outline{
   background-color:transparent;
   border-color:#d9534f
   }
   .card-inverse .card-footer,.card-inverse .card-header{
   border-bottom:1px solid rgba(255,255,255,.2)
   }
   .card-inverse .card-blockquote,.card-inverse .card-footer,.card-inverse .card-header,.card-inverse .card-title{
   color:#fff
   }
   .card-inverse .card-blockquote>footer,.card-inverse .card-link,.card-inverse .card-text{
   color:rgba(255,255,255,.65)
   }
   .card-inverse .card-link:focus,.card-inverse .card-link:hover{
   color:#fff
   }
   .card-blockquote{
   padding:0;
   margin-bottom:0;
   border-left:0
   }
   .card-img{
   border-radius:.25rem
   }
   .card-img-overlay{
   position:absolute;
   top:0;
   right:0;
   bottom:0;
   left:0;
   padding:1.25rem
   }
   .card-img-top{
   border-radius:.25rem .25rem 0 0
   }
   .card-img-bottom{
   border-radius:0 0 .25rem .25rem
   }
   @media (min-width:544px){
   .card-deck{
   display:table;
   table-layout:fixed;
   border-spacing:1.25rem 0
   }
   .card-deck .card{
   display:table-cell;
   width:1%;
   vertical-align:top
   }
   .card-deck-wrapper{
   margin-right:-1.25rem;
   margin-left:-1.25rem
   }
   }
   @media (min-width:544px){
   .card-group{
   display:table;
   width:100%;
   table-layout:fixed
   }
   .card-group .card{
   display:table-cell;
   vertical-align:top
   }
   .card-group .card+.card{
   margin-left:0;
   border-left:0
   }
   .card-group .card:first-child{
   border-top-right-radius:0;
   border-bottom-right-radius:0
   }
   .card-group .card:first-child .card-img-top{
   border-top-right-radius:0
   }
   .card-group .card:first-child .card-img-bottom{
   border-bottom-right-radius:0
   }
   .card-group .card:last-child{
   border-top-left-radius:0;
   border-bottom-left-radius:0
   }
   .card-group .card:last-child .card-img-top{
   border-top-left-radius:0
   }
   .card-group .card:last-child .card-img-bottom{
   border-bottom-left-radius:0
   }
   .card-group .card:not(:first-child):not(:last-child){
   border-radius:0
   }
   .card-group .card:not(:first-child):not(:last-child) .card-img-bottom,.card-group .card:not(:first-child):not(:last-child) .card-img-top{
   border-radius:0
   }
   }
   @media (min-width:544px){
   .card-columns{
   -webkit-column-count:3;
   -moz-column-count:3;
   column-count:3;
   -webkit-column-gap:1.25rem;
   -moz-column-gap:1.25rem;
   column-gap:1.25rem
   }
   .card-columns .card{
   display:inline-block;
   width:100%
   }
   }
</style>
<!DOCTYPE html>
<html lang="en">
   <?php
      require_once '../Etiqueta/Encabezado.php';
      require_once '../Etiqueta/MenuGeneral.php';
      
    include '../Conectar.php';
	$Validador = array('success' => false, 'messages' => array());
    $Consultar = $Conectar->query("CALL CantidadEstadoExpediente();");
	$Transferir = $Consultar->fetch_assoc(); 
    $PorLlegar = $Transferir['PorLlegar'];
    $EnOficina = $Transferir['EnOficina'];
    $Archivado = $Transferir['Archivados'];
    $Total = $Transferir['Total'];
    $IdOficina = $_SESSION['IdOficina'];
    $Conectar->close();
      ?>
   <div id="page-wrapper" style="background-color:white;margin-top:5%;">
      <div class="container-fluid" style="
    background-color: white;
">
         <!-- Page Heading -->
         <!-- /.row -->
         <div class="row">
            <div class="col-xl-3 col-lg-3">
               <div class="card card-primary card-inverse">
                  <div class="card-header card-primary">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-address-book fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-xs-right">
                           <div class="huge"><?php echo $EnOficina; ?></div>
                           <div>En Oficina</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-3">
               <div class="card card-warning card-inverse">
                  <div class="card-header card-warning">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-tasks fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-xs-right">
                           <div class="huge"><?php echo $PorLlegar; ?></div>
                           <div>Por Llegar</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-3">
               <div class="card card-success card-inverse">
                  <div class="card-header card-success">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-archive fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-xs-right">
                           <div class="huge"><?php echo $Archivado; ?></div>
                           <div>Total</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-3">
               <div class="card card-info card-inverse">
                  <div class="card-header card-info">
                     <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-archive fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-xs-right">
                           <div class="huge"><?php echo $Total; ?></div>
                           <div>Total Expedientes</div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                                        <table id="customers" width="100%" class="table table-striped table-bordered table-hover" style="border:1px solid #ddd;font-size:11.5px;">
                                        <tr>
                                                <th>Tupa</th>
                                                <th>Código</th>
                                                <th>Denominación</th>
                                                <th>UIT</th>
                                                <th>Valor</th>
                                                <th>Días Tramite</th>
                                              </tr>
                                              <?php 
                                                include '../Conectar.php';
                                            	$Consultar = $Conectar->query("SET NAMES 'utf8'");
                                                $Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
                                                
                                                if($_SESSION['Perfil']=='Administrador'){
                                                 $Consultar = $Conectar->query("CALL LlamarProcedimientoOficina('')");   
                                                } else {
                                                 $Consultar = $Conectar->query("CALL LlamarProcedimientoOficina('$IdOficina')");
                                                }

                                                while ($Fila = $Consultar->fetch_assoc()){
                                              ?>
                                              <tr>
                                                <td><?php echo $Fila['Tupa']; ?></td>
                                                <td><?php echo $Fila['Codigo']; ?></td>
                                                <td><?php echo $Fila['Denominacion']; ?></td>
                                                <td><?php echo $Fila['UIT']; ?></td>
                                                <td><?php echo $Fila['Valor']; ?></td>
                                                <td><?php echo $Fila['DiasTramite']; ?></td>
                                              </tr>
                                                <?php 
                                                }
                                                $Conectar->close();
                                              ?>
                                        </table>
         <!-- /.row -->
         <div class="row">
  
                                        
         <!-- /.container-fluid -->
      </div>
      <?php
         require_once'../Etiqueta/PieDePagina.php';
         ?>
   </div>
   </body>
</html>