<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Task Management</a>
        <small>Use this form to create new task</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url()?>/task"><i class="fa fa-dashboard"></i> Task</a></li>
        <li class="active">New task</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Create new task</h3>
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
                <?php echo form_open_multipart('task/creating') ?>

                    <!-- text input -->
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                        <label>Expire</label>
                        <div class='input-group date' id='expire' style="max-width: 25%;">
                            <input type='text' name='expire' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <select class="form-control" style="max-width: 25%;" name="company" id="company">
                        <?php 
                            foreach($company as $com) {
                               
                                echo "<option value=".$com->COMPANY_ID.">".$com->COMPANY_NAME."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Notes</label>
                        <textarea class="form-control" name="note" style="min-height: 300px;"></textarea>
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
<script type="text/javascript">
        $(function () {
            $('#expire').datepicker({
            });
        });
    </script>