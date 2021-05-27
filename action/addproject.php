<?php	
	session_start();

	if (empty($_POST['name'])) {
           $errors[] = "Nombre vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		} else if (
			!empty($_POST['name']) &&
			!empty($_POST['description'])
		){

		include "../config/config.php";//Función que conecta a la base de datos

		$name = $_POST["name"];
		$description = $_POST["description"];


		$sql="insert into project (name, description) value (\"$name\",\"$description\")";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El proyecto ha Sido Ingresado Satisfactoriamente.";
			} else{
				$errors []= "Lo Sentimos, No se ha Podido Ingresar el Proyecto. Intente nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error Desconocido.";
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