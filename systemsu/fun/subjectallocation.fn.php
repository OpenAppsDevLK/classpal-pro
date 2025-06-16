<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];
    
    // Call in database connection
    include_once '../../php-includes/connect.inc.php'; 

    function subjectallocation() {
        global $db;

        // Initialize variables with default values to avoid undefined issues
        $var_AS_AlloID = null;
        $var_AS_StuID = null;
        $var_AS_StuName = null;
        $var_AS_SubjID = null;
        $var_AS_Lecturerid = null;
        $var_AS_subj_fee = null;
        $var_AS_BchNo = null;
        $var_AS_AlloNotes = null;

        // Check if all required POST fields are set
        if (
            isset($_POST['txt_AlloAutoID']) &&
            isset($_POST['txt_stu_id']) &&
            isset($_POST['txt_stu_name']) &&
            isset($_POST['txt_subject']) &&
            isset($_POST['txt_Lecturer_id']) &&
            isset($_POST['txt_subject_fee']) &&
            isset($_POST['txt_batch_no'])
        ) {
            $var_AS_AlloID = $_POST['txt_AlloAutoID'];
            $var_AS_StuID = $_POST['txt_stu_id'];
            $var_AS_StuName = $_POST['txt_stu_name'];
            $var_AS_SubjID = $_POST['txt_subject'];
            $var_AS_Lecturerid = $_POST['txt_Lecturer_id'];
            $var_AS_subj_fee = $_POST['txt_subject_fee'];
            $var_AS_BchNo = $_POST['txt_batch_no'];
            $var_AS_AlloNotes = isset($_POST['txt_allocation_notes']) ? $_POST['txt_allocation_notes'] : ''; // Optional field

            // Validate that student ID is not empty or invalid
            if (empty($var_AS_StuID)) {
                echo "<script>alert('Error: Student ID cannot be empty.');</script>";
                return false;
            }

            // Use a prepared statement to add course allocation to the database
            $stmt1 = $db->prepare("INSERT INTO `cp_subj_allo` (sa_id, sa_stu_student_id, sa_stu_student_Name, sa_subj_id, sa_lec_id, sa_subj_fee, sa_batch_no, sa_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->bind_param('iisiidss', $var_AS_AlloID, $var_AS_StuID, $var_AS_StuName, $var_AS_SubjID, $var_AS_Lecturerid, $var_AS_subj_fee, $var_AS_BchNo, $var_AS_AlloNotes);
            
            if ($stmt1->execute()) {
                echo "<script>swal('Success', 'Student successfully added.', 'success');</script>";
            } else {
                echo "<script>swal('Error', 'Failed to add student allocation.', 'error');</script>";
            }
            
            $stmt1->close();
            return true;
        } else {
            //echo "<script>swal('Success', 'Student Added.', 'success');</script>";
            return false;
            
        }
    }
    
} else { 
    header('Location: ../login.php');
}
?>