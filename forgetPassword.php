<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
$result = 0;
if(isset($_POST['forgetPassword'])){
    $email = $_POST['email'];
    $fetch_email = $db_handle->runQuery("SELECT * FROM login WHERE email='$email'");
    $fetch_email_no = $db_handle->numRows("SELECT * FROM login WHERE email='$email'");
    if($fetch_email_no > 0){
        $id = $fetch_email[0]['id'];
        $subject = "Please visit the link and verify your password.";
        $messege = "<html>
<body style='background-color: #eee; font-size: 16px;'>
<div style='max-width: 600px; min-width: 200px; background-color: #ffffff; padding: 20px; margin: auto;'>

    <p style='text-align: center;color:#29a9e1;font-weight:bold'>Thank you for contacting us.</p>

    <p style='color:black;text-align: center'>
        Please visit <a href='https://frogbid.com/Set-Password?id=$id'><strong>this link</strong></a> to reset your password..
    </p>
</div>

</body>
</html>";

        $sender_name = "FrogBID Digital & Technologies";


        $sender_email = "contact@frogbid.com";
        $username = "contact@frogbid.com";
        $password = "I1d:j31m4)4";

        $receiver_email = $email;



        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = "mail.frogbid.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($sender_email, $sender_name);
        $mail->Username = $username;
        $mail->Password = $password;

        $mail->CharSet = 'UTF-8';

        $mail->Subject = $subject;
        $mail->msgHTML($messege);
        $mail->addAddress($receiver_email);
        if ($mail->send()) {
            $result = 1;
            exit;
        } else {
            $result = 2;
        }
    } else{
        $result = 3;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Ready | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- ================== BEGIN core-css ================== -->
    <link href="assets/css/vendor.min.css" rel="stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

</head>
<body >
<!-- BEGIN #loader -->
<div id="loader" class="app-loader">
    <div class="d-flex align-items-center">
        <div class="app-loader-circle"></div>
        <div class="app-loader-text">LOADING...</div>
    </div>
</div>
<!-- END #loader -->

<!-- BEGIN #app -->
<div id="app" class="app app-full-height app-without-header">
    <!-- BEGIN login -->
    <div class="login">
        <!-- BEGIN login-content -->
        <div class="login-content">
            <form action="#" method="POST">
                <h1 class="text-center">Sign In</h1>
                <div class="text-body text-opacity-50 text-center mb-5">
                    Please input the registered email address
                </div>
                <?php if($result == 2) {
                    ?>
                    <div class="alert alert-danger mt-3 mb-3">
                        <strong>Sorry!</strong> Something went wrong! Please try again.
                    </div>
                    <?php
                } if($result == 1){
                    ?>
                    <div class="alert alert-success mt-3 mb-3">
                        <strong>Success!</strong> Please check your email and verify your account.
                    </div>
                    <?php
                } if($result == 3) {
                    ?>
                    <div class="alert alert-warning mt-3 mb-3">
                        <strong>Sorry!</strong> This email is not registered with us! Try again.
                    </div>
                    <?php
                }?>
                <div class="mb-4">
                    <label class="form-label">Email Address</label>
                    <input type="text" class="form-control form-control-lg fs-14px" value="" placeholder="username@address.com" name="email"/>
                </div>
                <button type="submit" name="forgetPassword" class="btn btn-theme btn-lg d-block w-100 mb-3">Send Link</button>
                <div class="text-center text-body text-opacity-50">
                    Don't have an account yet? <a href="Signup">Sign up</a>.
                </div>
            </form>
        </div>
        <!-- END login-content -->
    </div>
    <!-- END login -->

    <!-- BEGIN btn-scroll-top -->
    <a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade">
        <iconify-icon icon="material-symbols-light:keyboard-arrow-up"></iconify-icon>
    </a>
    <!-- END btn-scroll-top -->

    <!-- BEGIN theme-panel -->
    <?php include ('includes/themecolor.php');?>
    <!-- END theme-panel -->
</div>
<!-- END #app -->

<!-- ================== BEGIN core-js ================== -->
<script src="code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js" type="75368eb3c58106765db00639-text/javascript"></script>
<script src="assets/js/vendor.min.js" type="75368eb3c58106765db00639-text/javascript"></script>
<script src="assets/js/app.min.js" type="75368eb3c58106765db00639-text/javascript"></script>
<!-- ================== END core-js ================== -->


<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3" type="75368eb3c58106765db00639-text/javascript"></script>

<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="75368eb3c58106765db00639-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"927e1e5bcb05c86a","version":"2025.3.0","r":1,"serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"4db8c6ef997743fda032d4f73cfeff63","b":1}' crossorigin="anonymous"></script>
</body>

</html>

