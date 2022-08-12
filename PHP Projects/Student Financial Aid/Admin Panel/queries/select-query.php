<?php  require 'connection.php';

    $sql = "SELECT * FROM admin";

    $result = $con->query($sql);

    if($result->num_rows > 0 ) {
        while($row = $result->fetch_assoc()) {
            echo "<br><b>Name: </b>" .$row["admin_name"]. "<br><b>CNIC: </b>" . $row["admin_cnic"]. "<br><b>Email: </b>" .
            $row["admin_email"]. "<br><b>Contact: </b>" . $row["admin_contact"]. "<br><b>Password: </b>" . 
            $row["admin_password"]."<br><b>Confirm Password: </b>" . $row["admin_cPassword"]. "<br><br>";
        }
    }
    else {
        echo "No results found!";
    }

?>