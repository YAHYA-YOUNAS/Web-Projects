<?php  require 'connection.php';

    // ------------------------------------- for donor -------------------------------------------------

    $sql = "DELETE FROM donor where donor_id= 3";
    $result = $con->query($sql);

    if ($result === TRUE) {
        echo "<h3>Record has been deleted successfully</h3>";
    } 
    else {
        echo "There is problem while deleting record: " . $con->error;
    }
    
?>