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

if(isset($_GET['update'])){
    $fetch_status = $db_handle->runQuery("SELECT status from doctors_contact WHERE contact_id = '".$_GET['update']."'");
    if($fetch_status[0]['status'] == 0){
        $status = "1";
    } else{
        $status = "0";
    }

    $update_status = $db_handle->insertQuery("UPDATE doctors_contact SET status = '$status' WHERE contact_id = '".$_GET['update']."'");
    if($update_status){
        $_SESSION['status'] = 'Success';
        echo "<script>window.location.href = 'Dashboard';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Admin</title>
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
    <div id="content" class="app-content p-3">
        <!-- BEGIN row -->
        <div class="row g-2">
            <!-- BEGIN col-12 -->
            <div class="col-xl-12">
                <!-- BEGIN row -->
                <div class="row g-2">
                    <!-- BEGIN col-2 -->
                    <div class="col-xl-2 col-lg-3 col-6">
                        <!-- BEGIN card -->
                        <div class="card h-100">
                            <!-- BEGIN card-header -->
                            <div class="card-header">Blogs</div>
                            <!-- END card-header -->

                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <?php
                                $fetch_blog_no = $db_handle->numRows("SELECT * FROM `doctors_blog` WHERE `doctor_id` = 1");
                                ?>
                                <div class="h4 fw-100 text-theme mb-1"><?php echo $fetch_blog_no;?></div>
                            </div>
                            <!-- END card-body -->
                        </div>
                        <!-- END card -->
                    </div>
                    <!-- END col-2 -->

                    <!-- BEGIN col-2 -->
                    <div class="col-xl-2 col-lg-3 col-6">
                        <!-- BEGIN card -->
                        <div class="card h-100">
                            <!-- BEGIN card-header -->
                            <div class="card-header">Contact Data</div>
                            <!-- END card-header -->

                            <!-- BEGIN card-body -->
                            <div class="card-body">
                                <?php
                                $fetch_contact_data = $db_handle->numRows("SELECT * FROM `doctors_contact` WHERE `doctor_id`=1");
                                ?>
                                <div class="h4 fw-100 text-theme mb-1"><?php echo $fetch_contact_data;?></div>
                            </div>
                            <!-- END card-body -->
                        </div>
                        <!-- END card -->
                    </div>
                    <!-- END col-2 -->

                </div>
                <!-- END row -->
            </div>
            <!-- END col-12 -->

            <div class="col-xl-12 mt-5">
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
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-9 -->
                    <div class="col-xl-12">
                        <h1 class="page-header">
                            Contact <small>all your contact request goes here...</small>
                        </h1>

                        <hr class="mb-4 opacity-3" />

                        <!-- BEGIN #datatable -->
                        <div id="datatable" class="mb-5">
                            <div class="card">
                                <div class="card-header with-btn">
                                    INSTALLATION
                                    <div class="card-header-btn">
                                        <a href="#" data-toggle="card-collapse" class="btn"><iconify-icon icon="material-symbols-light:stat-minus-1"></iconify-icon></a>
                                        <a href="#" data-toggle="card-expand" class="btn"><iconify-icon icon="material-symbols-light:fullscreen"></iconify-icon></a>
                                        <a href="#" data-toggle="card-remove" class="btn"><iconify-icon icon="material-symbols-light:close-rounded"></iconify-icon></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="datatableDefault" width="100%" class="table text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * FROM doctors_contact where doctor_id = '1' order by contact_id DESC";
                                        $contact = $db_handle->runQuery($query);
                                        $e_no = $db_handle->numRows($query);
                                        for($i=0; $i<$e_no; $i++){
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                <td><?php echo $contact[$i]['name'];?></td>
                                                <td><?php echo $contact[$i]['email'];?></td>
                                                <td><?php echo $contact[$i]['phone_number'];?></td>
                                                <td><?php echo $contact[$i]['message'];?></td>
                                                <td><?php if($contact[$i]['status'] == 0) {
                                                    ?>
                                                <a href="Dashboard?update=<?php echo $contact[$i]['contact_id'];?>"><span class="badge bg-danger bg-opacity-10 text-danger border border-danger">Unread</span></a>
                                                <?php
                                                }
                                                else {?>
                                                <a href="Dashboard?update=<?php echo $contact[$i]['contact_id'];?>"><span class="badge bg-success bg-opacity-10 text-success border border-success">Read</span> </a>
                                                <?php }?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END #datatable -->
                    </div>
                    <!-- END col-9-->
                </div>
                <!-- END row -->
            </div>
        </div>
        <!-- END row -->
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

<?php include ('includes/js.php');?>
</body>

</html>

