<?php
    require '../queries/connection.php';

    $sql = $con->query("SELECT scholarship_title, scholarship_image FROM scholarship");

    if ($sql->num_rows > 0) {
        while ($record = $sql->fetch_assoc()) {

            $scholarship_title = $record["scholarship_title"];
            $scholarship_image = $record["scholarship_image"];
    ?>
            <div class="form_img">
                <?php echo '<img src="data:image/jpeg;base64, ' . base64_encode($scholarship_image) . '"/>'; ?>
            </div>
            <div class="message">
                <button type="button"><a href="../downloadfile.php?title=<?php echo $record['scholarship_title']; ?>">Download</a></button>
                <p><?php echo $scholarship_title; ?> Scholarship</p>
            </div> <br><br>
    <?php }
    } else {
        echo "Record not found!";
}
?>