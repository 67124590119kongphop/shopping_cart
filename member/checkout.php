<?php
session_start();
include('../condb.php');

// ถ้าไม่มีสินค้าในตะกร้า
if(!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0){
    echo "<h3 style='text-align:center;margin-top:50px;'>ไม่มีสินค้าในตะกร้า</h3>";
    echo "<div style='text-align:center; margin-top:20px;'><a href='index.php'>กลับไปเลือกซื้อสินค้า</a></div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยืนยันการสั่งซื้อ - EpicGAMESHOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>ยืนยันการสั่งซื้อ</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>สินค้า</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>รวม</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach($_SESSION["cart"] as $p_id => $qty){
            $sql = "SELECT * FROM tbl_product WHERE p_id = $p_id";
            $query = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($query);
            $sum = $row['p_price'] * $qty;
            $total += $sum;
        ?>
            <tr>
                <td><?php echo $row['p_name']; ?></td>
                <td><?php echo number_format($row['p_price'],2); ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo number_format($sum,2); ?></td>
            </tr>
        <?php } ?>
            <tr>
                <td colspan="3" align="right"><b>รวมทั้งหมด</b></td>
                <td><b><?php echo number_format($total,2); ?> บาท</b></td>
            </tr>
        </tbody>
    </table>
    <div class="text-right">
        <a href="cart.php" class="btn btn-secondary">กลับไปแก้ไขตะกร้า</a>
        <a href="save_order.php" class="btn btn-success">ยืนยันการสั่งซื้อ</a>
    </div>
</div>
</body>
</html>
