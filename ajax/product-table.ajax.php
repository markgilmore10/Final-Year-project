<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

/**
 * Class productsTables
 */
class productsTables{

	/**
	 *  fetches display json data of the products table
	 * 
	 * @return void
	 */
	public function ShowProductsTable(){

		$item = null;
		$value = null;
		$order = "id";

		$products = productsController::ShowProductsController($item, $value, $order);

		if(count($products) == 0){

			$jsonData = '{"data":[]}';

			echo $jsonData;

			return;
		}

		$jsonData = '{
			"data":[';

				for($i=0; $i < count($products); $i++){
					
					$item = "id";
				  	$value = $products[$i]["idCategory"];

				  	$categories = ControllerCategories::ShowCategoriesController($item, $value);
				  	
				  	if($products[$i]["stock"] <= 10){

		  				$stock = "<button class='btn btn-danger'>".$products[$i]["stock"]."</button>";

		  			}else if($products[$i]["stock"] > 5 && $products[$i]["stock"] <= 15){

		  				$stock = "<button class='btn btn-warning'>".$products[$i]["stock"]."</button>";

		  			}else{

		  				$stock = "<button class='btn btn-success'>".$products[$i]["stock"]."</button>";

					  }
					  
					  if (isset($_GET["hiddenProfile"]) && $_GET["hiddenProfile"] == "Special") {

						$buttons =  "<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='"
							.$products[$i]["id"]."' data-toggle='modal' data-target='#editAProduct'><i class='fa fa-pencil'></i></button>";

					}else{

						$buttons =  "<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='"
						.$products[$i]["id"]."' data-toggle='modal' data-target='#editAProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeleteProduct' idProduct='".$products[$i]["id"]."' code='".$products[$i]["code"]."'><i class='fa fa-times'></i></button></div>";
					}

					$jsonData .='[
						"'.($i+1).'",
						"'.$products[$i]["code"].'",
						"'.$products[$i]["product"].'",
						"'.$categories["Category"].'",
						"'.$stock.'",
						"€ '.$products[$i]["buyingPrice"].'",
						"€ '.$products[$i]["sellingPrice"].'",
						"'.$buttons.'"
					],';
				}

				$jsonData = substr($jsonData, 0, -1);
				$jsonData .= '] 

			}';

		echo $jsonData;
	}
}


$showProducts = new productsTables();
$showProducts -> showProductsTable();
