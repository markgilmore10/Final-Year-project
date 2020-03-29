<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class salesProductTable{

	// Show Products 
	public function showSalesTable(){

		$item = null;
		$value = null;
		$order = "id";

		$products = ProductsController::ShowProductsController($item, $value, $order);
		
		if(count($products) == 0){

			$jsonData = '{"data":[]}';

			echo $jsonData;

			return;
		}

		$jsonData = '{
			"data":[';

				for($i=0; $i < count($products); $i++){

		  			$buttons =  "<div class='btn-group'><button class='btn btn-primary addProductSale recoverButton' idProduct='".$products[$i]["id"]."'>".$products[$i]["product"]."</button></div>";

					$jsonData .='[
						"'.$buttons.'"
					],';
				}

				$jsonData = substr($jsonData, 0, -1);
				$jsonData .= '] 

			}';

		echo $jsonData;
	}
}

$tillSalesTable = new salesProductTable();
$tillSalesTable -> showSalesTable();
