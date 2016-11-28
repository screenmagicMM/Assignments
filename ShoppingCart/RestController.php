<?php

/*
/**
 * @file RestController.php
 * @brief controls the RESTful services of Shopping Cart
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */

spl_autoload_register(function($class) {
    include $class . '.php';
});
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];

$shoppingCartRestHandler = new ShoppingCart();

switch($view){

	case "listcategory":
		// to handle REST Url /category/
		$shoppingCartRestHandler->ListCategories();
		break; 
		
	case "addcategory":
		// to handle REST Url /addcategory/<id>/
		$shoppingCartRestHandler->AddCategory();
		break;

	case "addproduct":
		// to handle REST Url /addproduct/<id>/
		$shoppingCartRestHandler->AddProduct();
		break;

	case "listproducts":
		// to handle REST Url /listproducts/<id>/
		$shoppingCartRestHandler->ListProducts();
		break;

	case "createcart":
		// to handle REST Url /createcart/<id>/
		$shoppingCartRestHandler->CreateCart();
		break;

	case "showcart":
		// to handle REST Url /showcart/<id>/
		$shoppingCartRestHandler->ShowCart();
		break;

	case "" :
		//404 - not found;
		break;
}
?>

