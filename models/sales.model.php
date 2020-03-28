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

		$stmt = Connection::connect()->prepare("INSERT INTO $table(code, idSeller, tableNo, idCustomer, products, netPrice, discount, totalPrice, paymentMethod) VALUES (:code, :idSeller, :tableNo, :idCustomer, :products, :netPrice, :discount, :totalPrice, :paymentMethod)");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":tableNo", $data["tableNo"], PDO::PARAM_STR);
		$stmt->bindParam(":idCustomer", $data["idCustomer"], PDO::PARAM_STR);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":discount", $data["discount"], PDO::PARAM_STR);
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

	public static function getAll () {

        $stmt = Connection::connect()->prepare("SELECT sales.*, customers.name AS customer FROM sales LEFT JOIN customers ON sales.idCustomer = customers.id ORDER BY id ASC");
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		
        return $stmt->fetchAll();
	}
	
	static public function ReopenSaleModel($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET idSeller = :idSeller, tableNo = :tableNo, idCustomer = :idCustomer, products = :products, netPrice = :netPrice, discount = :discount, totalPrice = :totalPrice, paymentMethod = :paymentMethod WHERE code = :code");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idSeller", $data["idSeller"], PDO::PARAM_INT);
		$stmt->bindParam(":tableNo", $data["tableNo"], PDO::PARAM_STR);
		$stmt->bindParam(":idCustomer", $data["idCustomer"], PDO::PARAM_STR);
		$stmt->bindParam(":products", $data["products"], PDO::PARAM_STR);
		$stmt->bindParam(":netPrice", $data["netPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":discount", $data["discount"], PDO::PARAM_STR);
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