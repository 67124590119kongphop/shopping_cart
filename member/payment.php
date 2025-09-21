<?php
session_start();
include('../condb.php');

// ถ้าไม่ได้ล็อกอินให้เด้งไป login
if (!isset($_SESSION['member_id'])) {
    header("Location: ../form_login.php");
    exit();
}

$member_id = $_SESSION['member_id'];

// ดึงออเดอร์ที่ยังไม่ชำระ
$sql = "SELECT * FROM tbl_order WHERE member_id = $member_id AND status = 'pending' ORDER BY o_date DESC";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>การชำระเงิน</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h3>💳 การชำระเงิน</h3>
  
  <?php if (mysqli_num_rows($result) > 0) { ?>
    <table class="table table-bordered mt-3">
      <thead>
        <tr>
          <th>รหัสสั่งซื้อ</th>
          <th>วันที่สั่ง</th>
          <th>ยอดรวม (บาท)</th>
          <th>การชำระเงิน</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['o_id']; ?></td>
          <td><?php echo $row['o_date']; ?></td>
          <td><?php echo number_format($row['total'],2); ?></td>
          <td>
            <a href="payment_form.php?o_id=<?php echo $row['o_id']; ?>" class="btn btn-success btn-sm">ชำระเงิน</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <div class="alert alert-info mt-3">✅ คุณไม่มีรายการที่รอชำระเงิน</div>
  <?php } ?>
  <a href="index.php" class="btn btn-secondary mt-3">กลับหน้าหลัก</a>
</div>
</body>
</html>
