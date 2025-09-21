<?php
session_start();
include('../condb.php');

if (!isset($_SESSION['member_id'])) {
    header("Location: ../form_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เปลี่ยนรหัสผ่าน</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px;">
    <div class="card-body">
      <h3 class="card-title text-center">เปลี่ยนรหัสผ่าน</h3>
      <hr>
      <form action="change_password_db.php" method="post" id="passwordForm">
        <div class="form-group">
          <label for="old_pass">รหัสผ่านปัจจุบัน</label>
          <input type="password" class="form-control" id="old_pass" name="old_pass" required>
        </div>
        <div class="form-group">
          <label for="new_pass">รหัสผ่านใหม่</label>
          <input type="password" class="form-control" id="new_pass" name="new_pass" required>
        </div>
        <div class="form-group">
          <label for="confirm_pass">ยืนยันรหัสผ่านใหม่</label>
          <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" required>
          <small id="passwordHelpBlock" class="form-text text-muted d-none">
            รหัสผ่านใหม่ไม่ตรงกัน
          </small>
        </div>
        <div class="mt-4 text-center">
          <button type="submit" class="btn btn-primary" name="submit_change">บันทึก</button>
          <a href="profile.php" class="btn btn-secondary">ยกเลิก</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $('#passwordForm').on('submit', function(event) {
    const newPass = $('#new_pass').val();
    const confirmPass = $('#confirm_pass').val();
    const passwordHelp = $('#passwordHelpBlock');

    if (newPass !== confirmPass) {
      event.preventDefault(); // ไม่ให้ฟอร์มส่งข้อมูล
      passwordHelp.removeClass('d-none').addClass('text-danger');
    } else {
      passwordHelp.addClass('d-none');
    }
  });
</script>
</body>
</html>