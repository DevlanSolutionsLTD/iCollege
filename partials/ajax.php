<?php
/*
 * Created on Thu Jul 08 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

include('../config/pdoconfig.php');

/* Student Name */
if (!empty($_POST["AdmissionNumber"])) {
    $id = $_POST['AdmissionNumber'];
    $stmt = $DB_con->prepare("SELECT * FROM iCollege_students WHERE admno = :id ");
    $stmt->execute(array(':id' => $id));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        echo htmlentities($row['name']);
    }
}

/* Unit Code */
if (!empty($_POST["UnitCode"])) {
    $id = $_POST['UnitCode'];
    $stmt = $DB_con->prepare("SELECT * FROM  iCollege_units WHERE code = :id ");
    $stmt->execute(array(':id' => $id));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        echo htmlentities($row['name']);
    }
}

/* Lec Details */
if (!empty($_POST["LecNumber"])) {
    $id = $_POST['LecNumber'];
    $stmt = $DB_con->prepare("SELECT * FROM iCollege_lecturers WHERE number = :id ");
    $stmt->execute(array(':id' => $id));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['name']);
    }
}

/* Get Course Details */
if (!empty($_POST["CourseName"])) {
    $id = $_POST['CourseName'];
    $stmt = $DB_con->prepare("SELECT * FROM iCollege_courses WHERE name = :id ");
    $stmt->execute(array(':id' => $id));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['id']);
    }
}

/* Parent Details */
if (!empty($_POST["ParentName"])) {
    $id = $_POST['ParentName'];
    $stmt = $DB_con->prepare("SELECT * FROM iCollege_parents WHERE name = :id ");
    $stmt->execute(array(':id' => $id));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo htmlentities($row['id']);
    }
}
