<?php	
	session_start();

	if (empty($_POST['username'])) {
           $errors[] = "Nombre de usuario vacío";
        } else if (empty($_POST['name'])){
			$errors[] = "Nombre y Apellidos vacío";
		}else if (empty($_POST['email'])){
			$errors[] = "Correo Vacio";
		} else if ($_POST['kind']==""){
			$errors[] = "Selecciona el Tipo";
		} else if (empty($_POST['password'])){
			$errors[] = "Contraseña vacía";
		} else if (
			!empty($_POST['username']) &&
			!empty($_POST['name']) &&
			$_POST['kind']!="" &&
			!empty($_POST['password'])
		){

		include "../config/config.php";//Función que conecta a la base de datos


		$username=mysqli_real_escape_string($con,(strip_tags($_POST["username"],ENT_QUOTES)));
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$email=$_POST["email"];
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$kind=intval($_POST['kind']);
		date_default_timezone_set('America/Guatemala');
		$dateT=date("Y-m-d H:i:s");
		$profile_pic = "default.png";

			$sql="INSERT INTO user ( username, password, name, email, profile_pic, kind, dateT) VALUES ('$username','$password','$name','$email','$profile_pic','$kind','$dateT')";
			$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "El usuario ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}
			
		}else{
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>