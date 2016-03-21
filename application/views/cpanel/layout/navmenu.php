<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $tenant_name; ?>
            <small>Tenant</small>
          </h1>
            <!-- BREADCRUMB
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>
            
            /.BREADCRUMB -->
        </section>
        <!-- Main content -->
        <section class="content">    
        <!-- =========================================================== -->

          <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-3">
              <!-- small box -->
                <a href="<?php echo site_url(); ?>/tenant/<?php echo $tenant_page; ?>" class="small-box-footer">
                    <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3>Chart</h3>
                        <p>&nbsp;</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-arrow-graph-up-right"></i>
                      </div>
                    </div>
                </a>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-3">
              <!-- small box -->
                <a href="<?php echo site_url(); ?>/tenant/<?php echo $tenant_page; ?>/upload" class="small-box-footer">
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h3>Upload</h3>
                        <p>&nbsp;</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                      </div>
                    </div>
                </a>
            </div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-3">
                <!-- small box -->
                <a href="<?php echo site_url(); ?>/tenant/<?php echo $tenant_page; ?>/report" class="small-box-footer">
                    <div class="small-box bg-red">
                      <div class="inner">
                        <h3>Report</h3>
                        <p>&nbsp;</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                    </div>
                </a>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-3">
              <!-- small box -->              
                <a href="<?php echo site_url(); ?>/tenant/<?php echo $tenant_page; ?>/export" class="small-box-footer">
                    <div class="small-box bg-green">
                      <div class="inner">
                        <h3>Export</h3>
                        <p>&nbsp;</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-code-download"></i>
                      </div>
                    </div>
                </a>
            </div><!-- ./col -->
        </div><!-- /.row -->
        
          <!-- =========================================================== -->
