<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Task Detail Management</a>
        <small>Use this form to edit task detail</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="<?php echo site_url()?>/task"><i class="fa fa-dashboard"></i> Task</a></li>
        <li class="active">Manage task detail</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Manage task detail ["<?php echo $task[0]->TASK_TITLE; ?>"]</h3>
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
                    <form id="featForm" action="<?php echo base_url()."task/update_detail/".$task_id;?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        
                        <div class="col-md-12">
                            
                            <?php
                            foreach($taskdetails->result() as $f) {
                                echo "<div class='form-group row'>";
                                echo "<div class='col-md-8'>";
                                echo     "<label>Task Detail</label>";
                                echo     "<input type='text' name='titles[]' required='required' value='{$f->TASK_DETAIL_DESC}' class='form-control'>";
                                echo "</div>";
                                
                                
                                echo "<div class='col-md-1 col-md-offset-3'>"
                                . "<button type='button' class='btn btn-primary removeButton bg-red' data-toggle='modal' data-target='#modal-1'><i class='fa fa-minus'></i></button>"
                                        . "</div>";
                                echo "</div>";
                            }
                            ?>
                            
                            
                            <!-- The template for adding new field -->
                            <div class="form-group hide row" id="featTemplate">

                                <div class="col-md-8">
                                    <label>Task Detail</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                
                                <div class="col-md-1 col-md-offset-3">
                                    <button type="button" class="btn btn-primary removeNewButton bg-red"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary addButton bg-blue"><i class="fa fa-plus"></i></button>
                            <button type="submit" class="btn btn-primary bg-green">Submit</button>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
      </div><!-- /.row -->

      <!-- Modal form-->
        <div class="modal fade" id="modal-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <h3>Apakah anda ingin menghapus data ini ?</h3>
                                </div>	
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <input type="hidden" name="idsel" value="" />
                            <input type="hidden" name="curtag" value="" />
                            <button type="button" class="btn btn-white" data-dismiss="modal">TIDAK</button>
                            <button type="button" class="btn btn-warning" id="modal-yes"  data-dismiss="modal">YA</button>
                        </div>
                </div>	
            </div>
        </div>
        <!-- end of modal ------------------------------>
      
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <script>
$(document).ready(function() {
        featIndex = 0;// Add button click handler
        $(document).on('click', '.addButton', function() {
        featIndex++;
        var $template = $('#featTemplate'),
            $clone    = $template
                            .clone()
                            .removeClass('hide')
                            .removeAttr('id')
                            .attr('data-feat-index', featIndex)
                            .insertBefore($template);

        // Update the name attributes
        $clone
            .find('[name="title"]').attr('required', 'required').end()
            .find('[name="title"]').attr('name', 'titles[]').end()
            .find('[name="desc"]').attr('name', 'descs[]').end()

    })
    
    .on('click', '.removeNewButton', function(){
        var $row  = $(this).parents('.form-group'),
            index = $row.attr('data-feat-index');
            
            $row.remove();
    })
    
    // Remove button click handler
    .on('click', '.removeButton', function() {
        var $row  = $(this).parents('.form-group'),
            index = $row.attr('data-feat-index');
        
        $('#modal-yes').on('click', function(){
                $row.remove();
            })
    });
    
               
});
</script>