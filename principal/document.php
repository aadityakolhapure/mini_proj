<?php include('includes/header.php') ?>
<?php include('../includes/session.php') ?>
<?php $get_id = $_GET['edit']; ?>
<?php
if (isset($_POST['add_staff'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $department = $_POST['department'];
    $address = $_POST['address'];
    $leave_days = $_POST['leave_days'];
    $user_role = $_POST['user_role'];
    $phonenumber = $_POST['phonenumber'];
    $emp = $_POST['emp_id'];
    $aadhar = $_POST['aadhar'];
    $pan = $_POST['pan'];
    $caste = $_POST['caste'];
    $subcaste = $_POST['subcaste'];
    $ssc = $_POST['ssc'];
    $hsc = $_POST['hsc'];
    $be = $_POST['be'];
    $pg = $_POST['pg'];
    $phd = $_POST['phd'];
    $publication = $_POST['publication'];
    $journal = $_POST['journal'];
    $patent = $_POST['patent'];

    $result = mysqli_query($conn, "update tblemployees set FirstName='$fname', LastName='$lname', EmailId='$email', Gender='$gender', Dob='$dob', Department='$department', Address='$address', Av_leave='$leave_days', role='$user_role', Phonenumber='$phonenumber', emp_id = '$emp', aadhar = '$aadhar', pan = '$pan', caste = '$caste', subcaste = '$subcaste', ssc = '$ssc', hsc = '$hsc', be = '$be', pg = '$pg', phd = '$phd', publication = '$publication', journal = '$journal', patent = '$patent' where emp_id='$get_id'         
		");
    if ($result) {
        echo "<script>alert('Record Successfully Updated');</script>";
        echo "<script type='text/javascript'> document.location = 'staff.php'; </script>";
    } else {
        die(mysqli_error());
    }
}

?>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="../vendors/images/deskapp-logo-svg.png" alt=""></div>
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
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Principal Portal</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Document</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <div class="title">
                                <h5>View Document</h5>
                            </div>
                            <p class="mb-20"></p>
                        </div>
                    </div>
                    <div class="wizard-content">
                        <form method="post" action="">

                            <section>

                                <?php
                                $query = mysqli_query($conn, "select * from tblemployees where emp_id = '$get_id' ") or die(mysqli_error());
                                $row = mysqli_fetch_array($query);
                                ?>
                                

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">Aadhar Card:</label>
                                            <iframe src="<?php echo (!empty($row['aadhar_pdf'])) ? '../uploads/aadhar/' . $row['aadhar_pdf'] : '../uploads/aadhar/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">Pan Card:</label>
                                            <iframe src="<?php echo (!empty($row['pan_pdf'])) ? '../uploads/Pan/' . $row['pan_pdf'] : '../uploads/Pan/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">Passbook:</label>
                                            <iframe src="<?php echo (!empty($row['passbook'])) ? '../uploads/passbook/' . $row['passbook'] : '../uploads/passbook/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">Caste Certificate:</label>
                                            <iframe src="<?php echo (!empty($row['caste_crf'])) ? '../uploads/caste/' . $row['caste_crf'] : '../uploads/caste/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">Caste Validity Certificate:</label>
                                            <iframe src="<?php echo (!empty($row['caste_validity'])) ? '../uploads/caste_validity1/' . $row['caste_validity'] : '../uploads/caste_validity1/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">Domacile Certificate:</label>
                                            <iframe src="<?php echo (!empty($row['domacile'])) ? '../uploads/domacile/' . $row['domacile'] : '../uploads/domacile/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">SSC marksheet:</label>
                                            <iframe src="<?php echo (!empty($row['ssc_pdf'])) ? '../uploads/SSC/' . $row['ssc_pdf'] : '../uploads/SSC/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">HSC marksheet:</label>
                                            <iframe src="<?php echo (!empty($row['hsc_pdf'])) ? '../uploads/HSC/' . $row['hsc_pdf'] : '../uploads/HSC/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">Diploma marksheet:</label>
                                            <iframe src="<?php echo (!empty($row['diploma_mrk'])) ? '../uploads/dip_marksheet/' . $row['diploma_mrk'] : '../uploads/dip_marksheet/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">UG marksheet:</label>
                                            <iframe src="<?php echo (!empty($row['be_pdf'])) ? '../uploads/be_marksheet/' . $row['be_pdf'] : '../uploads/be_marksheet/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">UG Certificate:</label>
                                            <iframe src="<?php echo (!empty($row['be_crf'])) ? '../uploads/be_certificate/' . $row['be_crf'] : '../uploads/be_certificate/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">PG marksheet:</label>
                                            <iframe src="<?php echo (!empty($row['pg_pdf'])) ? '../uploads/PG_marksheet/' . $row['pg_pdf'] : '../uploads/PG_marksheet/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">PG Certificate:</label>
                                            <iframe src="<?php echo (!empty($row['pg_crf'])) ? '../uploads/PG_certificate/' . $row['pg_crf'] : '../uploads/PG_certificate/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">PHD marksheet:</label>
                                            <iframe src="<?php echo (!empty($row['phd_pdf'])) ? '../uploads/PHD_marksheet/' . $row['phd_pdf'] : '../uploads/PHD_marksheet/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <label style="font-size: 18px;">PHD Certificate:</label>
                                            <iframe src="<?php echo (!empty($row['phd_crf'])) ? '../uploads/PHD_certificate/' . $row['phd_crf'] : '../uploads/PHD_certificate/NO-IMAGE-AVAILABLE.jpg'; ?>" width="300px" height="300px" alt=""></iframe>
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
</body>

</html>