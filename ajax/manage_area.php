<!DOCTYPE html>
<?php
  include '../db_conn.php';
  $user = new user();
  $area = $user->get_areas($_GET['areaNo'])
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Management of Areas</title>
  </head>
  <body>
    <table class="table">
      <tr>
        <td colspan="2">
          <label for="no">Area Name</label>
          <input type="text" name="name" class="form-control" style="width:100%" value="<?php echo $area['name']?>">
          <input type="hidden" name="id" value="<?php echo $area['id']?>">
        </td>
        <td></td>
      </tr>
      <tr>
        <td>
          <!-- <button type="button" class="" name="button"></button> -->
        </td>
        <td>
          <button class='btn btn-default pull-right' onclick="update_area()">Update</button>
        </td>
      </tr>
    </table>
  </body>

  <script type="text/javascript">
    function update_area(){
      $('input[name="name"]').val();
      var data = 'name='+$('input[name="name"]').val()+'&id='+$('input[name="id"]').val()+'&type=area_upd';
      $.ajax({
        data:data,
        url:'ajax/spec_functions.php'
      }).done(function(){
        alert_message("Area updated successfully");
      });
    }
  </script>
</html>
