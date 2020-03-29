<?php

class SalesController{

	// Show Sales
    static public function ShowSalesController($item, $value){

		$table = "sales";

		$answer = ModelSales::ShowSalesModel($table, $item, $value);

		return $answer;

	}

    static public function SaleController(){

        // Make Sale
		if(isset($_POST["newSale"])){

			$productsList = json_decode($_POST["productsList"], true);

			$totalPurchase = array();

			foreach ($productsList as $key => $value) {

			   array_push($totalPurchase, $value["quantity"]);
				
			   $tableProducts = "products";

			    $item = "id";
			    $valueProductId = $value["id"];
			    $order = "id";

			    $getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $valueProductId);

				$item1 = "sales";
				$value1 = $value["quantity"] + $getProduct["sales"];

			    $newSales = ProductsModel::UpdateProductModel($tableProducts, $item1, $value1, $valueProductId);

				$item2 = "stock";
				$value2 = $value["stock"];

				$newStock = ProductsModel::UpdateProductModel($tableProducts, $item2, $value2, $valueProductId);

			}

			$tableCustomers = "customers";

			$item = "id";
			$valueCustomer = $_POST["customerSearch"];

			$getCustomer = CustomersModel::ShowCustomersModel($tableCustomers, $item, $valueCustomer);

			$item1a = "purchases";
			$value1a = array_sum($totalPurchase) + $getCustomer["purchases"];
			var_dump($value1a);
			$customerPurchases = CustomersModel::UpdateCustomerModel($tableCustomers, $item1a, $value1a, $value);

			$item1b = "lastPurchase";

			date_default_timezone_set("Europe/Dublin");

			$date = date('Y-m-d');
			$hour = date('H:i:s');
			$value1b = $date.' '.$hour;

			$dateCustomer = CustomersModel::UpdateCustomerModel($tableCustomers, $item1b, $value1b, $value);

			$table = "sales";

			$data = array("code"=>$_POST["newSale"],
						  "idSeller"=>$_POST["idSeller"],
						  "tableNo"=>$_POST["tableNo"],
						  "idCustomer"=>$_POST["customerSearch"],
						  "products"=>$_POST["productsList"],
						  "netPrice"=>$_POST["newNetPrice"],
						  "discount"=>$_POST["newDiscountPrice"],
						  "totalPrice"=>$_POST["newSaleTotal"],
						  "paymentMethod"=>$_POST["newPaymentMethod"]);

			$answer = ModelSales::AddSaleModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Sale Succesfull",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "sales";

								}
							})

				</script>';

			}

		}

	}
	
	public static function index () {
        return ModelSales::getAll();
	}
	
	static public function OpenTableController(){

        // Make Sale
		if(isset($_POST["reopenSale"])){

			$table = "sales";

			$item = "code";
			$value = $_POST["reopenSale"];

			$getSale = ModelSales::ShowSalesModel($table, $item, $value);

			if($_POST["productsList"] == ""){

				$productsList = $getSale["products"];
				$productChange = false;


			}else{

				$productsList = $_POST["productsList"];
				$productChange = true;
			}

			if($productChange){

				$products =  json_decode($getSale["products"], true);

				$totalPurchasedProducts = array();

				foreach ($products as $key => $value) {

					array_push($totalPurchasedProducts, $value["quantity"]);
					
					$tableProducts = "products";

					$item = "id";
					$value = $value["id"];
					$order = "id";

					$getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $value, $order);

					$item1a = "sales";
					$value1a = $getProduct["sales"] - $value["quantity"];

					$newSales = ProductsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $value);

					$item1b = "stock";
					$value1b = $value["quantity"] + $getProduct["stock"];

					$nuevoStock = ProductsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $value);

				}

				$tableCustomers = "customers";

				$itemCustomer = "id";
				$valueCustomer = $_POST["selectCustomer"];

				$getCustomer = CustomersModel::ShowCustomersModel($tableCustomers, $itemCustomer, $valueCustomer);

				$item1a = "purchases";
				$value1a = $getCustomer["purchases"] - array_sum($totalPurchasedProducts);

				$customerPurchases = CustomersModel::UpdateCustomerModel($tableCustomers, $item1a, $value1a, $valueCustomer);

				$productsList_2 = json_decode($productsList, true);

				$totalPurchasedProducts_2 = array();

				foreach ($productsList_2 as $key => $value) {

					array_push($totalPurchasedProducts_2, $value["quantity"]);
					
					$tableProducts_2 = "products";

					$item_2 = "id";
					$value_2 = $value["id"];
					$order = "id";

					$getProduct_2 = ProductsModel::ShowProductsModel($tableProducts_2, $item_2, $value_2, $order);

					$item1a_2 = "sales";
					$value1a_2 = $value["quantity"] + $getProduct_2["sales"];

					$newSales_2 = ProductsModel::UpdateProductModel($tableProducts_2, $item1a_2, $value1a_2, $value_2);

					$item1b_2 = "stock";
					$value1b_2 = $getProduct_2["stock"] - $value["quantity"];

					$newStock_2 = ProductsModel::UpdateProductModel($tableProducts_2, $item1b_2, $value1b_2, $value_2);

				}

				$tableCustomers_2 = "customers";

				$item_2 = "id";
				$value_2 = $_POST["selectCustomer"];

				$getCustomer_2 = CustomersModel::ShowCustomersModel($tableCustomers_2, $item_2, $value_2);

				$item1a_2 = "purchases";
				$value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["purchases"];

				$customerPurchases_2 = CustomersModel::UpdateCustomerModel($tableCustomers_2, $item1a_2, $value1a_2, $value_2);

				$item1b_2 = "lastPurchase";

				date_default_timezone_set("Europe/Dublin");

				$date = date('Y-m-d');
				$hour = date('H:i:s');
				$value1b = $date.' '.$hour;

				$dateCustomer_2 = CustomersModel::UpdateCustomerModel($tableCustomers_2, $item1b_2, $value1b_2, $value_2);

			}

			$data = array("code"=>$_POST["reopenSale"],
						  "idSeller"=>$_POST["idSeller"],
						  "tableNo"=>$_POST["tableNo"],
						  "idCustomer"=>$_POST["customerSearch"],
						  "products"=>$_POST["productsList"],
						  "netPrice"=>$_POST["newNetPrice"],
						  "discount"=>$_POST["newDiscountPrice"],
						  "totalPrice"=>$_POST["newSaleTotal"],
						  "paymentMethod"=>$_POST["newPaymentMethod"]);

			$answer = ModelSales::AddSaleModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Sale Succesfull",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "sales";

								}
							})

				</script>';

			}
		}

	}

	// Delete Sales
	static public function DeleteSaleController(){

		if(isset($_GET["idSale"])){

			$table = "sales";

			$item = "id";
			$value = $_GET["idSale"];

			$getSale = ModelSales::ShowSalesModel($table, $item, $value);

			$tableCustomers = "customers";

			$itemsales = null;
			$valuesales = null;

			$getSales = ModelSales::ShowSalesModel($table, $itemsales, $valuesales);

			$saveDates = array();

			foreach ($getSales as $key => $value) {
				
				if($value["idCustomer"] == $getSale["idCustomer"]){

					array_push($saveDates, $value["saledate"]);

				}

			}

			if(count($saveDates) > 1){

				if($getSale["saledate"] > $saveDates[count($saveDates)-2]){

					$item = "lastPurchase";
					$value = $saveDates[count($saveDates)-2];
					$valueIdCustomer = $getSale["idCustomer"];

					$customerPurchases = CustomersModel::UpdateCustomerModel($tableCustomers, $item, $value, $valueIdCustomer);

				}else{

					$item = "lastPurchase";
					$value = $saveDates[count($saveDates)-1];
					$valueIdCustomer = $getSale["idCustomer"];

					$customerPurchases = CustomersModel::UpdateCustomerModel($tableCustomers, $item, $value, $valueIdCustomer);

				}


			}else{

				$item = "lastPurchase";
				$value = "0000-00-00 00:00:00";
				$valueIdCustomer = $getSale["idCustomer"];

				$customerPurchases = CustomersModel::UpdateCustomerModel($tableCustomers, $item, $value, $valueIdCustomer);

			}

			$products =  json_decode($getSale["products"], true);

			$totalPurchasedProducts = array();

			foreach ($products as $key => $value) {

				array_push($totalPurchasedProducts, $value["quantity"]);
				
				$tableProducts = "products";

				$item = "id";
				$valueProductId = $value["id"];
				$order = "id";

				$getProduct = productsModel::UpdateProductModel($tableProducts, $item, $valueProductId, $order);

				$item1a = "sales";
				$value1a = $getProduct["sales"] - $value["quantity"];

				$newSales = productsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $valueProductId);

				$item1b = "stock";
				$value1b = $value["quantity"] + $getProduct["stock"];

				$nuevoStock = productsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $valueProductId);

			}

			$tableCustomers = "customers";

			$itemCustomer = "id";
			$valueCustomer = $getSale["idCustomer"];

			$getCustomer = CustomersModel::ShowCustomersModel($tableCustomers, $itemCustomer, $valueCustomer);

			$item1a = "purchases";
			$value1a = $getCustomer["purchases"] - array_sum($totalPurchasedProducts);

			$customerPurchases = CustomersModel::UpdateCustomerModel($tableCustomers, $item1a, $value1a, $valueCustomer);

			$answer = ModelSales::DeleteSalesModel($table, $_GET["idSale"]);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Sale Deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "sales";

								}
							})

				</script>';

			}		
		}
	}

}