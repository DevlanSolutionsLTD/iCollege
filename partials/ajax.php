<?php
include('../config/pdoconfig.php');

/* Student Name */
if (!empty($_POST["AdmissionNumber"])) {
    $id = $_POST['AdmissionNumber'];
    $stmt = $DB_con->prepare("SELECT * FROM iCollege_students WHERE admno = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['name']); ?>
<?php
    }
}

/* Unit Code */
if (!empty($_POST["UnitCode"])) {
    $id = $_POST['UnitCode'];
    $stmt = $DB_con->prepare("SELECT * FROM  iCollege_units WHERE code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['name']); ?>
<?php
    }
}
