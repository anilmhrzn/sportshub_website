<?php 
if($_POST)
{
    $connection=mysqli_connect('localhost','root','','sportshub_db');
    $query="update orders set delivery_status=1 where o_id=".$_POST['o_id'];
    mysqli_query($connection,$query);
    mysqli_close($connection);
}
?>