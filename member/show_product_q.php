<?php
include("../condb.php");

// รับค่าที่ค้นหาจากฟอร์ม
$q = isset($_GET['q']) ? mysqli_real_escape_string($con, $_GET['q']) : '';

// ดึงข้อมูลสินค้าตามคำค้นหา
$sql = "SELECT * FROM tbl_product
        WHERE p_name LIKE '%$q%'
        OR p_detail LIKE '%$q%'
        ORDER BY p_id DESC";
$result = mysqli_query($con, $sql);
?>

<h4>ผลการค้นหา : <?php echo htmlspecialchars($q); ?></h4>
<hr>

<div class="row">
<?php if (mysqli_num_rows($result) > 0) { ?>
  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-sm-3" align="center">
      <div class="card border-Light mb-1" style="width: 16.5rem;">
        <br>
        <a href="prd.php?id=<?php echo $row['p_id']; ?>">
          <img src="../p_img/<?php echo $row['p_img']; ?>" width="200" height="200" class="card-img-top">
        </a>
        <div class="card-body">
          <a href="prd.php?id=<?php echo $row['p_id']; ?>">
            <b><?php echo $row["p_name"]; ?></b>
          </a>
          <br>
          ราคา <font color="red"><?php echo number_format($row["p_price"]); ?></font> บาท
          <br>
          คงเหลือ <?php echo $row["p_qty"] . " " . $row["p_unit"]; ?>
        </div>
        <br>
      </div>
    </div>
  <?php } ?>
<?php } else { ?>
  <div class="col-12">
    <div class="alert alert-warning">ไม่พบสินค้าที่ค้นหา</div>
  </div>
<?php } ?>
</div>
