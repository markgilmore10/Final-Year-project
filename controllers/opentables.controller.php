<?php

class OpenTableController{

	// Show Sales
    public static function ShowTableController($item, $value){

		$table = "open_tables";

		$answer = ModelTables::ShowTablesModel($table, $item, $value);

		return $answer;

	}

    // public static function TableController(){

    //     // Hold Table
	// 	if(isset($_POST["openTable"])){

	// 		$productsList = json_decode($_POST["productsList"], true);

	// 		$totalPurchase = array();

	// 		foreach ($productsList as $key => $value) {

	// 		   array_push($totalPurchase, $value["quantity"]);
				
	// 		   $tableProducts = "products";

	// 		    $item = "id";
	// 		    $valueProductId = $value["id"];
	// 		    $order = "id";

	// 		    $getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $valueProductId, $order);

	// 			$item1 = "sales";
	// 			$value1 = $value["quantity"] + $getProduct["sales"];

	// 		    $newSales = ProductsModel::UpdateProductModel($tableProducts, $item1, $value1, $valueProductId);

	// 			$item2 = "stock";
	// 			$value2 = $value["stock"];

	// 			$newStock = ProductsModel::UpdateProductModel($tableProducts, $item2, $value2, $valueProductId);

	// 		}

	// 		$table = "opentables";

	// 		$data = array("code"=>$_POST["newSale"],
	// 					  "idSeller"=>$_POST["idSeller"],
	// 					  "tableNo"=>$_POST["tableNo"],
	// 					  "products"=>$_POST["productsList"],
	// 					  "netPrice"=>$_POST["newNetPrice"]);

	// 		$answer = ModelTables::AddTableModel($table, $data);

	// 		if($answer == "ok"){

	// 			echo'<script>

	// 			localStorage.removeItem("range");

	// 			swal({
	// 				  type: "success",
	// 				  title: "Table on Hold",
	// 				  showConfirmButton: true,
	// 				  confirmButtonText: "Close"
	// 				  }).then((result) => {
	// 							if (result.value) {

	// 							window.location = "opentables";

	// 							}
	// 						})

	// 			</script>';

	// 		}

	// 	}

	// }
	
	public static function index () {
        return ModelTables::all();
    }

}