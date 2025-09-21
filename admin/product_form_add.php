<?php
$query2 = "SELECT * FROM tbl_type ORDER BY type_id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);
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
<?php 
 if(@$_GET['do']=='f'){
            echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
            echo '<meta http-equiv="refresh" content="2;url=durable.php?act=add" />';
 }elseif(@$_GET['do']=='d'){
            echo '<script type="text/javascript">
            swal("", "เลขครุภัณฑ์ซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
            echo '<meta http-equiv="refresh" content="1;url=durable.php?act=add" />';
 }
 ?>

<form action="product_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อสินค้า :
    </div>
    <div class="col-sm-3">
      <input type="text" name="p_name" required class="form-control">
    </div>
  </div>

   <div class="form-group">
    <div class="col-sm-2 control-label">
      ประเภทสินค้า :
    </div>
    <div class="col-sm-3">
        <select name="type_id" class="form-control" required>
              <option value="">เลือกประเภทสินค้า</option>
              <?php foreach($result2 as $results){?>
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
    <textarea name="p_detail" cols="60"></textarea>
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-2 control-label">
      ราคา :
    </div>
    <div class="col-sm-2">
      <input type="number" name="p_price" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      จำนวน :
    </div>
    <div class="col-sm-1">
      <input type="number" name="p_qty" required class="form-control">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      หน่วย :
    </div>
    <div class="col-sm-1">
    <select name="p_unit" id="p_unit" required>
              <option value="">กรุณาเลือก</option>
              <option value="ไอดี">ไอดี</option>
              <option value="ตัว">ตัว</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      รูปภาพสินค้า :
    </div>
    <div class="col-sm-4">
      <input type="file" name="p_img" required class="form-control" accept="image/*" onchange="readURL(this);"/>
      <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
      <a href="durable.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>