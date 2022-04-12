<?php
  $title = "Home";
  include "header.php";
?>
<?php
  $column = 'displayname';

  if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $result_array = $user->search($column, $search);
  } else {
    $search = '';
    $result_array = $user->search($column, $search);
  }
?>
<?php
  $select = 1;
  include "users.inc.php";
?>
<?php
  include "footer.php";
?>