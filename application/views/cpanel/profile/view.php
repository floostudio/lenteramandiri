
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile
            <small>Use this form to manage your profile</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Manage Your Profile</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php 
                        if(null !== $this->session->flashdata('fileuploaderror')) {
                            $message = $this->session->flashdata('fileuploaderror');
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
                    <?php $t = $user->result(); ?>
                    <?php echo form_open_multipart('profile/update/'.$t[0]->USER_CPANEL_USERNAME);?>
                    
                        <!-- text input -->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" value="<?php echo $t[0]->USER_CPANEL_USERNAME; ?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="user_name" class="form-control" value="<?php echo $t[0]->USER_CPANEL_NAME; ?>"/>
                        </div>
                        <?php 
                                if($t[0]->USER_CPANEL_LOGO) 
                                     { $logo = $t[0]->USER_CPANEL_LOGO; } 
                                else { $logo = "static/images/user/default.jpg"; }
                            ?>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="hidden" name="logo" value="<?php echo $logo; ?>" /><br>
                            <img src="<?php echo base_url().$logo; ?>">
                        </div>
                        <div class="form-group">
                            <input type="file" name='userfile' id="fileLogo">
                            <p class="help-block">Upload logo image must be 160x160 pixel size and 2MB Max.</p>
                        </div>
                        <div class="box-footer">
                            <a href="<?php echo site_url();?>/profile/changepass"><button type="button" class="btn btn-primary">Change Password</button></a>
                            <button type="submit" class="btn btn-primary bg-green">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
