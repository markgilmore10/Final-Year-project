<?php

/**
 * Class CustomerController
 * displaying, creation, editing, deletion and searching of customers
 */
class CustomerController{

	/**
	 * fetches data from the customers table
	 * and displays the data
	 * 
     * @param mixed $item
     * @param mixed $value
     * 
     * @return void
     */
    public static function ShowCustomerController($item, $value){

		$table = "customers";

		$answer = CustomersModel::ShowCustomersModel($table, $item, $value);

		return $answer;

	}

	/**
	 * creates new customers, if all inputs are valid and do not contain any invalud chars
	 * the new customer will be created and display a success message while if anything
	 * was entered incorrectly the user will recieve an error message
	 * @return void
	 */
	public static function CreateCustomerController(){

		if(isset($_POST["newCustomer"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCustomer"]) &&
			   preg_match('/^[0-9]+$/', $_POST["newId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["newEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["newMobile"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["newAddress"])){

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

	/**
	 * Edits existing customer in the customers table,
	 * if all inputs entered to edit the customer are correct the customer will be successfully edited
	 * and the user will get a success message while if any is input incorrectly the user will recieve
	 * an error message
     * @return void
     */
    public static function EditCustomerController(){

		if(isset($_POST["editCustomer"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCustomer"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editMobile"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editAddress"])){

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
						  title: "Error Filling in Customer Details. Try Again !!",
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

	/**
	 * gets the id of the customer chosen from the customers table and deletes it
	 * success message will be displayed after deletion
     * @return void
     */
    public static function DeleteCustomerController(){

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

    /**
	 * sends a request to search for customer by Id
	 * 
     * @param mixed $request
     * 
     * @return void
     */
    public static function searchCustomer($request){
		
        return CustomersModel::searchByNumberId($request);
    }
}