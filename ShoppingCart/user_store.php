<?php

spl_autoload_register(function($class) {
    include $class . '.php';
});

/**
 * @class user_store
 * @brief class to control every interactions to user table
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class user_store extends shopping_cart_store {

	/**
     * @fn __construct
     * @brief Constructor function
     * @details Calls parent class's constructor with the name of the database as parameter
     */
	function __construct() {
		parent::__construct("shopping_cart");
	}

	/**
     * @fn getUser
     * @details Creates an array of user id and user name
     * @return array of users
     */
	function getUser() {
		$sqlSelect = "SELECT user_id, user_name FROM user";

        $resSelect = $this->db->dbQuery($sqlSelect);

		$arrUsers = array();

		while ($user = mysql_fetch_assoc($resSelect)) {
			array_push($arrUsers, $user);
		}
		return $arrUsers;
	}

	/**
     * @fn setUser
     * @details Makes an entry of username
     * @param $user_name - user name of the user
     */
	function setUser($user_name) {
		$sqlInsert = "INSERT INTO user (user_name) 
						VALUES 
							('". $user_name ."')";
        $this->db->dbQuery($sqlInsert);
	}
} 
