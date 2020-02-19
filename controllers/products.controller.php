<?php

class productsController{
	
	static public function ShowProductsController($item, $value){

		$table = "products";

		$answer = productsModel::ShowProductsModel($table, $item, $value);

		return $answer;

    }

    static public function ctrCreateProducts(){

		if(isset($_POST["newDescription"])){

			if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["newProduct"]) &&
			   preg_match('/^[0-9]+$/', $_POST["prodStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["prodPurPrice"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["prodSalePrice"])){

				$table = "products";

				$data = array("idCategory" => $_POST["prodCategory"],
							   "code" => $_POST["prodCode"],
							   "description" => $_POST["newProduct"],
							   "stock" => $_POST["prodStock"],
							   "buyingPrice" => $_POST["prodPurPrice"],
							   "sellingPrice" => $_POST["prodSalePrice"]);

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
}