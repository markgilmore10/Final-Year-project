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

}