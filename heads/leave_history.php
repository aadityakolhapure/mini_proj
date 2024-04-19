<?php
include('includes_hod/header.php');
include('../includes/session.php');

// Check if emp_id is provided in the URL
if (isset($_GET['emp_id'])) {
    $emp_id = $_GET['emp_id'];

    // Fetch leave history for the specific staff member
    $sql = "SELECT * FROM tblleaves WHERE empid = '$emp_id'";

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
?>

        <body>
            <!-- Your HTML code here -->
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



            <?php include('includes_hod/left_sidebar.php') ?>

            <div class="main-container">
                <div class="pd-ltr-20">
                    <div class="title pb-20">
                        <?php
                        // Assuming you have the faculty ID in the $emp_id variable
                        $sql = "SELECT FirstName, LastName FROM tblemployees WHERE emp_id = :emp_id";
                        $stmt = $dbh->prepare($sql);
                        $stmt->bindParam(':emp_id', $emp_id, PDO::PARAM_INT);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        $faculty_name = $row['FirstName'] . ' ' . $row['LastName'];
                        ?>
                        <h2 class="h3 mb-0">Leave History for Faculty: <?php echo $faculty_name; ?></h2>

                    </div>
                    <div class="card-box mb-30">
                        <div class="pd-20">
                            <table class="data-table table stripe hover nowrap">
                                <thead>
                                    <tr>
                                        <th>LEAVE TYPE</th>
                                        <th>DATE FROM</th>
                                        <th>DATE TO</th>
                                        <th>DESCRIPTION</th>
                                        <th>HOD Status</th>
                                        <th>Admin Status</th>
                                        <th>Principal Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                        <tr>
                                            <td><?php echo htmlentities($row['LeaveType']); ?></td>
                                            <td><?php echo htmlentities($row['FromDate']); ?></td>
                                            <td><?php echo htmlentities($row['ToDate']); ?></td>
                                            <td><?php echo htmlentities($row['Description']); ?></td>
                                            <td style="color: <?php echo ($row['Status'] == 1) ? 'green' : (($row['Status'] == 2) ? 'red' : 'blue'); ?>">
                                                <?php echo ($row['Status'] == 1) ? 'Recommend' : (($row['Status'] == 2) ? 'Not recommend' : 'Pending'); ?>
                                            </td>
                                            <td style="color: <?php echo ($row['admin_status'] == 1) ? 'green' : (($row['admin_status'] == 2) ? 'red' : 'blue'); ?>">
                                                <?php echo ($row['admin_status'] == 1) ? 'Forward' : (($row['admin_status'] == 2) ? 'Rejected' : 'Pending'); ?>
                                            </td>
                                            <td style="color: <?php echo ($row['principal_status'] == 1) ? 'green' : (($row['principal_status'] == 2) ? 'red' : 'blue'); ?>">
                                                <?php echo ($row['principal_status'] == 1) ? 'Approved' : (($row['principal_status'] == 2) ? 'Not Approved' : 'Pending'); ?>
                                            </td>
                                            <td>
                                            <td>

                                            </td>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Include footer -->
                    <?php include('includes_hod/footer.php'); ?>
                </div>
            </div>

            <!-- Include scripts -->
            <?php include('includes_hod/scripts.php'); ?>
        </body>

        </html>

<?php
    } else {
        echo "No leave history found for this faculty member.";
    }
} else {
    // If emp_id is not provided, redirect back to the staff.php page
    header("Location: staff.php");
    exit();
}
?>