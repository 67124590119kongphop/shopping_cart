<?php
session_start();
include('../condb.php');

$p_id = isset($_GET['p_id']) ? intval($_GET['p_id']) : 0;
$act  = isset($_GET['act']) ? $_GET['act'] : '';

// ✅ เพิ่มสินค้าเข้าตะกร้า
if ($act == 'add' && $p_id > 0) {
    if (isset($_SESSION['cart'][$p_id])) {
        $_SESSION['cart'][$p_id]++;
    } else {
        $_SESSION['cart'][$p_id] = 1;
    }
}

// ✅ ลบสินค้าออก
if ($act == 'remove' && $p_id > 0) {
    unset($_SESSION['cart'][$p_id]);
}

// ✅ อัปเดตจำนวนสินค้า
if ($act == 'update' && !empty($_POST['amount'])) {
    foreach ($_POST['amount'] as $p_id => $qty) {
        $_SESSION['cart'][$p_id] = ($qty > 0) ? intval($qty) : 1;
    }
}

// ถ้าไม่มีสินค้าในตะกร้า
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
    echo "<h3 style='text-align:center;margin-top:50px;'>ตะกร้าของคุณยังว่างเปล่า</h3>";
    echo "<div style='text-align:center; margin-top:20px;'><a href='index.php'>เลือกซื้อสินค้า</a></div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ตะกร้าสินค้า - EpicGAMESHOP</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  <h2 class="mb-4">ตะกร้าสินค้าของคุณ</h2>
  <form action="cart.php?act=update" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>สินค้า</th>
          <th width="120">ราคา (บาท)</th>
          <th width="100">จำนวน</th>
          <th width="120">รวม (บาท)</th>
          <th width="80">ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        foreach ($_SESSION["cart"] as $p_id => $qty) {
            $sql   = "SELECT * FROM tbl_product WHERE p_id = $p_id";
            $query = mysqli_query($con, $sql);
            $row   = mysqli_fetch_array($query);

            $sum   = $row['p_price'] * $qty;
            $total += $sum;
        ?>
        <tr>
          <td><?php echo htmlspecialchars($row['p_name']); ?></td>
          <td><?php echo number_format($row['p_price'], 2); ?></td>
          <td>
            <input type="number" name="amount[<?php echo $p_id; ?>]" value="<?php echo $qty; ?>" min="1" class="form-control">
          </td>
          <td><?php echo number_format($sum, 2); ?></td>
          <td><a href="cart.php?p_id=<?php echo $p_id; ?>&act=remove" class="btn btn-danger btn-sm">ลบ</a></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="3" class="text-right"><b>รวมทั้งหมด</b></td>
          <td><b><?php echo number_format($total, 2); ?></b></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <div class="text-right">
      <button type="submit" class="btn btn-warning">อัปเดตตะกร้า</button>
      <a href="index.php" class="btn btn-secondary">เลือกซื้อสินค้าต่อ</a>
      <a href="checkout.php" class="btn btn-success">สั่งซื้อสินค้า</a>
    </div>
  </form>
</div>
</body>
</html>
