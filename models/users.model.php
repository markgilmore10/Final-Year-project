<?php

require_once "connection.php";

/**
 * Class UserModel
 */
class UserModel{

	// Show User
	/**
	 * shows the selected user from the user table in the database or displays all users in the table
	 * 
	 * @param mixed $table
	 * @param mixed $item
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public static function ShowUsersModel($table, $item, $value){

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

			$stmt -> close();

			$stmt = null;

	}

	/**
	 * adds users into the users table in the database using input data
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function AddUserModel($table, $data){

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
		
		$stmt -> close();

		$stmt = null;
	}

	/**
	 * edits the user in the users table using input data
	 * 
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function EditUserModel($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table set name = :name, password = :password, profile = :profile WHERE user = :user");

		$stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt -> bindParam(":user", $data["user"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":profile", $data["profile"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		
		}
		
		$stmt -> close();

		$stmt = null;
	}

	/**
	 * updates the user table using input data
	 * 
	 * @param mixed $table
	 * @param mixed $item1
	 * @param mixed $value1
	 * @param mixed $item2
	 * @param mixed $value2
	 * 
	 * @return void
	 */
	public static function UpdateUserModel($table, $item1, $value1, $item2, $value2){

		$stmt = Connection::connect()->prepare("UPDATE $table set $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {

			return 'error';
		
		}
		
		$stmt -> close();

		$stmt = null;
	}

	/**
	 * deletes selected user from the user table in the database by id
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function DeleteUserModel($table, $data){

		$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {

			return 'error';
		
		}
		
		$stmt -> close();

		$stmt = null;
	}
	
}
