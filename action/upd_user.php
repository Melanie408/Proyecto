<?php	

	session_start();

	if (empty($_POST['mod_name'])) {
           $errors[] = "Nombre vacío";
        }else if ($_POST['mod_username']==""){
			$errors[] = "Nombre de Usuario vacío";
		}else if (empty($_POST['mod_email'])){
			$errors[] = "Correo Vacio vacío";
		} else if ($_POST['mod_kind']==""){
			$errors[] = "Selecciona el estado";
		}else if (
			!empty($_POST['mod_name']) &&
			!empty($_POST['mod_email']) &&
			$_POST['mod_kind']!=""
		){

		include "../config/config.php";

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["mod_name"],ENT_QUOTES)));
		$username=$_POST["mod_username"];
		$email=$_POST["mod_email"];
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$kind=intval($_POST['mod_kind']);
		$id=$_POST['mod_id'];

		$sql="UPDATE user SET username=\"$username\", name=\"$name\", email=\"$email\", kind=\"$kind\"  WHERE id=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Datos actualizados satisfactoriamente.";

				if($_POST["password"]!=""){
					$update_passwd=mysqli_query($con,"update user set password=\"$password\" where id=$id");
					if ($update_passwd) {
						$messages[] = " Y la Contraseña ha sido actualizada.";
					}
				}

			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
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