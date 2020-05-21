<?php

require_once 'connection.php';

/**
 * Class ModelTables
 */
class ModelTables{
	
	// Show Open Tables
	/**
	 * displays opentables chosen by the user or displays all opentables in the table of the database
	 * 
	 * @param mixed $table
	 * @param mixed $item
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public static function ShowTablesModel($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * inserts a new opentable into the table using input data
	 * 
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function AddTableModel($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, idSeller, tableNo, products, netPrice) VALUES (:code, :idSeller, :tableNo, :products, :netPrice)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":tableNo", $data["tableNo"], PDO::PARAM_STR);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/**
	 * updates the opentable by code
	 * 
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function UpdateTableModel($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET idSeller = :idSeller, tableNo = :tableNo, products = :products, netPrice= :netPrice WHERE code = :code");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":tableNo", $data["tableNo"], PDO::PARAM_STR);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/**
	 * displays all opentables in the opentable table
	 * @return void
	 */
	public static function all () {
        $stmt = Connection::connect()->prepare("SELECT open_tables.* FROM open_tables ORDER BY id ASC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetchAll();
	}
    
    /**
	 * displays code sakes table
	 * @return void
	 */
    public static function getCode () {
        $stmt = Connection::connect()->prepare("SELECT MAX(code) AS code FROM sales ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetch();
	}
}