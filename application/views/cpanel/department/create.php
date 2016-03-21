<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Department Management</a>
        <small>Use this form to create new department</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url()?>/department"><i class="fa fa-dashboard"></i> Department</a></li>
        <li class="active">New department</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add new department</h3>
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
                <?php echo form_open_multipart('master/department/creating') ?>

                    <!-- text input -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                        <label>Tampilkan ?</label>
                        <select class="form-control" style="max-width: 25%;" name="valid" id="valid">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                        <p class="help-block">Jika memilih tidak, maka artikel akan disimpan sebagai draft dan tidak ditampilkan</p>
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
