<?php
$o_id = isset($_GET['o_id']) ? $_GET['o_id'] : 0;
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>สั่งซื้อสำเร็จ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container text-center mt-5">
  <h2 class="text-success">✅ สั่งซื้อสำเร็จ</h2>
  <p>หมายเลขคำสั่งซื้อของคุณคือ <b>#<?php echo $o_id; ?></b></p>
  <a href="index.php" class="btn btn-primary mt-3">กลับไปเลือกซื้อสินค้า</a>
</div>
</body>
</html>
