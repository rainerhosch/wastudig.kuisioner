<?php $this->load->view('admin/head'); ?>
<div class="wrapper" style="height: auto; min-height: 100%;">
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Catatan Kuesioner
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()."Login/dashboard";?>"><i class="fa fa-bank"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-archive"></i> Kuesioner</a></li>
        <li class="active"><i class="fa fa-sticky-note"></i> Catatan kuesioner</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">

        <!-- <div class="box box-solid">
        <div class="box-header">
            <div class="col-md-6">
                    <h2 style="margin-top:0px">Catatan Kuesioner List</h2>
            </div>
        </div>
        </div> -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Catatan Halaman Awal</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Catatan Dashboard Admin</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Catatan Dashboard Mahasiswa</a></li>
              <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Catatan cara pengisian kuesioner</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <form method="post" action="<?php echo base_url('Catatan/update_action'); ?>">
                <!-- <div class="form-group">
                <textarea id="textarea" name="catatan1" disabled="true"  rows="5" style="width: 1040px"><?php echo $awal['catatan']?></textarea>
                <span class="help-block"></span>
                </div> -->
                <p><?php echo $awal['catatan']?></p>
                <a class="btn btn-md btn-warning" href="Catatan/update_action/<?php echo $awal['id_catatan']?>"><i class='glyphicon glyphicon-pencil'></i> Edit</a>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <form method="post" action="<?php echo base_url('Catatan/update_action'); ?>">
                <!-- <div class="form-group">
                <textarea id="textarea" name="catatan2" disabled="true" rows="5" style="width: 1040px" ><?php echo $dsbr_adm['catatan']?></textarea>
                <span class="help-block"></span>
                </div> -->
                <p><?php echo $dsbr_adm['catatan']?></p>
                <a class="btn btn-md btn-warning" href="Catatan/update_action/<?php echo $dsbr_adm['id_catatan']?>"><i class='glyphicon glyphicon-pencil'></i> Edit</a>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <form method="post" action="<?php echo base_url('Catatan/update_action'); ?>">
                <!-- <div class="form-group">
                <textarea id="textarea" name="catatan3" disabled="true" rows="5" style="width: 1040px" ><?php echo $dsbr_mhs['catatan']?></textarea>
                <span class="help-block"></span>
                </div> -->
                <p><?php echo $dsbr_mhs['catatan']?></p>
                <a class="btn btn-md btn-warning" href="Catatan/update_action/<?php echo $dsbr_mhs['id_catatan']?>"><i class='glyphicon glyphicon-pencil'></i> Edit</a>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4">
                <form method="post" action="<?php echo base_url('Catatan/update_action'); ?>">
                <!-- <div class="form-group">
                <textarea id="textarea" name="catatan4" disabled="true" rows="5" style="width: 1040px" ><?php echo $cara_isi['catatan']?></textarea>
                <span class="help-block"></span>
                </div> -->
                <p><?php echo $cara_isi['catatan']?></p>
                <a class="btn btn-md btn-warning" href="Catatan/update_action/<?php echo $cara_isi['id_catatan']?>"><i class='glyphicon glyphicon-pencil'></i> Edit</a>
                </form>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
        <!-- /col-xs-12 -->
        </div>
        <!-- /row -->
        </div>
    <!-- /Main content -->
    </section>
</div>

<?php $this->load->view('admin/footer'); ?>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/backend/bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/jquery/dist/jquery.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/backend/bower_components/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/backend/bower_components/raphael/raphael.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/morris.js/morris.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/backend/bower_components/jquery-knob/dist/jquery.knob.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/backend/bower_components/moment/min/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.js')?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/backend/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/backend/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/backend/dist/js/pages/dashboard.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/backend/dist/js/demo.js')?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/backend/bower_components/datatables.net/js/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.js') ?>"></script>

<!-- DataTable & CRUD Modals-->
<script type="text/javascript">

// membuat datatable
$(document).ready(function () {
       var table=$('#catatan_table').DataTable({ //var 'table' mendefinisikan tabel 'catatan_tabel' sbg datatable
        "processing": true,     // menginisialiasi processing sabagai true
        "columnDefs":[      // kolom definisi
            {
                "targets":[0,2], //menargetkan kolom ke 0 dan 2 di datatable
                "orderable": false, //membuat kolom dengan targer diatas dengan orderable bernilai false
            }
        ]
       });

       $('.delete').click(function(){
            var id= $(this).attr("id");
            if (confirm("Apakah anda yakin akan menghapus data ini?"))
            {
                window.location="<?php echo base_url()."Catatan/delete_action/"?>"+id;
            }
            else
            {
                return false;
            }
        });

//update active
        $('.activ').click(function(){
            var id= $(this).attr("id");
            var x= document.getElementsByName('nonactive').length;
            var y= document.getElementsByName('active').length;
            if (confirm("Apakah anda yakin akan mengaktifkan catatan ini?"))
            {
                if (x==y) {
                    window.location="<?php echo base_url()."Catatan/aktif_status/"?>"+id;
                }
            }
            else
            {
                return false;
            }
        });

        $('.nonactive').click(function(){
            var id= $(this).attr("id");
            if (confirm("Apakah anda yakin akan menonaktifkan catatan ini?"))
            {
                window.location="<?php echo base_url()."Catatan/nonaktif_status/"?>"+id;
            }
            else
            {
                return false;
            }
        });

});
</script>
</body>
</html>