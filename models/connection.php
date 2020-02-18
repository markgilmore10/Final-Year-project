<?php

class Connection{

	public function connect(){

		$link = new PDO("mysql:host=localhost;dbname=restaurantpos", "root", "");

		$link -> exec("set names utf8");

		return $link;
	}

}