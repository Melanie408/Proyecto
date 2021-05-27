<?php

	/*Datos de conexion a la base de datos*/

	//Generalmente suele ser "127.0.0.1"
	define('DB_HOST', 'localhost');
	//Usuario de la base de datos
	define('DB_USER', 'root');
	//Contraseña del usuario de la base de datos
	define('DB_PASS', '');
	//Nombre de la base de datos
	define('DB_NAME', 'serviceTick_db');

	$con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        @die("<h2 style='text-align:center'>Imposible conectarse a la base de datos! </h2>".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>