<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Title Management</a>
        <small>Use this form to edit Title</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>/title"><i class="fa fa-dashboard"></i> Title</a></li>
        <li class="active">Edit Title</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit title</h3>
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
                
                <?php $a = $title->result(); ?>
                <?php echo form_open_multipart('master/title/update/'.$a[0]->M_TITLE_ID); ?>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $a[0]->M_TITLE_NAME; ?>" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                        <label>Tampilkan ?</label>
                        <select class="form-control" style="max-width: 25%;" name="valid" id="valid">
                            <option value="1" <?php if($a[0]->IS_SHOW) echo "selected='selected'" ?> >Ya</option>
                            <option value="0" <?php if(!$a[0]->IS_SHOW) echo "selected='selected'" ?> >Tidak</option>
                        </select>
                        <span class="help-block">Jika memilih tidak, maka artikel akan disimpan sebagai draft dan tidak ditampilkan</span>
                    </div>
                    <input type="hidden" name="userid" value="<?php echo $a[0]->M_TITLE_ID; ?>" class="form-control" />
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
