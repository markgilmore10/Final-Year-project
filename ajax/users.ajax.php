<?php


require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";

class AjaxUsers{

	// Edit User

	public $idUser;

	public function EditUserAjax(){

        $item = "id";
        
		$value = $this->idUser;

		$answer = ControllerUsers::ShowUsers($item, $value);

		echo json_encode($answer);

		//console.log("answer", $answer);
	}

	// Activate or Deactivate User

	public $activateUser;
	public $activateId;	

	public function ActivateUserAjax(){

		$table = "users";
		$item1 = "status";
		$value1 = $this->activateUser;

		$item2 = "id";
		$value2 = $this->activateId;

		$answer = UserModel::UpdateUserModel($table, $item1, $value1, $item2, $value2);

		//console.log("answer", answer);

	}

	// Duplicate Username Validation

	public $validateUser;

	public function ValidateUserAjax(){

		$item = "user";
		$value = $this->validateUser;

		$answer = ControllerUsers::ShowUsers($item, $value);

		echo json_encode($answer);

		//console.log("answer", answer);

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



