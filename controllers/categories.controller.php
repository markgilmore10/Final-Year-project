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
}