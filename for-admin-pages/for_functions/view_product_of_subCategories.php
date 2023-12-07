<?php
if($_GET){

$conn = mysqli_connect('localhost', 'root', '', 'sportshub_db');
if (!$conn) {
  die("Connection failed" . mysqli_connect_error());
}
?><a class="btn btn-dark m-2" href="./index.php" role="button">Back</a> <span>Products Information</span>

<div class="d-flex justify-content-center align-items-center my-2">
    <a href="./add_new_product.php">

        <button type="button" class="btn btn-outline-info" id="addNewProductBtn"> Add New Product</button>
    </a>
</div>
<div id="productsShowing" class="h-100 d-flex justify-content-center align-items-center">
    <table class="table table-dark table-hover m-3" style="width:70vw;">
    <thead>
      <tr>
      <th style="text-align: center;">Name</th>
        <th style="text-align: center;">Category</th>
        <th style="text-align: center;">Sub category</th>
        <th style="text-align: center;">Price</th>
        <th style="text-align: center;">Description</th>
        <th style="text-align: center;">Options</th>
      </tr>
    </thead>
        <?php
        $query = "SELECT products.id as id,products.name as productsName,products.price as productsPrice,products.description as productsDescription,categories.name as categoriesName,sub_categories.name as subCategoriesName from products INNER JOIN categories on products.category_id=categories.id INNER JOIN sub_categories on products.sub_categories_id=sub_categories.id  where products.status = 1 AND category_id=".$_GET['category']." AND sub_categories_id=".$_GET['category'].";";
        $result = mysqli_query($conn, $query);
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?><tr>
                    <td><?= $row['productsName']; ?></td>
                    <td><?= $row['categoriesName']; ?></td>
                    <td><?= $row['subCategoriesName']; ?></td>
                    <td><?= $row['productsPrice']; ?></td>
                    <td style="width: 50px;"><?= $row['productsDescription']; ?></td>
                    <td>
                        <a class="btn btn-warning mx-4" href="./add_new_product.php?id=<?= $row['id'] ?>">
                            <!-- <button type="button" class="btn btn-warning mx-4"> -->
                                Edit
                            <!-- </button> -->
                        </a>
                        <button type="button" class="btn btn-danger" onclick="removeProduct(<?= $row['id']; ?>);">Remove</button>
                    </td>
                </tr>
            <?php

            }
        } else {

            ?>
         <tr>
                 <td colspan="6">no records found</td>
             </tr>
        <?php
        }
        ?>
    </table>

</div>

<?php
}
?>

<!-- this is for pagination if needed in future  -->

<!-- <ul class="pagination d-flex justify-content-center align-items-center">
    <li class="page-item">
        <a class="page-link" href="#">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul> -->