
<?php
$error_msg = '';
if (isset($_POST['registerForm'])) {
    if (empty($_REQUEST['fullName']) || empty($_REQUEST['address']) || empty($_REQUEST['phoneNumber']) || empty($_REQUEST['emailAddress']) || empty($_REQUEST['username']) || empty($_REQUEST['password']) || empty($_REQUEST['reEnteredPassword'])) {
        $error_msg = 'fields cannot be empty.';
    }else{
        if(strlen($_REQUEST['password'])<8){
            $error_msg = 'Length of the password must be more than 8 characters.';
        }else{
            if($_REQUEST['password']!=$_REQUEST['reEnteredPassword']){
                $error_msg = 'Password and re-entered password does not match.';
            }
            else{
                $password = password_hash($_REQUEST['password'], 
                PASSWORD_DEFAULT);
                include './../../includes/db_config.php';
                $query="insert into customers(name,email,phone_number,address,username,password) values('".$_REQUEST['fullName']."','".$_REQUEST['emailAddress']."',".$_REQUEST['phoneNumber'].",'".$_REQUEST['address']."','".$_REQUEST['username']."','". $password ."')";
                if(mysqli_query($conn,$query)){
                    ?>
                    <script>
                        alert('Account created sucessfully');
                        window.location.href="http://localhost/sportshub/pages/files-for-main-content/customer-login.php";
                    </script>
                    <?php
                }
            }
        }
    }
}
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../../../bootstrap-4.1.3-dist/css/bootstrap.min.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration bg-dark text-light" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="fullName" name="fullName" class="form-control form-control-lg" value="<?php if(isset($_REQUEST['fullName'])) echo $_REQUEST['fullName'];?>"/>
                                            <label class="form-label" for="fullName">Full Name</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="address" name="address" class="form-control form-control-lg" value="<?php if(isset($_REQUEST['address'])) echo $_REQUEST['address'];?>"/>
                                            <label class="form-label" for="address">Address</label>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4 ">

                                        <div class="form-outline datepicker w-100">
                                            <input type="number" class="form-control form-control-lg" id="phoneNumber" name="phoneNumber" value="<?php if(isset($_REQUEST['phoneNumber'])) echo $_REQUEST['phoneNumber'];?>"/>
                                            <label for="phoneNumber" class="form-label">Phone Number</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <input type="email" id="emailAddress" name="emailAddress" class="form-control form-control-lg" value="<?php if(isset($_REQUEST['emailAddress'])) echo $_REQUEST['emailAddress'];?>"/>
                                            <label class="form-label" for="emailAddress">Email</label>
                                        </div>


                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 ">
                                        <div class="form-outline">
                                            <input type="text" class="form-control form-control-lg" id="username" name="username" value="<?php if(isset($_REQUEST['username'])) echo $_REQUEST['username'];?>"/>

                                            <label class="form-label" for="username">Username</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 ">
                                        <div class="form-outline">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" value="<?php if(isset($_REQUEST['password'])) echo $_REQUEST['password'];?>"/>
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 ">
                                        <div class="form-outline">
                                            <input type="password" id="reEnteredPassword" name="reEnteredPassword" class="form-control form-control-lg" value="<?php if(isset($_REQUEST['reEnteredPassword'])) echo $_REQUEST['reEnteredPassword'];?>"/>
                                            <label class="form-label" for="reEnteredPassword">Re-enter Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 ">
                                        <div class=" form-outline">
                                            <input class="btn btn-primary btn-lg" name="registerForm" type="submit" value="Submit" />
                                            <!-- <input type="submit" value="ss"> -->
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <p style="color:red">
                            <i>

                                <?= $error_msg ?>
                            </i>  
                            </p>
                            <div>
                                <p class="mb-0">Already have an account? <a href="http://localhost/sportshub/pages/files-for-main-content/customer-login.php" class="text-white-50 fw-bold">login</a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <?php if (isset($_SESSION['eMsg'])) echo $_SESSION['eMsg']; ?>
    <?php if (isset($_SESSION['eMsg'])) {
    ?>
    <script>
    alert("<?= $_SESSION['eMsg']; ?>");
    </script>
    <?php  } ?> -->
</body>

</html>