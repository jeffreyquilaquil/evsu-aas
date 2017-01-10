<?php
  include '../db_conn.php';
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registration of Area</title>
  </head>
  <body>
    <table class="table">
      <tr>
        <td>
          <label for="name">Area Name</label>
          <input type="text" name="area_name" class="form-control">
        </td>
      </tr>
      <tr>
        <td>
          <button class="btn btn-info pull-right" onclick="reg_area()">Register</button>
        </td>
      </tr>
    </table>
  </body>
</html>

<script type="text/javascript">
function reg_area(){
  var data = "name="+$('input[name="area_name"]').val()+"&type=area_reg";
  $.ajax({
    data:data,
    url:'ajax/spec_functions.php'
  }).done(function(){
    alert_message("Area has been registered");
  });
}
</script>
