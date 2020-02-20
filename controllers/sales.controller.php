<?php

class SalesController{

    static public function SaleController(){

		if(isset($_POST["newSale"])){

			$productsList = json_decode($_POST["productsList"], true);

			$totalPurchase = array();

			foreach ($productsList as $key => $value) {

			   array_push($totalPurchase, $value["quantity"]);
				
			   $tableProducts = "products";

			    $item = "id";
			    $valueProductId = $value["id"];
			    $order = "id";

			    $getProduct = ProductsModel::ShowProductsModel($tableProducts, $item, $valueProductId, $order);

				$item1a = "sales";
				$value1a = $value["quantity"] + $getProduct["sales"];

			    $newSales = ProductsModel::UpdateProductModel($tableProducts, $item1a, $value1a, $valueProductId);

				$item1b = "stock";
				$value1b = $value["stock"];

				$newStock = ProductsModel::UpdateProductModel($tableProducts, $item1b, $value1b, $valueProductId);

			}

			$table = "sales";

            $data = array("idSeller"=>$_POST["idSeller"],
                          "code"=>$_POST["newSale"],
						  "products"=>$_POST["productsList"],
						  "tax"=>$_POST["newSaleTotal"],
						  "netPrice"=>$_POST["netPrice"],
						  "totalPrice"=>$_POST["newSaleTotal"],
						  "paymentMethod"=>$_POST["newPaymentMethod"]);

			$answer = ModelSales::AddSaleModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "Sale Succesfully",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
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