<?php include('includes/header.php') ?>
<?php include('../includes/session.php') ?>

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
    <div class="main-container">
        <div class="profile-setting">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Documents</label>
                        <div class="document-file">
                            <?php
                            if (isset($_POST["update_documents"])) {
                                $emp_id = $session_id;

                                // Handle PAN PDF
                                $pan_pdf_name = $_FILES['pan_pdf']['name'];
                                if (!empty($pan_pdf_name)) {
                                    $pan_pdf_path = '../uploads/documents/' . $pan_pdf_name;
                                    move_uploaded_file($_FILES['pan_pdf']['tmp_name'], $pan_pdf_path);
                                } else {
                                    $pan_pdf_path = '';
                                }

                                // Handle Aadhar PDF
                                $aadhar_pdf_name = $_FILES['aadhar_pdf']['name'];
                                if (!empty($aadhar_pdf_name)) {
                                    $aadhar_pdf_path = '../uploads/documents/' . $aadhar_pdf_name;
                                    move_uploaded_file($_FILES['aadhar_pdf']['tmp_name'], $aadhar_pdf_path);
                                } else {
                                    $aadhar_pdf_path = '';
                                }

                                // ... (Handle other document uploads)

                                $result = mysqli_query($conn, "INSERT INTO tbldocument (emp_id, aadhar_pdf, ...) VALUES ('$emp_id', '$aadhar_pdf_path', ...) FROM tblemployees WHERE ") or die(mysqli_error());
                                if ($result) {
                                    echo "<script>alert('Documents Updated');</script>";
                                    echo "<script type='text/javascript'> document.location = 'document.php'; </script>";
                                } else {
                                    die(mysqli_error());
                                }
                            }
                            ?>
                            <a href="#document_modal" data-toggle="modal" data-target="#document_modal" class="edit-document"><i class="fa fa-pencil"></i></a>
                            <iframe src="<?php echo (!empty($row['document_path'])) ? $row['document_path'] : ''; ?>" width="300px" height="300px"></iframe>
                            <form method="post" enctype="multipart/form-data">
                                <div class="modal fade" id="document_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="weight-500 col-md-12 pd-5">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input name="pan_pdf" id="pan_pdf_file" type="file" class="custom-file-input" onchange="validatePANFile('pan_pdf_file')">
                                                        <label class="custom-file-label" for="pan_pdf_file">Choose PAN PDF</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input name="aadhar_pdf" id="aadhar_pdf_file" type="file" class="custom-file-input" onchange="validateAadharFile('aadhar_pdf_file')">
                                                        <label class="custom-file-label" for="aadhar_pdf_file">Choose Aadhar PDF</label>
                                                    </div>
                                                </div>
                                                <!-- Add more form groups for other document uploads -->
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" name="update_documents" value="Update" class="btn btn-primary">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>