<div id="wrapper" class="container well">
  <header class="">
    <section id="brand" class="row">
      <div class="col-md-6">
        <h1>Sistem Penilaian Kinerja Dosen <br><small>STT Wastukancana Purwakarta</small></h1>
      </div>
    </section>

    <nav class="navbar navbar-inverse">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class=""><a href="<?php echo base_url() . "Dashboard_user" ?>">Home</a></li>
          <li><a href="<?php echo base_url() . "Download" ?>">Download Penilaian Kinerja Dosen</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

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
      <!--/.navbar-collapse -->
    </nav>
  </header>