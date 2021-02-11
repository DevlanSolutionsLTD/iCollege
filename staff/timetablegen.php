<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
staff();
require_once '../config/codeGen.php';
require_once '../partials/timetable/admin_timetable_head.php';
?>

<body>

	<div class="limiter">
		<div id="Print_tt" class="container-table100">ICOLLEGE TIMETABLE
			<div class="wrap-table100">
				<div class="table100 ver1 m-b-110">
					<table data-vertable="ver1">
						<thead>
							<tr class="row100 head">
								<th class="column100 column1" data-column="column1">Course name</th>
								<th class="column100 column1" data-column="column1">Unit code</th>
								<th class="column100 column3" data-column="column3">Monday</th>
								<th class="column100 column4" data-column="column4">Tuesday</th>
								<th class="column100 column5" data-column="column5">Wednesday</th>
								<th class="column100 column6" data-column="column6">Thursday</th>
								<th class="column100 column7" data-column="column7">Friday</th>
								<th class="column100 column8" data-column="column8">Saturday</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$ret = 'SELECT * FROM `iCollege_timetable`';
							$stmt = $mysqli->prepare($ret);
							$stmt->execute(); //ok
							$res = $stmt->get_result();
							while ($tt = $res->fetch_object()) { ?>
								<tr class="row100">
									<td class="column100 column1" data-column="column1"><?php echo $tt->course_name; ?></td>
									<td class="column100 column2" data-column="column2"><?php echo $tt->unit_code; ?></td>
									<?php
									if ($tt->day == 'Monday') {
										echo "
											<td class='column100 column3' data-column='column3'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
											<td class='column100 column4' data-column='column4'>--</td>
											<td class='column100 column5' data-column='column5'>--</td>
											<td class='column100 column6' data-column='column6'>--</td>
											<td class='column100 column7' data-column='column7'>--</td>
											<td class='column100 column8' data-column='column8'>--</td>
										";
									} elseif ($tt->day == 'Tuesday') {
										echo "
												<td class='column100 column3' data-column='column3'>--</td>
												<td class='column100 column4' data-column='column4'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='column100 column5' data-column='column5'>--</td>
												<td class='column100 column6' data-column='column6'>--</td>
												<td class='column100 column7' data-column='column7'>--</td>
												<td class='column100 column8' data-column='column8'>--</td>
											";
									} elseif ($tt->day == 'Wednesday') {
										echo "
												<td class='column100 column3' data-column='column3'>--</td>
												<td class='column100 column4' data-column='column4'>--</td>
												<td class='column100 column5' data-column='column5'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='column100 column6' data-column='column6'>--</td>
												<td class='column100 column7' data-column='column7'>--</td>
												<td class='column100 column8' data-column='column8'>--</td>
											";
									} elseif ($tt->day == 'Thursday') {
										echo "
												<td class='column100 column3' data-column='column3'>--</td>
												<td class='column100 column4' data-column='column4'>--</td>
												<td class='column100 column5' data-column='column5'>--</td>
												<td class='column100 column6' data-column='column6'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='column100 column7' data-column='column7'>--</td>
												<td class='column100 column8' data-column='column8'>--</td>
											";
									} elseif ($tt->day == 'Friday') {
										echo "
												<td class='column100 column3' data-column='column3'>--</td>
												<td class='column100 column4' data-column='column4'>--</td>
												<td class='column100 column5' data-column='column5'>--</td>
												<td class='column100 column6' data-column='column6'>--</td>
												<td class='column100 column7' data-column='column7'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='column100 column8' data-column='column8'>--</td>
											";
									} else {
										echo "
											<td class='column100 column3' data-column='column3'>--</td>
											<td class='column100 column4' data-column='column4'>--</td>
											<td class='column100 column5' data-column='column5'>--</td>
											<td class='column100 column6' data-column='column6'>--</td>
											<td class='column100 column7' data-column='column7'>--</td>
											<td class='column100 column8' data-column='column8'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
										";
									}

									?>

								</tr>
							<?php }
							?>
				</div>
			</div>
		</div>
	</div>

	<p class="lead">
		<button id="print" onclick="printContent('Print_tt');" class="btn btn-default">Print Timetable</button>
	</p>

	<?php
	require_once '../partials/timetable/admin_timetable_scripts.php';
	?>
</body>

</html>