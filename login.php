<?php
$title = "Login";
include "header.php";
?>
<?php
$location = "index.php";

if ($user->is_login()){
  header("location:$location");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_SESSION["username"] =  $_POST['username'];
  $password = $_SESSION["password"] =  $_POST['password'];
  $username = $_SESSION["username"];
  $password = $_SESSION["password"];

  if ($user->login($username,  $password) == true) {
    header("location:$location");
  } else {
    $login_error =  '
              <div class="alert alert-danger" role="alert">
                <strong>Incorrect</strong> username or password.
              </div>      
          ';
  }
} else {
  $username = "";
  $password = "";
  $login_error = "";
  if ($user->is_login()) {
    header("location:$location");
  }
}
?>

<div id="login">
  <div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h3 class="text-center">Login</h3>
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="email" class="form-control" id="username" name="username" aria-describedby="usernameHelp" value="<?= $username; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="password" name="password" value="<?= $password; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <?php
          echo '<br>' . $login_error;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include "footer.php";
?>