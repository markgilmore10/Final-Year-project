<?php

class OpenTableController{

    static public function TableController(){

        // Hold Table
		if(isset($_POST["newTable"])){

			$productsList = json_decode($_POST["productsList"], true);

			$totalPurchase = array();

			foreach ($productsList as $key => $value) {

			   array_push($totalPurchase, $value["quantity"]);
				
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

			$table = "opentables";

			$data = array("code"=>$_POST["newSale"],
						  "idSeller"=>$_POST["idSeller"],
						  "tableNo"=>$_POST["tableNo"],
						  "products"=>$_POST["productsList"],
						  "netPrice"=>$_POST["newNetPrice"]);

			$answer = ModelTables::AddTableModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Table Succesfull",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "opentables";

								}
							})

				</script>';

			}

		}

    }

}