
<?php
session_start();
include './../includes/db_config.php';
$paymentRequestId = $_SESSION['USER_NAME']."-" . rand(1000, 1000000);
$total=0;
$grandTotal=0;
// session_destroy();
if(!isset($_SESSION['USER_ID']) && !isset($_SESSION['USER_NAME'])){
    echo "not logged in";
    exit();
    // header('location:http://localhost/sportshub/pages/files-for-main-content/customer-login.php');
}
foreach ($_SESSION['cart'] as $key => $value) {
    try {
        $total = $value['productPrice'] * $value['productQuantity'];
        $grandTotal=$grandTotal+$total;
        
    } catch (\Throwable $th) {
    }}
$query="Insert into orders(paymentRequestId,cus_id,total_price) values('".$paymentRequestId."',".$_SESSION['USER_ID'].",".$grandTotal.")";
if(mysqli_query($conn,$query)){
    echo $query." this is query for orders <br/>".$_SESSION['USER_ID']."<br/>".$grandTotal;
}
    // $query="Insert into orders(paymentRequestId,total_price) values('".$paymentRequestId."',".$grandTotal.")";
    // mysqli_close($conn);
foreach ($_SESSION['cart'] as $key => $value) {
    $query="Insert into products_orderd(paymentRequestId,product_id) values('".$paymentRequestId."',".$value['productId'].")";
    mysqli_query($conn,$query);
    // echo " this is query for products_ordered <br/>";
    // echo $query;
    // mysqli_close($conn);
}
    ?>
<div id="paymentMethod" class="paymentMethodsContainer">
    <fieldset class="paymentMethodSubContainer">
        <legend style="text-align: center;">Payment Method</legend>
        <form action="https://uat.esewa.com.np/epay/main" method="POST" style="display: inline;">
            <input value="<?=$grandTotal?>" name="tAmt" type="hidden">
                <input value="<?=$grandTotal?>" name="amt" type="hidden">
                <input value="0" name="txAmt" type="hidden">
                <input value="0" name="psc" type="hidden">
                <input value="0" name="pdc" type="hidden">
                <input value="EPAYTEST" name="scd" type="hidden">
                <input value="<?= $paymentRequestId ?>" name="pid" type="hidden">
                <input value="http://localhost/sportshub/payment/paymentSucess.php?q=su" type="hidden" name="su">
                <input value="http://localhost/sportshub/payment/paymentFaliure.php?q=fu" type="hidden" name="fu">
           <button type="submit" class="buttonForPaymentOptions">Online Through eSewa</button>         
        </form> 
        <button class="buttonForPaymentOptions" onclick="myFunction();">

            Cash On Delivery
        </button>
        
    </fieldset>
</div>
<script>
    function myFunction(){
        alert('You will be notified about your delivery time via phone call. Please wait Patiently.');
        window.location.href="http://localhost/sportshub/pages/index.php"
        <?php
        unset($_SESSION['cart']);
        ?>
        
        }
</script>