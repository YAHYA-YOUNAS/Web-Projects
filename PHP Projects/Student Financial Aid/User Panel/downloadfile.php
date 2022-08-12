<?php
    require './queries/connection.php';

    $title = $_GET['title'];

    $sql = $con->query("SELECT * FROM download");                          // fetch all sources from download table

    $pattern = "/$title/i";                                              // making title of scholarship as a pattern for regex

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {    
            if (preg_match($pattern, $row["download_source"]) === 1) {       // matching scholarship title and source of each download file
                $source = $row["download_source"];                
            }
        }

        $str = $source;
        $name = explode("/",$str);                                          // getting name of file
        $filename = $name[2];

        $fileName = basename($filename);                                

        $filePath = "../Admin Panel/uploads/files/" .$fileName;                   // specifying path of download file

        // download file script

        if(!empty($fileName) && file_exists($filePath)) {                   
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename=' .$fileName);
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
            
        } else {
            echo "File not found!";
        }

    } else {
        echo "Records not found!";
    }

    $con->close();

?>
    
