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

				//$crypt = crypt($_POST["loginPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$answer = UserModel::ModelShowUsers($table, $item, $value);

				if($answer["user"] == $_POST["loginUser"] && $answer["password"] == $_POST["loginPassword"]){ //$crypt){

					$_SESSION["loggedIn"] = "ok";
					$_SESSION["id"] = $answer["id"];
					$_SESSION["name"] = $answer["name"];
					$_SESSION["user"] = $answer["user"];
					$_SESSION["profile"] = $answer["profile"];
				
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

				if($_POST["EditPasswd"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditPasswd"])){

						$encryptpassword = crypt($_POST["EditPasswd"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

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

					$encryptpassword = $_POST["currentPasswd"];
					
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
}