<?php
include "../../database/db.php";
$db = new Database();
$con = $db->con;

if (substr(array_keys($_POST)[0], 0, 13) == "course-title-") {
    $id = array_keys($_POST)[0];
    $id = substr($id, 13, strlen($id));
    $courseTitle = $_POST['course-title-' . $id];
    $courseInst = $_POST['course-inst-' . $id];
    $courseStart = $_POST['course-begin-' . $id];
    $courseEnd = $_POST['course-end-' . $id];
    $courseDetail = $_POST['course-detail-' . $id];
    if ($courseStart == "" && $courseDetail == "" && $courseEnd == "" && $courseInst = "" && $courseTitle == "") {

    } else {
        $sql = "delete from education where course_title='$courseTitle' and id='$id'";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo "success";
        } else {
            echo "failure";
        }
    }
}
if (substr(array_keys($_POST)[0], 0, 10) == "emp-title-") {
    $id = array_keys($_POST)[0];
    $id = substr($id, 10, strlen($id));
    $empTitle = $_POST['emp-title-' . $id];
    $empInst = $_POST['emp-comp-' . $id];
    $empStart = $_POST['emp-begin-' . $id];
    $empEnd = $_POST['emp-end-' . $id];
    $empDetail = $_POST['emp-detail-' . $id];
    if ($empStart == "" && $empDetail == "" && $empEnd == "" && $empInst = "" && $empTitle == "") {

    } else {
        $sql = "delete from experience where emp_title='$empTitle' and id='$id'";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo "success";
        } else {
            echo "failure";
        }
    }
}
if (substr(array_keys($_POST)[0], 0, 11) == "skill-type-") {
    $id = array_keys($_POST)[0];
    $id = substr($id, 11, strlen($id));
    $skillType = $_POST['skill-type-' . $id];
    $skillList = $_POST['skill-list-' . $id];
    if ($skillType == "" && $skillList == "") {

    } else {
        $sql = "delete from skills where skill_type='$skillType' and id='$id'";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo "success";
        } else {
            echo "failure";
        }
    }
}
?>