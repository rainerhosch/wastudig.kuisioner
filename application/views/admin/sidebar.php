<aside class="main-sidebar" style="color: #FFDAB9">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="height: auto;">
    <!-- Sidebar user panel -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="<?php echo base_url() . "Kuisioner/dashboard" ?>">
          <i class="fa fa-bank"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview menu">
        <a href="#">
          <i class="fa fa-archive"></i> <span>Kuesioner</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url() . "Catatan" ?>"><i class="fa fa-book"></i> Catatan kuesioner</a></li>
          <li><a href="<?php echo base_url() . "Question" ?>"><i class="fa fa-book"></i> Pertanyaan kuesioner</a></li>
          <li><a href="<?php echo base_url() . "Pilihan" ?>"><i class="fa fa-book"></i> Pilihan Skala</a></li>
        </ul>
      </li>

      <li>
        <a href="<?php echo base_url() . "Kompetensi" ?>">
          <i class="fa fa-bookmark"></i> <span>Data Kompetensi</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url() . "Kriteria" ?>">
          <i class="fa fa-gears"></i> <span>Kriteria Nilai</span>
        </a>
      </li>
      <li>
        <a href="<?php echo base_url('Kuisioner/logout'); ?>">
          <i class="fa fa-power-off"></i> <span>Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>