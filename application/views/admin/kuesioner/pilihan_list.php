<?php $this->load->view('admin/head'); ?>
<div class="wrapper" style="height: auto; min-height: 100%;">
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pilihan Skala
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()."Login/dashboard";?>"><i class="fa fa-bank"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-archive"></i> Kuesioner</a></li>
        <li class="active"><i class="fa fa-check-circle"></i> Pilihan Skala</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
        <!-- Box -->
        <div class="box">
            <!-- box header -->
            <div class="box-header">
                <div class="col-md-6">
                    <h2 style="margin-top:0px">Pilihan Skala List</h2>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" data-toggle="modal" data-target="#pilihan_modal" class="btn btn-info btn-lg"><i class="fa fa-plus"></i>Tambah Pilihan Skala</button>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- box body -->
            <div class="box-body table-responsive">
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-6 text-center">
                    <div style="margin-top: 4px"  id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped" id="pilihan_table">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center">No</th>
                        <th >Tahun</th>
                        <th >Pilihan Skala</th>
                        <th width="15%" style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!-- /box body -->
            </div>
        <!-- /box -->
        </div>
        <!-- /col-xs-12 -->
        </div>
        <!-- /row -->
        </div>
    <!-- /Main content -->
    </section>
</div>

<!-- Modals Form -->

<div id="pilihan_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="form_pilihan" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Pilihan Skala</h4>
                </div>
                <div class="modal-body">
                <input hidden type="text" name="action" id="action" value="Simpan" />
                        <div class="form-group">
                            <label class="control-label col-xs-3">Tahun Akademik</label>
                            <div class="col-xs-8">
                                <select name="tahun" id="tahun" class="form-control" required="true">
                                    <option value="">--Pilih Tahun--</option>
                                    <?php
                                    foreach($tahun as $t){
                                      echo"<option value='$t->Tahun_ID'>$t->Tahun_ID</option>";
                                    }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped" style="margin-top: 25px;  width: 150%">
                            <thead>
                                <tr>
                                    <th colspan="10" style="text-align: center;"> Tentukan Pilihan Skala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pilihan 1: <input type="number" name="p1" id="p1" class="form-control" required="true" min="0" title="Silahkan masukkan inputan angka" /></td>
                                    <td>Pilihan 6: <input type="number" name="p6" id="p6" class="form-control" min="0" title="Silahkan masukkan inputan angka" /></td>
                                </tr>
                                <tr>
                                    <td>Pilihan 2: <input type="number" name="p2" id="p2" class="form-control" required="true" min="0" title="Silahkan masukkan inputan angka" /></td>
                                    <td>Pilihan 7: <input type="number" name="p7" id="p7" class="form-control" min="0" title="Silahkan masukkan inputan angka" /></td>
                                </tr>
                                <tr>
                                    <td>Pilihan 3: <input type="number" name="p3" id="p3" class="form-control" required="true" min="0" title="Silahkan masukkan inputan angka" /></td>
                                    <td>Pilihan 8: <input type="number" name="p8" id="p8" class="form-control" min="0" title="Silahkan masukkan inputan angka" /></td>
                                </tr>
                                <tr>
                                    <td>Pilihan 4: <input type="number" name="p4" id="p4" class="form-control" min="0" title="Silahkan masukkan inputan angka" /></td>
                                    <td>Pilihan 9: <input type="number" name="p9" id="p9" class="form-control" min="0" title="Silahkan masukkan inputan angka" /></td>
                                </tr>
                                <tr>
                                    <td>Pilihan 5: <input type="number" name="p5" id="p5" class="form-control" min="0" title="Silahkan masukkan inputan angka" /></td>
                                    <td>Pilihan 10: <input type="number" name="p10" id="p10" class="form-control" min="0" title="Silahkan masukkan inputan angka" /></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class="col-md-12 pull-right">
                            <small>*Pilihan skala minimal 3</small>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_pilih" id="id_pilih"/>
                    <input type="submit" name="action" id="action" value="Simpan" class="btn btn-success"/>
                    <button type="button" name="close" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /Modals Form -->

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
       var table=$('#pilihan_table').DataTable({ //var 'table' mendefinisikan tabel 'catatan_tabel' sbg datatable
        "processing": true,     // menginisialiasi processing sabagai true
        "serverSide": true,     // menginisialisasi pemrosesan dalam servermode sabagai true
        "order":[],
        "ajax":{
            url   :"<?php echo base_url().'Pilihan/fetch_pilihan'; ?>",  // memanggil function untuk menampilkan data-data ke dalam datatable
            type :"POST"
        },
        "columnDefs":[      // kolom definisi
            {
                "targets":[0,2,3], //menargetkan kolom ke 0 dan 2 di datatable
                "orderable": false, //membuat kolom dengan targer diatas dengan orderable bernilai false
            },
            {
                className: "text-center", 
                "targets": [1,2,3]
            },
            {
                "width": "20%",
                "targets": [1]
            },
            {
                "width": "40%",
                "targets": [2]
            },
            {
                "width": "30%",
                "targets": [3]
            }
        ]
       });

