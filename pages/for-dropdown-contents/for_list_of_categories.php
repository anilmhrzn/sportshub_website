<?php
include './../includes/db_config.php';
$sql='SELECT name FROM categories';
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
?>
    
    <li style="border-top: none;" onclick="show_certain_page('<?=$row['name']?>');">
        <?=$row['name']?>
    </li>
<?php
    }
}
else{
    echo 'no records to show.';
}
?>