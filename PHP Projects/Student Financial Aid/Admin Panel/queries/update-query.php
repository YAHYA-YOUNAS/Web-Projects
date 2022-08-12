<?php  require 'connection.php';

    $sql = "UPDATE admin SET admin_name= 'Yahya',
            admin_email= 'yahya@gmail.com' WHERE admin_id= 1";

    $result = $con->query($sql);

    if ($result === TRUE) {
        // echo "<h3>Record updated successfully</h3>";
        $_SESSION["notify"] = "<h3>Admin's record has been updated.</h3>";
    } 
    else {
        echo "There is problem while updating values: " . $con->error;
    }
    
?>