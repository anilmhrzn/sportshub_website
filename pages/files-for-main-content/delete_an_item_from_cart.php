<?php 
session_start();
unset($_SESSION['cart'][$_GET['cartId']]);

?>