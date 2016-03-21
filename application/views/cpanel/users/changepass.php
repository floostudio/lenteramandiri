
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Profile</a>
            <small>Use this form to change your password</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="<?php echo site_url();?>/profile/view/<?php echo $this->user_name;?>"><i class="fa fa-dashboard"></i> Profile</a></li>
            <li class="active">Change Password</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Change Your Password</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php 
                        if(null !== $this->session->flashdata('wrong_pass')) {
                            $message = $this->session->flashdata('wrong_pass');
                            echo "<div class='alert alert-danger alert-dismissable'>";
                            echo "<i class='fa fa-ban'></i>";
                            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                            echo $message;
                            echo "</div>";
                        }
                        else if (null !== $this->session->flashdata('success'))  {
                            $message = $this->session->flashdata('success');
                            echo "<div class='alert alert-success alert-dismissable'>";
                             echo "<i class='fa fa-check'></i>";
                            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                            echo $message;
                            echo "</div>";
                        }
                       
                    ?>
                    <form role="form" action="<?php echo site_url();?>/users/updatepass/<?php echo $userid;?>" method="post">
                        
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_pass" required="required" class="form-control" id="newpass" value=""/>
                        </div>
                        <div class="form-group">
                            <label>Re-enter Password</label>
                            <input type="password" name="reenter_pass" required="required" id="reenterpass" class="form-control"/>
                        </div>
                        
                        <div class="form-group">
                            <label id="validate-status"></label>
                        </div>
                        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary bg-green">Change</button>
                        </div>
                    </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <script type="text/javascript">
$(document).ready(function() {
  $("#reenterpass").keyup(validate);
});


function validate() {
  var p1 = $("#newpass").val();
  var p2 = $("#reenterpass").val();

    if(p1 == p2) {
       $("#validate-status").text("Password Matched");        
    }
    else {
        $("#validate-status").text("Password Unmatched");  
    }
    
}
</script>
