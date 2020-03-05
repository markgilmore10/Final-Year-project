<?php

require_once 'connection.php';


class ModelSales{
	
    // Show Sales
	static public function ShowSalesModel($table, $item, $value){

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

	static public function AddSaleModel($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, idSeller, products, totalPrice, paymentMethod) VALUES (:code, :idSeller, :products, :totalPrice, :paymentMethod)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":totalPrice", $data["totalPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":paymentMethod", $data["paymentMethod"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
}