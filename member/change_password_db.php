<?php
session_start();
include('../condb.php');

if (!isset($_SESSION['member_id'])) {
    header("Location: ../form_login.php");
    exit();
}

if (isset($_POST['submit_change'])) {
    $member_id = $_SESSION['member_id'];
    $old_pass = mysqli_real_escape_string($con, $_POST['old_pass']);
    $new_pass = mysqli_real_escape_string($con, $_POST['new_pass']);

    // ตรวจสอบรหัสผ่านเก่า
    $sql_check = "SELECT m_pass FROM tbl_member WHERE member_id = $member_id";
    $result = mysqli_query($con, $sql_check);
    $row = mysqli_fetch_assoc($result);

    if ($row['m_pass'] === $old_pass) {
        // อัปเดตรหัสผ่านใหม่
        $sql_update = "UPDATE tbl_member SET m_pass = '$new_pass' WHERE member_id = $member_id";
        if (mysqli_query($con, $sql_update)) {
            echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ');</script>";
            echo "<script>window.location='profile.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน');</script>";
            echo "<script>window.history.back();</script>";
        }
    } else {
        echo "<script>alert('รหัสผ่านปัจจุบันไม่ถูกต้อง');</script>";
        echo "<script>window.history.back();</script>";
    }
} else {
    echo "<script>alert('ไม่ได้รับข้อมูล');</script>";
    echo "<script>window.location='profile.php';</script>";
}
?>
