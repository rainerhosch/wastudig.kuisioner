<?php $this->load->view('admin/head'); ?>
<div class="wrapper" style="height: auto; min-height: 100%;">
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kriteria Nilai
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()."Login/dashboard";?>"><i class="fa fa-bank"></i> Home</a></li>
        <li class="active"><i class="fa fa-plus"></i> Kriteria Nilai</li>
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
                    <h2 style="margin-top:0px">Tambah Kriteria</h2>
                </div>
                <?php
                    echo form_open('Kriteria/input_action');
                ?>
            </div>
            <!-- /.box-header -->
            <!-- box body -->
            <div class="box-body">
            <form method="post" id="form_kriteria" class="form-horizontal">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label col-sm-1">Tahun</label>
                    <div class="col-sm-4">
                    <select name="tahun" class="form-control" placeholder="tahun" required title="Silahkan pilih tahun akademik">
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
                <div class="col-xs-12" style="border-top: 2px solid green;">
                <div class="form-group" style="margin-top: 10px;">
                    <label class="control-label col-xs-4" style="color: #FF7F50">Kriteria 1 :</label>
                    <div class="col-xs-12" >
                        <table>
                            <tr>
                                <td width="13%"><label>Dari Rata-Rata :</label></td>
                                <td ><input type="number" step="0.01" name="nilai_dari1" id="nilai_dari1" class="form-control" required title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="17%"><label style="margin-left: 15px">Sampai Rata-rata :</label></td>
                                <td><input type="number" step="0.01" name="nilai_sampai1" id="nilai_sampai1" class="form-control" required title="Maksimal dua angka dibelakang koma" /></td>
                                <td width="10%"><label style="margin-left: 15px">Kategori :</label></td>
                                <td><input type="text" name="kategori1" id="kategori1" class="form-control" required/></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label class="control-label col-xs-4" style="margin-top: 20px; color: #FF7F50" >Kriteria 2 :</label>
                    <div class="col-xs-12" >
                        <table>
                            <tr>
                                <td width="13%"><label>Dari Rata-Rata :</label></td>
                                <td ><input type="number" step="0.01" name="nilai_dari2" id="nilai_dari2" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="17%"><label style="margin-left: 15px">Sampai Rata-rata :</label></td>
                                <td><input type="number" step="0.01" name="nilai_sampai2" id="nilai_sampai2" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="10%"><label style="margin-left: 15px">Kategori :</label></td>
                                <td><input type="text" name="kategori2" id="kategori2" class="form-control"/></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label class="control-label col-xs-4" style="margin-top: 20px; color: #FF7F50" >Kriteria 3 :</label>
                    <div class="col-xs-12" >
                        <table>
                            <tr>
                                <td width="13%"><label>Dari Rata-Rata :</label></td>
                                <td ><input type="number" step="0.01" name="nilai_dari3" id="nilai_dari3" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="17%"><label style="margin-left: 15px">Sampai Rata-rata :</label></td>
                                <td><input type="number" step="0.01" name="nilai_sampai3" id="nilai_sampai3" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="10%"><label style="margin-left: 15px">Kategori :</label></td>
                                <td><input type="text" name="kategori3" id="kategori3" class="form-control"/></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label class="control-label col-xs-4" style="margin-top: 20px; color: #FF7F50" >Kriteria 4 :</label>
                    <div class="col-xs-12" >
                        <table>
                            <tr>
                                <td width="13%"><label>Dari Rata-Rata :</label></td>
                                <td ><input type="number" step="0.01" name="nilai_dari4" id="nilai_dari4" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="17%"><label style="margin-left: 15px">Sampai Rata-rata :</label></td>
                                <td><input type="number" step="0.01" name="nilai_sampai4" id="nilai_sampai4" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="10%"><label style="margin-left: 15px">Kategori :</label></td>
                                <td><input type="text" name="kategori4" id="kategori4" class="form-control"/></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label class="control-label col-xs-4" style="margin-top: 20px; color: #FF7F50" >Kriteria 5 :</label>
                    <div class="col-xs-12" >
                        <table>
                            <tr>
                                <td width="13%"><label>Dari Rata-Rata :</label></td>
                                <td ><input type="number" step="0.01" name="nilai_dari5" id="nilai_dari5" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="17%"><label style="margin-left: 15px">Sampai Rata-rata :</label></td>
                                <td><input type="number" step="0.01" name="nilai_sampai5" id="nilai_sampai5" class="form-control" title="Maksimal dua angka dibelakang koma"/></td>
                                <td width="10%"><label style="margin-left: 15px">Kategori :</label></td>
                                <td><input type="text" name="kategori5" id="kategori5" class="form-control"/></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /col-xs-12 -->
                </div>
            </div>
            </div>
                <div class="box-footer">
                <div class="pull-right">
                    <input type="hidden" name="id_kompetensi" id="id_kompetensi"/>
                    <button type="submit" name="submit" class="btn btn-success" >Simpan</button>
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

</body>
</html>