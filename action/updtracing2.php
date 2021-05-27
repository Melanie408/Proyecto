<?php
	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "Id vacío";
        } else if (
			!empty($_POST['id_status'])
		){

		include "../config/config.php";



		$id_status = $_POST["id_status"];

		$id=$_POST['mod_id'];
		
		$sql = "update ticket set id_status=\"$id_status\" where id=$id";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El estado ha sido actualizado satisfactoriamente.";
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