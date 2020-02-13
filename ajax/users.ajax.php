<?php

require_once "../models/users.model.php";
require_once "../controllers/users.controller.php";

class AjaxUsers{

	// Edit User

	public $idUser;

	public function EditUserAjax(){

        $item = "id";
        
		$value = $this->userId;

		$answer = ControllerUsers::ShowUsers($item, $value);

		echo json_encode($answer);
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

	}

}


// Edit User

if (isset($_POST["userId"])) {

	$edit = new AjaxUsers();
	$edit -> userId = $_POST["userId"];
	$edit -> EditUserAjax();
}

// Activate or Deactivate User

if (isset($_POST["activateUser"])) {

	$activateUser = new AjaxUsers();
	$activateUser -> activateUser = $_POST["activateUser"];
	$activateUser -> activateId = $_POST["activateId"];
	$activateUser -> ActivateUserAjax();
}


