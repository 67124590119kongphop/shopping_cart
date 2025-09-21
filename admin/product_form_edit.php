<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tbl_product as p 
INNER JOIN tbl_type as t ON p.type_id = t.type_id
WHERE p_id=$ID
ORDER BY p.p_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);


$sql2 = "SELECT * FROM tbl_type 
ORDER BY type_id DESC" or die("Error:" . mysqli_error());
$result_t = mysqli_query($con, $sql2) or die ("Error in query: $sql " . mysqli_error());


?>
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<form action="product_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อสินค้า :
    </div>
    <div class="col-sm-3">
      <input type="text" name="p_name" required class="form-control" value="<?php echo $row['p_name'];?>">
    </div>
  </div>

   <div class="form-group">
    <div class="col-sm-2 control-label">
      ประเภทสินค้า :
    </div>
    <div class="col-sm-3">
        <select name="type_id" class="form-control" required>
              <option value="<?php echo $row['type_id'];?>"><?php echo $row['type_name'];?></option>
              <option value="">เลือกประเภทสินค้า</option>
              <?php foreach($result_t as $results){?>
              <option value="<?php echo $results["type_id"];?>">
                <?php echo $results["type_name"]; ?>
              </option>
              <?php } ?>
        </select>
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-2 control-label">
      รายละเอียด :
    </div>
    <div class="col-sm-3">
    <textarea name="p_detail" cols="60"><?php echo $row['p_detail'];?></textarea>
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-2 control-label">
      ราคา :
    </div>
    <div class="col-sm-2">
      <input type="number" name="p_price" required class="form-control" value="<?php echo $row['p_price'];?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      จำนวน :
    </div>
    <div class="col-sm-1">
      <input type="number" name="p_qty" required class="form-control" value="<?php echo $row['p_qty'];?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      หน่วย :
    </div>
    <div class="col-sm-1">
    <select name="p_unit" id="p_unit" required>
       <option value=""><?php echo $row["p_unit"];?></option>
              <option value="">กรุณาเลือก</option>
              <option value="ชิ้น">ชิ้น</option>
              <option value="กล่อง">กล่อง</option>
              <option value="อัน">อัน</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      รูปภาพสินค้า :
    </div>
    <div class="col-sm-4">
      ภาพเก่า <br>
      <img src="../p_img/<?php echo $row['p_img'];?>" width="200px">
      <br>
      <input type="file" name="p_img" required class="form-control" accept="image/*" onchange="readURL(this);"/>
      <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
       <input type="hidden" name="p_img2" value="<?php echo $row['p_img'];?>">
      <input type="hidden" name="p_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="durable.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>