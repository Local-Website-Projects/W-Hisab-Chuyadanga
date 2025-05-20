<?php
require_once('config/dbConfig.php');
$db_handle = new DBController();
$result = 0;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $verify_id = $db_handle->insertQuery("update login set status='1' where id='$id'");
    if($verify_id){
        $result = 1;
    } else{
        $result = 2;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Verification | Demo Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- ================== BEGIN core-css ================== -->
    <link href="assets/css/vendor.min.css" rel="stylesheet" />
    <link href="assets/css/app.min.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->

    <link href="assets/plugins/kbw-countdown/dist/css/jquery.countdown.css" rel="stylesheet" />

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
    <!-- BEGIN coming-soon -->
    <div class="coming-soon">
        <div class="flex-1">

            <!-- END coming-soon-timer -->
            <!-- BEGIN coming-soon-content -->
            <?php if ($result == 1) {
                ?>
                <div class="coming-soon-content">
                    <div class="flex-1 mb-5">
                        <h2 class="mb-3">Congratulations!</h2>
                        <p class="mb-5">Your account is active now.<br /> Login and enjoy the amazing features. Stay tuned!</p>
                        <a href="Login">Go to Login</a>
                    </div>
                </div>
                <?php
            } if($result == 2){
                ?>
                <div class="coming-soon-content">
                    <div class="flex-1 mb-5">
                        <h2 class="mb-3">Sorry!</h2>
                        <p class="mb-5">Something went wrong.<br /> Please try to verify your account latter. Stay tuned!</p>
                        <a href="Login">Go to Login</a>
                    </div>
                </div>
                <?php
            } if($result == 0){
                ?>
                <div class="coming-soon-content">
                    <div class="flex-1 mb-5">
                        <h2 class="mb-3">Sorry!</h2>
                        <p class="mb-5">You are at the wrong place.<br /> Login and enjoy the amazing features. Stay tuned!</p>
                        <a href="Login">Go to Login</a>
                    </div>
                </div>
                <?php
            }?>

            <!-- END coming-soon-content -->
            <div class="text-center small mt-5 pt-1 mb-n5">
                &copy; 2025 FrogBID Right Reserved
            </div>
        </div>
    </div>
    <!-- END coming-soon -->

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
<script src="code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js" type="e1699d580cb2f0f6ee1c931d-text/javascript"></script>
<script src="assets/js/vendor.min.js" type="e1699d580cb2f0f6ee1c931d-text/javascript"></script>
<script src="assets/js/app.min.js" type="e1699d580cb2f0f6ee1c931d-text/javascript"></script>
<!-- ================== END core-js ================== -->

<script src="assets/plugins/kbw-countdown/dist/js/jquery.plugin.js" type="e1699d580cb2f0f6ee1c931d-text/javascript"></script>
<script src="assets/plugins/kbw-countdown/dist/js/jquery.countdown.js" type="e1699d580cb2f0f6ee1c931d-text/javascript"></script>
<script src="assets/js/demo/page-coming-soon.demo.js" type="e1699d580cb2f0f6ee1c931d-text/javascript"></script>


<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3" type="e1699d580cb2f0f6ee1c931d-text/javascript"></script>

<script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="e1699d580cb2f0f6ee1c931d-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"927e1e9faf13c86b","version":"2025.3.0","r":1,"serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"4db8c6ef997743fda032d4f73cfeff63","b":1}' crossorigin="anonymous"></script>
</body>

</html>
