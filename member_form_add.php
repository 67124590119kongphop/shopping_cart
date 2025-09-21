<div class="col-md-10">
<form  name="register" action="member_form_add_db.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
  <div class="form-group">
    <div class="col-sm-2">  </div>
    <div class="col-sm-6" align="left">
      
      <h4> สมัครสมาชิก </h4><hr>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2" align=""> Username :</div>
    <div class="col-sm-6" align="left">
      <input  name="m_user" type="text" required class="form-control" />  
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-2" align=""> Password :</div>
    <div class="col-sm-6" align="left">
      <input  name="m_pass" type="password" required class="form-control" id="m_pass"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2" align=""> ชื่อ-สกุล :</div>
    <div class="col-sm-6" align="left">
      <input  name="m_name" type="text" required class="form-control" id="m_name" placeholder="ภาษาอังกฤษหรือภาษาไทย" />
    </div>
  </div>
  
  
  <div class="form-group">
    <div class="col-sm-3" align=""> อีเมล : </div>
    <div class="col-sm-6" align="left">
      <input  name="m_email" type="email" class="form-control" id="m_email" required  placeholder="name@hotmail.com"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2" align=""> เบอร์โทรศัพท์ : </div>
    <div class="col-sm-6" align="left">
      <input  name="m_tel" type="text" class="form-control" id="m_tel" required  placeholder="ตัวเลขเท่านั้น" maxlength="10" pattern="^[0-9]+$" title="ตัวเลขเท่านั้น" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2" align=""> ที่อยู่ : </div>
    &nbsp;&nbsp;&nbsp;<font color="red">** หมายเหตุ: กรุณากรอกที่อยู่จริง ** </font>
    <div class="col-sm-6" align="left">
      <textarea name="m_address" class="form-control" id="m_address" required></textarea>
    </div>
  </div>
    <div class="form-group">   
          <div class="col-sm-6">
            รูปภาพ :
            <input type="file" name="m_img" id="card_img" class="form-control" />
          </div>
        </div>
  <div class="form-group">
    <div class="col-sm-2"> </div>
    <div class="col-sm-6" align="right">
      <button type="submit" class="btn btn-success" id="btn"><span class="glyphicon glyphicon-saved"></span> สมัครสมาชิก  
      </button> <a href="index.php" type="button" class="btn btn-danger" id="btn"><span class="glyphicon glyphicon-saved"></span> ยกเลิก  </a>
    </div>
    
  </div>
</form>
</div>