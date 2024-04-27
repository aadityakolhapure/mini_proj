<?php include('includes/header.php') ?>
<?php include('../includes/session.php') ?>
<?php
if (isset($_POST['apply'])) {
	$empid = $session_id;
	$leave_type = $_POST['leave_type'];
	$fromdate = date('Y-m-d', strtotime($_POST['date_from']));
	$todate = date('Y-m-d', strtotime($_POST['date_to']));
	$description = $_POST['description'];
	$status = 0;
	$isread = 0;
	$leave_days = $_POST['leave_days'];
	$datePosting = date("Y-m-d");

	if ($fromdate > $todate) {
		echo "<script>alert('End Date should be greater than Start Date');</script>";
	} elseif ($leave_days <= 0) {
		echo "<script>alert('YOU HAVE EXCEEDED YOUR LEAVE LIMIT. LEAVE APPLICATION FAILED');</script>";
	} else {

		$DF = date_create($_POST['date_from']);
		$DT = date_create($_POST['date_to']);

		$diff =  date_diff($DF, $DT);
		$num_days = (1 + $diff->format("%a"));
		$dateA = date("Y-m-d");
		// Assuming 'dateA' should be the current date
		$existing_loadA = $_POST['existing_loadA']; // Assuming 'existing_loadA' is coming from the form
		$schedule_timeA = $_POST['schedule_timeA']; // Assuming 'existing_loadA' is coming from the form
		$classA = $_POST['classA']; // Assuming 'existing_loadA' is coming from the form
		$alternative_facultyA = $_POST['alternative_facultyA'];
		$existing_loadA = $_POST['existing_loadA']; // Assuming 'existing_loadA' is coming from the form
		$date1 = $_POST['date1'];

		$existing_load = $_POST['existing_load']; // Assuming 'existing_loadA' is coming from the form
		$schedule_time = $_POST['schedule_time']; // Assuming 'existing_loadA' is coming from the form
		$class = $_POST['class']; // Assuming 'existing_loadA' is coming from the form
		$alternative_faculty = $_POST['alternative_faculty']; // Assuming 'existing_loadA' is coming from the form


		$sql = "INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid,num_days,PostingDate,dateA,existing_loadA,schedule_timeA,classA,alternative_facultyA,date1,existing_load,schedule_time,class,alternative_faculty) VALUES(:leave_type,:fromdate,:todate,:description,:status,:isread,:empid,:num_days,:datePosting,:dateA,:existing_loadA,:schedule_timeA,:classA,:alternative_facultyA,:date1,:existing_load,:schedule_time,:class,:alternative_faculty)";

		$query = $dbh->prepare($sql);
		$query->bindParam(':leave_type', $leave_type, PDO::PARAM_STR);
		$query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
		$query->bindParam(':todate', $todate, PDO::PARAM_STR);
		$query->bindParam(':description', $description, PDO::PARAM_STR);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':isread', $isread, PDO::PARAM_STR);
		$query->bindParam(':empid', $empid, PDO::PARAM_STR);
		$query->bindParam(':num_days', $num_days, PDO::PARAM_STR);
		$query->bindParam(':datePosting', $datePosting, PDO::PARAM_STR);
		$query->bindParam(':dateA', $dateA, PDO::PARAM_STR);
		$query->bindParam(':existing_loadA', $existing_loadA, PDO::PARAM_STR);
		$query->bindParam(':schedule_timeA', $schedule_timeA, PDO::PARAM_STR);
		$query->bindParam(':classA', $classA, PDO::PARAM_STR);
		$query->bindParam(':alternative_facultyA', $alternative_facultyA, PDO::PARAM_STR);
		$query->bindParam(':date1', $date1, PDO::PARAM_STR);
		$query->bindParam(':existing_load', $existing_load, PDO::PARAM_STR);
		$query->bindParam(':schedule_time', $schedule_time, PDO::PARAM_STR);
		$query->bindParam(':class', $class, PDO::PARAM_STR);
		$query->bindParam(':alternative_faculty', $alternative_faculty, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			echo "<script>alert('Leave Application was successful.');</script>";
			echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
		} else {
			echo "<script>alert('Something went wrong. Please try again');</script>";
		}
	}
}

