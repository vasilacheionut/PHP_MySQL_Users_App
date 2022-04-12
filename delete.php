<?php
  $title = "Delete";
  include "header.php";
  $location = 'users.php';
?>
<?php
  $id = $_GET["id"];
  if (!empty($id) && $user->is_login()) {
      $user->delete($id);
      header("location:$location");
    } else {
  }
?>

<?php
  include "footer.php";
?>