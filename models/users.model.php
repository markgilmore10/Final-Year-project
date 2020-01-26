<?php

require_once "connection.php";

class UserModel{

	// Show User

	static public function ModelShowUser($tableUsers, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $tableUsers WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else{
			$stmt = Connection::connect()->prepare("SELECT * FROM $tableUsers");

			$stmt -> execute();

			return $stmt -> fetchAll();

			
		}

		$stmt -> close();

		$stmt = null;

    }
    
}