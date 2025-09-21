<?php
session_start();
include('../condb.php');

// ตรวจสอบการเข้าสู่ระบบ
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
  <title>แก้ไขข้อมูลส่วนตัว</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <style>
    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #ddd;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="card shadow-sm p-4 mx-auto" style="max-width: 600px;">
    <div class="card-body">
      <h3 class="card-title text-center">แก้ไขข้อมูลส่วนตัว</h3>
      <hr>
      <form action="edit_profile_db.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
        <input type="hidden" name="old_img" value="<?php echo $row['m_img']; ?>">

        <div class="form-group text-center">
          <img src="../m_img/<?php echo $row['m_img']; ?>" class="profile-img mb-3" alt="รูปโปรไฟล์">
        </div>

        <div class="form-group">
          <label for="m_user">ชื่อผู้ใช้</label>
          <input type="text" class="form-control" name="m_user" id="m_user" value="<?php echo htmlspecialchars($row['m_user']); ?>" required>
        </div>

        <div class="form-group">
          <label for="m_name">ชื่อ-นามสกุล</label>
          <input type="text" class="form-control" name="m_name" id="m_name" value="<?php echo htmlspecialchars($row['m_name']); ?>" required>
        </div>

        <div class="form-group">
          <label for="m_address">ที่อยู่</label>
          <textarea class="form-control" name="m_address" id="m_address" rows="3" required><?php echo htmlspecialchars($row['m_address']); ?></textarea>
        </div>

        <div class="form-group">
          <label for="m_tel">เบอร์โทรศัพท์</label>
          <input type="tel" class="form-control" name="m_tel" id="m_tel" value="<?php echo htmlspecialchars($row['m_tel']); ?>" required>
        </div>

        <div class="form-group">
          <label for="m_email">อีเมล</label>
          <input type="email" class="form-control" name="m_email" id="m_email" value="<?php echo htmlspecialchars($row['m_email']); ?>" required>
        </div>

        <div class="form-group">
          <label for="m_img">รูปโปรไฟล์ใหม่</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="m_img" name="m_img" accept="image/*">
            <label class="custom-file-label" for="m_img">เลือกไฟล์รูปภาพ</label>
          </div>
        </div>

        <div class="mt-4 text-center">
          <button type="submit" name="submit_edit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
          <a href="profile.php" class="btn btn-secondary">ยกเลิก</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // แสดงชื่อไฟล์เมื่อมีการเลือกรูปภาพ
  $('#m_img').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').html(fileName);
  });
</script>
</body>
</html>
