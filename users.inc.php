<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Display Name</th>
        <th scope="col">Email</th>
        <th scope="col">Hash Password</th>
        <?php if ($user->getRole() == 2) : ?>
          <th scope="col" colspan="2"></th>
        <?php elseif ($user->is_login() && $select == 1): ?>
          <th scope="col"></th>             
        <?php else: ?>                 
        <?php endif; ?>

      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($result_array as $key) {
        echo "<tr>";
        echo '<td scope="row">' . $key['id'] . '</td>';
        echo '<td>' . $key['firstname'] . '</td>';
        echo '<td>' . $key['lastname'] . '</td>';
        echo '<td>' . $key['displayname'] . '</td>';
        echo '<td>' . '<a href="mailto:' . $key['email'] . '">' . $key['email'] . '</a>'  . '</td>';
        echo '<td>' . $key['password'] . '</td>';
        if ($user->is_login()) {
          switch ($select) {
            case '1':
              echo '<td colspan="2" class="text-center">' . "<a href='users.php?id=" . $key['id'] . "' class='text-info' type='submit'><i class='fas fa-folder-open'></i></a>" . '</td>';
              break;

            default:
            if($user->getRole() == 2){            
                echo '<td>' . "<a href='update.php?id=" . $key['id'] . "' class='text-info' type='submit'><i class='fas fa-pencil-alt'></i></a>" . '</td>';
                echo '<td>' . "<a href='delete.php?id=" . $key['id'] . "' class='text-danger' type='submit'><i class='fas fa-trash'></i></a>" . '</td>';
              }          
              break;
          }
        }
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>