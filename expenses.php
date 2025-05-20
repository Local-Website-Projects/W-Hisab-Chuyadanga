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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> অনুদান | এ্যাডমিন </title>
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
            <?php
            if(isset($_SESSION['status'])){
                if($_SESSION['status'] == 'Success'){
                    ?>
                    <div class="alert alert-success mt-3 mb-3">
                        <strong>Success!</strong> Information added successfully.
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
            <!-- modal-cover -->
            <button type="button" class="btn btn-theme me-2 mb-5 mt-3" data-bs-toggle="modal" data-bs-target="#modalCoverExample"> নতুন অনুদান যুক্ত করুন </button>
            <div class="modal modal-cover fade" id="modalCoverExample">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">নতুন অনুদান যুক্ত করুন!</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="Insert" method="post">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1"> নাম </label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="ব্যক্তির নাম" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">ঠিকানা</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="address" placeholder="ঠিকানা" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlSelect1"> খাত নির্বাচন করুন </label>
                                            <select class="form-select" id="exampleFormControlSelect1" name="cat_id" required>
                                                <option selected disabled>খাত নির্বাচন করুন</option>
                                                <?php
                                                $fetch_category = $db_handle->runQuery("select * from categories order by cat_id desc");
                                                $fetch_category_no = $db_handle->numRows("select * from categories order by cat_id desc");
                                                for($i=0; $i<$fetch_category_no; $i++){
                                                    ?>
                                                    <option value="<?php echo $fetch_category[$i]['cat_id'];?>"><?php echo $fetch_category[$i]['category_name'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3 mt-5">
                                            <button type="submit" name="add_expense" class="btn btn-theme">যুক্ত করুন</button>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">ফোন নাম্বার</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="phone" placeholder="ফোন নাম্বার" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="exampleFormControlInput1">টাকার পরিমান</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput1" name="amount" placeholder="টাকার পরিমান" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_GET['edit'])){
                $fetch_details = $db_handle->runQuery("select * from expenses where exp_id = '".$_GET['edit']."'");
                ?>
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
                    <div class="card-body pb-2 mb-5">
                        <form action="Update" method="post">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleFormControlInput1"> নাম </label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="নাম" value="<?php echo $fetch_details[0]['name'];?>" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleFormControlInput1"> ফোন নাম্বার </label>
                                        <input type="number" class="form-control" id="exampleFormControlInput1" name="phone" placeholder="ফোন নাম্বার" value="<?php echo $fetch_details[0]['phone'];?>" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleFormControlSelect1"> খাত পরিবর্তন করুন </label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="cat_id" required>

                                            <?php
                                            $fetch_selected_category = $db_handle->runQuery("select * from categories where cat_id = {$fetch_details[0]['cat_id']}");
                                            ?>
                                            <option selected value="<?php echo $fetch_selected_category[0]['cat_id'];?>"><?php echo $fetch_selected_category[0]['category_name'];?></option>
                                            <?php
                                            $fetch_category = $db_handle->runQuery("select * from categories order by cat_id desc");
                                            $fetch_category_no = $db_handle->numRows("select * from categories order by cat_id desc");
                                            for($i=0; $i<$fetch_category_no; $i++){
                                                ?>
                                                <option value="<?php echo $fetch_category[$i]['cat_id'];?>"><?php echo $fetch_category[$i]['category_name'];?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 mt-5">
                                        <button type="submit" name="update_expenses" class="btn btn-theme"> সেভ করুন </button>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleFormControlInput1"> ঠিকানা </label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="address" placeholder="ঠিকানা" value="<?php echo $fetch_details[0]['address'];?>" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="exampleFormControlInput1"> টাকার পরিমান </label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="amount" placeholder="টাকার পরিমান" value="<?php echo $fetch_details[0]['amount'];?>" required>
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $fetch_details[0]['exp_id'];?>" name="exp_id"/>

                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>

            <!-- BEGIN row -->
            <div class="row justify-content-center">
                <!-- BEGIN col-10 -->
                <div class="col-xl-12">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-9 -->
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-8">
                                    <h1 class="page-header">
                                        অনুদান <small> অনুদান সম্পর্কিত সকল তথ্য </small>
                                    </h1>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="searchInput" name="amount" placeholder="সার্চ করুন" required>
                                    </div>
                                </div>
                            </div>

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
                                                <th>নাম</th>
                                                <th> ফোন নাম্বার </th>
                                                <th> ঠিকানা </th>
                                                <th> খাতের নাম </th>
                                                <th> অর্থের পরিমান </th>
                                                <th>তারিখ</th>
                                                <th>সম্পাদনা</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = "SELECT * FROM categories,expenses WHERE expenses.cat_id = categories.cat_id order by expenses.exp_id DESC";
                                            $expertise = $db_handle->runQuery($query);
                                            $e_no = $db_handle->numRows($query);
                                            for($i=0; $i<$e_no; $i++){
                                                ?>
                                                <tr>
                                                    <td><?php echo $i+1;?></td>
                                                    <td><?php echo $expertise[$i]['name'];?></td>
                                                    <td><?php echo $expertise[$i]['phone'];?></td>
                                                    <td><?php echo $expertise[$i]['address'];?></td>
                                                    <td><?php echo $expertise[$i]['category_name'];?></td>
                                                    <td><?php echo $expertise[$i]['amount'];?></td>
                                                    <td><?php echo $expertise[$i]['inserted_at'];?></td>
                                                    <td><a href="Expenses?edit=<?php echo $expertise[$i]['exp_id'];?>"><i class="fas fa-lg fa-fw me-2 fa-pencil-alt"></i></a></td>
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

<?php include ('includes/js.php');?>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#datatableDefault tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
</body>

</html>

