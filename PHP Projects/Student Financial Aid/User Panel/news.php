<?php
    require './queries/connection.php';

    // Scholarship Table

    $sql = $con->query("SELECT scholarship_title FROM scholarship");

    if ($sql->num_rows > 0) {
        while ($record = $sql->fetch_assoc()) { ?>
            <p><a href="Scholarships.php"><?php echo $record["scholarship_title"] ?> Scholarship</a></p>
    <?php }
    } else {
        echo "Record not found!";
    }
?>