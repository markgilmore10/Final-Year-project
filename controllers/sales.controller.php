<?php

/**
 * Class SalesController
 * This will be used to control the
 * Displaying, creation, fetching all data from table, reopen/edit, delete sales, 
 * display sales by date, sum all sales and print receipt of sale
 * 
 */
class SalesController{

	// Show Sales
    /**
	 * fetches sales table from the database
	 * and displays the contents of the table
	 * 
     * @param mixed $item
     * @param mixed $value
     * 
     * @return void
     */
    public static function ShowSalesController($item, $value){

		$table = "sales";

		$answer = ModelSales::ShowSalesModel($table, $item, $value);

		return $answer;

	}

	// Create / Edit Sale

	/**
	 * Opens a table that can be re-opened to process the sale -
	 * sale info placed into the open sales table
	 * once order is placed user will recieve a order saved message.
	 * 
	 * Creates sale where when items are added to the order 
	 * they take the same amount is taken from their stock
	 * once sales is processed success message is delivered
	 * 
	 * 
     * @return void
     */
    public static function CreateSaleController(){

		if (isset($_POST["openTable"])) {

			// Update customer purchases, stock levels and product sale figures
			$productsList = json_decode($_POST["productsList"], true);

			$totalPurchases = array();

			foreach ($productsList as $key => $value) {

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
			
			// Save sale to database
			$table = "open_tables";
			
            $data = array("code"       => $_POST["newSale"],
                          "idSeller"   => $_POST["idSeller"],
                          "tableNo"    => $_POST["tableNo"],
                          "idCustomer" => $_POST["customerSearch"],
						  "products"   => $_POST["productsList"],
                          "netPrice"   => $_POST["newNetPrice"],
            );
            
			$answer = ModelTables::AddTableModel($table, $data);
			
            if ($answer == "ok") {
                
                echo '<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Order Saved",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "open-tables";

								}
							})

				</script>';
            
            }
            
        } elseif(isset($_POST["newSale"])){

			// Update customer purchases, stock levels and product sale figures
			$productsList = json_decode($_POST["productsList"], true);

			$totalPurchases = array();

			foreach ($productsList as $key => $value) {

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
			$value2 = $date.' '.$hour;

			$dateCustomer = CustomersModel::UpdateCustomerModel($tableCustomers, $item2, $value2, $valueCustomer);
			
			$table = "sales";

			// Save sale to database
			$data = array("code"=>$_POST["newSale"],
						  "idSeller"=>$_POST["idSeller"],
						  "tableNo"=>$_POST["tableNo"],
						  "idCustomer"=>$_POST["customerSearch"],
						  "products"=>$_POST["productsList"],
						  "netPrice"=>$_POST["newNetPrice"],
						  "discount"=>$_POST["newDiscountSale"],
						  "totalPrice"=>$_POST["newSaleTotal"],
						  "paymentMethod"=>$_POST["newPaymentMethod"]);

			$answer = ModelSales::AddSaleModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Sale Successful",
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
	
	/**
	 * fetches all data from the sales table 
	 * and returns it
	 * @return void
	 */
	public static function index () {
        return ModelSales::getAll();
	}
	
	/**
	 * Re-opens saved orders from the opentables
	 * and processes them as a sale.
	 * 
	 * 
	 * @return void
	 */
	public static function ReOpenTableController(){

        // Make Sale
		if(isset($_POST["reopenSale"])){

			$table = "sales";

			$item = "code";
			$value = $_POST["reopenSale"];
			$getSale = ModelSales::ShowSalesModel($table, $item, $value);
   
			// if statement checking if the sale was actually changed
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
					$newSales = ProductsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $value1);

					$item1b = "stock";
					$value1b = $value["quantity"] + $getProduct["stock"];

					$newStock = ProductsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $value1);

				}
				
				$tableCustomers = "customers";

				$itemCustomer = "idNumber";
				$valueCustomer = $_POST["customerSearch"];

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

				$item_2 = "idNumber";
				$value_2 = $_POST["customerSearch"];

				$getCustomer_2 = CustomersModel::ShowCustomersModel($tableCustomers_2, $item_2, $value_2);

				$item1a_2 = "purchases";
				$value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["purchases"];

				$customerPurchases_2 = CustomersModel::UpdateCustomerModel($tableCustomers_2, $item1a_2, $value1a_2, $value_2);

				$item1b_2 = "lastPurchase";

				date_default_timezone_set("Europe/Dublin");

				$date = date('Y-m-d');
				$hour = date('H:i:s');
				$value1b = $date.' '.$hour;

				$dateCustomer_2 = CustomersModel::UpdateCustomerModel($tableCustomers_2, $item1b_2, $value1b, $value_2);

			}
			
			if (isset($_POST['newPaymentMethod'])) {
                $data = array("code"          => $_POST["reopenSale"],
                              "idSeller"      => $_POST["idSeller"],
                              "tableNo"       => $_POST["tableNo"],
                              "idCustomer"    => $_POST["customerSearch"],
                              "products"      => $productsList,
                              "netPrice"      => $_POST["newNetPrice"],
                              "discount"      => $_POST["newDiscountSale"],
                              "totalPrice"    => $_POST["newSaleTotal"],
                              "paymentMethod" => $_POST["newPaymentMethod"]);
                
                $answer = ModelSales::ReopenSaleModel($table, $data);
                
                if ($answer == "ok") {
                    
                    echo '<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Sale Successful",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "sales";

								}
							})

				</script>';
                
                }
            } else {
                
                ModelSales::DeleteSalesModel('sales',$getSale['id']);
                
			    $table = "open_tables";
                
                $data = array("code"       => $_POST["reopenSale"],
                              "idSeller"   => $_POST["idSeller"],
                              "tableNo"    => $_POST["tableNo"],
                              "idCustomer" => $_POST["customerSearch"],
                              "products"   => $productsList,
                              "netPrice"   => $_POST["newNetPrice"],
                );
                $answer = ModelTables::AddTableModel($table, $data);
                if ($answer == "ok") {
                    ModelSales::DeleteSalesModel('sales',$getSale['id']);
                    echo '<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Sale Successfull",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "open-tables";

								}
							})

				</script>';
                
                }
			  
            }
		}

	}

	// Delete Sales
	/**
	 * fetches the idsale from the sales table
	 * deletes sale from the table
	 * @return void
	 */
	public static function DeleteSaleController(){

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

				$getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $valueProductId, $order);

				$item1a = "sales";
				$value1a = $getProduct["sales"] - $value["quantity"];
				
				$newSales = ProductsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $valueProductId);

				$item1b = "stock";
				$value1b = $value["quantity"] + $getProduct["stock"];

				$newStock = ProductsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $valueProductId);

			}

			$tableCustomers = "customers";

			$itemCustomer = "idNumber";
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


	//date ranges
	/**
	 * 
	 * displays sales in a specific date range chosen by the user
	 * 
	 * @param mixed $initialDate
	 * @param mixed $finalDate
	 * 
	 * @return void
	 */
	public static function salesDatesRangeController($initialDate, $finalDate){

		$table = "sales";

		$answer = ModelSales::DatesRangeModel($table, $initialDate, $finalDate);

		return $answer;
		
	}


	/**
	 * Sums the total of all sales from the 
	 * sales table
	 * 
	 * @return void
	 */
	public static function sumTotalSalesController(){

		$table = "sales";

		$answer = ModelSales::sumTotalSalesModel($table);

		return $answer;

	}


	//print report to excell

	/**
	 * prints the details of a sale onto an excell sheet
	 * 
	 * @return void
	 */
	public function printReportController(){

		if(isset($_GET["report"])){

			$table = "sales";

			if(isset($_GET["initialDate"]) && isset($_GET["finalDate"])){

				$sales = ModelSales::DatesRangeModel($table,$_GET["initialDate"], $_GET["finalDate"]);

			}else{

				$item = null;
				$value = null;

				$sales = ModelSales::ShowSalesModel($table, $item, $value);


			}


			//Excel file - https://stackoverflow.com/questions/37958282/php-generate-xlsx

			$name = $_GET["report"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Excel file
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'>

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>Code</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>Customer</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Staff</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Quantity</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Products</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Discount</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NetPrice</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>Total</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>Payment Method</td	
					<td style='font-weight:bold; border:1px solid #eee;'>Sale Date</td>		
					</tr>");


			foreach ($sales as $row => $item){

				$customer = CustomerController::ShowCustomerController("id", $item["idCustomer"]);
				$staff = UserController::ShowUsersController("id", $item["idSeller"]);

			echo utf8_decode("<tr>
					<td style='border:1px solid #eee;'>".$item["code"]."</td> 
					<td style='border:1px solid #eee;'>".$customer["name"]."</td>
					<td style='border:1px solid #eee;'>".$staff["name"]."</td>
					<td style='border:1px solid #eee;'>");

				$products =  json_decode($item["products"], true);

				foreach ($products as $key => $valueproducts) {
			 			
					echo utf8_decode($valueproducts["quantity"]."<br>");

					}

				echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

				foreach ($products as $key => $valueproducts) {
						
					echo utf8_decode($valueproducts["product"]."<br>");
				
				}

				echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>".number_format($item["discount"])."%</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["netPrice"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["totalPrice"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["paymentMethod"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["saledate"],0,10)."</td>		
		 			</tr>");



			}

			
			echo "</table>";
		}

	}

}