<?php
session_start();
include('../condb.php');

if (!isset($_SESSION['member_id'])) {
    header("Location: ../form_login.php");
    exit();
}

// ตรวจสอบและเพิ่มคอลัมน์ bank_id และ slip หากไม่มี
$sql_check_bank_id = "SHOW COLUMNS FROM `tbl_payment` LIKE 'bank_id'";
$result_check = mysqli_query($con, $sql_check_bank_id);
if (mysqli_num_rows($result_check) == 0) {
    $sql_add_bank_id = "ALTER TABLE `tbl_payment` ADD `bank_id` INT(11) NOT NULL AFTER `o_id`";
    mysqli_query($con, $sql_add_bank_id);
}

$sql_check_pay_slip = "SHOW COLUMNS FROM `tbl_payment` LIKE 'pay_slip'";
$result_check_slip = mysqli_query($con, $sql_check_pay_slip);
if (mysqli_num_rows($result_check_slip) == 0) {
    $sql_add_pay_slip = "ALTER TABLE `tbl_payment` ADD `pay_slip` VARCHAR(255) NOT NULL AFTER `pay_time`";
    mysqli_query($con, $sql_add_pay_slip);
}

// รับค่าจากฟอร์ม
$o_id       = intval($_POST['o_id']);
$pay_amount = mysqli_real_escape_string($con, $_POST['pay_amount']);
$pay_date   = mysqli_real_escape_string($con, $_POST['pay_date']);
$pay_time   = mysqli_real_escape_string($con, $_POST['pay_time']);
// ตรวจสอบว่ามี bank_id หรือไม่
$bank_id = isset($_POST['bank_id']) ? intval($_POST['bank_id']) : 0;


// โฟลเดอร์เก็บสลิป
$upload_dir = "../slip/";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$slip_file = "";
if (isset($_FILES['slip']) && $_FILES['slip']['error'] == 0) {
    $ext = pathinfo($_FILES['slip']['name'], PATHINFO_EXTENSION);
    $slip_file = "slip_" . time() . "." . $ext;
    move_uploaded_file($_FILES['slip']['tmp_name'], $upload_dir . $slip_file);
}

// บันทึกลงตาราง tbl_payment
$sql = "INSERT INTO tbl_payment (o_id, bank_id, pay_amount, pay_date, pay_time, pay_slip)
         VALUES ($o_id, $bank_id, '$pay_amount', '$pay_date', '$pay_time', '$slip_file')";

if (mysqli_query($con, $sql)) {
    // อัปเดตสถานะ order
    $update = "UPDATE tbl_order SET status = 'checking' WHERE o_id = $o_id";
    mysqli_query($con, $update);

    echo "<script>alert('บันทึกการชำระเงินเรียบร้อยแล้ว รอการตรวจสอบจาก Admin');</script>";
    echo "<script>window.location='order.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');</script>";
    echo "<script>window.history.back();</script>";
}
?>