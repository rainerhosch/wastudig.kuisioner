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
          <li class=""><a href="<?php echo base_url() . "Dashboard_user/dashboard_mhs" ?>">Home</a></li>
          <li><a href="<?php echo base_url() . "Penilaian" ?>">Penilaian Kinerja Dosen</a></li>
          <li><a href="<?php echo base_url() . "Penilaian/after_penilaian" ?>">Daftar Dosen Yang Telah Dinilai</a></li>
          <?php
          $nim = $this->session->userdata('nim');
          $this->db->select_max('idtahun');
          $this->db->where('nim', $nim);
          $max = $this->db->get('k__krs_new');
          $status_krs = $this->db->query("SELECT * FROM k__krs_new WHERE nim='" . $nim . "' AND idtahun='" . $max->row()->idtahun . "'")->num_rows();
          $status_kues = $this->db->query("SELECT * FROM k__status_kuesioner WHERE nim='" . $nim . "' AND id_tahun='" . $max->row()->idtahun . "'")->num_rows();
          if ($status_krs == $status_kues) {
            echo "<li>"; ?>
            <a href='<?php echo base_url() . "Perwalian" ?>'>Perwalian</a>
          <?php echo "</li>";
          } else {
            echo "<li style='display: none;'><a>Perwalian</a></li>";
          }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          //$rows = $this->db->query("SELECT * FROM mahasiswa_pt where nipd='".$this->session->userdata('nim')."'")->row_array();
          $rows = $this->db->query("SELECT mahasiswa.nm_pd, mahasiswa_pt.nipd FROM mahasiswa INNER JOIN mahasiswa_pt ON mahasiswa.id_pd = mahasiswa_pt.id_reg_pd where nipd='" . $this->session->userdata('nim') . "'")->row_array();

          ?>
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle disabled" data-toggle="dropdown">
              <img src="<?php echo base_url() . "assets/backend/dist/img/stt.png" ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Hello! <?php echo $rows['nm_pd']; ?></span>
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