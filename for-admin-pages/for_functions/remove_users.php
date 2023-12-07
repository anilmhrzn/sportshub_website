<?php 
$id=$_GET['id'];
include './../../includes/db_config.php';
$query="delete from `customers` WHERE `customers`.`id` = $id;";
if ($conn->query($query) === TRUE) {
    echo "Customer Removed Sucessfully";
  } else {
    echo "Error Removing customer: " . $conn->error;
  }
  
  $conn->close();
?>