<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class AjaxProducts{

	// Generate Category Code
	public $idCategory;

	public function CreateProductCodeAjax(){

		$item = "idCategory";
		$value = $this->idCategory;

		$answer = productsController::ShowProductsController($item, $value);

		echo json_encode($answer);

	}

}

// Generate Category Code
if(isset($_POST["idCategory"])){

	$productCode = new AjaxProducts();
	$productCode -> idCategory = $_POST["idCategory"];
	$productCode -> CreateProductCodeAjax();

}
  
