<?php
session_start();
include('../condb.php');

if (!isset($_SESSION['member_id'])) {
    header("Location: ../form_login.php");
    exit();
}

if (isset($_POST['submit_edit'])) {
    // รับค่าจากฟอร์ม
    $member_id = intval($_POST['member_id']);
    $m_user = mysqli_real_escape_string($con, $_POST['m_user']);
    $m_name = mysqli_real_escape_string($con, $_POST['m_name']);
    $m_address = mysqli_real_escape_string($con, $_POST['m_address']);
    $m_tel = mysqli_real_escape_string($con, $_POST['m_tel']);
    $m_email = mysqli_real_escape_string($con, $_POST['m_email']);
    $old_img = mysqli_real_escape_string($con, $_POST['old_img']);

    $new_img = $old_img;

    // โฟลเดอร์เก็บรูปภาพ
    $upload_dir = "../m_img/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // ตรวจสอบว่ามีการอัปโหลดรูปใหม่หรือไม่
    if (isset($_FILES['m_img']) && $_FILES['m_img']['error'] == 0) {
        $ext = pathinfo($_FILES['m_img']['name'], PATHINFO_EXTENSION);
        $new_img = "m_" . time() . "." . $ext;
        move_uploaded_file($_FILES['m_img']['tmp_name'], $upload_dir . $new_img);
        
        // ลบรูปเก่าถ้าไม่ใช่รูป default
        if ($old_img != 'default.jpg' && file_exists($upload_dir . $old_img)) {
            unlink($upload_dir . $old_img);
        }
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    $sql_update = "UPDATE tbl_member SET 
                   m_user = '$m_user',
                   m_name = '$m_name',
                   m_address = '$m_address',
                   m_tel = '$m_tel',
                   m_email = '$m_email',
                   m_img = '$new_img'
                   WHERE member_id = $member_id";

    if (mysqli_query($con, $sql_update)) {
        // อัปเดต session
        $_SESSION['m_name'] = $m_name;
        $_SESSION['m_img'] = $new_img;

        echo "<script>alert('แก้ไขข้อมูลสำเร็จ');</script>";
        echo "<script>window.location='profile.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล: " . mysqli_error($con) . "');</script>";
        echo "<script>window.history.back();</script>";
    }
} else {
    echo "<script>alert('ไม่ได้รับข้อมูล');</script>";
    echo "<script>window.location='profile.php';</script>";
}
?>
