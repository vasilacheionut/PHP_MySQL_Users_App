<?php
$title = "Profile";
include "header.php";
?>
<?php
$location = 'profile.php';
$id = $user->getId();
$result_array = $user->read_single($id);

if (isset($_POST['file'])) {
    $image = $_POST['file'];
} else {
    $image = 'no-image-available.png';
}

if (isset($_POST['update_image'])) {
    $user->updateImage($id, "profiles/".$image);
    $user->login($_SESSION["username"], $_SESSION["password"]);    
}

if (isset($_POST['save_user'])) {
    $oldPassword = hash('sha256', $_POST['oldPassword']);
    if ($user->verifyHashPassword($id, $_POST['oldPassword'])) {
        $newPassword = $_POST['newPassword'];
        $user->updatePassword($id, $newPassword);
        echo $_SESSION["username"] = $user->getEmail();
        echo '<br>';
        echo $_SESSION["password"] = $newPassword;
        $user->login($_SESSION["username"], $_SESSION["password"]);
        header("location:$location");
    }
} else {
    foreach ($result_array as $key) {
        $firstname = $key['firstname'];
        $lastname  = $key['lastname'];
        $email = $key['email'];
        $password =  '';
    }
}
?>

<div class="row down-space">
    <div class="col-md-2">
        <div class="profile-img">
            <img class="w100" src="<?= $user->getImage(); ?>" alt="<?= $user->getImage(); ?>" />
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="btn btn-sm btn-block btn-primary">
                    Change Photo
                    <input type="file" name="file" />
                </div>
                <button type='submit' name='update_image' class='btn form-control btn-info  text-center'><i class='fas fa-save'> Save Image</i></button>
            </form>
        </div>
    </div>
    <div class="col-md-5">
        <div class="profile-head">
            <?php foreach ($result_array as $key) { ?>
                <h5>
                    <?= $key['displayname']; ?>
                </h5>
                <h6>
                    Email: <?php echo  '<a href="mailto:' . $key['email'] . '">' . $key['email'] . '</a>'; ?>
                </h6>
                <p>Hash Password : <span><?= $key['password']; ?></span></p>
            <?php  } ?>
        </div>
    </div>
    <div class="col-md-5">
        <div class="table">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Old Password</th>
                        <th scope="col">New Password</th>
                        <?php if ($user->is_login()) : ?>
                            <th scope="col">#</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <?php
                        echo "<tr>";
                        echo '<td>' . "<input type='text' class='form-control text-center' id='oldPassword' name='oldPassword' placeholder='Old Password' value=''>" . '</td>';
                        echo '<td>' . "<input type='text' class='form-control text-center' id='newPassword' name='newPassword' placeholder='New Password' value='$newPassword'>" . '</td>';
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

    </div>
</div>

<?php
include "footer.php";
?>