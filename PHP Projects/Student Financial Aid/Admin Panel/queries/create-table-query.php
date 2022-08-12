<?php  require 'connection.php';

    $sql = "CREATE TABLE admin(".
            "admin_id INT(30) NOT NULL AUTO_INCREMENT, ".
            "admin_name VARCHAR(255) NOT NULL, ".
            "admin_cnic VARCHAR(255) NOT NULL, ".
            "admin_email VARCHAR(255) NOT NULL, ".
            "admin_contact VARCHAR(255) NOT NULL, ".
            "admin_password VARCHAR(255) NOT NULL, ".
            "admin_cPassword VARCHAR(255) NOT NULL, ".
            "PRIMARY KEY ( admin_id )); ";

    if ($con->query($sql) === TRUE) {
        // echo "<H1>Table ADMIN created successfully</H1>";
    } 
    else {
        echo "<H3>Error creating table: " . $con->error . "</H3>";
    }
?>