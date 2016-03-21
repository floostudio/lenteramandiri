<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          News Management</a>
        <small>Use this form to edit News</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>/news"><i class="fa fa-dashboard"></i> News</a></li>
        <li class="active">Edit News</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit news</h3>
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
                
                <?php $a = $news->result(); ?>
                <?php echo form_open_multipart('news/update/'.$a[0]->NEWS_ID); ?>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Judul*</label>
                        <input type="text" name="title" required="required" value="<?php echo $a[0]->NEWS_TITLE; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Featured Image</label>
                        <input type="file" name='userfile' id="fileLogo">
                        <span class="help-block">Upload logo image must be max 1280 x 720 size and 2MB Max.</span>
                        <img class='img-thumbs-lg' src="<?php echo base_url().$a[0]->NEWS_IMAGE; ?>">
                    </div>
                    <div class="form-group">
                        <label>Content*</label>
                        <textarea class="form-control" name="content" required="required" style="min-height: 300px;"><?php echo $a[0]->NEWS_CONTENT; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tampilkan ?</label>
                        <select class="form-control" style="max-width: 25%;" name="valid" id="valid">
                            <option value="1" <?php if($a[0]->IS_SHOW) echo "selected='selected'" ?> >Ya</option>
                            <option value="0" <?php if(!$a[0]->IS_SHOW) echo "selected='selected'" ?> >Tidak</option>
                        </select>
                        <span class="help-block">Jika memilih tidak, maka artikel akan disimpan sebagai draft dan tidak ditampilkan</span>
                    </div>
                    <input type="hidden" name="banner" value="<?php echo $a[0]->NEWS_IMAGE; ?>" />
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
