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

$admin = $_SESSION['admin'];


if(isset($_POST['add_expense'])){
    $name = $db_handle->checkValue($_POST['name']);
    $address = $db_handle->checkValue($_POST['address']);
    $cat_id = $db_handle->checkValue($_POST['cat_id']);
    $phone = $db_handle->checkValue($_POST['phone']);
    $amount = $db_handle->checkValue($_POST['amount']);

    $insert_expense = $db_handle->insertQuery("");

    if($insert_expense){
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

if(isset($_POST['add_category'])){
    $cat_name = $db_handle->checkValue($_POST['cat_name']);

    $insert_category = $db_handle->insertQuery("INSERT INTO `categories`(`category_name`, `inserted_at`) VALUES ('$cat_name','$inserted_at')");
    if($insert_category){
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

if(isset($_POST['add_service'])){
    $service_title = $db_handle->checkValue($_POST['service_title']);
    $short_desc = $db_handle->checkValue($_POST['short_desc']);

    $insert_service = $db_handle->insertQuery("INSERT INTO `doctors_services`(`doctor_id`, `service_title`, `short_desc`, `inserted_at`) VALUES ('$admin','$service_title','$short_desc','$inserted_at')");
    if($insert_service){
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


if(isset($_POST['add_blog'])){
    $blog_title = $db_handle->checkValue($_POST['blog_title']);
    $publish_date = $db_handle->checkValue($_POST['publish_date']);
    $blog_body = $db_handle->checkValue($_POST['blog_body']);

    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp  = $_FILES['image']['tmp_name'];
        move_uploaded_file($file_tmp, "../blog_image/" . $file_name);
        $image = "blog_image/" . $file_name;
    }

    $insert_blog = $db_handle->insertQuery("INSERT INTO `doctors_blog`(`doctor_id`, `blog_title`, `publish_date`, `blog_body`,`blog_image`, `inserted_at`) VALUES ('$admin','$blog_title','$publish_date','$blog_body','$image','$inserted_at')");
    if($insert_blog){
        $_SESSION['status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Blogs';
</script>
        ";
    } else {
        $_SESSION['status'] = 'Error';
        echo "
        <script>
        window.location.href = 'Blogs';
</script>
        ";
    }
}


if(isset($_POST['add_patient'])){
    $full_name = $db_handle->checkValue($_POST['full_name']);
    $patient_age = $db_handle->checkValue($_POST['patient_age']);
    $contact_number = $db_handle->checkValue($_POST['contact_number']);
    $gender = $db_handle->checkValue($_POST['gender']);

    $insert_patient = $db_handle->insertQuery("INSERT INTO `patients_data`(`full_name`, `age`, `contact_number`, `gender`, `inserted_at`) VALUES ('$full_name','$patient_age','$contact_number','$gender','$inserted_at')");
    if($insert_patient){
        $fetch_last_id = $db_handle->runQuery("SELECT `patient_id` FROM `patients_data` ORDER BY patient_id DESC LIMIT 1");
        $_SESSION['status'] = 'Success';
        echo "
        <script>
        window.location.href = 'Make-Prescription?id=".$fetch_last_id[0]['patient_id']."';
</script>
        ";
    } else {
        $_SESSION['status'] = 'Error';
        echo "
        <script>
        window.location.href = 'Make-Prescription';
</script>
        ";
    }
}


if(isset($_POST['generate_prescription'])){
    $patient_id = $db_handle->checkValue($_POST['patient_id']);
    $patient_data = $db_handle->checkValue($_POST['patient_data']);
    $patient_complain = $db_handle->checkValue($_POST['patient_complain']);
    $medical_tests = $db_handle->checkValue($_POST['medical_tests']);
    $doctor_observation = $db_handle->checkValue($_POST['doctor_observation']);

    $medicine = implode(",", array_filter(array_map([$db_handle, 'checkValue'], $_POST['medicine'])));
    $dose = implode(",", array_filter(array_map([$db_handle, 'checkValue'], $_POST['dose'])));
    $meal = implode(",", array_filter(array_map([$db_handle, 'checkValue'], $_POST['meal'])));
    $duration = implode(",", array_filter(array_map([$db_handle, 'checkValue'], $_POST['duration'])));

    $doctor_advice = $db_handle->checkValue($_POST['doctor_advice']);

    try {
        $db_handle->beginTransaction();

        $db_handle->insertQuery("INSERT INTO `prescription_data`(`medicine_name`, `patient_id`, `dose`, `meal`, `duration`, `inserted_at`) VALUES ('$medicine','$patient_id','$dose','$meal','$duration','$inserted_at')");
        $fetch_patient_id = $db_handle->runQuery("SELECT `prescription_id` FROM `prescription_data` ORDER BY prescription_id DESC LIMIT 1");
        $prescription_id = $fetch_patient_id[0]['prescription_id'];
        $db_handle->insertQuery("INSERT INTO `prescription_general_info`(`prescription_id`, `patient_id`, `patient_data`, `inserted_at`) VALUES ('$prescription_id','$patient_id','$patient_data','$inserted_at')");
        $db_handle->insertQuery("INSERT INTO `prescription_patient_symptoms`(`prescription_id`, `patient_id`, `patient_symptoms`, `inserted_at`) VALUES ('$prescription_id','$patient_id','$patient_complain','$inserted_at')");
        $db_handle->insertQuery("INSERT INTO `prescription_test_info`(`prescription_id`, `patient_id`, `medical_test`, `inserted_at`) VALUES ('$prescription_id','$patient_id','$medical_tests','$inserted_at')");
        $db_handle->insertQuery("INSERT INTO `prescription_doctor_observation`(`prescription_id`, `patient_id`, `doctor_observation`, `inserted_at`) VALUES ('$prescription_id','$patient_id','$doctor_observation','$inserted_at')");
        $db_handle->insertQuery("INSERT INTO `prescription_advice`(`prescription_id`, `patient_id`, `doctors_advice`, `inserted_at`) VALUES ('$prescription_id','$patient_id','$doctor_advice','$inserted_at')");

        $db_handle->commit();
        echo "
        <script>
        window.location.href = 'Print-Prescription?id=".$prescription_id."';
</script>
        ";
    } catch (Exception $e) {
        $db_handle->rollback();
        echo "
        <script>
        window.location.href = 'Make-Prescription';
</script>
        ";
    }
}