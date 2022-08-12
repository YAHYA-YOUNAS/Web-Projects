<?php
    require '../queries/connection.php';

    if(isset($_POST['submit']) )
    {
        $feedback = $_POST['feedback'];

        if(!empty($feedback)) {
            $sql = "INSERT INTO feedback(feedback_description, feedback_date) VALUES('$feedback', CURDATE())";
            $result = $con->query($sql);

            if($result) {
                $con->close();
                header('Location: DonorDashboard.php');
            } 
            else {
                echo "There is problem while submitting feedback: " . $con->error;
            }
        } else {
            echo "<b>Kindly write something in the box and then submit!</b>";
        }
        
    }
?>