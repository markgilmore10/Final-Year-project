<?php

header("refresh:20"); 

require_once "../../../controllers/opentables.controller.php";
require_once "../../../models/opentables.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";
/**
 * Class printDrinkReceipt
 */
class printDrinkReceipt{

/**
 * @var undefined
 */
public $code;

/**
 * takes in data from the table and displays on a pdf using tcpdf
 * @return void
 */
public function getDrinkReceiptPrinting(){

// Sale Info
$itemSale = "code";
$saleValue = $this->code;
    
$saleAnswer = OpenTableController::ShowTableController($itemSale, $saleValue);

$saledate = substr($saleAnswer["date"],0,-8);
$products = json_decode($saleAnswer["products"], true);

$findCategory = 2;

$catProducts = array_filter($products, function ($product) use ($findCategory) {
    return $product['category'] == $findCategory;
});

$netPrice = number_format($saleAnswer["netPrice"],2);

//User Info
$itemUser = "id";
$userValue = $saleAnswer["idSeller"];

$userAnswer = UserController::ShowUsersController($itemUser, $userValue);



require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

//blocks made to 540px as the pdf is 540px wide
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

			<td style="border: 1px solid #666; background-color:white; width:50%; text-align:center">Product</td>
			<td style="border: 1px solid #666; background-color:white; width:50%; text-align:center">Quantity</td>

		</tr>

	</table>


EOF;

$pdf->writeHTML($block3, false, false, false, false, '');

////

foreach ($catProducts as $key => $item) {

$itemProduct = "product";
$productValue = $item["product"];
$order = null;

$answerProduct = ProductsController::ShowProductsController($itemProduct, $productValue, $order);

$block4 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:50%; text-align:center">
				$item[product]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:50%; text-align:center">
				$item[quantity]
			</td>

		</tr>

	</table>


	

EOF;

$pdf->writeHTML($block4, false, false, false, false, '');


}

ob_end_clean();
$pdf->Output('receipt.pdf');

}


}


$receipt = new printDrinkReceipt();
$receipt -> code = $_GET["code"];
$receipt -> getDrinkReceiptPrinting();

?>