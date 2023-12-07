<?php
session_start();
?>

<body>
    <nav class="display-grid">
        <ul class="company-logo remove-list-style">
            <li class="first-part">
                Sports
            </li>
            <li class="second-part">
                Hub
            </li>
        </ul>
        <ul class="remove-list-style  options-navbar">
            <li onclick="loadHomePage();" id="home_navbar_options">

                <span>Home</span>

            </li>
            <li class="for-products" id="Categories_navbar_options">
                <span>
                    Categories
                </span>
                <ul class="dropdown-block remove-list-style">
                    <?php include './../pages/for-dropdown-contents/for_list_of_categories.php'; ?>
                </ul>
            </li>
            <?php if (isset($_SESSION['USER_ID']) && isset($_SESSION['USER_NAME'])) {
?>
<li class="for-feedback">
                <span>
                    Feedback
                </span>
                <ul class="remove-list-style feedback-class">
                    <form action="" method="POST">
                        <li>
                            <textarea name="feedback" id="" cols="30" rows="10" placeholder="Enter your feedback here............." style="padding: 5px; outline:none;"></textarea>
                        </li>
                        <li><input type="submit" value="submit" name="feedbackSubmit"></li>
                    </form>
                </ul>
            </li>
<?php
}?>
            
        </ul>
        <ul class="remove-list-style flex-justify-space-between searcbar-login-logout">
            <li>
                <form action="" method="GET" name="" onsubmit="hideShowSearchedResult();">
                    <input type="search" name="idtemSearch" value="<?php if (isset($_REQUEST['idtemSearch'])) echo $_REQUEST['idtemSearch']; ?>" id="itemSearch">
                    <input type="submit" name="hello" id="">
                </form>
            </li>
            <i class="fa-solid fa-cart-shopping cartIcon" onclick="viewCart();"></i>
            <li class="for-login-dropdown">
                <span>
                    <i class="login-icon fab fa-solid fa-right-to-bracket">
                    </i>
                </span>
                <?php if (!isset($_SESSION['USER_ID']) && !isset($_SESSION['USER_NAME'])) {

                ?>
                    <ul class="dropdown-blocks remove-list-style">
                        <li onclick="window.location.href='./../pages/files-for-main-content/customer-login.php'">
                            <span>Login</span>
                        </li>
                        <li onclick="window.location.href='./../pages/files-for-main-content/customer-register.php'">
                            <span>Register</span>
                        </li>
                    </ul>

                <?php
                } else {
                ?>
                    <ul class="dropdown-blocks remove-list-style">
                        <li style="text-align: center;" onclick="logout_function()">
                            <span>Logout</span>
                        </li>
                        <li style="text-align: center;" onclick="changePassword();">
                            <span> Change <br>Password</span>
                        </li>
                    </ul>
                <?php
                }
                ?>
            </li>
        </ul>
    </nav>


    <?php
    if (isset($_GET['hello'])) {
    ?>
        <div id="searchResult">
            <h1>
                <i class="fa-solid fa-rectangle-xmark" onclick="hideShowSearchedResult();" style="float: right;"></i>
            </h1>
            <?php
            // if($_GET['hello']){
            include 'db_config.php';
            $searched = strtolower($_REQUEST['idtemSearch']);
            $sql = "SELECT * FROM `products` where name like '$searched%' or name like '%$searched' or name like '%$searched%' ";
            $result = $conn->query($sql);
            if ($result !== false && $result->num_rows > 0) {
            ?>
                <div style="text-align: center;">
                    <h1>

                        <?php
                        echo 'We found this for your search :';
                        echo "\"" . $_REQUEST['idtemSearch'] . "\"";
                        // echo ''
                        ?>
                    </h1>
                </div>
                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div style="display:flex; justify-content:center; width:100%; margin-top:30px;">
                        <div style="width:fit-content;">

                            <div class="containerForProduct">
                                <div class="imageOfProduct">
                                    <img src="<?= $row['image_address'] ?>" alt="image not available" class="product-image"><br>
                                </div>
                                <p class="align-center">


                                    <?= $row['name'] ?>
                                </p>
                                <p class="align-center">
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
                                <button class="add_to_cart" name="add_to_cart" onclick="add_to_cart(<?= $row['id'] ?>,'<?= $row['name'] ?>',<?= $row['price'] ?>);">Add To Cart <i class="fa-solid fa-cart-shopping"></i></button>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <h1>did you searched for <br> " <?php echo $_REQUEST['idtemSearch'] ?>" <br> not available </h1>
            <?php

            }
            ?>
        <?php
    }
        ?>
        </div>

        <?php
        if (isset($_POST['feedbackSubmit'])) {
            if (empty(trim($_REQUEST['feedback']))) {
        ?>
                <script>
                    alert('Feedback cannot be empty');
                </script>
                <?php
            } else {
                include 'db_config.php';
                $sql = "insert into feedback_tbl(c_id,feedbacks) values(" .isset($_SESSION['USER_ID']).",'". trim($_REQUEST['feedback']) . "')";
                if (mysqli_query($conn, $sql)) {

                ?>
                    <script>
                        alert('Feedback submitted successfully');
                    </script>
                <?php
                } else {
                    // echo $sql;
                ?>
                    <script>
                        alert('Please give us feedback on our social sites or call at +997-9823673702');
                    </script>
        <?php
                }
            }
        }
        ?>
        <script>
            function logout_function() {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                    }
                };
                request.open("GET", "./../pages/files-for-main-content/logout.php", true);
                request.send();
            }

            function hideShowSearchedResult() {
                var x = document.getElementById("searchResult");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>