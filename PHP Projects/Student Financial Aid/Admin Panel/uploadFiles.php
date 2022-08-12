<?php
    session_start();

    require './queries/connection.php';

    if(isset($_POST["submit"])) {

        $target_dir ="uploads/files/";
        $target_file = $target_dir . basename($_FILES["pdfFile"]["name"]);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is pdf file
        if(!($fileType === 'pdf')){
            $_SESSION["error"] = "Kindly upload pdf file only.";
            header('Location: adminDownloads.php');
        }

        // Check if file already exists
        else if (file_exists($target_file)) {
            $_SESSION["error"] = "File already exists.";
            header('Location: adminDownloads.php');
        }

        // if everything is ok, try to upload file
        else {
            if(move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file)) {
                $result = $con->query("INSERT INTO download(download_source) VALUES('$target_file')");
                if ($result) {
                    $con->close();
                    header('Location: adminDownloads.php');
                } else {
                    $_SESSION["error"] = "Unable to insert file source in database!";
                    header('Location: adminDownloads.php');
                }
            } else {
                $_SESSION["error"] = "There was an error uploading your file. ";
                header('Location: adminDownloads.php');
            }
        }
    }
    
?>