<?php
//database connection  
$conn = mysqli_connect('localhost', 'root', '', 'sportshub_db');
if (!$conn) {
  die("Connection failed" . mysqli_connect_error());
} else {
  mysqli_select_db($conn, 'pagination');
}

//define total number of results you want per page  
$results_per_page = 2;

// TODO: check this and make it 10

//find the total number of results stored in the database  
$query = "select * from orders";
$result = mysqli_query($conn, $query);
$number_of_result = mysqli_num_rows($result);

//determine the total number of pages available  
$number_of_page = ceil($number_of_result / $results_per_page);

//determine which page number visitor is currently on  
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

//determine the sql LIMIT starting number for the results on the displaying page  
$page_first_result = ($page - 1) * $results_per_page;

//retrieve the selected results from database   
$query = "SELECT * FROM orders LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($conn, $query);
// print_r($result) ;
?>
<a class="btn btn-dark m-2" href="./index.php" role="button">Back</a> <span>Orders Information</span>
<div id="display_part">

</div>

<div class="h-100 d-flex justify-content-center align-items-center">

  <table class="table table-hover table-dark" style="width:auto;">
    <thead>
      <tr>
        <th scope="col" class="text-center">Order ID</th>
        <th scope="col" class="text-center">Pyment Request Id</th>
        <th scope="col" class="text-center">Customer ID</th>
        <th scope="col" class="text-center">Total Price</th>
        <th scope="col" class="text-center">Payment status</th>
        <th scope="col" class="text-center">Delivery Status</th>
        <th scope="col" class="text-center">Features</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //display the retrieved result on the webpage  
      while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
          <td class="text-center"><?= $row['o_id'] ?></td>
          <td class="text-center"><?= $row['paymentRequestId'] ?></td>
          <td class="text-center">
            <?= $row['cus_id'] ?>
          </td>
          <td class="text-center"><?= $row['total_price'] ?></td>
          <td class="text-center">
            <?php
            if ($row['payment_status']) {
            ?>
              <div class="text-success">
                Paid
              </div>
            <?php
            } else {
            ?>
              <div class="text-danger">

                Pending
              </div>
            <?php

            }
            ?>

          </td>
          <td id="delivery_status" class="text-center">

            <?php
            if ($row['delivery_status']) {
            ?>
              <div class="text-success">
                Delivered
              </div>
            <?php
            } else {
            ?>
              <div class="text-danger">
                Pending
              </div>
              <button type="button" class="btn btn-light mt-4" onclick="changeDeliveryStatus(<?= $row['o_id'] ?>,
              <?php if (!isset($_GET['page'])) {$page = 1;echo $page;} else {$page = $_GET['page'];echo $page;}?>);">Change status</button>
            <?php
}?>
          </td>
          <td class="text-center d-flex justify-content-center align-items-center">
            <div class="d-flex flex-column " style="height: 100%;">
              <button type="button" class="btn btn-light" onclick="viewProfileOfTheCustomer(<?= $row['cus_id'] ?>)"> Profile of customer</button>
              <!-- <button type="button" class="btn btn-light mt-2" onclick="viewProductsInOrder(<?=$row['o_id']?>)"> Products in order</button> -->
              <!-- <?= $row['o_id'] ?> -->
            </div>
        </tr>
      <?php
    }
      ?>
    </tbody>
  </table>
</div>
<!-- <br> -->
<div class="w-100vh ">
  <div class="d-flex justify-content-center align-items-center">
    <div class="d-flex justify-content-space-between align-items-center " style="width:fit-content ;">
      <?php
      //display the link of the pages in URL  
      for ($page = 1; $page <= $number_of_page; $page++) {  ?>
        <button type="button" class="btn btn-dark mx-2" onclick="orderPage(<?php echo $page ?>)"><?php echo $page ?></button>
      <?php
      }

      ?>
    </div>
  </div>
</div>