<?php
session_start();
include('../condb.php');

// Check admin login status
if(!isset($_SESSION['member_id']) || $_SESSION['m_level'] != 'admin'){
    header("Location: ../form_login.php");
    exit;
}

// Get order ID from URL
$o_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get current order status
$sql_status = "SELECT status FROM tbl_order WHERE o_id = $o_id";
$result_status = mysqli_query($con, $sql_status);
$current_status = mysqli_fetch_assoc($result_status)['status'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_status = $_POST['status'];

    // Update the order status
    $sql_update = "UPDATE tbl_order SET status = '$new_status' WHERE o_id = $o_id";
    if (mysqli_query($con, $sql_update)) {
        echo "<script>alert('อัปเดตสถานะเรียบร้อยแล้ว'); window.location='admin_order.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดต');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขสถานะ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3>แก้ไขสถานะการสั่งซื้อ #<?php echo $o_id; ?></h3>
    <div class="card mt-3">
        <div class="card-body">
            <form action="admin_order_edit.php?id=<?php echo $o_id; ?>" method="post">
                <div class="form-group">
                    <label for="status">สถานะปัจจุบัน:</label>
                    <p class="font-weight-bold">
                        <?php
                            if($current_status=='pending'){ echo "<span class='badge badge-warning'>รอชำระ</span>"; }
                            elseif($current_status=='checking'){ echo "<span class='badge badge-info'>รอตรวจสอบ</span>"; }
                            elseif($current_status=='paid'){ echo "<span class='badge badge-success'>ชำระแล้ว</span>"; }
                            elseif($current_status=='shipped'){ echo "<span class='badge badge-primary'>จัดส่งแล้ว</span>"; }
                            else { echo "<span class='badge badge-danger'>ยกเลิก</span>"; }
                        ?>
                    </p>
                    <label for="status">เปลี่ยนสถานะเป็น:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" <?php if($current_status == 'pending') echo 'selected'; ?>>รอชำระ</option>
                        <option value="checking" <?php if($current_status == 'checking') echo 'selected'; ?>>รอตรวจสอบ</option>
                        <option value="paid" <?php if($current_status == 'paid') echo 'selected'; ?>>ชำระแล้ว</option>
                        <option value="shipped" <?php if($current_status == 'shipped') echo 'selected'; ?>>จัดส่งแล้ว</option>
                        <option value="cancelled" <?php if($current_status == 'cancelled') echo 'selected'; ?>>ยกเลิก</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="admin_order.php" class="btn btn-secondary">ยกเลิก</a>
            </form>
            <a href="index.php" class="btn btn-secondary mt-3">กลับหน้าหลัก</a>
        </div>
    </div>
</div>
</body>
</html>
