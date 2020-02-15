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

				$crypt = crypt($_POST["loginPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$answer = UserModel::ModelShowUsers($table, $item, $value);

				if($answer["user"] == $_POST["loginUser"] && $answer["password"] == $crypt){

					if($answer["status"] == 1){

						$_SESSION["loggedIn"] = "ok";
						$_SESSION["id"] = $answer["id"];
						$_SESSION["name"] = $answer["name"];
						$_SESSION["user"] = $answer["user"];
						$_SESSION["profile"] = $answer["profile"];

						// Last Login (https://www.php.net/manual/en/timezones.europe.php)
						// https://stackoverflow.com/questions/44193842/php-date-default-timezone-set-not-working-why
						date_default_timezone_set("Europe/Dublin");

						$date = date('Y-m-d');
						$hour = date('H:i:s');

						$actualDate = $date.' '.$hour;

						$item1 = "lastLogin";
						$value1 = $actualDate;

						$item2 = "id";
						$value2 = $answer["id"];

						$lastLogin = UserModel::UpdateUserModel($table, $item1, $value1, $item2, $value2);
					
						echo '<script>

							window.location = "dashboard";

						</script>';

					}else{
							
						echo '<br><div class="alert alert-danger">Sorry, User is Deactivated</div>';
					
					}

				}else{

					echo '<br><div class="alert alert-danger">Username or Password Incorrect</div>';

				}
			}
		}
	}

	static public function CreateUser(){

		if (isset($_POST["newUser"])) {
			
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["newName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])){

				$table = 'users';

				$crypt = crypt($_POST["newPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$data = array('name' => $_POST["newName"],
							  'user' => $_POST["newUser"],
							  'password' => $crypt,
							  'profile' => $_POST["newProfile"]);

				$answer = UserModel::modelAddUser($table, $data);

				if ($answer == 'ok') {

						echo '<script>
						
						swal({
							type: "success",
							title: "User Added Succesfully!",
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

	// Show Users
	static public function ShowUsers($item, $value){

		$table = "users";

		$answer = UserModel::ModelShowUsers($table, $item, $value);

		return $answer;
	}

	// Edit User
	static public function EditUserController(){

		if (isset($_POST["EditUser"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditName"])){

				$table = 'users';

				if($_POST["EditPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditPassword"])){

						$encryptpassword = crypt($_POST["EditPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}

					else{

						echo '<script>
					
							swal({
								type: "error",
								title: "Please fill in all fields, no special characters allowed",
								showConfirmButton: true,
								confirmButtonText: "Close"

								}).then(function(result){
										
									if (result.value) {
						
										window.location = "users";

									}
								});
							
						</script>';
					}
				
				}else{

					$encryptpassword = $_POST["currentPassword"];
					
				}

				$data = array('name' => $_POST["EditName"],
								'user' => $_POST["EditUser"],
								'password' => $encryptpassword,
								'profile' => $_POST["EditProfile"]);

				$answer = UserModel::ModelEditUser($table, $data);

				if ($answer == 'ok') {
					
					echo '<script>
					
						swal({
							type: "success",
							title: "User Edited Succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"

						 }).then(function(result){
							
							if (result.value) {

								window.location = "users";
							}

						});
					
					</script>';
				}
				else{
					echo '<script>
						
						swal({
							type: "error",
							title: "Please fill in all fields, no special characters allowed",
							showConfirmButton: true,
							confirmButtonText: "Close"
							 }).then(function(result){
									
								if (result.value) {

									window.location = "users";
								
								}

							});
						
					</script>';
				}
			
			}	
		
		}
	
	}

	// Delete User

	static public function DeleteUserController(){

		if(isset($_GET["userId"])){

			$table ="users";
			$data = $_GET["userId"];

			$answer = UsersModel::DeleteUserModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "User has been  Deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"

					  }).then(function(result){
					  	
						if (result.value) {

						window.location = "users";

						}
					})

				</script>';

			}		

		}

	}
}