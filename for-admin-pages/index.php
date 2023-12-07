<?php include './includes/header.php'; ?>
<?php include './includes/navbar.php'; ?>
<style>
    #mainPart {
        background-image: url('images/background.webp');
        background-size: cover;
        background-position: center;
        background-color: rgba(0, 0, 0, 5); /* Adjust the last value (0.5) to change opacity */
    }
</style>
<div id="mainPart">
    <?php
    include './options.php';
    ?>
</div>
<?php include './includes/footer.php'?>
