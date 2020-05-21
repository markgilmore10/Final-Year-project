<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

/**
 * Class AjaxProducts
 */
class AjaxProducts{

	// Generate Category Code
	public $idCategory;

	/**
	 * creates product by product finding id
	 * @return void
	 */
	public function CreateProductCodeAjax(){

		$item = "idCategory";
		$value = $this->idCategory;
		$order = "id";

		$answer = ProductsController::ShowProductsController($item, $value, $order);

		echo json_encode($answer);

	}

	//edit product
	public $idProduct;

	/**
	 * uses the products id to find products to edit
	 * @return void
	 */
	public function EditProductAjax(){
		$item = "id";
		$value = $this->idProduct;
		$order = "id";

		$answer = ProductsController::ShowProductsController($item,$value, $order);

		echo json_encode($answer);
	}

}

// Generate Category Code
if(isset($_POST["idCategory"])){

	$productCode = new AjaxProducts();
	$productCode -> idCategory = $_POST["idCategory"];
	$productCode -> CreateProductCodeAjax();

}

//Edit Product
if(isset($_POST["idProduct"])){
	
	$editProduct = new AjaxProducts();
	$editProduct -> idProduct = $_POST["idProduct"];
	$editProduct -> EditProductAjax();
}

