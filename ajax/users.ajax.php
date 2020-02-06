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

}


// Edit User

if (isset($_POST["userId"])) {

	$edit = new AjaxUsers();
	$edit -> userId = $_POST["userId"];
	$edit -> EditUserAjax();
}
