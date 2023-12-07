<?php
session_start();
if(!isset($_SESSION['ADMIN_USER_ID'] ) && !isset($_SESSION['ADMIN_USER_NAME']))
{
    header('location:./../for-admin-pages/includes/admin-login.php');
}
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="./../../../bootstrap-4.1.3-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="./../../../fontawesome-free-6.1.1-web/css/all.min.css">
<link rel="stylesheet" href="./../../../fontawesome-free-6.1.1-web/css/fontawesome.min.css">
<script src="./../../../jquery-3.6.0.min.js"></script>
<!-- <style>
    #modal {
  background: white;

  position: fixed;
width: 500px;
height: 200px;
top: 50%;
left: 50%;
margin-top: -100px; /* Negative half of height. */
margin-left: -250px; /* Negative half of width. */
  /* position: fixed;
  width: 50%;
  top: 50%;
  left: 50%;
  margin: -25% 0 0 -25%; */

  /* Embiggen */
  transform: scale(1.5); /* prefix me */

  /* Hidden */
  opacity: 0;
  pointer-events: none;
}
.dialogIsOpen #page-wrap {

/* Blur and de-color */
-webkit-filter: blur(5px) grayscale(50%);

/* Recede */
-webkit-transform: scale(0.9);

}
.dialogIsOpen #modal {
  
  /* Regular size and visible */
  transform: scale(1); /* prefix me */
  opacity: 1;

  /* Clickable */
  pointer-events: auto;

}
</style> -->
</head>