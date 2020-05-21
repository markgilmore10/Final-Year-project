<?php

require_once "../../../controllers/sales.controller.php";
require_once "../../../models/sales.model.php";

require_once "../../../controllers/customers.controller.php";
require_once "../../../models/customer.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";

/**
 * Class printReceipt
 */
class printReceipt{

/**
 * @var undefined
 */
public $code;

/**
 * takes in data from the table and displays on a pdf using tcpdf
 * @return void
 */
public function getReceiptPrinting(){

// Sale Info
$itemSale = "code";
$saleValue = $this->code;
//$order = null;
    
$saleAnswer = SalesController::ShowSalesController($itemSale, $saleValue);

$saledate = substr($saleAnswer["saledate"],0,-8);
$products = json_decode($saleAnswer["products"], true);
// $products->results[0]->category;

// $findCategory = 1;

// $catProducts = array_filter($products, function ($product) use ($findCategory) {
//     return $product['category'] == $findCategory;
// });
// foreach ($saleAnswer as $fproducts) {
// 	//$products = json_decode($saleAnswer["products"], true);
// 	$productsf = ProductsController::ShowProductsController("id", $item["category"], $order);
// 	//$staff = UserController::ShowUsersController("id", $item["idSeller"]);
// }
// if($products == "2")
// {
// 	$products = json_decode($productsf["products"], true);
// 	var_dump($products);
// }

$netPrice = number_format($saleAnswer["netPrice"],2);
$discount = number_format($saleAnswer["discount"]);
$totalPrice = number_format($saleAnswer["totalPrice"],2);

//User Info
$itemUser = "id";
$userValue = $saleAnswer["idSeller"];

$userAnswer = UserController::ShowUsersController($itemUser, $userValue);



require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

//blocks made to 540px as the pdf is 540px wide

$block1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-cellar.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					ADDRESS: 12 Eglinton St, Galway

                    <br>
                    EIRCODE: H91 D278
					
				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					PHONE: (091) 563 966
					
					<br>
					thecellar.ie

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>Rec N.<br>$saleValue</td>

			


		</tr>

	</table>

EOF;

$pdf->writeHTML($block1, false, false, false, false, '');

//------------------------------------------------------------------------------------------------------//

$block2 = <<<EOF


    <table>
            
        <tr>
            
            <td style="width:540px"><img src="images/back.jpg"></td>

        </tr>

    </table>

    <table style="font-size:10px; padding:5px 10px;">

        <tr>

            <td style="border: 1px solid #666; background-color:white; width:390px">

				Staff Member: $userAnswer[name]

            </td>

            <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Date: $saledate

            </td>
            
        </tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>
    
    </table>

EOF;

$pdf->writeHTML($block2, false, false, false, false, '');

$block3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Product</td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Quantity</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Item Cost</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Total Price</td>

		</tr>

	</table>


EOF;

$pdf->writeHTML($block3, false, false, false, false, '');

////

foreach ($products as $key => $item) {

$itemProduct = "product";
$productValue = $item["product"];
//$order = null;

$answerProduct = ProductsController::ShowProductsController($itemProduct, $productValue, $order); 

$unitValue = number_format($answerProduct["sellingPrice"], 2);

$totalProducts = number_format($item["totalPrice"], 2);

$block4 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[product]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[quantity]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$unitValue
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$totalProducts
			</td>


		</tr>

	</table>


	

EOF;

$pdf->writeHTML($block4, false, false, false, false, '');

}

////

$block5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				€ $netPrice
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Discount:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$discount%
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Net:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				€ $totalPrice
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($block5, false, false, false, false, '');


ob_end_clean();
$pdf->Output('receipt.pdf');

}


}


$receipt = new printReceipt();
$receipt -> code = $_GET["code"];
$receipt -> getReceiptPrinting();

?>