<?php
  include '../db_conn.php';
  $docu = new Document();
  $results = $docu->sel_query("SELECT area_id FROM tbl_areas");
  $area_exist = [];
  $area_available = range(1,100);
  foreach($results as $row){
    array_push($area_exist, $row['area_id']);
  }
  $area_available = array_diff($area_available,$area_exist);
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
            <label for="area_no">Area No.</label>
            <select class="form-control" name="area_no">
          <?php
            foreach($area_available as $area_no){
              echo "<option value='".$area_no."'>".$area_no."</option>";
            }

          ?>
        </select>
        </td>
        <td>
          <label for="name">Area Name</label>
          <input type="text" name="area_name" class="form-control">
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <button class="btn btn-info pull-right" onclick="reg_area()">Register</button>
        </td>
      </tr>
    </table>
  </body>
</html>

<script type="text/javascript">
function reg_area(){
  var data = "name="+$('input[name="area_name"]').val()+"&no="+$('input[name="area_no"]').val()+"&type=area_reg";
  $.ajax({
    data:data,
    url:'ajax/spec_functions.php'
  }).done(function(){
    alert_message("Area has been registered");
  });
}
</script>
