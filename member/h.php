<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../condb.php");
//print_r($_SESSION);
//exit();

$member_id = $_SESSION['member_id'];
$m_name = $_SESSION['m_name'];
$m_level = $_SESSION['m_level'];
$m_img = $_SESSION['m_img'];
//echo $member_id;
if($m_level != 'member'){
    header("Location: ../logout.php");
}

$sql = "SELECT * FROM tbl_member WHERE  member_id =$member_id";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql" . mysqli_error());
$row = mysqli_fetch_array($result);

$m_name = $row['m_name'];
$m_img = $row['m_img'];


//echo $sql;
//exit();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
