<?php
session_start();
if ($_SESSION['Acceso']=='Ingreso'){
	header("Location: Perfil/");
}else{
	header("Location: ../");
}
?>