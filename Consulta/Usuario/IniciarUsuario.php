<?php 
include '../Conectar.php';
session_start();

if($_POST) {

	$Parametro1 = $_POST['Usuario'];
	$Parametro2 = $_POST['Clave'];
	
	$Consultar = $Conectar->query("SET NAMES 'utf8'");
	$Consultar = $Conectar->query("SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content");
	$Consulta = $Conectar->query("CALL AccederUsuario ('$Parametro1','$Parametro2')");
	
	if ($Consulta->num_rows > 0) {

		while ($Fila = $Consulta->fetch_assoc()) {
				$_SESSION['IdUsuario']=$Fila['IdUsuario'];
				$_SESSION['Usuario']=$Fila['Usuario'];
				$_SESSION['Perfil']=$Fila['Perfil'];
				$_SESSION['Trabajador']=$Fila['Trabajador'];
				$_SESSION['Oficina']=$Fila['Oficina'];
				$_SESSION['IdOficina']=$Fila['IdOficina'];
				$_SESSION['IdCargo']=$Fila['IdCargo'];
				$_SESSION['Cargo']=$Fila['Cargo'];
				$_SESSION['Imagen']=$Fila['Imagen'];
				$_SESSION['Acceso']='Ingreso';
		}

		echo "Concedido";
	
	} else {

		echo "Denegado";

	}

	$Conectar->close();

}?>