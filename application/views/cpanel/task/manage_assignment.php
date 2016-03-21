<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Task Assignment Management</a>
            <small>Use this form assignment task</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url()?>/task"><i class="fa fa-dashboard"></i> TASK MANAGEMENT</a>
            </li>
            <li class="active">MANAGE ASSIGNMENT</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        
            <div class='form-group'>
                <div class="box box-solid">
                    <div class="box-header">
                        <i class="fa fa-th"></i>
                        <h3 class="box-title">TASK ASSIGNMENT</h3><br>
                        
                        <div class="box-tools pull-right">
                            <button type='button' class="btn bg-teal btn-sm collapseButton" data-widget="collapse"><i name="fa" class="fa fa-minus"></i></button>
                        </div>
                        
                    </div>
                    <form id="featForm" action="<?php echo base_url()."task/updateassignment/".$task_id;?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="box-body border-radius-none" name='box-body'>
                        <div class='form-group row'>
                            <label class="col-md-12"><h3>Assignment pada TASK ["<?php echo $task[0]->TASK_TITLE; ?>"]</h3></label>
                        </div>
                        <div class='form-group row'>
                          <label class="col-md-6" style="text-align: center;">USER LIST</label>
                          <label class="col-md-6" style="text-align: center;">USER ASSIGNED</label>
                        </div>
                        <div class='form-group row'>
                          <div class="col-md-12">
                              <select multiple class="searchable" name="searchable[]">
                                  <?php
                                    foreach($list_user->result() as $lr) {
                                        $userFound = false;
                                        foreach($preselected_user->result() as $pr){
                                           // echo "<option value='".$lr->id."'>".$lr->username." ".$pr->USER_ID."</option>";
                                            if($lr->USER_ID == $pr->USER_ID) {
                                                echo "<option style='min-height: '500px';' value='{$lr->USER_ID}' selected='selected'>{$lr->USER_FIRST_NAME} {$lr->USER_LAST_NAME}</option>";
                                                $userFound = true;
                                                break;
                                            }
                                        }
                                        if(!$userFound) {
                                            echo "<option value='".$lr->USER_ID."'>{$lr->USER_FIRST_NAME} {$lr->USER_LAST_NAME}</option>";
                                        }
                                    }
                                    
                                  ?>
                              </select>
                              <br />
                            </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary bg-green">Submit</button>
                </div>
                </form>
            </div>
        </div>
    
        
        
        
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
  <!-- Multiselect -->
    <script src="<?php echo base_url(); ?>static/plugins/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>static/plugins/quicksearch/jquery.quicksearch.js" type="text/javascript"></script>
    <script>
        
$(document).ready(function() {
        $('.searchable').multiSelect({
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='find user name'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='find user name'>",
            afterInit: function(ms){
              var that = this,
                  $selectableSearch = that.$selectableUl.prev(),
                  $selectionSearch = that.$selectionUl.prev(),
                  selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                  selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

              that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
              .on('keydown', function(e){
                if (e.which === 40){
                  that.$selectableUl.focus();
                  return false;
                }
              });

              that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
              .on('keydown', function(e){
                if (e.which == 40){
                  that.$selectionUl.focus();
                  return false;
                }
              });
            },
            afterSelect: function(){
              this.qs1.cache();
              this.qs2.cache();
            },
            afterDeselect: function(){
              this.qs1.cache();
              this.qs2.cache();
            }
          });
});
</script>