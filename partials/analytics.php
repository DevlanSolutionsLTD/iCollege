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

/* Courses Offered */
$query = "SELECT COUNT(*)  FROM `iCollege_courses`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($courses_offered);
$stmt->fetch();
$stmt->close();

/* Academic Units Available */
$query = "SELECT COUNT(*)  FROM `iCollege_units`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($units);
$stmt->fetch();
$stmt->close();

/* Lecturers */
$query = "SELECT COUNT(*)  FROM `iCollege_lecturers`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($lecs);
$stmt->fetch();
$stmt->close();

/* Parents */
$query = "SELECT COUNT(*)  FROM `iCollege_parents`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($parents);
$stmt->fetch();
$stmt->close();

/* Students */
$query = "SELECT COUNT(*)  FROM `iCollege_students`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($students);
$stmt->fetch();
$stmt->close();

/* Billed Finances */
$query = "SELECT SUM(amt_billed)  FROM `iCollege_fees_payments`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($billed);
$stmt->fetch();
$stmt->close();

/* Paid Finances */
$query = "SELECT SUM(amt_paid)  FROM `iCollege_fees_payments`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($paid);
$stmt->fetch();
$stmt->close();
