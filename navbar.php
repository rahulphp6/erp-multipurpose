<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo BASE; ?>" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Alamin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php if (!empty($_SESSION['profile'])) {
                    echo $_SESSION['profile'];
                  } else {
                    echo "dist/img/user2-160x160.jpg";
                  } ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="?page=profile" class="d-block"><?php echo ucfirst($_SESSION['name']); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- User Nav -->
        <?php
        if (isUser()) { ?>
          <li class="nav-item has-treeview menu-open ">
            <a href="<?php echo BASE; ?>" class="nav-link">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Projects
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="<?php echo BASE; ?>?page=project" class="nav-link">
                  <i class="nav-icon fa fa-circle"></i>
                  <p>
                    See All
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="<?php echo BASE; ?>?page=project-add" class="nav-link">
                  <i class="nav-icon fa fa-circle"></i>
                  <p>
                    Add New
                  </p>
                </a>
              </li>
            </ul>
          </li>

        <?php } ?>
        <!-- Admin Nav -->
        <?php
        if (isAdmin() or isSuper()) { ?>
          <li class="nav-item has-treeview">
            <a href="<?php echo BASE; ?>admin.php" class="nav-link">
              <i class="nav-icon fa fa-tachometer"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                User Management
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin.php?page=users" class="nav-link">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin.php?page=users-detail" class="nav-link">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>See Users</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="?page=role-management" class="nav-link">
                  <i class="nav-icon fa fa-lock"></i>
                  <p>
                    Roles
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Setting
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="?page=configuration" class="nav-link">
                  <i class="nav-icon fa fa-circle"></i>
                  <p>
                    General Setting
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="<?php echo BASE; ?>admin.php?page=mail" class="nav-link">
                  <i class="nav-icon fa fa-circle"></i>
                  <p>
                    Mail Setting
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="?page=note" class="nav-link">
              <i class="nav-icon fa fa-bell"></i>
              <p>
                Note
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if (isSuper()) { ?>
          <li class="nav-item">
            <a href="admin.php?page=options" class="nav-link">
              <i class="fa fa-circle nav-icon"></i>
              <p>Modules</p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="fa fa-power-off nav-icon"></i>
            <p>Log out</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>