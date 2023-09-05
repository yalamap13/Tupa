<?php
session_start();
if ($_SESSION['Acceso']=='Ingreso') {
?>
<style>

.label-top-modal{
    margin-top:9px;
}

</style>
<body style="display: unset;" id="yadcf_example">

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#4c4c4c;">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Sistema Tupa</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <ul class="nav navbar-right navbar-top-links">
            <?php if ($_SESSION['Perfil']=='Administrador') { ?>
            <?php } ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding:15px;">
                    <i class="fa fa-user fa-fw" style="font-size:17px;"></i><b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user" style="width:100%;">
                    <li><a href="index.php"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>
                    <li class="divider"></li>
                    <li><a onclick="CerrarPerfil(); return false;"><i class="fa fa-sign-out fa-fw"></i> Cerrar Usuario</a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <?php if ($_SESSION['Perfil']=='Administrador') { ?>
                    <li>
                        <div style="text-align:center;">
                        <?php if ($_SESSION['Imagen'] == '') { ?>
                        <img src="../Perfil/Funcionalidad/Usuario/Imagen/icono.png" style="padding:15px;width:130px;">
                        <?php } else { ?>
                        <img src="../Perfil/Funcionalidad/Usuario/Imagen/<?php echo $_SESSION['Imagen']; ?>" style="padding:15px;width:130px;">
                        <?php } ?>
                        </div>
                        <a style="background:#4c4c4c;color:white;text-transform:uppercase;font-size:12px;">
                        Usuario - <?php echo '<label>'.$_SESSION['Usuario'].'</label>'; ?></a>
                    </li>
                    <li>
                        <a style="background:#4c4c4c;color:white;text-transform:uppercase;font-size:12px;">
                        Perfil - <?php echo '<label>'.$_SESSION['Perfil'].'</label>'; ?></a>
                    </li>                          
                    <?php } else { ?> 
                    <li>
                        <div style="text-align:center;">
                        <?php if ($_SESSION['Imagen'] == '') { ?>
                        <img src="../Perfil/Funcionalidad/Usuario/Imagen/icono.png" style="padding:15px;width:130px;">
                        <?php } else { ?>
                        <img src="../Perfil/Funcionalidad/Usuario/Imagen/<?php echo $_SESSION['Imagen']; ?>" style="padding:15px;width:130px;">
                        <?php } ?>
                        </div>
                        <a style="background:#4c4c4c;color:white;text-transform:uppercase;font-size:12px;">
                        Usuario - <?php echo '<label>'.$_SESSION['Usuario'].'</label>'; ?></a>
                    </li>
                    <li>
                        <a style="background:#4c4c4c;color:white;text-transform:uppercase;font-size:12px;">
                        Perfil - <?php echo '<label>'.$_SESSION['Perfil'].'</label>'; ?></a>
                    </li> 
                    <li>
                        <a style="background:#4c4c4c;color:white;text-transform:uppercase;font-size:12px;">
                        Oficina / <?php echo '<label>'.$_SESSION['Oficina'].'</label>'; ?></a>
                    </li> 
                    <?php } ?>
                    <?php if ($_SESSION['Perfil']=='Cliente') { ?>
                    <li>
                        <a><i class="fa fa-sitemap fa-fw" style="font-size:20px;"></i> Expedientes del Área <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="TotalExpedientes.php">Total, de expedientes del área</a>
                            </li>
                            <li>
                                <a href="EnOficina.php">Tramites En Oficina</a>
                            </li>
                            <li>
                                <a href="PorLlegar.php">Tramites Por Llegar</a>
                            </li>
                            <li>
                                <a href="Archivados.php">Tramites Archivados</a>
                            </li>
                        </ul>
                    </li>
                    <?php } else if ($_SESSION['Perfil']=='Administrador') { ?> 
                    <li>
                        <a href="Parametro.php"><i class="menu-icon mdi mdi-cube" style="font-size:20px;"></i> Parametros</a>
                    </li>
                    <li>
                        <a><i class="fa fa-sitemap fa-fw" style="font-size:20px;"></i> Expedientes del Área<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="TotalExpedientes.php">Total, de expedientes del área</a>
                            </li>
                            <li>
                                <a href="EnOficina.php">Tramites En Oficina</a>
                            </li>
                            <li>
                                <a href="PorLlegar.php">Tramites Por Llegar</a>
                            </li>
                            <li>
                                <a href="Archivados.php">Tramites Archivados</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-sitemap fa-fw" style="font-size:20px;"></i> Configuración <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="UnidadOrganica.php">Unidad Orgánica</a>
                            </li>
                            <li>
                                <a href="EstadoTramite.php">Estado Tramite</a>
                            </li>
                            <li>
                                <a href="Oficinas.php">Oficinas</a>
                            </li>
                            <li>
                                <a href="Cargos.php">Cargos</a>
                            </li>
                            <li>
                                <a href="Patrocinado.php">Patrocinado</a>
                            </li>
                            <li>
                                <a href="Usuario.php">Usuarios</a>
                            </li>
                            <li>
                                <a href="TipoDocumento.php">Tipo Documento</a>
                            </li>
                            <li>
                                <a href="TipoExpediente.php">Tipo Expediente</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-sitemap fa-fw" style="font-size:20px;"></i> Tramites <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="Tupa.php">Tupa</a>
                            </li>
                            <li>
                                <a href="Procedimientos.php">Procedimientos</a>
                            </li>
                            <li>
                                <a href="Requisitos.php">Requisitos</a>
                            </li>
                        </ul>
                    </li>                   
                    <li>
                        <a href="Reporte.php"><i class="menu-icon mdi mdi-file-export" style="font-size:20px;"></i> Reporte</a>
                    </li>
                    <?php } else {} ?>
                </ul>

            </div>
        </div>
    </nav>

<?php } else { header("Location: ../../"); } ?>
