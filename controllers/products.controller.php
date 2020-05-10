<?php

/**
 * Class ProductsController
 * Displaying, adding, editing, deleting products and shows the adding of sales
 */
class ProductsController{
	
 /**
  * fetches the products table from the database and
  * displays the contents of the table
  * 
  * @param mixed $item
  * @param mixed $value
  * @param mixed $order
  * 
  * @return void
  */
	static public function ShowProductsController($item, $value, $order){

		$table = "products";

		$answer = productsModel::ShowProductsModel($table, $item, $value, $order);

		return $answer;

    }

    /**
	 * Create new products to be added to the products database table
	 * product details need to be correct and have no invalid chars
	 * once completed will send a success message to user
	 * if failure to enter valid chars user will recieve an error message
	 * 
     * @return void
     */
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
	/**
	 * takes the product from the products table and allows the user
	 * to change the values , if any of the values input are invalid
	 * editing will fail
	 * 
	 * if edit is successful user will receive a success message
	 * while if edit fails user will receive an error message
	 * 
	 * @return void
	 */
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
	/**
	 * fetches product id from the products table 
	 * then deletes the product from the table
	 * 
	 * if deletion is successful user will recieve a success message 
	 * while if deletion fails user will recieve an error message
	 * 
	 * @return void
	 */
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

 /**
  * Sums the total of all sales from the 
  * products table
  * @return void
  */
	static public function sumOfSalesController(){

		$table = "products";

		$answer = productsModel::sumOfSalesModel($table);

		return $answer;

	}
}