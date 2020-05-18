<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class salesProductTable{

	// Show Products 
	public function showSalesTable(){

		$item = null;
		$value = null;
		//$order = "idCategory";

		$products = ProductsController::ShowProductsController($item, $value); //, $order);
		
		if(count($products) == 0){

			$jsonData = '{"data":[]}';

			echo $jsonData;

			return;
		}

		$jsonData = '{

			"data":[';

				$buttons ='';
				
				for($i=0; $i < count($products); $i++){

		  			$buttons .=  "<button class='btn btn-primary btn-block addProductSale recoverButton pull-left' style='width:50%' idProduct='".$products[$i]["id"]."'>".$products[$i]["product"]." - ".$products[$i]["code"]."</button> ";

					$jsonData .='["'.$buttons.'"],';

					$buttons ='';
    
				}

				$jsonData = substr($jsonData, 0, -1);
				$jsonData .= '] 

			}';

		echo $jsonData;
	}
}

$tillSalesTable = new salesProductTable();
$tillSalesTable -> showSalesTable();
