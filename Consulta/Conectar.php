<?php
    $FuenteDato = 'localhost';
    $Usuario = 'root';
    $Clave = '';
    $Catalogo = 'tupa';

    $Conectar = new mysqli($FuenteDato, $Usuario, $Clave, $Catalogo);
  
    if($Conectar->connect_error) {
      die("Conexión Fallida : " . $Conectar->connect_error);
    } else {
    }
?>