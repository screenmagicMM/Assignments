<?php

spl_autoload_register(function($class) {
    include $class . '.php';
});

/**
 * @class product_store
 * @brief class to control every interactions to product table
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class product_store extends shopping_cart_store {

	/**
     * @fn __construct
     * @brief Constructor function
     * @details Calls parent class's constructor with the name of the database as parameter
     */
	function __construct() {
		parent::__construct("shopping_cart");
	}

	/**
     * @fn getProducts
     * @details Creates an array of products corresponding to a category
     * @param $category - category id for which products needs to fetched
     * @return array of products
     */
	function getProducts($category) {
		$sqlSelect = "SELECT product_id, product_name FROM product WHERE category_id = $category";

        $resSelect = $this->db->dbQuery($sqlSelect);

		$arrProducts = array();

		while ($product = mysql_fetch_assoc($resSelect)) {
			array_push($arrProducts, $product);
		}

		return $arrProducts;
	}

	/**
     * @fn addProduct
     * @details Makes an entry of product details
     * @param $arrProductDetails - array of product details
     * @subparam $product_name - product name
     * @subparam $product_desc - product description
     * @subparam $price - product price
     * @subparam $tax - tax on the product (in percentage)
     * @subparam $discount - discount on the product (in percentage)
     * @subparam $category_id - category for which the product belongs
     */
	function addProduct($arrProductDetails) {
		extract($arrProductDetails);

        $sqlInsert = "INSERT INTO product (product_name, product_desc, price, tax, discount, category_id) 
				VALUES 
					('". addslashes($product_name) ."', '". addslashes($product_desc) ."', '". $price ."', '". $tax ."', '". $discount ."', '". $category_id ."')";

		$this->db->dbQuery($sqlInsert);
	}
} 