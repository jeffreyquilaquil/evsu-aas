<?php
include '../db_conn.php';
$user = new user();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table class="table table-striped">
      <thead>
        <th width="30%">Area No.</th>
        <th>Area Name</th>
        <th width="15%">Action</th>
      </thead>
      <tbody>
        <?php
          foreach ($user->get_areas() as $value) {
            echo '<tr>
                <td>'.$value['id'].'</td>
                <td>'.$value['name'].'</td>
                <td><button onclick="edit_area('.$value['id'].')"><i class="fa fa-edit"></i></button></td>
              </tr>';
          }
         ?>
      </tbody>
    </table>
  </body>
</html>
