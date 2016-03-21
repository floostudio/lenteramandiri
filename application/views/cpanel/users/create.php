<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Users Management</a>
        <small>Use this form to create new user</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url()?>/users"><i class="fa fa-dashboard"></i> User</a></li>
        <li class="active">New user</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Create new user</h3>
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
                    }   else if (null !== $this->session->flashdata('success'))  {
                            $message = $this->session->flashdata('success');
                            echo "<div class='alert alert-success alert-dismissable'>";
                             echo "<i class='fa fa-check'></i>";
                            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                            echo $message;
                            echo "</div>";
                    }
                ?>
                <?php echo form_open_multipart('users/creating') ?>

                    <!-- text input -->
                    <div class="form-group">
                        <label>NIP*</label>
                        <input type="text" name="nip" required="required" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="email" name="email" required="required" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Password*</label>
                        <input type="password" name="pass" required="required" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>First Name*</label>
                        <input type="text" name="first_name" required="required" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Last Name*</label>
                        <input type="text" name="last_name" required="required" class="form-control" />
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Directorate</label>
                        <select class="form-control" style="max-width: 25%;" name="directorate" id="directorate">
                        <?php 
                            foreach($directorate as $dir) {
                                echo "<option value=".$dir->M_DIRECTORATE_ID.">".$dir->M_DIRECTORATE_NAME."</option>";
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
                                echo "<option value=".$g->M_GROUP_ID.">".$g->M_GROUP_NAME."</option>";
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
                                echo "<option value=".$dep->M_DEPARTMENT_ID.">".$dep->M_DEPARTMENT_NAME."</option>";
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
                                echo "<option value=".$tit->M_TITLE_ID.">".$tit->M_TITLE_NAME."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" name='userfile' id="fileLogo">
                        <p class="help-block">Upload logo image must be max 500px x 500px size and 2MB Max.</p>
                    </div>
                    
                    <div class="form-group">
                        <label>Is Active ?</label>
                        <select class="form-control" style="max-width: 25%;" name="active" id="active">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                        <p class="help-block">Jika memilih tidak, maka user akan disimpan sebagai draft dan tidak ditampilkan</p>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary bg-green">Submit</button>
                    </div>
                </form>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->

    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
