<a class="btn btn-dark m-2" href="./index.php" role="button">Back</a><span>Users Information</span>
<div class="h-100 d-flex justify-content-center align-items-center">

    <table class="table table-dark table-hover m-3" style="width: auto;">
        <th>Name</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>Username</th>
        <th>Options</th>
        <?php
        include './../includes/db_config.php';
        $query = "SELECT id,name,email,phone_number,address,username FROM customers ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
        ?><tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['phone_number']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td>
                        <button type="button" class="btn btn-warning mx-4"
                        onclick="editUser(<?= $row['id']; ?>);"
                        >Edit</button>
                        <button type="button" class="btn btn-danger"
                         onclick="removeUser(<?= $row['id']; ?>);"
                        >Remove</button>
                    </td>
                </tr>
            <?php

            }
        } else {

            ?>
            <tr>
                <td colspan="6">no records found</td>
            </tr>
        <?php
        }
        ?>
    </table>

</div>
