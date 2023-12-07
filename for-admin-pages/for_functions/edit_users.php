<button type="button" class="btn btn-dark m-5" id="backFromEditUsers" 
onclick="showUser();"
>Back</button><span>Editing users Information</span>
<?php
if($_POST){
    // echo 'hey yrr i m from $_post condtion of edit users';
    $id=$_REQUEST['id'];
    include './../../includes/db_config.php';
    $fullName=$_POST['fullName'];
    $address=$_POST['address'];
    $phone_number=$_POST['phone_number'];
    $emailAddress=$_POST['emailAddress'];
    $username=$_POST['username'];
    // $query="SELECT * from customers  WHERE `customers`.`id` = $id AND `status` = 1";
    $query="UPDATE `customers` SET name='$fullName', email='$emailAddress',phone_number='$phone_number',address='$address',username='$username'  WHERE `customers`.`id` = $id;";
    if ($conn->query($query) === TRUE) {
        // echo "Record updated successfully";
        header('location:http://localhost/sportshub/for-admin-pages/index.php');
              } else {
        echo "Error updating record: " . $conn->error;
      }
      
      $conn->close();

}
if($_GET){
// echo 'hey';
$id=$_REQUEST['id'];
include './../../includes/db_config.php';
$query="SELECT * from customers   WHERE `customers`.`id` = $id ";
$result=mysqli_query($conn,$query);
        if (mysqli_num_rows($result) > 0) {
        while($row=mysqli_fetch_assoc($result)){
            
            ?>
            <section>
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration bg-dark text-light" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <!-- <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3> -->
                            <form action="./for_functions/edit_users.php" method="POST" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="hidden" name="id" value="<?=$id?>">
                                            <input type="text" id="fullName" name="fullName" class="form-control form-control-lg" value="<?=$row['name']?>"/>
                                            <label class="form-label" for="fullName">Full Name</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="address" name="address" class="form-control form-control-lg" value="<?=$row['address']?>"/>
                                            <label class="form-label" for="address">Address</label>
                                        </div>

                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-md-6 mb-4 ">

                                        <div class="form-outline datepicker w-100">
                                            <input type="text" class="form-control form-control-lg" id="phone_number" name="phone_number" value="<?=$row['phone_number']?>"/>
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="email" id="emailAddress" name="emailAddress" class="form-control form-control-lg" value="<?=$row['email']?>"/>
                                            <label class="form-label" for="emailAddress">Email</label>
                                        </div>


                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 ">
                                        <div class="form-outline">
                                            <input type="text" class="form-control form-control-lg" id="username" name="username" value="<?=$row['username']?>"/>

                                            <label class="form-label" for="username">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 ">
                                        <div class=" form-outline">
                                            <input class="btn btn-primary btn-lg" type="submit" value="Update" />
                                        </div>

                                    </div>
                                </div>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <?php
    //    echo 'edit user is sucessfully running '; 
    
        }}
        else{
        echo 'no records';
    }
}
?>