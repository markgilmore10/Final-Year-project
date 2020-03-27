<?php

class CustomerController{

    static public function ShowCustomerController($item, $value){

		$table = "customers";

		$answer = CustomersModel::ShowCustomersModel($table, $item, $value);

		return $answer;

	}

	static public function CreateCustomerController(){

		if(isset($_POST["newCustomer"])){

			if(//preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCustomer"]) &&
			   preg_match('/^[0-9]+$/', $_POST["newId"])){ // &&
			   //preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["newEmail"]) && 
			   //preg_match('/^[()\-0-9 ]+$/', $_POST["newMobile"]) && 
			   //preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["newAddress"])){

			   	$table = "customers";

			   	$data = array("name"=>$_POST["newCustomer"],
					           "idNumber"=>$_POST["newId"],
					           "email"=>$_POST["newEmail"],
					           "mobile"=>$_POST["newMobile"],
					           "address"=>$_POST["newAddress"],
                               "dob"=>$_POST["newDob"],
                               "discount"=>$_POST["newDiscount"]);

			   	$answer = CustomersModel::AddCustomerModel($table, $data);

			   	if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Saved",
						  showConfirmButton: true,
						  confirmButtonText: "Confirm"
						  }).then(function(result){
									if (result.value) {

									window.location = "customers";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Please Fill in all Customer Details",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "customers";

							}
						})

			  	</script>';

			}

		}

    }

    static public function EditCustomerController(){

		if(isset($_POST["editCustomer"])){

			if(//preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCustomer"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editId"])){ // &&
			   //preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editEmail"]) && 
			   //preg_match('/^[()\-0-9 ]+$/', $_POST["editMobile"]) && 
			   //preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editAddress"])){

			   	$table = "customers";

                   $data = array("id"=>$_POST["idCustomer"],
                               "name"=>$_POST["editCustomer"],
					           "idNumber"=>$_POST["editId"],
					           "email"=>$_POST["editEmail"],
					           "mobile"=>$_POST["editMobile"],
					           "address"=>$_POST["editAddress"],
                               "dob"=>$_POST["editDob"],
                               "discount"=>$_POST["editDiscount"]);

			   	$answer = CustomersModel::EditCustomerModel($table, $data);

			   	if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Saved",
						  showConfirmButton: true,
						  confirmButtonText: "Confirm"
						  }).then(function(result){
									if (result.value) {

									window.location = "customers";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Please Fill in all Customer Details",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "customers";

							}
						})

			  	</script>';

			}

		}

    }

    static public function DeleteCustomerController(){

		if(isset($_GET["idCustomer"])){

			$table ="customers";
			$data = $_GET["idCustomer"];

			$answer = CustomersModel::DeleteCustomerModel($table, $data);

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then(function(result){
								if (result.value) {

								window.location = "customers";

								}
							})

				</script>';

			}		

		}

	}
    
    static public function searchCustomer($request){
		
        return CustomersModel::searchByNumberId($request);
    }
}