<?php

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

/**
 * Class AjaxCategories
 */
class AjaxCategories{

	/**
	 * @var undefined
	 */
	public $idCategory;

	/**
	 *  uses the category id to find category to edit
	 * @return void
	 */
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
