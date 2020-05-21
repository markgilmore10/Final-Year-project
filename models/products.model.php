<?php

require_once 'connection.php';
/**
 * Class productsModel
 */
class ProductsModel{

	/**
	 * displays the chosen product or displays the full table
	 * 
	 * @param mixed $table
	 * @param mixed $item
	 * @param mixed $value
	 * @param mixed $order
	 * 
	 * @return void
	 */
	public static function ShowProductsModel($table, $item, $value, $order){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY idCategory DESC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY $order DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

	/**
	 * adds a product to the database table using input data from the user
     * @param mixed $table
     * @param mixed $data
     * 
     * @return void
     */
    public static function AddProductModel($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(idCategory, code, product, stock, buyingPrice, sellingPrice) VALUES (:idCategory, :code, :product, :stock, :buyingPrice, :sellingPrice)");

		$stmt->bindParam(":idCategory", $data["idCategory"], PDO::PARAM_INT);
		$stmt->bindParam(":code", $data["code"], PDO::PARAM_STR);
		$stmt->bindParam(":product", $data["product"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":buyingPrice", $data["buyingPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":sellingPrice", $data["sellingPrice"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	// Edit product
	/**
	 * edits product in the products table in the database using input data from the user
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function EditProductModel($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET code = :code, idCategory = :idCategory, product = :product,
		 stock = :stock, buyingPrice = :buyingPrice, sellingPrice = :sellingPrice WHERE product = :product");

		$stmt->bindParam(":code", $data["code"], PDO::PARAM_STR);
		$stmt->bindParam(":idCategory", $data["idCategory"], PDO::PARAM_INT);
		$stmt->bindParam(":product", $data["product"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":buyingPrice", $data["buyingPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":sellingPrice", $data["sellingPrice"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	//delete product
	/**
	 * deletes selected product in the  products table by id
	 * @param mixed $table
	 * @param mixed $data
	 * 
	 * @return void
	 */
	public static function DeleteProductModel($table, $data){

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

	/**
	 * updates the product table using input data
	 * @param mixed $table
	 * @param mixed $item1
	 * @param mixed $value1
	 * @param mixed $value
	 * 
	 * @return void
	 */
	public static function UpdateProductModel($table, $item1, $value1, $value){

		$stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $value, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/**
	* displays the sum of sales as total price from the database table
	* 
	* @param mixed $table
	* 
	* @return void
	*/
	static public function sumOfSalesModel($table){

		$stmt = Connection::connect()->prepare("SELECT SUM(sales) as totalPrice FROM $table");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}
}