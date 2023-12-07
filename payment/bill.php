<?php
include './../includes/header.php';
include './../includes/navbar.php';
?>
<?php
// session_start(); 
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                ?>
    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
    <div id="forBill" style="margin-top:15px;display:flex;justify-content:center;align-items:center;">
        <p>
            Bill of your order
        </p>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;margin:30px">
        <table class='view-cart-table'>
            <tr>
                <th>Index</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <?php
                    $total = 0;
                    $grandTotal = 0;
                    $counter = 1;
                    $counter2 = 1;
                    foreach ($_SESSION['cart'] as $key => $value) {
                        try {
                            $total = $value['productPrice'] * $value['productQuantity'];
                            $grandTotal = $grandTotal + $total;
                        } catch (\Throwable $th) {
                        }

            ?>
                <tr>
                    <td>
                        <?= $counter++ ?>
                    </td>

                    <td>

                        <?= $value['productName']; ?>
                    </td>
                    <td>

                        <?= $value['productPrice']; ?>
                    </td>
                    <td>
                        <p>
                        <?= $value['productQuantity']; ?> 
                        </p>
                        <!-- <input type="number" name="" id="updatedQuantity<?= $value['productId']; ?>" value="<?= $value['productQuantity']; ?>"> -->

                    </td>
                    <td>
                        <?= $total ?>
                    </td>
                    
                </tr>


            <?php $total = 0;
                    } ?>
            <td colspan="4">Grand Total:</td>
            <td colspan="2">
                <?= $grandTotal ?>
            </td>
        </table>
    </div>
    <div style="width: 100%;display:flex;justify-content:center;align-items:center;">
<a href="http://localhost/sportshub/pages/index.php">Go Back to home page</a>
        <!-- <button style="margin: 2vh auto; padding:2vh" id="orderNowBtn" onclick="showPaymentOptions();">Order Now</button> -->
    </div>
<?php
                        unset($_SESSION['cart']);

                } 
?>
</body>
<script src="./../javascript/script.js"></script>
<script src="./../../jquery-3.6.0.min.js"></script>
</html>