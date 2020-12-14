<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Penilaian Kinerja Dosen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()."Login/dashboard";?>"><i class="fa fa-bank"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $jumlah_kompetensi ?></h3>

              <p>Kompetensi</p>
            </div>
            <div class="icon">
              <i class="ion ion-bookmark"></i>
            </div>
            <a href="<?php echo base_url()."Kompetensi"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $jumlah_pertanyaan ?></h3>

              <p>Pertanyaan kuesioner</p>
            </div>
            <div class="icon">
              <i class="ion ion-filing"></i>
            </div>
            <a href="<?php echo base_url()."Question"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
         <div class="col-xs-12">
           <div class="small-box" style="background-color: #FF7F50">
            <div class="inner">
              <h1>Selamat Datang!</h1>
              <p><?php echo $dsbr_adm['catatan']?></p>
            </div>
          </div>
         </div>
      </div>
    </section>
    <!-- /.content -->
  </div>