<?php
session_start();
// session_destroy();
if(!isset($_SESSION['USER_ID']) && !isset($_SESSION['USER_NAME'])){
    echo "not logged in";
    exit();
    // header('location:http://localhost/sportshub/pages/files-for-main-content/customer-login.php');
}else{
        //    echo $_SESSION['USER_ID'];
        //    echo $_SESSION['USER_NAME'];
            // echo $_SESSION["USER_NAME"];

if (isset($_GET)) {
    if(isset($_SESSION['cart']) && in_array($_REQUEST['productId'],$check_product=array_column($_SESSION['cart'],'productId'))){
        echo "Product already added";
    }else{
        if(isset($_REQUEST['productQunatity'])==''){
            $_REQUEST['productQunatity']=1;
        }
        // echo $_SESSION['cart'];
        $_SESSION['cart'][] = array(
            'productId' => $_REQUEST['productId'],
            'productName' => $_REQUEST['productName'],
            'productPrice' => $_REQUEST['productPrice'],
            'productQuantity' => $_REQUEST['productQunatity']
            // ,
            // 'image_address' => $_REQUEST['image_address']
        );
                
              echo  "Product  added";
    }
}
}        


                ?>