<?php
session_start();
if (!isset($_SESSION['USER_ID']) && !isset($_SESSION['USER_NAME'])) {
    echo 'not logged in';
    exit();
                // header('location:http://localhost/sportshub/pages/files-for-main-content/customer-login.php');
            } 
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    // print_r($_SESSION['cart']);
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
    <div id="forBill" style="display:flex;justify-content:center;align-items:center;">
        <div>

        </div>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;margin:30px">
        <table class='view-cart-table'>
            <tr>
                <th>Index</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <!-- <th>Image</th> -->
                <th>Total Price</th>
                <th>Action</th>
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
                        <input type="number" name="" id="updatedQuantity<?= $value['productId']; ?>" value="<?= $value['productQuantity']; ?>">

                    </td>
                    <!-- <td >
            <img src="<?= $value['image_address'] ?>"  style="width:20vw;display:flex;justify-content:center;align-items:center;padding:10px" alt="img not available" srcset="">
        </td> -->
                    <td>
                        <?= $total ?>
                    </td>
                    <td>
                        <button onclick="update_quantity_of_procduct(<?= $key ?>,'updatedQuantity<?= $value['productId']; ?>');">update</button>
                        <button onclick="delete_an_item_from_cart(<?= $key ?>);">delete</button>

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

        <button style="margin: 2vh auto; padding:2vh" id="orderNowBtn" onclick="showPaymentOptions();">Order Now</button>
    </div>
<?php
                } else {
                    echo "Cart is empty please add something";
                }
            // }
            // mysqli_close($conn);
?>