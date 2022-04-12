<?php
    $title = "Users";
    include "header.php";
?>
<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $result_array = $user->read_single($id);
    }else {
        $result_array = $user->read();
    }
?>
<?php
    $select = 0;
    include "users.inc.php";
?>

<?php
    include "footer.php";
?>