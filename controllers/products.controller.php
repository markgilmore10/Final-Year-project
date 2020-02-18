<?php

class productsController{
	
	static public function ShowProductsController($item, $value){

		$table = "products";

		$answer = productsModel::ShowProductsModel($table, $item, $value);

		return $answer;

    }
}