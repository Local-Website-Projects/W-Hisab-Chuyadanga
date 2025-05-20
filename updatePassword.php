<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");
if(!isset($_SESSION['admin'])){
    echo "
    <script>window.location.href = 'Login';</script>
    ";
}

$fetch_doctor_data = $db_handle->runQuery("SELECT * FROM `doctors_basic_info` where doctors_id = '".$_SESSION['admin']."'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Update Password | Admin</title>
    <?php include ('includes/css.php');?>

</head>
<body >
<!-- BEGIN #loader -->
<?php include ('includes/preloader.php');?>
<!-- END #loader -->

<!-- BEGIN #app -->
<div id="app" class="app">
    <!-- BEGIN #header -->
    <?php include ('includes/headerfile.php');?>
    <!-- END #header -->

    <!-- BEGIN #sidebar -->
    <?php include ('includes/sidemenu.php');?>
    <!-- END #sidebar -->

    <!-- BEGIN mobile-sidebar-backdrop -->
    <?php include ('includes/mobilebutton.php');?>
    <!-- END mobile-sidebar-backdrop -->

    <!-- BEGIN #content -->
    <div id="content" class="app-content">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN row -->
            <div class="row justify-content-center">
                <!-- BEGIN col-10 -->
                <div class="col-xl-10">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-9 -->
                        <div class="col-xl-12">

                            <h1 class="page-header">
                                Update Password <small>you can update your password from here...</small>
                            </h1>

                            <hr class="mb-4 opacity-3" />

                            <!-- BEGIN #formControls -->
                            <div id="formControls" class="mb-5">
                                <div class="card">
                                    <?php
                                    if(isset($_SESSION['status'])){
                                        if($_SESSION['status'] == 'Success'){
                                            ?>
                                            <div class="alert alert-success mt-3 mb-3">
                                                <strong>Success!</strong> Information updated successfully.
                                            </div>
                                            <?php
                                        } if($_SESSION['status'] == 'Error'){
                                            ?>
                                            <div class="alert alert-danger mt-3 mb-3">
                                                <strong>Sorry!</strong> Something went wrong.
                                            </div>
                                            <?php
                                        }
                                        unset($_SESSION['status']);
                                    }
                                    ?>

                                    <div class="card-header with-btn">
                                        INSTALLATION
                                        <div class="card-header-btn">
                                            <a href="#" data-toggle="card-collapse" class="btn"><iconify-icon icon="material-symbols-light:stat-minus-1"></iconify-icon></a>
                                            <a href="#" data-toggle="card-expand" class="btn"><iconify-icon icon="material-symbols-light:fullscreen"></iconify-icon></a>
                                            <a href="#" data-toggle="card-remove" class="btn"><iconify-icon icon="material-symbols-light:close-rounded"></iconify-icon></a>
                                        </div>
                                    </div>
                                    <div class="card-body pb-2">
                                        <form action="Update" method="post">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label" for="exampleFormControlInput1">Old Password <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" id="exampleFormControlInput1" name="password" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">New Password <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control form-control-lg fs-14px" id="password" name="new_password" autocomplete="off" required/>
                                                        <small id="passwordError" class="text-danger"></small>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control form-control-lg fs-14px" id="confirm_new_password" name="confirm_password" autocomplete="off" required/>
                                                        <small id="confirmPasswordError" class="text-danger"></small>
                                                    </div>

                                                    <div class="form-group mb-3 mt-5">
                                                        <button type="submit" name="update_password" id="update_password" class="btn btn-theme">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END #formControls -->
                        </div>
                        <!-- END col-9-->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END col-10 -->
            </div>
            <!-- END row -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #content -->

    <!-- BEGIN btn-scroll-top -->
    <?php include ('includes/scrolltop.php');?>
    <!-- END btn-scroll-top -->

    <!-- BEGIN theme-panel -->
    <?php include ('includes/themecolor.php');?>
    <!-- END theme-panel -->
</div>
<!-- END #app -->
<script>
    document.getElementById("update_password").addEventListener("click", function(event) {
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirm_password").value;
        let passwordError = document.getElementById("passwordError");
        let confirmPasswordError = document.getElementById("confirmPasswordError");

        // Regular expression to check password complexity
        let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Reset errors
        passwordError.textContent = "";
        confirmPasswordError.textContent = "";

        if (!passwordRegex.test(password)) {
            passwordError.textContent = "Password must be at least 8 characters, include an uppercase letter, lowercase letter, number, and special character.";
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (password !== confirmPassword) {
            confirmPasswordError.textContent = "Passwords do not match.";
            event.preventDefault(); // Prevent form submission
        }
    });
</script>

<?php include ('includes/js.php');?>
</body>

</html>