?>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/favicon-32x32.png" alt="" style="height: 100px; width: 100px;"></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<?php include('includes/navbar.php') ?>

	<?php include('includes/right_sidebar.php') ?>

	<?php include('includes/left_sidebar.php') ?>

	<div class="mobile-menu-overlay"></div>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pb-20">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Leave Application</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Apply for Leave</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h3 class="text-blue h4">Faculty Form</h3>
							<p class="mb-20"></p>
						</div>
					</div>
					<div class="wizard-content">
						<form method="post" action="">
							<section>

								<?php if ($role_id = 'Staff') : ?>
									<?php $query = mysqli_query($conn, "select * from tblemployees where emp_id = '$session_id'") or die(mysqli_error());
									$row = mysqli_fetch_array($query);
									?>

									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>First Name </label>
												<input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Last Name </label>
												<input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Email Address</label>
												<input name="email" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['EmailId']; ?>">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Available Leave Days </label>
												<input name="leave_days" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Av_leave']; ?>">
											</div>
										</div>
									<?php endif ?>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="form-group">
												<label>Leave Type :</label>
												<select name="leave_type" class="custom-select form-control" required="true" autocomplete="off">
													<option value="">Select leave type...</option>
													<?php $sql = "SELECT  LeaveType from tblleavetype";
													$query = $dbh->prepare($sql);
													$query->execute();
													$results = $query->fetchAll(PDO::FETCH_OBJ);
													$cnt = 1;
													if ($query->rowCount() > 0) {
														foreach ($results as $result) {   ?>
															<option value="<?php echo htmlentities($result->LeaveType); ?>"><?php echo htmlentities($result->LeaveType); ?></option>
													<?php }
													} ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Start Leave Date :</label>
												<input name="date_from" type="text" class="form-control date-picker" required="true" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>End Leave Date :</label>
												<input name="date_to" type="text" class="form-control date-picker" required="true" autocomplete="off">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-8 col-sm-12">
											<div class="form-group">
												<label>Reason For Leave :</label>
												<textarea id="textarea1" name="description" class="form-control" required length="150" maxlength="150" required="true" autocomplete="off"></textarea>
											</div>
										</div>



									</div>
									<div class="clearfix">

										<h3 class="text-blue h4">Load Balance</h3>
										<p class="mb-20"></p>

									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Date of load:</label>
												<input name="dateA" type="text" class="form-control date-picker" required="true" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Existing Load</label>
												<input name="existing_loadA" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Schedule Time</label>
												<input name="schedule_timeA" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Class</label>
												<input name="classA" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Name of Alternative Faculty</label>
												<input name="alternative_facultyA" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="clearfix">

										<h6 class="text-blue h4">Load balance(Write null or none if there is no another load to balance)</h6>
										<p class="mb-20"></p>

									</div>

									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Date of load:</label>
												<input name="date1" type="text" class="form-control date-picker" required="true" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Existing Load</label>
												<input name="existing_load" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Schedule Time</label>
												<input name="schedule_time" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Class</label>
												<input name="class" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12">
											<div class="form-group">
												<label>Name of Alternative Faculty</label>
												<input name="alternative_faculty" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>


									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label style="font-size:16px;"><b></b></label>
											<div class="modal-footer justify-content-center">
												<button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Apply&nbsp;Leave</button>
											</div>
										</div>
									</div>
							</section>
						</form>


					</div>

				</div>

			</div>
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->
	<?php include('includes/scripts.php') ?>
	<script>
		function validateleaveImage(id) {
			var file = document.getElementById(id).files[0];
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "pdf") {
				alert('Please select a valid PDF file');
				document.getElementById(id).value = '';
				return false;
			}
			if (file.size > 1050000) {
				alert('Max upload size is 1MB');
				document.getElementById(id).value = '';
				return false;
			}

			return true;
		}
	</script>
	<script>
		$(document).ready(function() {
			$('#uploadBtn').click(function() {
				var file_data = $('#leave_file').prop('files')[0];
				var form_data = new FormData();
				form_data.append('file', file_data);
				$.ajax({
					url: 'upload.php',
					type: 'post',
					data: form_data,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response == 'success') {
							alert('Document PDF Uploaded Successfully');
							// Reload the iframe or update the document display
							// Add your code here
						} else {
							alert('Error uploading document PDF');
						}
					}
				});
			});
		});
	</script>
</body>

</html>