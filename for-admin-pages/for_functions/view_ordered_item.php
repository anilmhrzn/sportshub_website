TODO:DO THIS PAGE
<?php
echo 'helllo yr ';
$connection = mysqli_connect('localhost', 'root', '', 'sportshub_db');
$query = 'SELECT products_orderd.Quantity, products_orderd.Price as price_per_piece ,products.name, orders.paymentRequestId
FROM ((products_orderd
INNER JOIN products ON products_orderd.product_id = products.id)
INNER JOIN orders ON products_orderd.o_id = orders.o_id) WHERE products_orderd.o_id='. $_GET['o_id'];

$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
    ?>
    <thead>
    <tr>
        <!-- <th>S.N.</th> -->
        <th scope="col">PaymentRequestId</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price Per Piece</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Price</th>

    </tr>
  </thead>
  <tbody>
    <?php
while ($row = mysqli_fetch_assoc($result)) {
?>
<div id="profileOfCustomers" class="d-flex justify-content-center align-items-center my-3">
    <div class="card p-3 py-4 bg-dark text-white" style="height:fit-content;">
        <i class="fa-solid fa-rectangle-xmark fa-2x text-right" onclick="hideProfile();"></i>
        <table class="table table-sm">
    <tr>
      <!-- <th scope="row">1</th> -->
      <td><?=$row['paymentRequestId']?></td>
      <td><?=$row['name']?></td>
      <td><?=$row['price_per_piece']?></td>
      <td><?=$row['Quantity']?></td>
      <td><?=$row['Quantity']*$row['price_per_piece']?></td>
    </tr>


<?php
    }
}

?>  </tbody>
</table>
    </div>
</div>