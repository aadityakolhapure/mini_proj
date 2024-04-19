<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'project');

$conn = mysqli_connect('localhost', 'root', '', 'project') or die(mysqli_error());
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    $sql = "UPDATE tblemployees SET reset_token_hash = ?, reset_token_expires_at = ? WHERE EmailId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $token_hash, $expiry, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $mail = require __DIR__ . "/mailer.php";
        $mail->setFrom("aadityakolhapure28@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
Click <a href="http://localhost/EstablishSection/reset-password.php?token=$token">here</a> to reset your password.
END;

        try {
            $mail->send();
            echo "Message sent, please check your inbox.";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
    }
    // Proceed with the rest of the code
} else {
    // Handle the case where 'EmailId' is not set
}



?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Establishment Section</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body class="login-page">

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/forgot-password.png" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Reset Password</h2>
                        </div>
                        <form name="signin" method="post" action="forget-password.php">

                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Email ID" name="email" id="email">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy fa fa-envelope-o" aria-hidden="true"></i></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" name="submit" id="signin" type="submit" value="Send Mail">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="vendors/scripts/core.js"></script>
    <script src="vendors/scripts/script.min.js"></script>
    <script src="vendors/scripts/process.js"></script>
    <script src="vendors/scripts/layout-settings.js"></script>
</body>

</html>