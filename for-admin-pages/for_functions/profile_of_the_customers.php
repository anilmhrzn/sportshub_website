<?php
$connection = mysqli_connect('localhost', 'root', '', 'sportshub_db');
$query = 'SELECT name,email,phone_number,address,username FROM customers where id=' . $_GET['cus_id'];
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_assoc($result)) {
?>
<div id="profileOfCustomers" class="d-flex justify-content-center align-items-center my-3">
    <div class="card p-3 py-4 bg-dark text-white" style="height:fit-content;">
        <i class="fa-solid fa-rectangle-xmark fa-2x text-right" onclick="hideProfile();"></i>
        <div>
            <div class="d-flex justify-content-center">
                    <img src="./profile.jpg" width="100" class="rounded-circle">
            </div>
            <h3 class="mt-2"><?=$row['name']?></h3>
            <p class="mt-1" style="letter-spacing:3px;"><i class="fa fa-2x">&#xf007;</i><b> <?=$row['username']?></b></p>
            <p class="mt-1 "><i class="fa fa-2x">&#xf658;</i> <?= $row['email']?></p>
            <p class="mt-1 fa-solid " style="letter-spacing:3px;"><i class="fa fa-2x " >
                    &#xf098;
                </i> <?=$row['phone_number']?></p>
            <p class="mt-1 "><i class="fa fa-2x">&#xe3af;</i> <?=$row['address']?></p>
        </div>
    </div>
</div>
<?php
    }
}

?>