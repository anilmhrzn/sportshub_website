<?php
if($_GET){

    $conn = mysqli_connect('localhost', 'root', '', 'sportshub_db');
    $query="select * from sub_categories";
    $result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    ?>
    <button type="button" class="btn btn-dark m-2"  onclick="showCategories()">Back</button>
<div class=" h-100 d-flex justify-content-center align-items-center">
    <div class="  m-5 container w-50">
        <?php
    while ($row = mysqli_fetch_assoc($result)) {
        
        ?>
        <div class="row ">
            
            <button type="button" class="btn btn-outline-dark col m-5 " style="height: 10vh;"
            id="usersOption" onclick="selectSubCategories(<?=$_GET['category']?>,<?= $row['id']; ?>)"><?= $row['name']; ?></button>
        </div>
        <?php
    }?>
    </div>
</div>
    <?php
}
} 
?>

              