//tambah data
$(document).on('submit','#form_pilihan', function(event){
    event.preventDefault();
    var tahun = $('#tahun').val(); //menempatkan value option 'tahun' pada modal ke variable tahun
    var p1=$('#p1').val();
    var p2=$('#p2').val();
    var p3=$('#p3').val();
    var p4=$('#p4').val();
    var p5=$('#p5').val();
    var p6=$('#p6').val();
    var p7=$('#p7').val();
    var p8=$('#p8').val();
    var p9=$('#p9').val();
    var p10=$('#p10').val();
        $.ajax({
            url: "<?php echo base_url(). 'Pilihan/input_action'?>", //memanggil function insert di controller catatan
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(data)  // function success
            {
                alert(data);
                $('.modal-title').text("Tambah Pilihan Skala");   //mengubah judul modals
                $('#form_pilihan')[0].reset();      // mereset kembali form
                $('#pilihan_modal').modal('hide'); //menyembunyika modal
                table.ajax.reload(); //reload datatable
            } 
        });
    });

//update data
$(document).on('click','.update',function(){
    var id_pilih = $(this).attr("id");
    $.ajax({
       url:"<?php echo base_url(). 'Pilihan/fetch_single_data'?>",  //memanggil function update di controller catatan
       method:"POST",
       data:{id_pilih:id_pilih},
       dataType:"json",
       success:function(data)
       {
            $('#pilihan_modal').modal('show');
            $('#tahun').val(data.id_tahun);
            $('#p1').val(data.p1);
            $('#p2').val(data.p2);
            $('#p3').val(data.p3);
            $('#p4').val(data.p4);
            $('#p5').val(data.p5);
            $('#p6').val(data.p6);
            $('#p7').val(data.p7);
            $('#p8').val(data.p8);
            $('#p9').val(data.p9);
            $('#p10').val(data.p10);
            $('.modal-title').text("Edit Pilihan Skala");   //mengubah judul modals
            $('#id_pilih').val(id_pilih);
            $('#action').val("Edit");   //mendefinisikan variable action bernilai 'Edit'
       }
    })
});

//duplikat data data
$(document).on('click','.duplikat',function(){
    var id_pilih = $(this).attr("id");
    $.ajax({
       url:"<?php echo base_url(). 'Pilihan/fetch_single_data'?>",  //memanggil function update di controller catatan
       method:"POST",
       data:{id_pilih:id_pilih},
       dataType:"json",
       success:function(data)
       {
            $('#pilihan_modal').modal('show');
            $('#tahun').val(data.id_tahun);
            $('#p1').val(data.p1);
            $('#p2').val(data.p2);
            $('#p3').val(data.p3);
            $('#p4').val(data.p4);
            $('#p5').val(data.p5);
            $('#p6').val(data.p6);
            $('#p7').val(data.p7);
            $('#p8').val(data.p8);
            $('#p9').val(data.p9);
            $('#p10').val(data.p10);
            $('.modal-title').text("Duplikat Pilihan Skala");   //mengubah judul modals
            $('#id_pilih').val(id_pilih);
            $('#action').val("Simpan");   //mendefinisikan variable action bernilai 'Edit'
       }
    })
});


//hapus data
$(document).on('click','.delete',function(){
     var id_pilih = $(this).attr("id");
     if(confirm("Anda yakin akan menghapus data ini?"))
     {
        $.ajax({
            url:"<?php echo base_url(). 'Pilihan/delete_single_data'?>",
            method:"POST",
            data:{id_pilih:id_pilih},
            success:function(data)
            {
                alert(data);
                table.ajax.reload();
            }
        });
     }
     else
     {
        return false;
     }
});

//close
$('#pilihan_modal').on('hidden.bs.modal',function(){
    $('.modal-title').text("Tambah Pilihan Skala");   //mengubah judul modals
    $('#form_pilihan')[0].reset();      // mereset kembali form
    $('#pilihan_modal').modal('hide'); //menyembunyika modal
});

});
</script>
</body>
</html>