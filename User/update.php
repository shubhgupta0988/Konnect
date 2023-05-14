<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Update User</h3>
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
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateUser()" value="Update"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
              
  include('../master.php');
?>
<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/user/read_single.php?id=<?php echo $_GET['username']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#name').val(data['name']);
                $('#email').val(data['email']);
                $('#dob').val(data['dob']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateUser(){
        $.ajax(
        {
            type: "POST",
            url: '../api/user/update.php',
            dataType: 'json',
            data: {
                username: <?php echo $_GET['username']; ?>,
                name: $("#name").val(),
                email: $("#email").val(),        
                dob: $("#dob").val(),
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated User!");
                    window.location.href = '/konnect/user';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>