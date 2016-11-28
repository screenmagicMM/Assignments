<?php
spl_autoload_register(function($class) {
    include $class . '.php';
});

/**
 * @class shopping_cart_store
 * @brief Parent class of all shopping cart stores, with default database connection support
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class shopping_cart_store {
    protected $db;

    /**
     * @fn __construct
     * @brief Constructor function
     * @details Makes a connection to the database (and saves it in $this->db)
     * @param $dbName - The database name to which the connection is to be made
     */
    protected function __construct($dbName) {
        if ($dbName == "")
            $dbName = 'shopping_cart';

        $dbArray = array(
				'host' => "localhost",
				'user' => "root",
				'password' => "root",
				'database' => $dbName
		);		
		
		$this->db = new DbConfiguration($dbArray);
    }
}
