
<?php
session_start();
include('../condb.php');

if(!isset($_SESSION['member_id']) || $_SESSION['m_level'] != 'admin'){
    header("Location: form_login.php");
    exit;
}

// ดึงข้อมูล order + member (ตาราง tbl_payment ไม่มีในฐานข้อมูลที่แนบมา จึงถูกนำออก)
$sql = "SELECT o.*, m.m_name
        FROM tbl_order o
        INNER JOIN tbl_member m ON o.member_id = m.member_id
        ORDER BY o.o_date DESC";
$result = mysqli_query($con, $sql);

// ตรวจสอบว่า query มีข้อผิดพลาดหรือไม่
if (!$result) {
    die("Error: " . mysqli_error($con));
}
?>
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">


  <table class="table table-bordered table-striped mt-3">
    <thead class="thead-dark">
      <tr>
        <th>รหัสสั่งซื้อ</th>
        <th>ลูกค้า</th>
        <th>วันที่สั่ง</th>
        <th>ยอดรวม</th>
        <th>สถานะ</th>
        <th>ชำระเงิน</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><?php echo $row['o_id']; ?></td>
        <td><?php echo $row['m_name']; ?></td>
        <td><?php echo $row['o_date']; ?></td>
        <td><?php echo number_format($row['total'],2); ?></td>
        <td>
          <?php 
            if($row['status']=='pending'){ echo "<span class='badge badge-warning'>รอชำระ</span>"; }
            elseif($row['status']=='checking'){ echo "<span class='badge badge-info'>รอตรวจสอบ</span>"; }
            elseif($row['status']=='paid'){ echo "<span class='badge badge-success'>ชำระแล้ว</span>"; }
            elseif($row['status']=='shipped'){ echo "<span class='badge badge-primary'>จัดส่งแล้ว</span>"; }
            else { echo "<span class='badge badge-danger'>ยกเลิก</span>"; }
          ?>
        </td>
        <td>
            <span class="text-danger">ยังไม่ได้ชำระ</span>
        </td>
        <td>
          <a href="admin_order_view.php?id=<?php echo $row['o_id']; ?>" class="btn btn-info btn-sm">รายละเอียด</a>
          <a href="admin_order_edit.php?id=<?php echo $row['o_id']; ?>" class="btn btn-warning btn-sm">แก้ไขสถานะ</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <a href="index.php" class="btn btn-secondary mt-3">กลับหน้าหลัก</a>
</div>
</body>
</html>