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
        <li class="active"><i class="fa fa-book"></i> Pertanyaan</li>
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
                    <h2 style="margin-top:0px">Pertanyaan List</h2>
                </div>
                <div class="col-md-6 text-right">
                    <a type="button" href="<?php echo base_url()."Question/input_action";?>" class="btn btn-info btn-lg"><i class="fa fa-plus"></i>Tambah Pertanyaan</a>
                </div>
                <div class="col-md-12 text-right">
                    <button id="duplicate" class="btn btn-success" style="margin-top: 10px" data-toggle="modal" data-target="#modal_duplicate"><i class="glyphicon glyphicon-duplicate"></i> Duplikat By Tahun</button>
                </div>
                <div class="col-md-12 text-right">
                    <button id="deleteList" class="btn btn-danger" style="display: none; margin-top: 10px" onclick="deleteList()"><i class="glyphicon glyphicon-trash"></i>Delete list</button>
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
            <table class="table table-bordered table-striped" id="pertanyaan_table" >
                <thead>
                    <tr>
                        <th ><input type="checkbox" id="check-all"></th>
                        <th style="text-align: center" width="20px">No</th>
                        <th style="text-align: center" width="100px">Kompetensi</th>
                        <th style="text-align: center" width="300px">Pertanyaan</th>
                        <th style="text-align: center" width="50px">Tahun Akademik</th>
                        <th style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            <!-- /box body -->
            </table>
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

    <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form student</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <input type="hidden" name="id_pertanyaan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tahun Akademik</label>
                            <div class="col-md-9">
                                <select name="tahun" class="form-control">
                                    <option value="">--pilih Tahun--</option>
                                    <?php
                                    foreach($tahun as $t){
                                      echo"<option value='$t->Tahun_ID'>$t->Tahun_ID</option>";
                                    }
                                    ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kompetensi</label>
                            <div class="col-md-9">
                                <select name="kompetensi" class="form-control" placeholder="kompetensi" required>
                                    <option value="">--Pilih kompetensi--</option> 
                                    <?php
                                        foreach ($kompetensi as $k) {
                                        echo"<option value='$k->id_kompetensi'>$k->kompetensi</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Pertanyaan</label>
                            <div class="col-md-9">
                                <input name="pertanyaan" placeholder="pertanyaan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_duplicate" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Pilih Tahun</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_duplikat" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-4">Duplikat dari data tahun</label>
                            <div class="col-md-6">
                                <select name="tahun" id="tahun" class="form-control">
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" class="btn btn-primary get_data">Proses</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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

    table=$('#pertanyaan_table').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "Question/ajax_list",
            "type": "POST"
            },

            //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ 0,1,5 ], //first column
                "orderable": false, //set not orderable
            },{
                className: "text-center", 
                "targets": [4,5]
            },{
                "width": "35%",
                "targets": [5]
            },{
                "width": "5%",
                "targets": [0]
            }
            ],
    });

    $(document).on('click','.get_data', function(){
    var tahun = $('#tahun').val(); //menempatkan vaue textbox 'catatan' pada modal ke variable catatan
    if (tahun != '')  // kondisi apabila var 'catatan' tidak sama dengan null
    {
        $('#modal_duplicate').modal('hide');
        window.location="<?php echo base_url()."Question/get_one_tahun/"?>"+tahun;
    }
    });

    //check all
    $("#check-all").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
        showBottomDelete();
    });

});

    function hapus(id) {
        if(confirm('Anda yakin akan menghapus data ini?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "question/delete_action/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //if success reload ajax table
                    reloadTable();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

    function showBottomDelete()
    {
      var total = 0;

      $('.data-check').each(function()
      {
         total+= $(this).prop('checked');
      });

      if (total > 0)
          $('#deleteList').show();
      else
          $('#deleteList').hide();
    }


    function deleteList()
    {
        var list_id = [];
        $(".data-check:checked").each(function() {
                list_id.push(this.value);
        });
        if(list_id.length > 0)
        {
            if(confirm('Are you sure delete this '+list_id.length+' data?'))
            {
                $.ajax({
                    type: "POST",
                    data: {id:list_id},
                    url: "Question/ajax_list_delete",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status)
                        {
                            reloadTable();
                        }
                        else
                        {
                            alert('Failed.');
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            }
        }
        else
        {
            alert('no data selected');
        }
    }

    function duplicate(id)
    {
        save_method = 'duplicate';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "Question/get_one/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="kompetensi"]').val(data.id_kompetensi);
                $('[name="pertanyaan"]').val(data.pertanyaan);
                $('[name="tahun"]').val(data.id_tahun);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Duplikat Pertanyaan'); // Set title to Bootstrap modal title 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error getting data from ajax');
            }
        });
    }

    function edit(id)
    {
        save_method = 'edit';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "Question/get_one/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_pertanyaan"]').val(data.id_pertanyaan);
                $('[name="kompetensi"]').val(data.id_kompetensi);
                $('[name="pertanyaan"]').val(data.pertanyaan);
                $('[name="tahun"]').val(data.id_tahun);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Pertanyaan'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error getting data from ajax');
            }
        });
    }

    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;

        if(save_method == 'duplicate') {
            url = "Question/duplicate";
        }else{
            url = "Question/update_action";
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reloadTable();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Edit/Duplikat Data');
                $('#btnSave').text('Save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
    }

    function reloadTable()
    {
        table.ajax.reload(null,false); //reload datatable ajax
        $('#deleteList').hide();
    }
</script>
</body>
</html>