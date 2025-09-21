<?php
include("../condb.php");

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
  <div class="col-sm-3 mb-3">
    <div class="card h-100">
        <a href="prd.php?id=<?php echo $row_prd['p_id']; ?>">
          <img src="../p_img/<?php echo htmlspecialchars($row_prd['p_img']); ?>" 
               width="200" height="200" 
               class="card-img-top" 
               alt="<?php echo htmlspecialchars($row_prd['p_name']); ?>">
        </a>
        <div class="card-body text-center">
            <a href="prd.php?id=<?php echo $row_prd['p_id']; ?>">
              <b><?php echo htmlspecialchars($row_prd["p_name"]); ?></b>
            </a>
            <br>
            ราคา <span class="text-danger"><?php echo number_format($row_prd["p_price"]); ?></span> บาท
            <br>
            คงเหลือ <?php echo $row_prd["p_qty"] . " " . $row_prd["p_unit"]; ?>
        </div>
        <div class="card-footer text-center">
          
          <a href="cart.php?p_id=<?php echo $row_prd['p_id']; ?>&act=add" 
             class="btn btn-success btn-sm">ใส่ตะกร้า</a>
        </div>
    </div>
  </div>
<?php } ?>
