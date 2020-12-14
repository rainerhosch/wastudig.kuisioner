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
        <li><a href="#"><i class="fa fa-archive"></i> Kuesioner</a></li>
        <li class="active"><i class="fa fa-book"></i>Pertanyaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
        <!-- Box -->
        <div class="box">
            <!-- box header -->
            <div class="box-header with-border">
                <div class="col-md-6">
                    <h2 style="margin-top:0px">Duplikat Pertanyaan By Tahun</h2>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- box body -->
            <div class="box-body">
            <form method="post" action="<?php echo base_url().'Question/duplicate_by_th';?>">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-6">
                    <label class="control-label col-md-2" style="margin-top: 5px">Tahun :</label>
                        <div class="col-md-6">
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">--Pilih Tahun--</option>
                                    <?php
                                foreach($tahun as $t){
                                    echo"<option value='$t->Tahun_ID'";
                                    echo $tahun_pilih==$t->Tahun_ID?'selected':'';
                                    echo">$t->Tahun_ID</option>";
                                }
                                ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                </div>
            </div>
            <table class="table table-bordered table-striped" id="duplikat_table" style="display: block; overflow-y: auto; height: 500px;">
                <thead>
                    <tr>
                        <th style="text-align: center" width="20px">No</th>
                        <th style="text-align: center" width="200px" colspan="3">Kompetensi</th>
                        <th style="text-align: center" width="800px" colspan="7">Pertanyaan</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($jum_record==0) {
                        echo "<tr>
                                <td colspan='11' style='text-align: center'>Pertanyaan tahun ".$tahun_pilih." tidak ada</td>
                              </tr>";
                    }else{
                        $no=1;
                            foreach ($record as $r) {
                                echo "<tr>
                                        <td align='center' width='20px'>$no</td>
                                        <td style='text-align: center'>
                                        <select name='kompetensi".$no."' class='form-control' placeholder='kompetensi' required>
                                            <option value=''>--Pilih kompetensi--</option>";?>
                                            <?php
                                                foreach ($kompetensi as $k) {
                                                echo"<option value='$k->id_kompetensi'";
                                                echo $r['id_kompetensi']==$k->id_kompetensi?'selected':'';
                                                echo">$k->kompetensi</option>";
                                                }
                                            ?>
                            <?php echo "</select>
                                        </td>
                                        <td colspan='7'><textarea name='pertanyaan".$no."' class='form-control' maxlength='200' rows='4' >".$r['pertanyaan']."</textarea></td>
                                    </tr>
                                    ";
                                    $no++;
                            }
                        }
                    ?>
                </tbody>
            <!-- /box body -->
            </table>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    <input type='hidden' name='no' class='form-control' value='<?php echo $no;?>'/>
                    <button type="submit" name="submit" class="btn btn-success" >Duplikat</button>
                    <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
                </div>
                <!-- /box-footer -->
            </div>
        <!-- /box -->
        </div>
        </form>
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
<script type="text/javascript">
    //hapus data
$(document).ready(function(){

    $('#duplikat_table').DataTable({
        "processing": true,
        "columnDefs":[      // kolom definisi
            {
                "targets":[4], //menargetkan kolom ke 0 dan 2 di datatable
                "orderable": false, //membuat kolom dengan targer diatas dengan orderable bernilai false
            }
        ]
    });

});
</script>
</body>
</html>