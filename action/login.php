<?php
	session_start();

	if (isset($_POST['token']) && $_POST['token']!=='') {
			
	//Contiene las variables de configuracion para conectar a la base de datos
	include "../config/config.php";

	$username=mysqli_real_escape_string($con,(strip_tags($_POST["username"],ENT_QUOTES)));
	$password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));

    $query = mysqli_query($con,"SELECT * FROM user WHERE username=\"$username\" OR email =\"$username\" AND password = \"$password\";");

		if ($row = mysqli_fetch_array($query)) {
				
				$_SESSION['user_id'] = $row['id'];
				$user_kind = $row['kind'];
            
		        if($user_kind == "1"){
		            header("location: ../dashboard.php");
		        } else if($user_kind == "2"){
		            header("location: ../tracing2.php");
		        } else if($user_kind == "3"){
		            header("location: ../tickets3.php");
		        }
				

		}else{
			$invalid=sha1(md5("contrasena o usuario invalido"));
			header("location: ../index.php?invalid=$invalid");
		}
	}else{
		header("location: ../");
	}

?>