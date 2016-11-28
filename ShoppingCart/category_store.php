<?php

spl_autoload_register(function($class) {
    include $class . '.php';
});

/**
 * @class category_store
 * @brief class to control every interactions to category table
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class category_store extends shopping_cart_store {

	/**
     * @fn __construct
     * @brief Constructor function
     * @details Calls parent class's constructor with the name of the database as parameter
     */
	function __construct() {
		parent::__construct("shopping_cart");
	}

	/**
     * @fn getCategory
     * @details Creates an array of categories
     * @return array of categories
     */
	function getCategory() {
		$sqlSelect = "SELECT category_id, category_name, category_desc FROM category";

        $resSelect = $this->db->dbQuery($sqlSelect);

		$arrCategory = array();

		while ($category = mysql_fetch_assoc($resSelect)) {
			array_push($arrCategory, $category);
		}
		return $arrCategory;
	}

	/**
     * @fn setUser
     * @details Makes an entry of category name and description
     * @param $category_name - category name
     * @param $category_desc - category description
     */
	function setCategory($category_name, $category_desc) {
		$sqlInsert = "INSERT INTO category (category_name, category_desc) 
						VALUES 
							('". addslashes($category_name) ."', '". addslashes($category_desc) ."' )";
        $this->db->dbQuery($sqlInsert);
	}
} 
