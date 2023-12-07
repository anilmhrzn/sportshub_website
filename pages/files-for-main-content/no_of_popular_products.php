<?php
include './../../includes/db_config.php';
$sql='SELECT * FROM PRODUCTS WHERE popular=1';
echo mysqli_num_rows(mysqli_query($conn,$sql));
?>