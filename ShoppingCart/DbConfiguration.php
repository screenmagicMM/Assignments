<?php
/**
 * @class DbConfiguration
 * @brief Class having all Database related common functions
 * @author Nidhi Agarwal
 * @date 2016-11-26
 */
class DbConfiguration {

	private $dbCon;

	/**
     * @fn __construct
     * @brief Constructor function
     * @param $dbArray - array of database parameters
     * @subparam $host - server name on which database is residing
     * @subparam $user - user name to connect the database
     * @subparam $password - password to connect the database
     * @subparam $database - database name
     * @details sets host, username, password, database name
     */
	public function __construct($dbArray) {
		extract($dbArray);

		$dbHost = isset($host) ? $host: "localhost";
		$dbUser = isset($user) ? $user: "root";
		$dbPassword = isset($password) ? $password : "root";
		$dbName = isset($database) ? $database : "shopping_cart";

		$this->dbConnect($dbHost, $dbUser, $dbPassword);
		$this->dbSelect($dbName);
	}

	/**
     * @fn __construct
     * @brief Constructor function
     * @param $dbArray - array of database parameters
     * @subparam $host - server name on which database is residing
     * @subparam $user - user name to connect the database
     * @subparam $password - password to connect the database
     * @subparam $database - database name
     * @details sets host, username, password, database name
     */
	private function dbConnect($dbHost, $dbUser, $dbPassword) {
        $this->dbCon = mysql_connect($dbHost, $dbUser, $dbPassword);
	}

	/**
     * @fn dbSelect
     * @brief sets the database name
     * @param $dbName - database name
     */
	private function dbSelect($dbName) {
		mysql_select_db($dbName, $this->dbCon);
	}

	/**
     * @fn dbQuery
     * @brief makes a query to the database
     * @param $query - sql query
     * @result mysql resource
     */
	public function dbQuery($query) {
		$resQuery = mysql_query($query, $this->dbCon) or die("died.....".mysql_error($query));
		return $resQuery;
	}
}
