<?php
session_start();
echo '<meta charset="utf-8">';
include('condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

	$m_level = 'member';
	$m_user = mysqli_real_escape_string($con,$_POST["m_user"]);
	$m_pass = mysqli_real_escape_string($con,$_POST["m_pass"]);
	$m_name = mysqli_real_escape_string($con,$_POST["m_name"]);
	$m_tel = mysqli_real_escape_string($con,$_POST["m_tel"]);
	$m_email = mysqli_real_escape_string($con,$_POST["m_email"]);
	$m_address = mysqli_real_escape_string($con,$_POST["m_address"]);

	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$m_img = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
	$upload=$_FILES['m_img']['name'];
	if($upload !='') { 
		$path="m_img/";
		$type = strrchr($_FILES['m_img']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="m_img/".$newname;
		move_uploaded_file($_FILES['m_img']['tmp_name'],$path_copy);  
	}

	

	$sql = "INSERT INTO tbl_member
	(
	m_level,
	m_user,
	m_pass,
	m_name,
	m_img,
	m_tel,
	m_email,
	m_address
	)
	VALUES
	(
	'$m_level',
	'$m_user',
	'$m_pass',
	'$m_name',
	'$newname',
	'$m_tel',
	'$m_email',
	'$m_address'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	
	mysqli_close($con);

	if($result){
	echo '<script type="text/javascript">';
    echo "alert('สมัครสมาชิกเรียบร้อย');";
    echo "window.location='index.php';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='index.php';";
    echo '</script>';
}
?>
