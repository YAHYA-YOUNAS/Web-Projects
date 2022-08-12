<?php  require 'connection.php';
    // ----------------------------- for donor table -------------------------------------------
    // $sql = "CREATE TABLE donor(".
    //         "donor_id INT(30) NOT NULL AUTO_INCREMENT, ".
    //         "donor_name VARCHAR(255) NOT NULL, ".
    //         "donor_cnic VARCHAR(255) NOT NULL, ".
    //         "donor_email VARCHAR(255) NOT NULL, ".
    //         "donor_contact VARCHAR(255) NOT NULL, ".
    //         "donor_category VARCHAR(255) NOT NULL, ".
    //         "donor_organization VARCHAR(255) NOT NULL, ".
    //         "donor_password VARCHAR(255) NOT NULL, ".
    //         "donor_cPassword VARCHAR(255) NOT NULL, ".
    //         "donor_business_name VARCHAR(255) NOT NULL, ".
    //         "donor_address VARCHAR(255) NOT NULL, ".
    //         "donor_city VARCHAR(255) NOT NULL, ".
    //         "donor_zip INT(255) NOT NULL, ".
    //         "donor_amount INT(255) NOT NULL, ".
    //         "donor_payment_method VARCHAR(255) NOT NULL, ".
    //         "PRIMARY KEY ( donor_id )); ";

    // if ($con->query($sql) === TRUE) {
    //      echo "<H1>Table Donor created successfully</H1>";
    // } 
    // else {
    //     echo "<H3>Error creating table: " . $con->error . "</H3>";
    // }


    // ----------------------------- for student table -------------------------------------------
    $sql = "CREATE TABLE student(".
            "student_id INT(30) NOT NULL AUTO_INCREMENT, ".
            "student_name VARCHAR(255) NOT NULL, ".
            "student_dob DATE NOT NULL, ".
            "student_email VARCHAR(255) NOT NULL, ".
            "student_contact VARCHAR(255) NOT NULL, ".
            "student_password VARCHAR(255) NOT NULL, ".
            "student_cPassword VARCHAR(255) NOT NULL, ".
            "student_applied_for VARCHAR(255) NOT NULL, ".
            "student_cnic VARCHAR(255) NOT NULL, ".
            "student_address VARCHAR(255) NOT NULL, ".
            "student_profession VARCHAR(255) NOT NULL, ".
            "student_income INT(255) NOT NULL, ".
            "student_family_income INT(255) NOT NULL, ".
            "student_expenditure INT(255) NOT NULL, ".
            "PRIMARY KEY ( student_id )); ";

    if ($con->query($sql) === TRUE) {
         echo "<H1>Table Student created successfully</H1>";
    } 
    else {
        echo "<H3>Error creating table: " . $con->error . "</H3>";
    }
    

    

    
?>