<?php

class ProductsController{
	
	public static function ShowProductsController($item, $value){

		$table = "products";

		$answer = productsModel::ShowProductsModel($table, $item, $value);

		return $answer;

    }

    public static function AddProductsController(){

		if(isset($_POST["newProduct"])){

			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newProduct"]) &&
			   preg_match('/^[0-9]+$/', $_POST["newStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["newBuyingPrice"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["newSellingPrice"])){

				$table = "products";

				$data = array("idCategory" => $_POST["newCategory"],
							   "code" => $_POST["newCode"],
							   "product" => $_POST["newProduct"],
							   "stock" => $_POST["newStock"],
							   "buyingPrice" => $_POST["newBuyingPrice"],
							   "sellingPrice" => $_POST["newSellingPrice"]);

				$answer = productsModel::AddProductModel($table, $data);

				if($answer == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Product Added Successfully",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
										if (result.value) {

										window.location = "products";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Sorry, Product Was Not Added",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "products";

							}
						})

			  	</script>';
			}

		}

	}


	//edit products controller
	public static function EditProductsController(){

		if(isset($_POST["editProducts"])){

			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editProducts"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editBuyingPrice"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editSellingPrice"])){

				$table = "products";

				$data = array("idCategory" => $_POST["editCategory"],
							   "code" => $_POST["editCode"],
							   "product" => $_POST["editProducts"],
							   "stock" => $_POST["editStock"],
							   "buyingPrice" => $_POST["editBuyingPrice"],
							   "sellingPrice" => $_POST["editSellingPrice"]);

				$answer = productsModel::EditProductModel($table, $data);

				if($answer == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "Product Edited Successfully",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
										if (result.value) {

										window.location = "products";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Sorry, Product Was Not Edited",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "products";

							}
						})

			  	</script>';
			}

		}

	}

	//delete product
	public static function DeleteProductsController(){

		if(isset($_GET["idProduct"])){
			
			$table = "products";
			$data = $_GET["idProduct"];

			$answer = productsModel::DeleteProductModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "Product Deleted Successfully",
						showConfirmButton: true,
						confirmButtonText: "Close"
						}).then(function(result){
								if (result.value) {

								window.location = "products";

								}
							})

				</script>';

			}
		}

	}
}