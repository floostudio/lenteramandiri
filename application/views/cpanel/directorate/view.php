<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              Directorate Management
              <small></small>
            </h1>
            <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>/directorate"><i class="fa fa-dashboard"></i> Directorate</a></li>
      </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                        <a href="<?php echo site_url();?>/master/directorate/create"><button class="btn btn-primary" >Add directorate</button></a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php 
                        if(null !== $this->session->flashdata('error')) {
                            $message = $this->session->flashdata('error');
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
                        <table id="dataTable1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tampilkan?</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                        <tbody>
                            <?php
                                $no =1;
                                foreach($directorate->result() as $row) {
                                    if($row->IS_SHOW) {$stats = "YA"; $bgColor = 'bg-green';} 
                                    else {$stats = "TIDAK"; $bgColor = 'bg-red';}
                                    echo "<tr>";
                                    echo "<td>".$no."</td>";
                                    echo "<td>".$row->M_DIRECTORATE_NAME."</td>";
                                    echo "<td align='center'><a href='".base_url()."/master/directorate/toggleactive/{$row->M_DIRECTORATE_ID}/{$row->IS_SHOW}'><div class='btn btn-view ".$bgColor." no-shadow' style='cursor:pointer;'>".$stats."</div></a></td>";
                                    echo "<td align='center'>"
                                . "<a href='". site_url()."/master/directorate/edit/".$row->M_DIRECTORATE_ID." ' style='color:black;cursor:pointer;'>"
                                    . "<span class='glyphicon glyphicon-pencil bg_black'></span></a></td>";
                                    echo "</tr>";

                                    $no++;
                                }
                            ?>

                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tampilkan?</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
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
                <form id="form_input" name="form_input" method="post" action="<?php echo site_url() ?>/article/delete">
                    <div class="modal-footer">
                        <input type="hidden" name="idsel" value="" />
                        <input type="hidden" name="curtag" value="" />
                        <button type="button" class="btn btn-white" data-dismiss="modal">TIDAK</button>
                        <button type="submit" class="btn btn-warning">YA</button>
                    </div>
                </form>
            </div>	
        </div>
    </div>
    <!-- end of modal ------------------------------>
    <script type="text/javascript">
      $(function () {
        $("#dataTable1").dataTable();
        $('#modal-1').on('show.bs.modal', function (event) {
                 var button = $(event.relatedTarget); // Button that triggered the modal
                 var recipient = button.data('tenantid'); // Extract info from data-* attributes
                 var modal = $(this);
                 modal.find('.modal-footer input').val(recipient);
               })
      });
    </script>