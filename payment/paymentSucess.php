<?php
include './../includes/header.php';
include './../includes/navbar.php'; ?>
<div id='main-page'>

    <?php
    require_once './../includes/db_config.php';
    if ($_GET && isset($_REQUEST["refId"])) {
        //Fetch record with respect to payment request id
        $sql = "Select * from orders where total_price = "
            . $_REQUEST['amt'] . " AND paymentRequestId = '" . $_REQUEST['oid']
            . "' AND payment_status = 0";

        $result = mysqli_query($conn, $sql);
        $purchaseData = mysqli_fetch_assoc($result);

        if ($purchaseData) {
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data = [
                'amt' => $purchaseData["total_price"],
                'rid' => $_REQUEST["refId"],
                'pid' => $purchaseData["paymentRequestId"],
                'scd' => 'EPAYTEST'
            ];
            // print_r($data); exit;

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            if (strpos($response, "Success") !== false) {
                //Need to update the database with the transaction reference id
                $sql = "Update orders set payment_status = 1 
            where paymentRequestId = '" . $purchaseData["paymentRequestId"] . "'";
                if (mysqli_query($conn, $sql)) { ?>
                    <script>
                        alert("Transaction completed successfully.Your products will be delivered shortly.");
                        location.href ="http://localhost/sportshub/payment/bill.php";
                        <?php
                        // unset($_SESSION['cart']);

                        ?>
                    </script><?php
                            } else { ?>
                    <script>
                        alert("Some problem occurred while saving the request in our end. Please contact the administrator or call us at +977-9851320011.");
                        location.href = "http://localhost/sportshub/pages/index.php"
                    </script><?php
                            }
                        } else { ?>
                <script>
                    alert("Error occurred while performing the transaction. Please contact the administrator or call us at +977-9851320011.");
                    location.href = "http://localhost/sportshub/pages/index.php"
                </script><?php
                        }
                    } else { ?>
            <script>
                alert('Invalid request');
                location.href = "http://localhost/sportshub/pages/index.php"
            </script><?php
                    }
                } ?>

</div>
<?php
include './../includes/footer.php';
?>