<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Users List</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="users" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Username</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Username</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>';
  include('../master.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/user/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].name+"</td>"+
                "<td>"+data[user].email+"</td>"+
                "<td>"+data[user].dob+"</td>"+
                "<td>"+data[user].username+"</td>"+
                "<td><a href='update.php?username="+data[user].username+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].username+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#users"));
        }
    });
  });
  function Remove(username){
    var result = confirm("Are you sure you want to Delete the User Record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/user/delete.php',
            dataType: 'json',
            data: {
                username: p123
            },
            error: function (result) {
                alert("ERROROROR Removed User!");
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed User!");
                    window.location.href = '/konnect/user';
                }
                else {
                    alert("ERROROROR AAAAA User!");
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>