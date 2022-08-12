<?php  require 'connection.php';

    // ------------------------------------- for donor -------------------------------------------------

    $sql = "SELECT donor_name, donor_cnic, donor_email, donor_contact, donor_category, donor_organization,
            donor_password, donor_cPassword FROM donor";

    $result = $con->query($sql);

    if($result->num_rows > 0 ) {
        while($row = $result->fetch_assoc()) {
            echo "<br><b>Name: </b>" .$row["donor_name"]. "<br><b>CNIC: </b>" . $row["donor_cnic"]. "<br><b>Email: </b>" .
            $row["donor_email"]. "<br><b>Contact: </b>" . $row["donor_contact"]. "<br><b>Category: </b>" . $row["donor_category"].
            "<br><b>Organization: </b>" . $row["donor_organization"]. "<br><b>Password: </b>" . $row["donor_password"]. 
            "<br><b>Confirm Password: </b>" . $row["donor_cPassword"]. "<br><br>";
        }
    }
    else {
        echo "No results found!";
    }

?>