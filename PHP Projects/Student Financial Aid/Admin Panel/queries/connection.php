<?php

    $con = mysqli_connect("localhost", "root", "", "sfa");
    if (!$con) {
        die ("Could not connect: ". mysqli_connect_error() . "<br>");
    } else {
        // echo "Connection established successfully!!! <br>";
    }

?>