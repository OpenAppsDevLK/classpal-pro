<?php

// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

//Call in studentattendance.inc.php

    include_once '../../php-includes/connect.inc.php';

    function addabsents() {

        if (isset($_POST['btn_ab'])) {



            if (isset($_POST['txt_abID'])) {
                $varATTiD = $_POST['txt_abID'];
            }

            if (isset($_POST['txt_abdate'])) {
                $varAttdate = $_POST['txt_abdate'];
            }


            if (isset($_POST['txt_ab_student_id'])) {
                $varStudentID = $_POST['txt_ab_student_id'];
            }

            if (isset($_POST['txt_ab_SubjectID'])) {
                $varSubjID = $_POST['txt_ab_SubjectID'];
            }

            if (isset($_POST['txt_ab_SubjectName'])) {
                $varSubjName = $_POST['txt_ab_SubjectName'];
            }

            if (isset($_POST['txt-sa_LecturerID'])) {
                $varLecID = $_POST['txt-sa_LecturerID'];
            }

            if (isset($_POST['txt-sa_LecturerName'])) {
                $varLecName = $_POST['txt-sa_LecturerName'];
            }

            global $db;

            $stmt5 = $db->prepare("SELECT stu_studentID FROM `cp_students` WHERE stu_studentID LIKE '%{$varStudentID}%'");
            $stmt5->bind_result($Student_id);
            $stmt5->execute();

            while ($stmt5->fetch()) {
                
            }


            if ($Student_id == $varStudentID) {



                global $db;

                $stmt = $db->prepare("INSERT INTO `cp_absent` (id, date, student_id, subj_id, subj_name, lec_id, lec_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
                //i - integer / d - double / s - string / b - BLOB                            [Time Zone]
                $stmt->bind_param('isiisis', $varATTiD, $varAttdate, $varStudentID, $varSubjID, $varSubjName, $varLecID, $varLecName);
                $stmt->execute();
                $stmt->close();

                return($stmt);
            } else {

                echo "<script>sweetAlert('Oops... OMG', 'No student under this ID..!! Check and Try Again', 'error');</script>";
            }
        }
    }

// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}
?>
