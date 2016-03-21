<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php if($this->user_logo) {
                        echo base_url().$this->user_logo; 
                    } else {
                        echo base_url()."static/images/users/default.jpg";
                    } ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $this->name; ?></p>
              <!-- Status -->
              <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
          </div>

          <!-- search form (Optional) 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            
            <li class="treeview">
                <a href="<?php echo site_url(); ?>/dashboard">
                    <i class="fa fa-bar-chart"></i><span>Dashboard</span>
                </a>
                <a href="<?php echo site_url(); ?>/task">
                    <i class="fa fa-tasks"></i><span>Task</span>
                </a>
                <a href="<?php echo site_url(); ?>/news">
                    <i class="fa fa-newspaper-o"></i><span>News</span>
                </a>
                <a href="<?php echo site_url(); ?>/portfolio">
                    <i class="fa fa-folder-open"></i><span>Portofolio</span>
                </a>
                <a href="<?php echo site_url(); ?>/users">
                    <i class="fa fa-users"></i><span>Users</span>
                </a>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i><span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo site_url(); ?>/master/company">Master Company</a></li>
                        <li><a href="<?php echo site_url(); ?>/master/directorate">Master Directorate</a></li>
                        <li><a href="<?php echo site_url(); ?>/master/group">Master Group</a></li>
                        <li><a href="<?php echo site_url(); ?>/master/department">Master Department</a></li>
                        <li><a href="<?php echo site_url(); ?>/master/title">Master Title</a></li>
                    </ul>
                </li>
            </li>
            
            
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      