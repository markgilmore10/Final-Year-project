<?php

/**
 * Class OpenTableController
 * showing of the openedtables and displays all tables
 */
class OpenTableController{

    // Show Sales
    /**
	 * fetches the open_tables table from the database 
	 * displays the table
     * @param mixed $item
     * @param mixed $value
     * 
     * @return void
     */
    public static function ShowTableController($item, $value){

		$table = "open_tables";

		$answer = ModelTables::ShowTablesModel($table, $item, $value);

		return $answer;

	}
	
	public static function index () {
        return ModelTables::all();
    }
    
    public function reopenTable () {
        
        if ( !empty($_POST)) {
            $table = "open_tables";
            $item = "id";
            $value = $_GET["id"];
            
            $getSale = ModelTables::ShowTablesModel($table, $item, $value);
            if ($_POST["productsList"] == "") {
                $productsList = $getSale["products"];
                $products = json_decode($getSale["products"], true);
                $productChange = false;
            } else {
                $productsList = $_POST["productsList"];
                $products = json_decode($_POST["productsList"], true);
                $productChange = true;
            }
        }
        
        // Make Sale
        if (isset($_POST["openTable"])) {
            // if statement checking if the sale was actually changed
            if ($productChange) {
                
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
                
                // $tableCustomers_2 = "customers";
                
                // $item_2 = "idNumber";
                // $value_2 = $_POST["customerSearch"];
                
                // $getCustomer_2 = CustomersModel::ShowCustomersModel($tableCustomers_2, $item_2, $value_2);
                
                // $item1a_2 = "purchases";
                // $value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["purchases"];
                
                // $customerPurchases_2 = CustomersModel::UpdateCustomerModel($tableCustomers_2, $item1a_2, $value1a_2, $value_2);
                
                // $item1b_2 = "lastPurchase";
                
                // date_default_timezone_set("Europe/Dublin");
                
                // $date = date('Y-m-d');
                // $hour = date('H:i:s');
                // $value1b_2 = $date . ' ' . $hour;
                
                // $dateCustomer_2 = CustomersModel::UpdateCustomerModel($tableCustomers_2, $item1b_2, $value1b_2, $value_2);
                
            }
            
            $data = array("code"       => $_POST["reopenSale"],
                          "idSeller"   => $_POST["idSeller"],
                          "tableNo"    => $_POST["tableNo"],
                          "products"   => $productsList,
                          "netPrice"   => $_POST["newNetPrice"],
                          //"discount"   => $_POST["newDiscountSale"],
                          //"totalPrice" => $_POST["newSaleTotal"],
            );
            
            $answer = ModelTables::UpdateTableModel($table, $data);
            
            if ($answer == "ok") {
                
                echo '<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Update Succesfull",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "open-tables";

								}
							})

				</script>';
            
            }
        } elseif (isset($_POST["newPaymentMethod"])) {

            // Update customer purchases, stock levels and product sale figures
            $totalPurchases = array();
            
            foreach ($products as $key => $value) {
                
                array_push($totalPurchases, $value["quantity"]);
                
                $tableProducts = "products";
                
                $item = "id";
                $valueProductId = $value["id"];
                $order = "id";
                
                $getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $valueProductId, $order);
                
                $item1 = "sales";
                $value1 = $value["quantity"] + $getProduct["sales"];
                
                $newSales = ProductsModel::UpdateProductModel($tableProducts, $item1, $value1, $valueProductId);
                
                $item2 = "stock";
                $value2 = $value["stock"];
                
                $newStock = ProductsModel::UpdateProductModel($tableProducts, $item2, $value2, $valueProductId);
                
            }
            
            $tableCustomers = "customers";
            
            $item = "idNumber";
            $valueCustomer = $_POST["customerSearch"];
            
            
            $getCustomer = CustomersModel::ShowCustomersModel($tableCustomers, $item, $valueCustomer);
            $item1 = "purchases";
            $value1 = array_sum($totalPurchases) + $getCustomer["purchases"];
            
            $customerPurchases = CustomersModel::UpdateCustomerModel($tableCustomers, $item1, $value1, $valueCustomer);
            
            $item2 = "lastPurchase";
            
            date_default_timezone_set("Europe/Dublin");
            
            $date = date('Y-m-d');
            $hour = date('H:i:s');
            $value2 = $date . ' ' . $hour;
            
            $dateCustomer = CustomersModel::UpdateCustomerModel($tableCustomers, $item2, $value2, $valueCustomer);
            
            $table = "sales";
            
            $data = array("code"		  => $_POST["reopenSale"],
                          "idSeller"      => $_POST["idSeller"],
                          "tableNo"       => $_POST["tableNo"],
                          "idCustomer"    => $_POST["customerSearch"],
                          "products"      => $productsList,
                          "netPrice"      => $_POST["newNetPrice"],
                          "discount"      => $_POST["newDiscountSale"],
                          "totalPrice"    => $_POST["newSaleTotal"],
                          "paymentMethod" => $_POST["newPaymentMethod"]);
            
            $answer = ModelSales::AddSaleModel($table, $data);
            
            if ($answer == "ok") {
                
                ModelSales::DeleteSalesModel('open_tables', $_GET['id']);
                
                echo '<script>

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
    /**
	 * fetches the idsale from the opentable table
	 * deletes opentable from the table
	 * @return void
	 */
	public static function DeleteOpenTableController(){

		if(isset($_GET["idSale"])){

			$table = "open_tables";

			$item = "id";
			$value = $_GET["idSale"];

			$getSale = ModelSales::ShowSalesModel($table, $item, $value);

			$products =  json_decode($getSale["products"], true);

			$totalPurchasedProducts = array();

			foreach ($products as $key => $value) {

				array_push($totalPurchasedProducts, $value["quantity"]);
				
				$tableProducts = "products";

				$item = "id";
				$valueProductId = $value["id"];
				$order = "id";

				$getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $valueProductId, $order);

				$item1a = "sales";
				$value1a = $getProduct["sales"] - $value["quantity"];
				
				$newSales = ProductsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $valueProductId);

				$item1b = "stock";
				$value1b = $value["quantity"] + $getProduct["stock"];

				$newStock = ProductsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $valueProductId);

			}

			$answer = ModelSales::DeleteSalesModel($table, $_GET["idSale"]);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Table Deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "open-tables";

								}
							})

				</script>';

			}else{
                echo'<script>

				swal({
					  type: "success",
					  title: "Error",
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

