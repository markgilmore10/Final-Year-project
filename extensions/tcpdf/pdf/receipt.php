<?php

require_once "../../../controllers/sales.controller.php";
require_once "../../../models/sales.model.php";

class printReceipt{

public $code;

public function getReceiptPrinting(){

$itemSale = "code";
$saleValue = $this->code;
    
$answerSale = SalesController::ShowSalesController($itemSale, $saleValue);



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


ob_end_clean();
$pdf->Output('receipt.pdf');

}


}


$receipt = new printReceipt();
$receipt -> code = $_GET["code"];
$receipt -> getReceiptPrinting();

?>