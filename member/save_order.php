<?php
session_start();
include('../condb.php');

// ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
 echo "<script>alert('ไม่มีสินค้าในตะกร้า'); window.location='index.php';</script>";
 exit();
}

// สมมติว่าคุณมีการ login เก็บ member_id ไว้ใน SESSION
$member_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : 0;

// คำนวณยอดรวม
$total = 0;
foreach ($_SESSION["cart"] as $p_id => $qty) {
 $sql  = "SELECT p_price FROM tbl_product WHERE p_id = $p_id";
 $query = mysqli_query($con, $sql);
 $row  = mysqli_fetch_array($query);
 $total += $row['p_price'] * $qty;
}

// ✅ บันทึกลงตาราง order
$sql_order = "INSERT INTO tbl_order (o_date, member_id, total)
 VALUES (NOW(), '$member_id', '$total')";
mysqli_query($con, $sql_order);

// ✅ เอา id ของ order ล่าสุด
$o_id = mysqli_insert_id($con);

// ✅ บันทึกรายการสินค้าในตาราง order_detail
foreach ($_SESSION["cart"] as $p_id => $qty) {
 $sql  = "SELECT p_price FROM tbl_product WHERE p_id = $p_id";
 $query = mysqli_query($con, $sql);
 $row  = mysqli_fetch_array($query);
 $price = $row['p_price']; // เก็บค่าราคาที่ถูกต้องไว้ในตัวแปร $price

 $sql_detail = "INSERT INTO tbl_order_detail (o_id, p_id, qty, p_price)
VALUES ('$o_id', '$p_id', '$qty', '$price')"; // ใช้ตัวแปร $price ที่ถูกต้อง
 mysqli_query($con, $sql_detail);

 // ตัดสต๊อกสินค้า
 $sql_update = "UPDATE tbl_product SET p_qty = p_qty - $qty WHERE p_id = $p_id";
 mysqli_query($con, $sql_update);
}

// ✅ ล้างตะกร้า
unset($_SESSION["cart"]);

// เสร็จแล้ว redirect ไปหน้าแจ้งผล
echo "<script>alert('บันทึกคำสั่งซื้อเรียบร้อยแล้ว'); window.location='order_success.php?o_id=$o_id';</script>";
?>