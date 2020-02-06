<?php

require_once "connection.php";

class UserModel{

	// Show User

	static public function ModelShowUsers($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

			//$stmt -> close();

			$stmt = null;

	}

	static public function ModelAddUser($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(name, user, password, profile) VALUES (:name, :user, :password, :profile)");

		$stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt -> bindParam(":user", $data["user"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":profile", $data["profile"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		//$stmt -> close();

		$stmt = null;
	}
	
}
