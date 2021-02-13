<?php
$admn = $_SESSION['admno'];

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

/* Enrolled Units */
$query = "SELECT COUNT(*)  FROM `iCollege_enrollments` WHERE std_regno = '$admn' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($enrolled);
$stmt->fetch();
$stmt->close();