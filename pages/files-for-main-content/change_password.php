<!-- TODO: do change password remove html head tags -->



<!-- <style scoped>
        #container-for-change-password{

            @import url('http://localhost/bootstrap-4.1.3-dist/css/bootstrap.min.css');
        }
    </style> -->

<?php
session_start();
if (isset($_SESSION['USER_ID']) && isset($_SESSION['USER_NAME'])) {
    if ($_POST) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $new_re_password = $_POST['new_re_password'];
        // include './includes/db_config.php';
        include './../../includes/db_config.php';
        $query = "Select password from customers where username='" . $_SESSION['USER_NAME'] . "' AND  id=" . $_SESSION['USER_ID'];
        // echo $query;
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $password = $row['password'];
                if (password_verify($old_password, $row['password'])) {
                    if ($new_password == $new_re_password) {
                        $newpassword = password_hash(
                            $new_password,
                            PASSWORD_DEFAULT
                        );
                        $query = "update customers  set `password`='" . $newpassword . "' where username='" . $_SESSION['USER_NAME'] . "' AND  id=" . $_SESSION['USER_ID'].";";
                        mysqli_query($conn,$query);
                        // echo $query; 
                        // echo $new_password; 
                        ?>
                        <script>
                            setTimeout(function(){
                                alert('password changed sucessfully');
                                location.href="http://localhost/sportshub/pages/index.php";
                            }, 2000); 
                        </script>
                        <?php
                        // header('location:http://localhost/sportshub/pages/index.php');
                    } else {
                        $error_message_new_re_password = "re-entered password doesnot match with the new password ";
                    }
                    // $_SESSION['USER_ID'] = $row['id'];
                    // $_SESSION['USER_NAME'] = $row['username'];
                    // header('location:./../index.php');
                } else {
                    $error_message_old_password = "Invalid Password.";
                }
            }
        } else {
            echo "error. Please try again later or call us at +997-9823673702.";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- <link rel="stylesheet" type="text/css" href="./../../bootstrap-4.1.3-dist/css/bootstrap.min.css">/ -->
        <link rel="stylesheet" type="text/css" href="./../../../bootstrap-4.1.3-dist/css/bootstrap.min.css">
    </head>

    <body>
        <!-- <div id="container-for-change-password"> -->

        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <a href="http://localhost/sportshub/pages/index.php" type="button" class="btn btn-dark " style="position: fixed; top:30px; left:30px;">Back</a>
            <form class="my-5 w-50" method="POST" action="">
                <div class="row">
                    <div class="col">
                        Old password:
                        <input type="text" class="form-control" name="old_password" placeholder="Old Password">
                        <span class="text-danger">

                            <?php if (isset($error_message_old_password)) echo $error_message_old_password; ?>
                        </span>

                    </div>
                    <div class="col">
                        New password:
                        <input type="text" class="form-control" name="new_password" placeholder="New Password">
                        <span class="text-danger">

                            <?php if (isset($error_message_new_password)) echo $error_message_new_password; ?>
                        </span>
                    </div>
                    <div class="col">
                        Re-enter new password:
                        <input type="text" class="form-control" name="new_re_password" placeholder="Re-enter new password">
                        <span class="text-danger">

                            <?php if (isset($error_message_new_re_password)) echo $error_message_new_re_password; ?>
                        </span>
                    </div>
                </div>
                <div class="my-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">submit</button>
                </div>
            </form>
        </div>
        <!-- </div> -->
    </body>

    </html>
<?php
}
?>