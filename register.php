<?php
$title = "Register";
include "header.php";
?>
<?php
$location = "login.php";
if ($user->is_login()){
  header("location:$location");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['firstname'])){$valid_firstname =  'is-valid';} else {$valid_firstname =  'is-invalid';}
  if (isset($_POST['lastname'])) {$valid_lastname  =  'is-valid';} else {$valid_lastname  =  'is-invalid';}
  if (isset($_POST['email']))    {$valid_email     =  'is-valid';} else {$valid_email     =  'is-invalid';}
  if (isset($_POST['password'])) {$valid_password  =  'is-valid';} else {$valid_password  =  'is-invalid';}


  if (
    isset($_POST['firstname']) && 
    isset($_POST['lastname']) && 
    isset($_POST['email']) && 
    isset($_POST['password'])
  ){
    $firstname =  $_POST['firstname'];
    $lastname  =  $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($firstname, $lastname, $email, $password) == true) {
      header("location:$location");
    } else {
      $register_error =  '
          <div class="alert alert-danger" role="alert">
              <strong>User</strong> exists...
          </div>      
      ';
    }    
  } else {

  }
} else {
  $firstname =  "";
  $lastname  =  "";    
  $email = "";
  $password = "";
  $register_error = "";
}
?>

<div id="register">
  <div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h3 class="text-center">Register</h3>
            <div class="form-group">
              <label for="FirstName">First Name</label>
              <input type="firstname" class="form-control <?= $valid_firstname; ?>" id="firstname" name="firstname"  value="<?= $firstname; ?>" required>
            </div>
            <div class="form-group">
              <label for="LastName">Last Name</label>
              <input type="lastname" class="form-control <?= $valid_lastname; ?>" id="lastname" name="lastname"  value="<?= $lastname; ?>" required>
            </div>            
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" class="form-control <?= $valid_email; ?>" id="email" name="email"  value="<?= $email; ?>" required>
            </div>            
            <div class="form-group">
              <label for="Password">Password</label>
              <input type="password" class="form-control <?= $valid_password; ?>" id="password" name="password" value="<?= $password; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
          <?php
            echo '<br>' . $register_error;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  include "footer.php";
?>
