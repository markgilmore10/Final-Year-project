<?php


require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";

/**
 * Class AjaxUsers
 */
class AjaxUsers{

	// Edit User
	/**
	 * @var undefined
	 */
	public $idUser;

	/**
	 * uses the user id to find users to edit
	 * @return void
	 */
	public function EditUserAjax(){

        $item = "id";
        
		$value = $this->idUser;

		$answer = UserController::ShowUsersController($item, $value);

		echo json_encode($answer);

		//console.log("answer", $answer);
	}

	// Activate or Deactivate User

	/**
	 * @var undefined
	 */
	public $activateUser;
	/**
	 * @var undefined
	 */
	public $activateId;	

	/**
	 * updates the table by activating users
	 * @return void
	 */
	public function ActivateUserAjax(){

		$table = "users";
		$item1 = "status";
		$value1 = $this->activateUser;

		$item2 = "id";
		$value2 = $this->activateId;

		$answer = UserModel::UpdateUserModel($table, $item1, $value1, $item2, $value2);

	}

	// Duplicate Username Validation
	
	/**
	 * @var undefined
	 */
	public $validateUser;

	/**
	 * validayes the user 
	 * @return void
	 */
	public function ValidateUserAjax(){

		$item = "user";
		$value = $this->validateUser;

		$answer = UserController::ShowUsersController($item, $value);

		echo json_encode($answer);

	}

}


// Edit User
if (isset($_POST["idUser"])) {

	$edit = new AjaxUsers();
	$edit -> idUser = $_POST["idUser"];
	$edit -> EditUserAjax();
}

// Activate or Deactivate User
if (isset($_POST["activateUser"])) {

	$activateUser = new AjaxUsers();
	$activateUser -> activateUser = $_POST["activateUser"];
	$activateUser -> activateId = $_POST["activateId"];
	$activateUser -> ActivateUserAjax();
}

// Duplicate Username Validation
if (isset($_POST["validateUser"])) {

	$valUser = new AjaxUsers();
	$valUser -> validateUser = $_POST["validateUser"];
	$valUser -> ValidateUserAjax();
}



