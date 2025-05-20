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

if(isset($_GET['dlt'])){

    $fetch_blog_image = $db_handle->runQuery("select blog_image from doctors_blog where blog_id = '".$_GET['dlt']."'");
    unlink('../'.$fetch_blog_image[0]['blog_image']);

    $dlt_blog = $db_handle->insertQuery("DELETE FROM doctors_blog WHERE blog_id  = '".$_GET['dlt']."'");
    if($dlt_blog){
        $_SESSION['dlt_status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Blogs';
</script>
        ";
    }
}