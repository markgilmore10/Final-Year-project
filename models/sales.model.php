<?php

require_once 'connection.php';

/**
 * Class ModelSales
 */
class ModelSales{
	
	// Show Sales
	/**
	 * displays selected sale or displays the whole table
	 * 
	 * 
	 * @param mixed $table
	 * @param mixed $item
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public static function ShowSalesModel($table, $item, $value){

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
	 * adds sale to the sales table in the database using input data
	 * 
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function AddSaleModel($table, $data){

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

	/**
	 * displays all sales from the sales table in the database
	 * @return void
	 */
	public static function getAll () {

        $stmt = Connection::connect()->prepare("SELECT sales.*, customers.name AS customer FROM sales LEFT JOIN customers ON sales.idCustomer = customers.id ORDER BY id ASC");
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		
        return $stmt->fetchAll();
	}
	
	/**
	 * re-opens opentables and proccesses the sale
	 * 
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function ReopenSaleModel($table, $data){

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

	/**
	 * deletes selected sale from the the sales table in the database by id
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function DeleteSalesModel($table, $data){

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

	///// date ranges

	/**
	 * displays date ranges from the table from an initial date to a finaldate
	 * 
	 * @param mixed $table
	 * @param mixed $initialDate
	 * @param mixed $finalDate
	 * 
	 * @return void
	 */
	public static function DatesRangeModel($table, $initialDate, $finalDate){

		if($initialDate == null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($initialDate == $finalDate){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE saledate like '%$finalDate%'");

			$stmt -> bindParam(":saledate", $finalDate, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
			
		}else{

			$actualDate = new DateTime();
			$actualDate ->add(new DateInterval("P1D"));
			$actualDatePlusOne = $actualDate->format("Y-m-d");

			$finalDate2 = new DateTime($finalDate);
			$finalDate2 ->add(new DateInterval("P1D"));
			$finalDatePlusOne = $finalDate2->format("Y-m-d");

			if($finalDatePlusOne == $actualDatePlusOne){

				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE saledate BETWEEN '$initialDate' AND '$finalDatePlusOne'");

			}else{


				$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE saledate BETWEEN '$initialDate' AND '$finalDate'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}

	//adding total sales

	/**
	 * sums the netprice as total price from the table
	 * @param mixed $table
	 * 
	 * @return void
	 */
	public 	static function sumTotalSalesModel($table){	

		$stmt = Connection::connect()->prepare("SELECT SUM(netPrice) as totalPrice FROM $table");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}