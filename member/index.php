<?php
session_start();
include('h.php');
include("../condb.php");
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <?php include('../boot4.php'); ?>
</head>
<body>
<?php
  include('banner.php');
  include('navbar.php');
?>
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="margin-top: 10px">
        <div class="row">
          <?php
          // รับค่าจาก GET แบบปลอดภัย
          $act = isset($_GET['act']) ? $_GET['act'] : '';
          $q   = isset($_GET['q']) ? $_GET['q'] : '';

          if ($act == 'showbytype') {
              if (file_exists('list_prd_by_type.php')) {
                  include('list_prd_by_type.php');
              } else {
                  echo "<div class='alert alert-danger'>ไม่พบไฟล์ list_prd_by_type.php</div>";
              }
          } elseif ($q != '') {
              if (file_exists('show_product_q.php')) {
                  include("show_product_q.php");
              } else {
                  echo "<div class='alert alert-danger'>ไม่พบไฟล์ show_product_q.php</div>";
              }
          }  else {
              if (file_exists('show_product.php')) {
                  include('show_product.php');
              } else {
                  echo "<div class='alert alert-danger'>ไม่พบไฟล์ show_product.php</div>";
              }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<?php 
// include script (ถ้ามีไฟล์)
if (file_exists('script4.php')) {
    include('script4.php'); 
} else {
    echo "<!-- script4.php ไม่พบ -->";
}
?>
