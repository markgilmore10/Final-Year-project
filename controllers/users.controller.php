<?php

class ControllerUsers{

	// User Login
	
	static public function UserLogin(){

		if (isset($_POST["loginUser"])) {
			
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]) && 
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPassword"])) {
				
				$table = 'users';

				$item = 'user';
				$value = $_POST["loginUser"];

				$answer = UserModel::ModelShowUsers($table, $item, $value);

				if($answer["user"] == $_POST["loginUser"] && $answer["password"] == $_POST["loginPassword"]){

					$_SESSION["loggedIn"] = "ok";
				
					echo '<script>

						window.location = "dashboard";

					</script>';

				}else{

					echo '<br><div class="alert alert-danger">Username or Password Incorrect</div>';

				}
			}
		}
	}

	static public function CreateUser(){

		if (isset($_POST["newUser"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])){

				$table = 'users';

				$data = array('name' => $_POST["newName"],
							  'user' => $_POST["newUser"],
							  'password' => $_POST["newPassword"],
							  'profile' => $_POST["newProfile"]);

				$answer = UserModel::modelAddUser($table, $data);

				if ($answer == 'ok') {

						echo '<script>
						
						swal({
							type: "success",
							title: "¡User Added Succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"

						}).then(function(result){

							if(result.value){

								window.location = "users";
							}

						});
						
						</script>';

				}
			
			}else{

				echo '<script>
					
					swal({
						type: "error",
						title: "Please fill in all fields, no special characters allowed",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "users";
							}

						});
					
				</script>';
			}
			
		}
	}
}