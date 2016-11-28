<?php
spl_autoload_register(function($class) {
    include $class . '.php';
});

/**
 * @class cart_store
 * @brief class to control every interactions to cart table
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class cart_store extends shopping_cart_store {

	/**
     * @fn __construct
     * @brief Constructor function
     * @details Calls parent class's constructor with the name of the database as parameter
     */
	function __construct() {
		parent::__construct("shopping_cart");
	}

	/**
     * @fn getCart
     * @details Creates an array of cart for a particular user
     * @param $user_id - User name for which the cart will be displayed
     * @return array of cart
     */
	function getCart($user_id) {
		$sqlSelect = "	SELECT 	a4.user_name as cart_name,
								a3.product_name as product,
						        count(a1.product_id) as quantity,
						        sum(a3.price) as total_price,
						        sum((a3.price * a3.discount)/100) as discount,
						        sum(((a3.price - ((a3.price * a3.discount)/100)) * a3.tax)/100) as tax
						from cart as a1
						Join category as a2 on a1.category_id = a2.category_id
						join product as a3 on a1.product_id = a3.product_id
						join user as a4 on a1.user_id = a4.user_id
						where 	a1.user_id = ". $user_id
								." and a1.checkout_flag = 0
						GROUP by a4.user_name,
								a3.product_name";

		$resSelect = $this->db->dbQuery($sqlSelect);

		$arrCart = array();

		while ($cart = mysql_fetch_assoc($resSelect)) {
			array_push($arrCart, $cart);
		}
		return $arrCart;
	}

	/**
     * @fn setCart
     * @details Makes an entry of product and category in cart table
     * @param $user_id - user id of the user who is creating the cart
     * @param $product - selected product
     * @param $category_name - seelcted category
     */
	function setCart($user_id, $product, $category_name) {
		$sqlInsert = "INSERT INTO cart (user_id, product_id, category_id) 
						VALUES 
							($user_id, $product, $category_name)";
		$this->db->dbQuery($sqlInsert);
	}
} 
