<?php 
session_start();
$_SESSION['cart'][$_GET['cartId']]['productQuantity']=$_GET['updatedQuantity'];
?>