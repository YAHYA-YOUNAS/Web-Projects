<?php  require 'connection.php';

    $sql = "DELETE FROM admin where admin_id= 7";
    $result = $con->query($sql);

    if ($result === TRUE) {
        // echo "<h3>Record has been deleted successfully</h3>";
        $_SESSION["notify"] = "<h3>Admin's record has been deleted.</h3>";
    } 
    else {
        echo "There is problem while deleting record: " . $con->error;
    }
    
?>