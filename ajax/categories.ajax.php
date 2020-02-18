<?php

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class AjaxCategories{

	public $idCategory;

	public function EditCategoryAjax(){

		$item = "id";
		$value = $this->idCategory;

		$answer = ControllerCategories::ShowCategoriesController($item, $value);

		echo json_encode($answer);

	}
}

if(isset($_POST["idCategory"])){

	$category = new AjaxCategories();
	$category -> idCategory = $_POST["idCategory"];
	$category -> EditCategoryAjax();
}
