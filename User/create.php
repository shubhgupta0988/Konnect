<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">DOB</label>
                          <input type="text" class="form-control" id="dob" placeholder="Enter DOB">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Username</label>
                          <input type="text" class="form-control" id="username" placeholder="Enter Username">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddUser()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
  function AddUser(){

        $.ajax(
        {
            type: "POST",
            url: '../api/user/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
                email: $("#email").val(),        
                dob: $("#dob").val(),
                username: $("#username").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New User!");
                    window.location.href = '/konnect/User';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>