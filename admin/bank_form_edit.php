<?php
//print_r($_GET);
//exit();
$ID = mysqli_real_escape_string($con,$_GET["ID"]);
$sql = "SELECT * FROM tbl_bank WHERE b_id =$ID";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

//echo $sql;
//exit();
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
<form action="bank_form_edit.db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อธนาคาร :
    </div>
    <div class="col-sm-3">
      <input type="text" name="b_name" required class="form-control"  value="<?php echo $row['b_name'] ?> ">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-2 control-label">
      ประเภทธนาคาร :
    </div>
    <div class="col-sm-3">
      <input type="text" name="b_type" required class="form-control" value="ออมทรัพย์">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่บัญชี :
    </div>
    <div class="col-sm-3">
      <input type="text" name="b_number" required class="form-control" value="<?php echo $row['b_number'] ?> ">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เจ้าของบัญชี :
    </div>
    <div class="col-sm-3">
      <input type="text" name="b_owner" required class="form-control" value="<?php echo $row['b_owner'] ?> ">
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-2 control-label">
      สาขา :
    </div>
    <div class="col-sm-3">
      <input type="text" name="bn_name" required class="form-control" value="<?php echo $row['bn_name'] ?> ">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      โลโก้ธนาคาร :
    </div>
    <div class="col-sm-4">
      โลโก้ธนาคารเก่า <br>
      <img src="../b_logo/<?php echo $row['b_logo'];?>" width="200px"><br>
      <input type="file" name="b_logo" required class="form-control" accept="image/*" onchange="readURL(this);"/>
      <img id="blah" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="b_logo2" value="<?php echo $row['b_logo'];?>" >
      <input type="hidden" name="b_id" value="<?php echo $ID;?>" >
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="bank.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>