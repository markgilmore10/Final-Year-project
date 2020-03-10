<?php

require_once "connection.php";

class CustomersModel{

    // Create Customer
	static public function AddCustomerModel($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(name, idNumber, address, email, phone, dob, discount) VALUES (:name, :idNumber, :address, :email, :phone, :dob, :discount)");

		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":idNumber", $data["idNumber"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
		$stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt->bindParam(":dob", $data["dob"], PDO::PARAM_STR);
        $stmt->bindParam(":discount", $data["discount"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
    
    // Show Customers
    static public function ShowCustomersModel($table, $item, $value){

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
	
}