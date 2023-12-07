<?php
include './../includes/db_config.php';
$flag = '';
// TODO: now edit and remove is left in product 
$msg = '';
$isvalid = true;

// this is if clause for the condition if the user tries to update a product
if ($_GET) {
    $flag = 'forUpdate';
    $pId = $_GET['id'];
    $sql = "SELECT name,category_id,sub_categories_id,price,description,image_address FROM `products` WHERE id=" . $pId . " AND status=1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            $initialnameOfProduct = $nameOfProduct = $row['name'];
            $initialpriceOfProduct = $priceOfProduct = $row['price'];
            $initialcategoryOfProduct = $categoryOfProduct = $row['category_id'];
            $initialsubCategoryOfProduct = $subCategoryOfProduct = $row['sub_categories_id'];
            $initialDescription = $Description = $row['description'];
            $image_address = $row['image_address'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}
?>
<?php

// this is if clause if a user tries to post after filling the form 
if (isset($_POST['subimtForNewProduct'])) {
    include './../includes/db_config.php';
    $nameOfProduct = $_POST['nameOfProduct'];
    $priceOfProduct = $_POST['priceOfProduct'];
    $categoryOfProduct = $_POST['categoryOfProduct'];
    $subCategoryOfProduct = $_POST['subCategoryOfProduct'];
    $Description = $_POST['Description'];

    //this if clause check the fields are empty or not
    if (!empty($nameOfProduct) && !empty($priceOfProduct) && !empty($subCategoryOfProduct) && !empty($Description)) {
    } else {
        $msg = $msg . ' Fields cannot be empty. Please fill all the fields.';
        $isvalid = false;
    }

    // this check if the $isvalid variable is ture or not and the $isvalid variable is only true when all fields are not empty 
    if ($isvalid) {

        //this $flag is variable used to check if the form  should be updated or post  
        if ($flag == 'forUpdate') {
            // TODO: write codes for update
            if ($initialnameOfProduct == $nameOfProduct && $initialpriceOfProduct == $priceOfProduct && $initialcategoryOfProduct == $categoryOfProduct &&  $initialsubCategoryOfProduct == $subCategoryOfProduct &&  $initialDescription == $Description) {
                $msg = $msg . 'Please update something.';
            } else {

                $query = " UPDATE `products` SET `name`='$nameOfProduct',`category_id`='$categoryOfProduct',`sub_categories_id`='$subCategoryOfProduct',`price`='$priceOfProduct',`description`='$Description' where id=" . $pId;
                if (mysqli_query($conn, $query)) {
?><script>
window.location.href = "http://localhost/sportshub/for-admin-pages/index.php";
alert('Sucessfully Updated');
</script><?php
                                // header('location:http://localhost/sportshub/for-admin-pages/index.php');
                            } else {
                                $msg = $msg .  ' Product not updated sucessfully';
                            }
                        }
                    } else {
                        $target_dir = 'D:/xampp/htdocs/sportshub/images/';;
                        $productImage = $target_dir . basename($_FILES['imageOfProduct']['name']);
                        $image_address = "./../images/" . basename($_FILES['imageOfProduct']['name']);
                        $imageFileType = strtolower(pathinfo($productImage, PATHINFO_EXTENSION));
                        $check = $_FILES['imageOfProduct']['tmp_name'];
                        if ($check == '') {
                            $msg = 'Insert image of the product.';
                        }
                        // echo $check;
                        // if(move_uploaded_file($_FILES['imageOfProduct']['tmp_name'], $productImage))
                        // echo 'image moved successfully';
                        $query = "INSERT INTO products(name,category_id,sub_categories_id,price,description,image_address) VALUES('$nameOfProduct','$categoryOfProduct','$subCategoryOfProduct','$priceOfProduct','$Description','$image_address')";
                        // if(mysqli_query($conn,$query)){
                        //     echo 'wow';
                        // }else{
                        //     echo 'la vayena ni insert gareko tw solti'.mysqli_error($conn);
                        // }
                        if (move_uploaded_file($_FILES['imageOfProduct']['tmp_name'], $productImage) && mysqli_query($conn, $query)) {
                                ?><script>
window.location.href = "http://localhost/sportshub/for-admin-pages/index.php";
alert('Sucessfully inserted');
</script><?php
                            // header('location:http://localhost/sportshub/for-admin-pages/index.php');
                        } else {
                            $msg = $msg .  ' Form not submitted sucessfully'.mysqli_error($conn);
                        }
                    }
                }
            }
                            ?>


<?php include './includes/header.php' ?>
<?php include './includes/navbar.php' ?>

<div id="mainPart">
<button type="button" class="btn btn-dark m-5" id="backFromEditUsers" onclick="goToProductPage();">Back</button>
<!-- 
    <button class="nav-link btn btn-dark m-5" onclick="goToProductPage();">Back</button> -->
<script>
function goToProductPage() {

    // window.location.href = 'http://localhost/sportshub/for-admin-pages/index.php'
    showProductsCategories() ;
}
</script>
<!-- </button> -->
<?php if ($_GET) {
?>
<span>Form for updating product</span>

<?php
} else { ?>
<span>Form for adding
    new product</span>

<?php
}
?>
    <section>
        <div class="container ">
            <div class="row justify-content-center align-items-center ">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration bg-dark text-light" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-4">
                            <!-- <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3> -->
                            <form action="" method="POST" enctype="multipart/form-data">

                                <!-- <div> -->

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="nameOfProduct" name="nameOfProduct"
                                                class="form-control form-control-lg"
                                                value="<?= isset($nameOfProduct) ? $nameOfProduct : '' ?>" />
                                            <label class="form-label" for="nameOfProduct">Name of the product</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4 ">
                                        <div class="form-outline">
                                            <input type="number" class="form-control form-control-lg"
                                                id="priceOfProduct" name="priceOfProduct"
                                                value="<?= isset($priceOfProduct) ? $priceOfProduct : '' ?>" />

                                            <label class="form-label" for="priceOfProduct">Price</label>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <select class="form-select" id="categoryOfProduct" name="categoryOfProduct">
                                                <option>Select the category</option>
                                                <option <?php if (isset($categoryOfProduct)) {
                                                            echo $categoryOfProduct == 1 ? 'selected' : '';
                                                        } ?> value="1">Football</option>
                                                <option <?php if (isset($categoryOfProduct)) {
                                                            echo $categoryOfProduct == 2 ? 'selected' : '';
                                                        } ?> value="2">Cricket</option>
                                                <option <?php if (isset($categoryOfProduct)) {
                                                            echo $categoryOfProduct == 3 ? 'selected' : '';
                                                        } ?> value="3">BasketBall</option>
                                                <option <?php if (isset($categoryOfProduct)) {
                                                            echo $categoryOfProduct == 4 ? 'selected' : '';
                                                        } ?> value="4">Table Tennis</option>
                                                <option <?php if (isset($categoryOfProduct)) {
                                                            echo $categoryOfProduct == 5 ? 'selected' : '';
                                                        } ?> value="5">Volleyball</option>
                                                <option value="6">Badmintion</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <select class="form-select" name="subCategoryOfProduct"
                                                id="subCategoryOfProduct">
                                                <option selected>Select the sub-category</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 1 ? 'selected' : '';
                                                        } ?> value="1">T-shirt</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 2 ? 'selected' : '';
                                                        } ?> value="2">Shorts</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 3 ? 'selected' : '';
                                                        } ?> value="3">Gloves</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 4 ? 'selected' : '';
                                                        } ?> value="4">Shocks</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 5 ? 'selected' : '';
                                                        } ?> value="5">Caps</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 6 ? 'selected' : '';
                                                        } ?> value="6">Tools</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 7 ? 'selected' : '';
                                                        } ?> value="7">Gaurds</option>
                                                <option <?php if (isset($subCategoryOfProduct)) {
                                                            echo $subCategoryOfProduct == 8 ? 'selected' : '';
                                                        } ?> value="8">Shoes</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <?php
                                    if (!$_GET) {
                                    ?>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input class="form-control" type="file" name="imageOfProduct"
                                                id="imageOfProduct">
                                            <label for="imageOfProduct" class="form-label">Image of the product</label>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="col-md-6 mb-4 ">
                                        <div>
                                            <textarea class="form-control" placeholder="Description of the product"
                                                id="Description" name="Description"
                                                style="color: black;"><?= isset($Description) ? $Description : '' ?></textarea>
                                            <label for="Description">Description</label>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($msg)) {
                                ?>
                                <div class="row">

                                    <div class="col-md-auto ">
                                        <div class="form-outline">
                                            <p class="text-danger">
                                                <?= $msg ?>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-auto ">
                                        <div class="form-outline">
                                            <input class="btn btn-primary btn-lg" type="submit" value="
                                        <?php if ($_GET) {
                                        ?>
                                            update
                                            <?php
                                        } else { ?>
                                        Add
                                        <?php
                                        }
                                        ?>
                                        
                                        " name="subimtForNewProduct" />
                                        </div>
                                    </div>
                                </div>


                                <!-- </div> -->
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './includes/footer.php' ?>