<?php

/**
 * Class ControllerCategories
 */
 class ControllerCategories{

    // Create Category
	
	/**
	 * @return void
	 */
	public static function CreateCategoryController(){

		if(isset($_POST['newCategory'])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["newCategory"])){

				$table = 'categories';

				$data = array("category"=>$_POST["newCategory"],
							  "vat"=>$_POST["newVat"],
							  "tax"=>$_POST["newTax"]);

				$answer = CategoriesModel::AddCategoryModel($table, $data);

				if($answer == 'ok'){

					echo '<script>
						
						swal({
							type: "success",
							title: "Category created successfully",
							showConfirmButton: true,
							confirmButtonText: "Close"

							}).then(function(result){
								if (result.value) {

									window.location = "categories";

								}
							});
						
					</script>';
				}
				

			}else{

				echo '<script>
						
						swal({
							type: "error",
							title: "Please fill in all fields, no special characters allowed",
							showConfirmButton: true,
							confirmButtonText: "Close"
				
							 }).then(function(result){

								if (result.value) {
									window.location = "categories";
								}
							});
						
				</script>';
				
			}
		}
    }

    // Show Categories
    /**
     * @param mixed $item
     * @param mixed $value
     * 
     * @return void
     */
    public static function ShowCategoriesController($item, $value){

		$table = "categories";

		$answer = CategoriesModel::ShowCategoriesModel($table, $item, $value);

		return $answer;
    }
    
    /**
     * @return void
     */
    public static function EditCategoryController(){

		if(isset($_POST["editCategory"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editCategory"])){

				$table = "categories";

				$data = array("Category"=>$_POST["editCategory"],
							   "id"=>$_POST["idCategory"],
							   "Vat"=>$_POST["newVat"],
							   "Tax"=>$_POST["newTax"]);

				$answer = CategoriesModel::EditCategoryModel($table, $data);

				if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Category Edited Successfully",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Please fill in all fields, no special characters allowed",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "categories";

							}
						})

			  	</script>';

			}

		}

    }
    
    /**
     * @return void
     */
    public static function DeleteCategoryController(){

		if(isset($_GET["idCategory"])){

			$table ="categories";
			$data = $_GET["idCategory"];

			$answer = CategoriesModel::DeleteCategoryModel($table, $data);
			// var_dump($answer);

			if($answer == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Category successfully deleted",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';
			}
		
		}
		
	}

}