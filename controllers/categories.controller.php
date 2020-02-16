<?php

 class ControllerCategories{

    // Create Category
	
	static public function CreateCategoryController(){

		if(isset($_POST['newCategory'])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["newCategory"])){

				$table = 'categories';

				$data = $_POST['newCategory'];

				$answer = CategoriesModel::AddCategoryModel($table, $data);
				// var_dump($answer);

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

    static public function ShowCategoriesController($item, $value){

		$table = "categories";

		$answer = CategoriesModel::ShowCategoriesModel($table, $item, $value);

		return $answer;
    }
    
    static public function EditCategoryController(){

		if(isset($_POST["editCategory"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editCategory"])){

				$table = "categories";

				$data = array("Category"=>$_POST["editCategory"],
							   "id"=>$_POST["idCategory"]);

				$answer = CategoriesModel::EditCategoryModel($table, $data);

				if($answer == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Category edited successfully",
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

}