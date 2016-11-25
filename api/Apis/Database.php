<?php 
class Database {
    // The database connection variable
    protected static $connection;

	/* connecting to db */
    public function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {
            // Load co$mysql_hostname = "localhost";
            self::$connection = new mysqli('localhost',"root","",'test');
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
		//print_r( self::$connection); 
        return self::$connection;
    }

    /* Query the database     */
    public function query($query) {
    echo $query;
		// Connect to the database
        $connection = $this -> connect();
		
        // Query the database
        $result = $connection -> query($query);
		//echo 'error'.$connection -> error;
	 
        return $result;
    }

    /* Fetch rows from the database (SELECT query)     */
    public function select($query) { 
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /* Fetch the last error from the database */
    public function error() {
        $connection = $this -> connect();
		echo $connection -> error;
        return $connection -> error;
    }

    /* Quote and escape value     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }
}