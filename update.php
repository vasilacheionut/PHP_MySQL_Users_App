<?php
    $title = "Update";
    include "header.php";
    $location = 'users.php';
?>
<?php
    if (isset($_POST['save_user'])) {
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user->update($id, $firstname, $lastname, $email, $password);
        header("location:$location");
    } else {
        $id = $_GET["id"];
        $result_array = $user->read_single($id);
        foreach ($result_array as $key) {
            $firstname = $key['firstname'];
            $lastname  = $key['lastname'];
            $email = $key['email'];
            $password =  '';
        }
    }
?>

<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Update Password</th>
                <?php if ($user->is_login()) : ?>
                    <th scope="col">#</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <?php
                    echo "<tr>";
                    echo '<td scope="row" >' . "<input type='text' style='width: 35px;'  class='form-control text-center' id='id' name='id' placeholder='Id' value='$id' readonly >" . '</td>';                    
                    echo '<td>' . "<input type='text' class='form-control text-center' id='firstname' name='firstname' placeholder='First Name' value='$firstname'>" . '</td>';
                    echo '<td>' . "<input type='text' class='form-control text-center' id='lastname' name='lastname' placeholder='Last Name' value='$lastname'>" . '</td>';
                    echo '<td>' . "<input type='email' class='form-control text-center' id='email' name='email' placeholder='Email' value='$email'>" . '</td>';
                    echo '<td>' . "<input type='text' class='form-control text-center' id='password' name='password' placeholder='Password' value='$password'>" . '</td>';
                    if ($user->is_login()) {
                        echo '<td>' 
                       . "<button type='submit' name='save_user' class='btn input-block-level form-control btn-info  text-center'><i class='fas fa-save'></i></button>"
                       . '</td>';
                    }
                    echo "</tr>";
                ?>
            </form>
        </tbody>
    </table>
</div>

<?php
    include "footer.php";
?>