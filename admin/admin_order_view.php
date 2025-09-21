<?php
// เริ่ม session และรวมไฟล์เชื่อมต่อฐานข้อมูล
session_start();
include('../condb.php');

// ตรวจสอบสิทธิ์การเข้าใช้งาน (ต้องเป็น admin)
if (!isset($_SESSION['member_id']) || $_SESSION['m_level'] != 'admin') {
    header("Location: ../form_login.php");
    exit;
}

// รับค่า o_id (รหัสการสั่งซื้อ) จาก URL และป้องกัน SQL Injection
$o_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ตรวจสอบและสร้างตาราง tbl_payment หากไม่มี (การตรวจสอบและสร้างตารางควรทำเพียงครั้งเดียวในส่วนติดตั้ง)
$sql_check_table = "SHOW TABLES LIKE 'tbl_payment'";
$result_check = mysqli_query($con, $sql_check_table);
if (!$result_check || mysqli_num_rows($result_check) == 0) {
    $sql_create_table = "
    CREATE TABLE `tbl_payment` (
      `pay_id` int(11) NOT NULL AUTO_INCREMENT,
      `o_id` int(11) NOT NULL,
      `pay_amount` decimal(10,2) NOT NULL,
      `pay_date` date NOT NULL,
      `pay_time` time NOT NULL,
      `pay_slip` varchar(255) NOT NULL,
      PRIMARY KEY (`pay_id`),
      KEY `o_id` (`o_id`),
      CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `tbl_order` (`o_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
    ";
    mysqli_query($con, $sql_create_table);
}

// ดึงข้อมูลการสั่งซื้อ, รายละเอียดสินค้า, ข้อมูลลูกค้า และข้อมูลสินค้า
// เพิ่มการเชื่อมโยงตาราง tbl_payment เข้ามาด้วย
$sql = "SELECT o.*, m.m_name, m.m_email, m.m_tel, m.m_address, od.*, p.p_name, p.p_img, t.type_name, pay.pay_amount, pay.pay_date, pay.pay_time, pay.pay_slip
        FROM tbl_order o
        INNER JOIN tbl_member m ON o.member_id = m.member_id
        INNER JOIN tbl_order_detail od ON o.o_id = od.o_id
        INNER JOIN tbl_product p ON od.p_id = p.p_id
        INNER JOIN tbl_type t ON p.type_id = t.type_id
        LEFT JOIN tbl_payment pay ON o.o_id = pay.o_id
        WHERE o.o_id = $o_id";
$result = mysqli_query($con, $sql);

// ตรวจสอบว่า query มีข้อผิดพลาดหรือไม่
if (!$result) {
    die("Error: " . mysqli_error($con));
}

// เก็บข้อมูลทั้งหมดลงใน array เพื่อนำไปแสดงผล
$order_data = [];
$total_price = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $order_data[] = $row;
    // คำนวณราคารวมทั้งหมด
    $total_price += $row['p_price'] * $row['qty'];
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>รายละเอียดการสั่งซื้อ</title>
  <!-- Bootstrap 4 CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <h3>รายละเอียดการสั่งซื้อ #<?php echo $o_id; ?></h3>
  <?php if (count($order_data) > 0) { 
    $order = $order_data[0];
  ?>
    <!-- ส่วนแสดงข้อมูลลูกค้า -->
    <div class="card mt-3">
      <div class="card-header">
        ข้อมูลลูกค้า
      </div>
      <div class="card-body">
        <p><strong>ชื่อลูกค้า:</strong> <?php echo $order['m_name']; ?></p>
        <p><strong>อีเมล:</strong> <?php echo $order['m_email']; ?></p>
        <p><strong>เบอร์โทรศัพท์:</strong> <?php echo $order['m_tel']; ?></p>
        <p><strong>ที่อยู่:</strong> <?php echo $order['m_address']; ?></p>
      </div>
    </div>

    <!-- ส่วนแสดงรายการสินค้าในคำสั่งซื้อ -->
    <div class="card mt-3">
      <div class="card-header">
        รายการสินค้า
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>รูปภาพ</th>
              <th>ชื่อสินค้า</th>
              <th>ประเภท</th>
              <th>ราคา</th>
              <th>จำนวน</th>
              <th>ราคารวม</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_data as $item) { ?>
            <tr>
              <td><img src="../p_img/<?php echo $item['p_img']; ?>" width="50" height="50" alt="<?php echo $item['p_name']; ?>"></td>
              <td><?php echo $item['p_name']; ?></td>
              <td><?php echo $item['type_name']; ?></td>
              <td><?php echo number_format($item['p_price'], 2); ?></td>
              <td><?php echo $item['qty']; ?></td>
              <td><?php echo number_format($item['p_price'] * $item['qty'], 2); ?></td>
            </tr>
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5" class="text-right"><strong>ราคารวมทั้งหมด:</strong></td>
              <td><strong><?php echo number_format($total_price, 2); ?></strong></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    
    <!-- ส่วนแสดงข้อมูลการชำระเงิน -->
    <div class="card mt-3">
        <div class="card-header">
            ข้อมูลการชำระเงิน
        </div>
        <div class="card-body">
            <?php if(isset($order['pay_amount']) && !empty($order['pay_amount'])){ ?>
                <p><strong>ยอดที่ชำระ:</strong> <?php echo number_format($order['pay_amount'], 2); ?></p>
                <p><strong>วันที่และเวลาที่ชำระ:</strong> <?php echo $order['pay_date']; ?> <?php echo $order['pay_time']; ?></p>
                <p>
                    <strong>สลิปการโอนเงิน:</strong>
                    <?php if(isset($order['pay_slip']) && !empty($order['pay_slip'])){ ?>
                        <a href="../slip/<?php echo $order['pay_slip']; ?>" target="_blank" class="btn btn-sm btn-outline-info">ดูสลิป</a>
                    <?php } else { ?>
                        <span class="text-danger">ไม่พบสลิป</span>
                    <?php } ?>
                </p>
            <?php } else { ?>
                <span class="text-danger">ยังไม่มีการชำระเงิน</span>
            <?php } ?>
        </div>
    </div>

  <?php } else { ?>
    <!-- แสดงข้อความเมื่อไม่พบข้อมูลการสั่งซื้อ -->
    <div class="alert alert-warning mt-3">ไม่พบข้อมูลการสั่งซื้อ</div>
  <?php } ?>

  <a href="admin_order.php" class="btn btn-secondary mt-3">กลับ</a>
</div>
</body>
</html>
