<?php
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลจำนวนสินค้ามาไหม
if(isset($_POST['amount'])){
    foreach($_POST['amount'] as $p_id => $qty){
        if($qty > 0){
            $_SESSION["cart"][$p_id] = $qty;
        }else{
            unset($_SESSION["cart"][$p_id]); // ถ้าจำนวน <= 0 ลบออก
        }
    }
}

// กลับไปที่หน้าตะกร้า
header("Location: cart.php");
exit();
?>
