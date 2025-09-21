<?php
session_start();
include('../condb.php');

if (!isset($_SESSION['member_id'])) {
    header("Location: ../form_login.php");
    exit();
}

$o_id = isset($_GET['o_id']) ? intval($_GET['o_id']) : 0;

// ดึงข้อมูลธนาคารจาก tbl_bank
$sql_bank = "SELECT * FROM tbl_bank ORDER BY b_id ASC";
$query_bank = mysqli_query($con, $sql_bank);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แจ้งการชำระเงิน</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h3>📑 แจ้งการชำระเงิน (ออเดอร์ #<?php echo $o_id; ?>)</h3>
  <form action="save_payment.php" method="post" enctype="multipart/form-data" class="mt-3">
    <input type="hidden" name="o_id" value="<?php echo $o_id; ?>">
    
    <div class="form-group">
      <label>เลือกบัญชีธนาคารที่โอน</label>
      <select name="bank_id" class="form-control" required>
        <option value="">-- เลือกธนาคาร --</option>
        <?php while($b = mysqli_fetch_assoc($query_bank)){ ?>
          <option value="<?php echo $b['b_id']; ?>">
            <?php echo $b['b_name']." - ".$b['b_number']." (".$b['b_owner'].")"; ?>
          </option>
        <?php } ?>
      </select>
    </div>
    
    <div class="form-group">
      <label>จำนวนเงินที่โอน (บาท)</label>
      <input type="number" step="0.01" name="pay_amount" class="form-control" required>
    </div>

    <div class="form-group">
      <label>วันที่โอน</label>
      <input type="date" name="pay_date" class="form-control" required>
    </div>

    <div class="form-group">
      <label>เวลาที่โอน</label>
      <input type="time" name="pay_time" class="form-control" required>
    </div>

    <div class="form-group">
      <label>หลักฐานการโอน (สลิป)</label>
      <input type="file" name="slip" class="form-control-file" required>
    </div>

    <button type="submit" class="btn btn-primary">บันทึกการชำระเงิน</button>
    <a href="payment.php" class="btn btn-secondary">ยกเลิก</a>
  </form>
</div>
</body>
</html>
