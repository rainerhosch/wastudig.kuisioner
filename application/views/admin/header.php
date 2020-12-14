<header class="main-header">
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <span style="color: rgba(255,255,255,0.9); display: inline-block; margin-right: 10px; text-decoration: none; font-size: 30px;"><b>Penilaian Kinerja </b>Dosen</span>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a class="dropdown-toggle disabled" data-toggle="dropdown">
            <img src="<?php echo base_url() . "assets/backend/dist/img/stt.png" ?>" class="user-image" alt="User Image">
            <span class="hidden-xs">Hello! <?php echo $this->session->userdata("nama"); ?></span>
          </a>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="<?php echo base_url('Kuisioner/logout'); ?>">Logout <i class="fa fa-power-off"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>