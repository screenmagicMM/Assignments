<?php
class connection{
    public function db(){
        $mysqli = new mysqli("localhost", "root", "", "rest_api");

        /* check connection */
        if($mysqli->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            return $mysqli;
        }
    }
}

?>