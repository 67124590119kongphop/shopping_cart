<?php
session_start();
include('../condb.php');

// ถ้าไม่ได้ล็อกอินให้เด้งไป login
if (!isset($_SESSION['member_id'])) {
    header("Location: ../form_login.php");
    exit();
}

$member_id = $_SESSION['member_id'];

// ดึงข้อมูลสมาชิกจากฐานข้อมูล
$sql = "SELECT * FROM tbl_member WHERE member_id = $member_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<script>alert('ไม่พบข้อมูลสมาชิก');</script>";
    echo "<script>window.location='../index.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ข้อมูลส่วนตัว</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <style>
    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #ddd;
    }
    .card-title {
      color: #333;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px;">
    <div class="card-body text-center">
      <h3 class="card-title">ข้อมูลส่วนตัว</h3>
      <hr>
      <img src="../m_img/<?php echo $row['m_img']; ?>" class="profile-img my-3" alt="รูปโปรไฟล์">
      <h4 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row['m_user']); ?></h4>
      <p class="card-text">
        <b>ชื่อ-นามสกุล:</b> <?php echo htmlspecialchars($row['m_name']); ?><br>
        <b>ที่อยู่:</b> <?php echo htmlspecialchars($row['m_address']); ?><br>
        <b>เบอร์โทรศัพท์:</b> <?php echo htmlspecialchars($row['m_tel']); ?><br>
        <b>อีเมล:</b> <?php echo htmlspecialchars($row['m_email']); ?>
      </p>
      <div class="mt-4">
        <a href="edit_profile.php" class="btn btn-primary">แก้ไขข้อมูล</a>
        <a href="change_password.php" class="btn btn-warning">แก้ไขรหัสผ่าน</a>
        <a href="index.php" class="btn btn-secondary">กลับหน้าหลัก</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
