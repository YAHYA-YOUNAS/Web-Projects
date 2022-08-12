<?php
    session_start();

    require '../queries/connection.php';    // importing connection

    $name = $_SESSION['username'];      // storing session name

    if (isset($_POST['submit'])) 
    {
        // get all form variables

        $apply_for = $_POST['applyFor'];
        $cnic = $_POST['cnic'];
        $address = $_POST['address'];
        $profession = $_POST['profession'];
        $income = $_POST['income'];
        $family_income = $_POST['familyIncome'];
        $expenditure = $_POST['expenditure'];

        // select id from the database of current student

        $sql = "SELECT student_id FROM student WHERE student_name= '$name'";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $result_array = $result->fetch_assoc();                 // get record of the current student
            $id = $result_array["student_id"];                      // storing id of current student

            // checking the applied_for field of current student

            $check = "SELECT student_applied_for FROM student WHERE student_id= $id";  
            $check_result = $con->query($check);

            if ($check_result->num_rows > 0) {
                $record = $check_result->fetch_assoc();

                if ($record["student_applied_for"] === $apply_for) {  // if student already applied in current scholarship

                    $_SESSION["apply_error"] = "Already applied for <b>" .strtoupper($apply_for). "</b> Scholarship";
                    header('Location: StudentApplicationForm.php');
                
                }
                else if (!empty($record["student_applied_for"])) {  // if student already applied in another scholarship

                    $_SESSION["apply_error"] = "Sorry! You have already applied for <b>" .strtoupper($record["student_applied_for"]). "</b> Scholarship";
                    header('Location: StudentApplicationForm.php');
                }  
                else if (empty($record["student_applied_for"])) { // if student did not applied in any scholarship

                    // adding application form data in the database

                    $insertion = "UPDATE student SET student_applied_for= '$apply_for', student_cnic= '$cnic', student_address= '$address',
                    student_profession= '$profession', student_income= '$income', student_family_income= '$family_income',
                    student_expenditure= '$expenditure' WHERE student_id= $id";

                    $data = $con->query($insertion);

                    if($data) {
                        $con->close();
                        unset($_SESSION["noRecordFound"]);
                        $_SESSION["notify"] = "You have applied for <b>" .strtoupper($apply_for). "</b> Scholarship!";
                        header('Location: StudentApplicationForm.php');
                    } else {
                        $_SESSION["error"] = "Unable to apply!";
                        header('Location: StudentApplicationForm.php');
                    }
                }
            } 
            else {
                $_SESSION["error"] = "Unable to find student!";
                header('Location: StudentApplicationForm.php');
            }
        } 
        else {
            $_SESSION["error"] = "Unable to apply!";
            header('Location: StudentApplicationForm.php');
        }

    }
?>