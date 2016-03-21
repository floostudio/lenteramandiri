<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Users Management</a>
        <small>Use this form to edit Users</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>/users"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Edit Users</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit user</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php 
                    if(null !== $this->session->flashdata('error')) {
                            $message = $this->session->flashdata('error');
                            echo "<div class='alert alert-danger alert-dismissable'>";
                            echo "<i class='fa fa-ban'> </i>";
                            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                            echo $message;
                            echo "</div>";
                    } else if (null !== $this->session->flashdata('success'))  {
                            $message = $this->session->flashdata('success');
                            echo "<div class='alert alert-success alert-dismissable'>";
                            echo "<i class='fa fa-check'></i>";
                            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                            echo $message;
                            echo "</div>";
                    }
                ?>
                
                <?php $a = $user; ?>
                <?php echo form_open_multipart('users/updating/'.$a[0]->USER_ID); ?>
                    <!-- text input -->
                    <div class="form-group">
                        <label>NIP*</label>
                        <input type="text" name="nip" required="required"  value="<?php echo $a[0]->USER_NIP; ?>" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="email" name="email" required="required"  value="<?php echo $a[0]->USER_EMAIL; ?>" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>First Name*</label>
                        <input type="text" name="first_name" required="required" value="<?php echo $a[0]->USER_FIRST_NAME; ?>" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Last Name*</label>
                        <input type="text" name="last_name" required="required" value="<?php echo $a[0]->USER_LAST_NAME; ?>" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Directorate</label>
                        <select class="form-control" style="max-width: 25%;" name="directorate" id="directorate">
                        <?php 
                            foreach($directorate as $dir) {
                               ($a[0]->USER_DIRECTORATE == $dir->M_DIRECTORATE_ID) ? $dir_value = "selected='selected'" : $dir_value = '';
                                echo "<option value=".$dir->M_DIRECTORATE_ID." ".$dir_value.">".$dir->M_DIRECTORATE_NAME."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Group</label>
                        <select class="form-control" style="max-width: 25%;" name="group" id="group">
                        <?php 
                            foreach($group as $g) {
                                ($a[0]->USER_GROUP == $g->M_GROUPs_ID) ? $g_value = "selected='selected'" : $g_value = '';
                                echo "<option value=".$g->M_GROUP_ID." ".$g_value.">".$g->M_GROUP_NAME."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control" style="max-width: 25%;" name="department" id="department">
                        <?php 
                            foreach($department as $dep) {
                                ($a[0]->USER_DEPARTMENT == $dep->M_DEPARTMENT_ID) ? $dep_value = "selected='selected'" : $dep_value = '';
                                echo "<option value=".$dep->M_DEPARTMENT_ID." ".$dep_value.">".$dep->M_DEPARTMENT_NAME."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Title</label>
                        <select class="form-control" style="max-width: 25%;" name="title" id="title">
                        <?php 
                            foreach($title as $tit) {
                                ($a[0]->USER_TITLE == $tit->M_TITLE_ID) ? $tit_value = "selected='selected'" : $tit_value = '';
                                echo "<option value=".$tit->M_TITLE_ID." ".$tit_value.">".$tit->M_TITLE_NAME."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <?php 
                            if($a[0]->USER_IMG) 
                                 { $logo = $a[0]->USER_IMG; } 
                            else { $logo = "static/images/user/default.jpg"; }
                        ?>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="hidden" name="logo" value="<?php echo $logo; ?>" /><br>
                        <img style="max-width: 150px;" src="<?php echo base_url().$logo; ?>">
                    </div>
                    <div class="form-group">
                        <input type="file" name='userfile' id="fileLogo">
                        <span class="help-block">Upload logo image must be max 500 x 500px size and 2MB Max.</span>
                    </div>
                    <div class="form-group">
                        <label>Tampilkan ?</label>
                        <select class="form-control" style="max-width: 25%;" name="active" id="active">
                            <option value="1" <?php if($a[0]->IS_ACTIVE) echo "selected='selected'" ?> >Ya</option>
                            <option value="0" <?php if(!$a[0]->IS_ACTIVE) echo "selected='selected'" ?> >Tidak</option>
                        </select>
                        <span class="help-block">Jika memilih tidak, maka artikel akan disimpan sebagai draft dan tidak ditampilkan</span>
                    </div>
                    <input type="hidden" name="userid" value="<?php echo $a[0]->USER_ID; ?>" class="form-control" />
                    <input type="hidden" name="banner" value="<?php echo $logo; ?>" />
                    <div class="box-footer">
                        <a href="<?php echo base_url('users/changepass')."/".$a[0]->USER_ID;?>" class="btn btn-primary bg-blue">Change Password</a>
                        <button type="submit" class="btn btn-primary bg-green">Submit</button>
                    </div>
                </form>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
