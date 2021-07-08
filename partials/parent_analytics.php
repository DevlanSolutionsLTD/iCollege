<?php
$id = $_SESSION['id'];
$ret = "SELECT * FROM `iCollege_students` WHERE parent_id = '$id' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($student = $res->fetch_object()) {
    $admn = $student->admno;

    /* Billed Finances */
    $query = "SELECT SUM(amt_billed)  FROM `iCollege_fees_payments` WHERE std_regno ='$admn'  ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($billed);
    $stmt->fetch();
    $stmt->close();

    /* Paid Finances */
    $query = "SELECT SUM(amt_paid)  FROM `iCollege_fees_payments` WHERE std_regno ='$admn' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($paid);
    $stmt->fetch();
    $stmt->close();
}
