<?php

class OpenTableController{

	// Show Sales
    public static function ShowTableController($item, $value){

		$table = "open_tables";

		$answer = ModelTables::ShowTablesModel($table, $item, $value);

		return $answer;

	}
	
	public static function index () {
        return ModelTables::all();
    }
    
    public function ReopenTable () {
        // Make Sale
        if(isset($_POST["openTable"])){
        
            $table = "open_tables";
        
            $item = "code";
            $value = $_POST["reopenTable"];
        
            $getSale = ModelTables::ShowTablesModel($table, $item, $value);

            // if statement checking if the sale was actually changed

            if($_POST["productsList"] == ""){

                $productsList = $getSale["products"];
           
				$productChange = false;


			}else{

                $productsList = $_POST["productsList"];

				$productChange = true;
			}
        
            if($productChange){
 
                $products = json_decode($getSale["products"], true);
 
                $totalPurchasedProducts = array();
            
                foreach ($productsList as $key => $value) {
                
                    array_push($totalPurchasedProducts, $value["quantity"]);
                
                    $tableProducts = "products";
                
                    $item = "id";
                    $value = $value["id"];
                    $order = "id";
                
                    $getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $value, $order);
                
                    $item1a = "sales";
                    // $value1a_2 = $value["quantity"] + $getProduct_2["sales"];
                    $value1a = $getProduct_2["sales"] - $value["quantity"];
                    $newSales = ProductsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $value);
                
                    $item1b = "stock";
                    // $value1b_2 = $getProduct_2["stock"] - $value["quantity"];
                    $value1b = $value["quantity"] + $getProduct["stock"];
                    $newStock = ProductsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $value);
                
                }

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
            
                
        }
       
				$data = array("code"=>$_POST["reopenTable"],
                          "idSeller"=>$_POST["idSeller"],
                          "tableNo"=>$_POST["tableNo"],
                          "products"=>$productsList,
                          "netPrice"=>$_POST["newNetPrice"]);

            	$answer = ModelTables::UpdateTableModel($table, $data);
		
        
            if($answer == "ok"){
            
                echo'<script>

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
        }elseif(isset($_POST["newPaymentMethod"])) {
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
    
            $table1 = "open_tables";
            $table2 = "sales";
    
            $data = array("code"=>$_POST["reopenSale"],
							"idSeller"=>$_POST["idSeller"],
							"tableNo"=>$_POST["tableNo"],
							"idCustomer"=>$_POST["customerSearch"],
							"products"=>$productsList,
							"netPrice"=>$_POST["newNetPrice"],
							"discount"=>$_POST["newDiscountSale"],
							"totalPrice"=>$_POST["newSaleTotal"],
							"paymentMethod"=>$_POST["newPaymentMethod"]);

				$answer = ModelSales::ReopenSaleModel($table1, $table2, $data);
    
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

				$getProduct = productsModel::ShowProductsModel($tableProducts, $item, $valueProductId, $order);

				$item1a = "sales";
				$value1a = $getProduct["sales"] - $value["quantity"];
				
				$newSales = productsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $valueProductId);

				$item1b = "stock";
				$value1b = $value["quantity"] + $getProduct["stock"];

				$newStock = productsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $valueProductId);

			}

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

