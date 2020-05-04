<?php

require_once "connection.php";

class CustomersModel{

    // Create Customer
	public static function AddCustomerModel($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(name, idNumber, address, email, mobile, dob, discount) VALUES (:name, :idNumber, :address, :email, :mobile, :dob, :discount)");

		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":idNumber", $data["idNumber"], PDO::PARAM_INT);
        $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":mobile", $data["mobile"], PDO::PARAM_STR);
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
    public static function ShowCustomersModel($table, $item, $value){

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
    
    // Edit Customer
	public static function EditCustomerModel($table, $data){

        $stmt = Connection::connect()->prepare("UPDATE $table SET name = :name, idNumber = :idNumber, address = :address, email = :email, mobile = :mobile, dob = :dob, discount = :discount WHERE id = :id");
        
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":idNumber", $data["idNumber"], PDO::PARAM_INT);
        $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":mobile", $data["mobile"], PDO::PARAM_STR);
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

    public static function DeleteCustomerModel($table, $data){

		$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	public static function searchByNumberId($query){

		$stmt = Connection::connect()->prepare("SELECT * FROM customers WHERE idNumber LIKE '%$query%'");
		
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		
		$stmt -> execute();
		
        return $stmt -> fetchAll();
    
	}
	
	public static function UpdateCustomerModel($table, $item1, $value1, $value){

		$stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE idNumber = :idNumber");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
		$stmt -> bindParam(":idNumber", $value, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	
}