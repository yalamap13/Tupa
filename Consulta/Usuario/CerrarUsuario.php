<?php 
		$AplicarSalida=$_POST['Salida'];
		if ($AplicarSalida=='SalirPerfil')
		{
			session_start();
			$_SESSION['Acceso']='CerrarPerfil';
		}
?>