<?php
    require './queries/connection.php';

    $result = $con->query("SELECT * FROM gallery");

    if($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) { ?>

            <div class="w3-content w3-section" style="max-width:500px">
                <img class="mySlides w3-animate-fading" src="../Admin Panel/<?php echo $row['gallery_source'] ?>" style="width:100%; height: 250px;">
            </div>

        <?php 
        }
    }

    else {
        echo "No images found!";
    } 
?>