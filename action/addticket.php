<?php	
	session_start();

	if (empty($_POST['code'])) {
           $errors[] = "Código Vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Descripción vacía";
		} else if (!empty($_POST['id_project']) && !empty($_POST['id_requirements'])) {
			$errors[] = "Seleccione Unicamente El Proyecto o El Requerimiento. No Ambos";
		} else if (
			!empty($_POST['code']) &&
			!empty($_POST['description'])
		){


		include "../config/config.php";

		$code = $_POST["code"];
		$description = $_POST["description"];
		$id_project = $_POST["id_project"];
		$id_requirements = $_POST["id_requirements"];
		$user_id = $_SESSION["user_id"];
		$technical = $_POST["technical"];
		$status = 1;
		date_default_timezone_set('America/Guatemala');
		$dateT=date("Y-m-d H:i:s");

		if($id_project != null){
			$sql="insert into ticket (code,description,id_project,id_user,technical,dateT,id_status) value (\"$code\",\"$description\",\"$id_project\",\"$user_id\",\"$technical\",\"$dateT\",\"$status\")";
		} else if ($id_requirements != null) {
			$sql="insert into ticket (code,description,id_requirements,id_user,technical,dateT,id_status) value (\"$code\",\"$description\",\"$id_requirements\",\"$user_id\",\"$technical\",\"$dateT\",\"$status\")";
		}
		

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu ticket ha sido ingresado satisfactoriamente.";
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
					<strong>¡Error!</strong> 
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