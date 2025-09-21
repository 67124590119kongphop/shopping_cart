<?php
include("condb.php");

// รับค่าค้นหา ถ้าไม่มีให้เป็นค่าว่าง
$q = isset($_GET['q']) ? mysqli_real_escape_string($con, $_GET['q']) : "";

// ถ้ามีการค้นหา
if ($q != "") {
    $sql = "SELECT * FROM tbl_product AS p
            INNER JOIN tbl_type AS t ON p.type_id = t.type_id
            WHERE p.p_name LIKE '%$q%' OR t.type_name LIKE '%$q%'
            ORDER BY p.p_id DESC";
} else {
    // ถ้าไม่ค้นหา แสดงทั้งหมด
    $sql = "SELECT * FROM tbl_product AS p
            INNER JOIN tbl_type AS t ON p.type_id = t.type_id
            ORDER BY p.p_id DESC";
}

$result = mysqli_query($con, $sql);
?>

<?php while ($row_prd = mysqli_fetch_array($result)) { ?>
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
            ราคา <font color=""><?php echo number_format($row_prd["p_price"]); ?></font> บาท
            <br>
            คงเหลือ <?php echo $row_prd["p_qty"] . " " . $row_prd["p_unit"]; ?>
            <br><button type="button" class="btn btn-info btn-sm">
              <a href="prd.php?id=<?php echo $row_prd[0]; ?>" style="color:#fff">รายละเอียด</a>
            </button>
        </div>
        <br>
    </div>
  </div>
<?php } ?>
