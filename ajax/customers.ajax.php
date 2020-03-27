<?php

require_once "../controllers/customers.controller.php";
require_once "../models/customer.model.php";

class CustomerAjax{

	public $idCustomer;

	public function EditCustomerAjax(){

		$item = "id";
		$value = $this->idCustomer;

		$answer = CustomerController::ShowCustomerController($item, $value);

		echo json_encode($answer);


	}

	public function searchCustomer ($request) {
        
        $customers = CustomerController::searchCustomer($request);
        
        if ($customers) {
            
            foreach ($customers as $customer) {

				echo '<div class="customer_row" data-id="' . $customer->id . '" data-discount="' . $customer->discount . '" >' +
				
					 '<div class="name">' . $customer->name . '</div>' +
					
					 '<div class="number">' . $customer->idNumber . '</div>' +
					
                     '</div>';
            }
            
        } else {

			echo '<div class="customer_row" data-id="">' +
			
				 '<div class="name">No data found</div>' +
				 
				 '<div class="number"></div>' +
				 
                 '</div>';
        }
         
    }

}

if(isset($_POST["idCustomer"])) {

	$Customer = new CustomerAjax();
	$Customer -> idCustomer = $_POST["idCustomer"];
	$Customer -> EditCustomerAjax();

}

if (isset($_POST["search"]) && isset($_POST["number"])) {

    $Customer = new CustomerAjax();
	$Customer->searchCustomer($_POST["number"]);
	
}