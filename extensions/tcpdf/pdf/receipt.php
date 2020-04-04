<?php

require_once "../../../controllers/sales.controller.php";
require_once "../../../models/sales.model.php";

require_once "../../../controllers/customers.controller.php";
require_once "../../../models/customer.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";

class printReceipt{

public $code;

public function getReceiptPrinting(){

// Sale Info
$itemSale = "code";
$saleValue = $this->code;
    
$answerSale = SalesController::ShowSalesController($itemSale, $saleValue);

$saledate = substr($answerSale["saledate"],0,-8);
$products = json_decode($answerSale["products"], true);
$netPrice = number_format($answerSale["netPrice"],2);
$tax = number_format($answerSale["tax"],2);
$totalPrice = number_format($answerSale["totalPrice"],2);

// Customer Info
$itemCustomer = "id";
$CustomerValue = $answerSale["customerId"];

$answerCustomer = CustomerController::ShowCustomerController($itemCustomer, $valueCustomer);

//User Info
$itemUser = "id";
$userValue = $answerSale["userId"];

$answerUser = ControllerUsers::ShowUsers($itemUser, $userValue);



require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

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

    <table style="font-size:10px; padding:5px 10px;">

        <tr>

            <td style="border: 1px solid #666; background-color:white; width:390px">

				Customer: $answerCustomer[name]

            </td>

            <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Date: $saledate

			</td>
            
        </tr>
    
    </table>

EOF;

$pdf->writeHTML($block2, false, false, false, false, '');

ob_end_clean();
$pdf->Output('receipt.pdf');

}


}


$receipt = new printReceipt();
$receipt -> code = $_GET["code"];
$receipt -> getReceiptPrinting();

?>