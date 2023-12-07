<?php
$currentPage = $_GET['currentPage'];


$conn = mysqli_connect('localhost', 'root', '', 'sportshub_db');
if ($conn->connect_error) {
    die('connection failed' . $conn->connect_error);
}
$fetchPopularTrue = "SELECT * from products where popular=1 limit $currentPage,1";
$result = mysqli_query($conn, $fetchPopularTrue);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="inside-popular-picks-grid">
    <div
        class="containerForProduct">
        <div class="imageOfProduct" >
            <img src="<?= $row['image_address'] ?>" alt="image not available" class="product-image"><br>
        </div>
        <p class="align-center">


            <?= $row['name'] ?>
        </p>
        <p class="align-center" style="font-size: 0.8rem;">
            (
            <i>
                <?= $row['description'] ?>
            </i>
            )
        </p>

        <p class="priceOfProduct">
            <?php
                    $fmt = numfmt_create('en_ne', NumberFormatter::CURRENCY);
                    echo numfmt_format_currency($fmt,  $row['price'], "NPR");
                    ?>
        </p>

    </div>


    <div style="display: flex; justify-content:center; margin:4px 0;">
        <b>Quantity: </b>
        <input type="number" id="productQunatity" name="qunatity" placeholder="Quantity" value="1"> <br>
    </div>
    <div style="display: flex; justify-content:center; margin:4px 0; ">
        <button class="add_to_cart" name="add_to_cart"
            onclick="add_to_cart(<?= $row['id'] ?>,'<?= $row['name'] ?>',<?= $row['price'] ?>);"
            >Add To Cart <i
                class="fa-solid fa-cart-shopping"></i></button>
    </div>

</div>

<?php
    }
} else {
    echo 'no records to fetch';
}

?>