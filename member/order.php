<?php
session_start();
include('../condb.php'); // ไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบ session ว่ามีการ login หรือยัง
if(!isset($_SESSION['member_id'])){
    header("Location: ../login.php");
    exit;
}

$member_id = $_SESSION['member_id'];

// ดึงข้อมูลคำสั่งซื้อของสมาชิก
$sql = "SELECT * FROM tbl_order WHERE member_id = '$member_id' ORDER BY o_date DESC";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>รายการสั่งซื้อของฉัน</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h3>📦 รายการสั่งซื้อของฉัน</h3>
  <table class="table table-bordered mt-3">
    <thead>
      <tr>
        <th>รหัสสั่งซื้อ</th>
        <th>วันที่สั่ง</th>
        <th>ยอดรวม (บาท)</th>
        <th>สถานะ</th>
      </tr>
    </thead>
    <tbody>
      <?php if(mysqli_num_rows($result) > 0){ ?>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td><?php echo $row['o_id']; ?></td>
          <td><?php echo $row['o_date']; ?></td>
          <td><?php echo number_format($row['total'],2); ?></td>
          <td>
            <?php 
              if($row['status']=='pending'){ echo "⏳ รอชำระเงิน"; }
              elseif($row['status']=='paid'){ echo "💰 ชำระเงินแล้ว"; }
              elseif($row['status']=='shipped'){ echo "🚚 จัดส่งแล้ว"; }
              elseif($row['status']=='completed'){ echo "✅ เสร็จสิ้น"; }
              else { echo "❌ ยกเลิก"; }
            ?>
          </td>
        </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="4" class="text-center">ยังไม่มีรายการสั่งซื้อ</td>
        </tr>
      <?php } ?>
      <a href="index.php" class="btn btn-secondary mt-3">กลับหน้าหลัก</a>
    </tbody>
  </table>
</div>
</body>
</html>
