<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../condb.php');

// ข้อมูล session สมาชิก (ถ้ามี)
$member_id = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : '';
$m_name    = isset($_SESSION['m_name']) ? $_SESSION['m_name'] : '';
$m_img     = isset($_SESSION['m_img']) ? $_SESSION['m_img'] : 'default.png';

// ดึงประเภทสินค้า
$query_typeprd = "SELECT * FROM tbl_type ORDER BY type_id ASC";
$typeprd = false;
if (isset($con)) {
    $typeprd = mysqli_query($con, $query_typeprd);
    if ($typeprd) {
        $row_typeprd = mysqli_fetch_assoc($typeprd);
        $totalRows_typeprd = mysqli_num_rows($typeprd);
    } else {
        $row_typeprd = null;
        $totalRows_typeprd = 0;
    }
} else {
    $row_typeprd = null;
    $totalRows_typeprd = 0;
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
<nav class="navbar navbar-expand-lg navbar-info" style="background-color: #f74040ff;">
  <div class="container">

    <!-- Brand -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      
      <span class="font-weight-bold text-dark">EpicGAMESHOP</span>
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- Left -->
      <ul class="navbar-nav mr-auto align-items-center">
        <li class="nav-item mx-1">
          <a class="nav-link text-dark" href="index.php">หน้าหลัก</a>
        </li>

        <!-- Dropdown ประเภทสินค้า -->
        <li class="nav-item dropdown mx-1">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="typeDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            ประเภทสินค้า
          </a>
          <div class="dropdown-menu" aria-labelledby="typeDropdown">
            <?php if ($totalRows_typeprd > 0) : ?>
              <?php do { ?>
                <a class="dropdown-item" href="index.php?act=showbytype&type_id=<?php echo $row_typeprd['type_id']; ?>">
                  <?php echo htmlspecialchars($row_typeprd['type_name']); ?>
                </a>
              <?php } while ($row_typeprd = mysqli_fetch_assoc($typeprd)); ?>
            <?php else: ?>
              <a class="dropdown-item" href="#">ไม่มีประเภทสินค้า</a>
            <?php endif; ?>
          </div>
        </li>

        
      </ul>

      <!-- Search -->
      <form class="form-inline my-2 my-lg-0 mr-3" action="index.php" method="GET">
        <div class="input-group">
          <input class="form-control" type="search" placeholder="ค้นหา" aria-label="Search" name="q"
                 value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
          <div class="input-group-append">
            <button class="btn btn-success" type="submit">Search</button>
          </div>
        </div>
      </form>

      <!-- Right -->
      <ul class="navbar-nav align-items-center">
        <!-- Cart -->
        <li class="nav-item mx-1">
          <a class="nav-link btn btn-outline-light btn-sm text-dark d-flex align-items-center" href="cart.php">
            <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>
            <span>ตะกร้า</span>
            <span class="badge badge-pill badge-danger ml-2" id="cartCount">
              <?php echo isset($_SESSION['cart_count']) ? intval($_SESSION['cart_count']) : 0; ?>
            </span>
          </a>
        </li>

        <!-- User -->
        <?php if ($member_id == '') : ?>
          <li class="nav-item mx-1">
            <a class="nav-link btn btn-light btn-sm text-dark" href="form_login.php">เข้าสู่ระบบ</a>
          </li>
        <?php else : ?>
          <li class="nav-item dropdown mx-1">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo '../m_img/' . htmlspecialchars($m_img); ?>" 
                   width="34" height="34" 
                   class="rounded-circle mr-2" 
                   alt="avatar">
              <span class="text-dark"><?php echo htmlspecialchars($m_name); ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
              <a class="dropdown-item" href="order.php">รายการสั่งซื้อ</a>
              <a class="dropdown-item" href="payment.php">การชำระเงิน</a> 
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="logout.php" onclick="return confirm('ต้องการออกจากระบบหรือไม่ ?')">ออกจากระบบ</a>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
</div>
  </div>
</div>
