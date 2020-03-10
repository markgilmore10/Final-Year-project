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

}

if(isset($_POST["idCustomer"])){

	$Customer = new CustomerAjax();
	$Customer -> idCustomer = $_POST["idCustomer"];
	$Customer -> EditCustomerAjax();

}