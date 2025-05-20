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


if(isset($_POST['update_basic_info'])){
    $id = $db_handle->checkValue($_POST['id']);
    $name = $db_handle->checkValue($_POST['name']);
    $birth_place = $db_handle->checkValue($_POST['birth_place']);
    $email = $db_handle->checkValue($_POST['email']);
    $age = $db_handle->checkValue($_POST['age']);
    $contact_number = $db_handle->checkValue($_POST['contact_number']);
    $year_exp = $db_handle->checkValue($_POST['year_exp']);

    $update_basic_info = $db_handle->insertQuery("UPDATE `doctors_basic_info` SET `doctors_name`='$name',`doctors_age`='$age',`doctors_birthplace`='$birth_place',`doctors_phone_number`='$contact_number',`doctors_email`='$email',`updated_at`='$inserted_at', `doctors_years_of_experience` = '$year_exp' WHERE `doctors_id` = '$id'");
    if($update_basic_info){
        $_SESSION['status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Basic-Info';
</script>
        ";
    } else {
        $_SESSION['status'] = 'Error';
        echo "
        <script>
        window.location.href = 'Basic-Info';
</script>
        ";
    }
}


if(isset($_POST['update_social_media'])){
    $id = $db_handle->checkValue($_POST['id']);
    $whatsapp = $db_handle->checkValue($_POST['whatsapp']);
    $facebook = $db_handle->checkValue($_POST['facebook']);
    $linkedin = $db_handle->checkValue($_POST['linkedin']);
    $instagram = $db_handle->checkValue($_POST['instagram']);

    $update_social_media = $db_handle->insertQuery("UPDATE `doctors_social_media` SET `whatsapp`='$whatsapp',`facebook`='$facebook',`linkedin`='$linkedin',`instagram`='$instagram', `updated_at`='$inserted_at' WHERE `doctors_id` = '$id'");
    if($update_social_media){
        $_SESSION['status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Social-Media';
</script>
        ";
    } else {
        $_SESSION['status'] = 'Error';
        echo "
        <script>
        window.location.href = 'Social-Media';
</script>
        ";
    }
}


if(isset($_POST['update_expenses'])){
    $id = $db_handle->checkValue($_POST['exp_id']);
    $name = $db_handle->checkValue($_POST['name']);
    $phone = $db_handle->checkValue($_POST['phone']);
    $cat_id = $db_handle->checkValue($_POST['cat_id']);
    $address = $db_handle->checkValue($_POST['address']);
    $amount = $db_handle->checkValue($_POST['amount']);

    $update_expense = $db_handle->insertQuery("UPDATE `expenses` SET `name`='$name',`phone`='$phone',`address`='$address',`cat_id`='$cat_id',`amount`='$amount',`updated_at`='$inserted_at' WHERE `exp_id` = '$id'");
    if($update_expense){
        $_SESSION['status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Expenses';
</script>
        ";
    } else {
        $_SESSION['status'] = 'Error';
        echo "
        <script>
        window.location.href = 'Expenses';
</script>
        ";
    }
}

if(isset($_POST['update_category'])){
    $id = $db_handle->checkValue($_POST['cat_id']);
    $cat_title = $db_handle->checkValue($_POST['cat_title']);

    $update_category = $db_handle->insertQuery("UPDATE `categories` SET `category_name`='$cat_title',`updated_at`='$inserted_at' WHERE `cat_id` = '$id'");
    if($update_category){
        $_SESSION['status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Categories';
</script>
        ";
    } else {
        $_SESSION['status'] = 'Error';
        echo "
        <script>
        window.location.href = 'Categories';
</script>
        ";
    }
}


if(isset($_POST['update_service'])){
    $id = $db_handle->checkValue($_POST['experience_id']);
    $service_title = $db_handle->checkValue($_POST['service_title']);
    $short_desc = $db_handle->checkValue($_POST['doctor_service_id']);

    $update_service = $db_handle->insertQuery("UPDATE `doctors_services` SET `service_title`='$service_title',`short_desc`='$short_desc',`updated_at`='$inserted_at' WHERE `doctor_service_id`='$id'");
    if($update_service){
        $_SESSION['status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Services';
</script>
        ";
    } else {
        $_SESSION['status'] = 'Error';
        echo "
        <script>
        window.location.href = 'Services';
</script>
        ";
    }
}


if(isset($_POST['update_password'])){
    $password = $db_handle->checkValue($_POST['password']);
    $new_password = $db_handle->checkValue($_POST['new_password']);
    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

    $fetch_password = $db_handle->runQuery("SELECT * FROM `login` WHERE `id`={$_SESSION['admin']}");
    $hashed_password = $fetch_password[0]['password'];
    if(password_verify($password, $hashed_password)){
        $update_password = $db_handle->insertQuery("UPDATE `login` SET`password`='$hashedPassword',`updated_at`='$inserted_at' WHERE `id`={$_SESSION['admin']}");
        if($update_password){
            $_SESSION['status'] = 'Success';
            echo "<script>window.location.href='Update-Password';</script>";
        } else{
            $_SESSION['status'] = 'Error';
            echo "<script>window.location.href='Update-Password';</script>";
        }
    } else {
        $_SESSION['status'] = 'Error';
        echo "<script>window.location.href='Update-Password';</script>";
    }
}