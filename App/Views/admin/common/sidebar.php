

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="<?php echo assets('admin/dist/img/AdminLTELogo.png')?> " alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo assets('admin/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $userInfo->first_name . ' ' . $userInfo->last_name; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a id="admin-link" href="<?php echo url('/admin');?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul> -->
          </li>


          <li class="nav-item">
            <a id="users-link" href="<?php echo url('/admin/users');?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a id="users-groups-link" href="<?php echo url('/admin/users-groups');?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users Groups
              </p>
            </a>
          </li>
 

          <li class="nav-item">
            <a id="categories-link" href="<?php echo url('/admin/categories');?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a id="posts-link" href="<?php echo url('/admin/posts');?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Posts
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a id="ads-link" href="<?php echo url('/admin/ads');?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Ads
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a id="settings-link" href="<?php echo url('/admin/settings');?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Settings
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="<?php url('/logout'); ?>" class="nav-link">
              <i class="fa fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
     
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">