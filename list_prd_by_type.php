<?php
include("condb.php");

// รับค่า type_id จาก URL
$type_id = isset($_GET['type_id']) ? intval($_GET['type_id']) : 0;

// ดึงข้อมูลสินค้าตามประเภท
$sql = "SELECT * FROM tbl_product AS p
        INNER JOIN tbl_type AS t ON p.type_id = t.type_id
        WHERE p.type_id = $type_id
        ORDER BY p.p_id DESC";
$result = mysqli_query($con, $sql);
?>

<?php if (mysqli_num_rows($result) > 0) { ?>
  <?php while ($row_prd = mysqli_fetch_assoc($result)) { ?>
    <div class="col-sm-3" align="center">
      <div class="card border-Light mb-1" style="width: 16.5rem;">
        <br>
        <a href="prd.php?id=<?php echo $row_prd['p_id']; ?>">
          <img src="p_img/<?php echo $row_prd['p_img']; ?>" width="200" height="200" class="card-img-top">
        </a>
        <div class="card-body">
          <a href="prd.php?id=<?php echo $row_prd['p_id']; ?>">
            <b><?php echo $row_prd["p_name"]; ?></b>
          </a>
          <br>
          ราคา <font color="red"><?php echo number_format($row_prd["p_price"]); ?></font> บาท
          <br>
          คงเหลือ <?php echo $row_prd["p_qty"] . " " . $row_prd["p_unit"]; ?>
        </div>
        <br>
      </div>
    </div>
  <?php } ?>
<?php } else { ?>
  <div class="col-12">
    <div class="alert alert-warning">ไม่พบสินค้าของประเภทนี้</div>
  </div>
<?php } ?>
