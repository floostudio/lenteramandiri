<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          News Management</a>
        <small>Use this form to create new news</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url()?>/news"><i class="fa fa-dashboard"></i> News</a></li>
        <li class="active">New news</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Create new news</h3>
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
                <?php echo form_open_multipart('news/creating') ?>

                    <!-- text input -->
                    <div class="form-group">
                        <label>Judul*</label>
                        <input type="text" name="title" required="required" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Featured Image</label>
                        <input type="file" name='userfile' id="fileLogo">
                        <p class="help-block">Upload news image must be max 1280px x 720px size and 2MB Max.</p>
                    </div>
                    <div class="form-group">
                        <label>Konten*</label>
                        <textarea class="form-control" required="reqired" name="content" style="min-height: 300px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tampilkan ?</label>
                        <select class="form-control" style="max-width: 25%;" name="valid" id="valid">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                        <p class="help-block">Jika memilih tidak, maka berita akan disimpan sebagai draft dan tidak ditampilkan</p>
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
