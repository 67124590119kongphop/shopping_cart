<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
    <!-- Left side column. contains the logo and sidebar -->
    
        <?php include('menu_l.php');?>
      
    <div class="content-wrapper">
      <section class="content-header">
      <h1>
        <i class="glyphicon glyphicon-bitcoin"></i> <span class="hidden-xs">ข้อมูลธนาคาร</span>
        <a href="bank.php?act=add" class="btn btn-primary btn-sm">เพิ่มธนาคาร</a>
        </h1>
        
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="box-body">
                    <?php
                  $act = (isset($_GET['act']) ? $_GET['act'] : '');
                  if($act == 'add'){
                  include('bank_form_add.php');
                  }elseif ($act == 'edit') {
                  include('bank_form_edit.php');
                  }else {
                  include('bank_list.php');
                  }
                  ?>                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </body>
  </html>
  <?php include('footerjs.php');?>