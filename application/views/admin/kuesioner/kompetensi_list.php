<?php $this->load->view('admin/head'); ?>
<div class="wrapper" style="height: auto; min-height: 100%;">
<?php $this->load->view('admin/header'); ?>
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kompetensi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()."Login/dashboard";?>"><i class="fa fa-bank"></i> Home</a></li>
        <li class="active"><i class="fa fa-bookmark"></i>Data Kompetensi</li>
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
                    <h2 style="margin-top:0px">Kompetensi List</h2>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" data-toggle="modal" data-target="#kompetensi_modal" class="btn btn-info btn-lg"><i class="fa fa-plus"></i>Tambah Kompetensi</button>
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
            <table class="table table-bordered table-striped" id="kompetensi_table">
                <thead>
                    <tr>
                        <th width="5%" style="text-align: center">No</th>
                        <th width="60%">Kompetensi</th>
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

<div id="kompetensi_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="form_kompetensi" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Kompetensi</h4>
                </div>
                <div class="modal-body">
                <input hidden type="text" name="action" id="action" value="Simpan" />
                        <div class="form-group">
                            <label class="control-label col-xs-3">Kompetensi</label>
                            <div class="col-xs-8">
                            <input type="text" class="form-control" name="kompetensi" id="kompetensi" placeholder="Kompetensi" required="true" maxlength="50" />
                            <span class="help-block"></span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kompetensi" id="id_kompetensi"/>
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
       var table=$('#kompetensi_table').DataTable({ //var 'table' mendefinisikan tabel 'catatan_tabel' sbg datatable
        "processing": true,     // menginisialiasi processing sabagai true
        "serverSide": true,     // menginisialisasi pemrosesan dalam servermode sabagai true
        "order":[],
        "ajax":{
            url   :"<?php echo base_url().'Kompetensi/fetch_kompetensi'; ?>",  // memanggil function untuk menampilkan data-data ke dalam datatable
            type :"POST"
        },
        "columnDefs":[      // kolom definisi
            {
                "targets":[0,2], //menargetkan kolom ke 0 dan 2 di datatable
                "orderable": false, //membuat kolom dengan targer diatas dengan orderable bernilai false
            },
            {
                className: "text-center", 
                "targets": [2]
            }
        ]
       });

//tambah data
$(document).on('submit','#form_kompetensi', function(event){
    event.preventDefault();
    var kompetensi = $('#kompetensi').val(); //menempatkan vaue textbox 'catatan' pada modal ke variable catatan
    if (kompetensi != '')  // kondisi apabila var 'catatan' tidak sama dengan null
    {
        $.ajax({
            url: "<?php echo base_url(). 'Kompetensi/input_action'?>", //memanggil function insert di controller catatan
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(data)  // function success
            {
                alert(data);
                $('.modal-title').text("Tambah Kompetensi");   //mengubah judul modals
                $('#form_kompetensi')[0].reset();      // mereset kembali form
                $('#kompetensi_modal').modal('hide'); //menyembunyika modal
                table.ajax.reload(); //reload datatable
            } 
        });
    }
    });

//update data
$(document).on('click','.update',function(){
    var id_kompetensi = $(this).attr("id");
    $.ajax({
       url:"<?php echo base_url(). 'Kompetensi/fetch_single_data'?>",  //memanggil function update di controller catatan
       method:"POST",
       data:{id_kompetensi:id_kompetensi},
       dataType:"json",
       success:function(data)
       {
            $('#kompetensi_modal').modal('show');
            $('#kompetensi').val(data.kompetensi);
            $('.modal-title').text("Edit Kompetensi");   //mengubah judul modals
            $('#id_kompetensi').val(id_kompetensi);
            $('#action').val("Edit");   //mendefinisikan variable action bernilai 'Edit'
       }
    })
});


//hapus data
$(document).on('click','.delete',function(){
     var id_kompetensi = $(this).attr("id");
     if(confirm("Anda yakin akan menghapus data ini?"))
     {
        $.ajax({
            url:"<?php echo base_url(). 'Kompetensi/delete_single_data'?>",
            method:"POST",
            data:{id_kompetensi:id_kompetensi},
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
$('#kompetensi_modal').on('hidden.bs.modal',function(){
    $('.modal-title').text("Tambah Kompetensi");   //mengubah judul modals
    $('#form_kompetensi')[0].reset();      // mereset kembali form
    $('#kompetensi_modal').modal('hide'); //menyembunyika modal
});

});
</script>
</body>
</html>