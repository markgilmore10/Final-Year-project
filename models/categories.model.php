<?php

require_once "connection.php";

class CategoriesModel{

	// Add Categories
	public static function AddCategoryModel($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(category, vat, tax) VALUES (:category, :vat, :tax)");

		$stmt -> bindParam(":category", $data["category"], PDO::PARAM_STR);
		$stmt -> bindParam(":vat", $data["vat"], PDO::PARAM_STR);
		$stmt -> bindParam(":tax", $data["tax"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';

		} else {

			return 'error';

		}
		
		$stmt -> close();

		$stmt = null;
    }

    // Show Categories
    public static function ShowCategoriesModel($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
    // Edit Category
    public static function EditCategoryModel($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET Category = :Category, Vat = :Vat, Tax = :Tax WHERE id = :id");

		
		$stmt -> bindParam(":Category", $data["Category"], PDO::PARAM_STR);
		$stmt -> bindParam(":Vat", $data["Vat"], PDO::PARAM_STR);
		$stmt -> bindParam(":Tax", $data["Tax"], PDO::PARAM_STR);

		$stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

        $stmt->close();
        
		$stmt = null;

    }
	
	// Delete Category
    public static function DeleteCategoryModel($table, $data){

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

}