<?php
include('h.php');
include("../condb.php");
$p_id = $_GET["id"];
?>
<!DOCTYPE html>
<head>
  <?php include('../boot4.php');?>
  <style>
  * {
  box-sizing: border-box;
  }
  .zoom {
  padding: 50px;
  transition: transform .2s;
  width: 300px;
  height: 300px;
  margin: 0 auto;
  }
  .zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5);
  }
  </style>
</head>
<body>
  <?php
  include('banner.php');
  include('navbar.php');
  ?>
  <div class="container">
    <div class="row">
      <?php
      $sql = "SELECT * FROM tbl_product as p 
          INNER JOIN tbl_type  as t ON p.type_id=t.type_id      
      AND p_id = $p_id
      ";
      $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
      $row = mysqli_fetch_array($result);

            $sql_last_view = "SELECT p_view FROM tbl_product Where p_id = '".$p_id."'";
            $resalt_last_view = mysqli_query($con, $sql_last_view) or die ("Error in query: $sql_last_view " . mysqli_error());
            $row_last_view = mysqli_fetch_assoc($resalt_last_view);
            //เรียกดูวิวของสินค้านั้นๆ
                $last_view = $row_last_view['p_view']++;            
                $last_view++;
                //นำวิวสินค้าเดิมมา+1
                $update_view = "UPDATE `tbl_product` SET `p_view` = '".$last_view."' WHERE `p_id` ='".$p_id."'";
                $resalt_updateview = $con->query($update_view);
                //อัพเดทวิวสินค้าใหม่



      ?>
      <div class="col-md-12">
        <div class="container" style="margin-top: 50px">
          <div class="row">
            <div class="col-md-6">
              <div class="zoom">
                <?php echo"<img src='../p_img/".$row['p_img']."'width='100%'>";?>
              </div>
            </div>
            <div class="col-md-6">
              <br>
              <h5><b><?php echo $row["p_name"];?></b></h5>
              <p>
                ประเภท : <?php echo $row["type_name"];?>
                <br>
                ราคา : <font color="red"> <?php echo $row["p_price"];?> </font> บาท  <br>
                 <b>คงเหลือ :</b> <?php echo $row["p_qty"];?> <?php echo $row["p_unit"];?>
              </p>
              <?php echo $row["p_detail"];?>
              <br> จำนวนการเข้าชม <?php echo $row['p_view']; ?> ครั้ง
            
              
                 <p> <!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5500ee80057fdb99"></script>
                <div class="addthis_inline_share_toolbox_sf2w"></div>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php include('script4.php');?>