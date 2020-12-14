<?php $this->load->view('admin/head'); ?>
<div class="wrapper" style="height: auto; min-height: 100%;">
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pertanyaan
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()."Login/dashboard";?>"><i class="fa fa-bank"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-archive"></i> Kuesioner</a></li>
        <li class="active"><i class="fa fa-plus"></i>Pertanyaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
        <!-- Box -->
        <div class="box box-warning">
            <!-- box header -->
            <div class="box-header with-border">
                <div class="col-md-6">
                    <h2 style="margin-top:0px">Tambah Pertanyaan</h2>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- box body -->
            <div class="box-body table-responsive">
            <form method="post" id="form_pertanyaan" class="form-horizontal" action="<?php echo base_url().'Question/input_action';?>">
                
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-sm-2" style="margin-top: 5px">Kompetensi</label>
                    <div class="col-sm-10">
                    <select name="kompetensi" class="form-control" placeholder="kompetensi" required>
                        <option value="">--Pilih kompetensi--</option> 
                        <?php
                            foreach ($kompetensi as $k) {
                            echo"<option value='$k->id_kompetensi'>$k->kompetensi</option>";
                            }
                        ?>
                    </select>
                    <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-sm-2">Tahun Akademik</label>
                    <div class="col-sm-10">
                    <select name="tahun" class="form-control" placeholder="tahun" required>
                        <option value="">--Pilih tahun--</option> 
                        <?php
                            foreach ($tahun as $t) {
                            echo"<option value='$t->Tahun_ID'>$t->Tahun_ID</option>";
                            }
                        ?>
                    </select>
                    <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="border-top: 2px solid green;" >
                <div class="form-group" style="margin-top: 10px;">
                    <label class="control-label col-xs-4" style="margin-top: 20px;" >Pertanyaan 1 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan1" id="pertanyaan1" class="form-control" maxlength="200" required="true" rows="3" style="overflow-scroll=true"></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px;">Pertanyaan 2 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan2" id="pertanyaan2" class="form-control" maxlength="200" rows="3"></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px">Pertanyaan 3 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan3" id="pertanyaan3" class="form-control" maxlength="200" rows="3" ></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px">Pertanyaan 4 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan4" id="pertanyaan4" class="form-control" maxlength="200" rows="3" ></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px">Pertanyaan 5 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan5" id="pertanyaan5" class="form-control" maxlength="200" rows="3" ></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <!--col-md-6-->
            </div>
            <div class="col-md-6" style="border-top: 2px solid green;" >
                <div class="form-group" style="margin-top: 10px;">
                    <label class="control-label col-xs-4" style="margin-top: 20px;" >Pertanyaan 6 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan6" id="pertanyaan6" class="form-control" maxlength="200" rows="3"></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px;">Pertanyaan 7 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan7" id="pertanyaan7" class="form-control" maxlength="200" rows="3"></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px">Pertanyaan 8 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan8" id="pertanyaan8" class="form-control" maxlength="200" rows="3" ></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px">Pertanyaan 9 </label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan9" id="pertanyaan9" class="form-control" maxlength="200" rows="3" ></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4" style="margin-top: 20px">Pertanyaan 10</label>
                    <div class="col-md-8">
                    <textarea name="pertanyaan10" id="pertanyaan10" class="form-control" maxlength="200" rows="3" ></textarea>
                    <span class="help-block"></span>
                    </div>
                </div>
                <!-- /col-md-6 -->
                </div>  
            </div>
                <div class="box-footer">
                <div class="pull-right">
                    <input type="hidden" name="id_kompetensi" id="id_kompetensi"/>
                    <button type="submit" name="submit" class="btn btn-success" id="simpan" >Simpan</button>
                    <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
                </div>
                <!-- /box-footer -->
                </div>
                <!-- /form -->
                </form>
        <!-- /box -->
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
<!-- <script type="text/javascript">
$(document).ready(function() {
  $('#simpan').on('click', function (e) {
    e.preventDefault();

    $.ajax({
      type: $('form').attr("method"),
      url: $('form').attr("action"),
      data: $('form').serialize(),
      success: function (i) {
        if(i == 'true'){
            new PNotify({
                      title: 'Success',
                      text: 'Login Berhasil, Tunggu Sebentar',
                      type: 'success',
                      hide: true,
                      styling: 'bootstrap3'
                  });
            window.location.replace("<?=base_url('Login/dashboard')?>");
        }else{
            new PNotify({
                      title: 'Gagal',
                      text: 'Login Gagal, Username Password Tidak Sesuai!',
                      type: 'warning',
                      hide: true,
                      styling: 'bootstrap3'
                  });
        }
      }    
    });

  });
});
  </script> -->
</body>
</html>