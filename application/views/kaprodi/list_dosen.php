<?php $this->load->view('kaprodi/head'); ?>
<?php $this->load->view('kaprodi/header'); ?>

		<div class="container-well" style="min-height: 916px;">
			<div class="box box-solid" style="background-color: #FFE4C4;">
				<div class="box-header with-border">
					<div class="row">
						<div class="col-md-10">
			               <h3 style="margin-top:0px">Download Hasil Kuesioner</h3>
			            </div>
		            </div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
						<div class="box box-info">
						<form class="form-horizontal" method="post" action="<?php echo base_url()."Download/export_excel_by_one";?>" >
							<div class="box-header with-border">
								<h3 class="box-title">Berdasarkan Dosen</h3>
							</div>
							<div class="box-body">
								<div class="form-group" style="margin-top: 10px">
									<label class="control-label col-sm-3" style="margin-top: 5px">Dosen </label>
				                    <div class="col-sm-8">
				                    <select name="dosen1" class="form-control" required>
				                        <option value="">--Pilih Dosen--</option> 
				                        <?php
				                            foreach ($dosen as $d) {
				                            echo"<option value='".$d['nidn']."'>".$d['nm_ptk']."</option>";
				                            }
				                        ?>
				                    </select>
				                    <span class="help-block"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                    <label class="control-label col-sm-3" style="margin-top: 5px">Dari Tahun </label>
				                    <div class="col-sm-8">
				                    <select name="fromth" class="form-control" required>
				                        <option value="">--Pilih Tahun--</option> 
				                        <?php
				                            foreach ($tahun as $d) {
				                            echo"<option value='".$d['Tahun_ID']."'>".$d['Tahun_ID']."</option>";
				                            }
				                        ?>
				                    </select>
				                    <span class="help-block"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                    <label class="control-label col-sm-3" style="margin-top: 5px">Sampai Tahun </label>
				                    <div class="col-sm-8">
				                    <select name="toth" class="form-control" required>
				                        <option value="">--Pilih Tahun--</option> 
				                        <?php
				                            foreach ($tahun as $d) {
				                            echo"<option value='".$d['Tahun_ID']."'>".$d['Tahun_ID']."</option>";
				                            }
				                        ?>
				                    </select>
				                    <span class="help-block"></span>
				                    </div>
				                </div>
				                <div class="box-footer">
				                <div class="pull-right">
									
								    <button type="submit" name="submit" class="btn btn-success" >Proses</button>
								    <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
								</div>
								</div>
							</div>
						</form>
						</div>

						</div>
						<div class="col-md-6">
						<div class="box box-info" style="height: 305px">
						<form class="form-horizontal" method="post" action="<?php echo base_url()."Download/export_excel_by_one";?>">
							<div class="box-header with-border">
								<h3 class="box-title">Berdasarkan Tahun</h3>
							</div>
							<div class="box-body">
								<div class="form-group" style="margin-top: 10px">
									<label class="control-label col-sm-2" style="margin-top: 5px">Tahun </label>
				                    <div class="col-sm-8">
				                    <select name="tahun" class="form-control" required>
				                        <option value="">--Pilih Tahun--</option> 
				                        <?php
				                            foreach ($tahun as $th) {
				                            echo"<option value='".$th['Tahun_ID']."'>".$th['Tahun_ID']."</option>";
				                            }
				                        ?>
				                    </select>
				                    <span class="help-block"></span>
				                    </div>
				                </div>
				                <div class="box-footer" style="margin-top: 140px">
				                <div class="pull-right">
							        <button type="submit" name="submit" class="btn btn-success" >Proses</button>
							        <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
							    </div>
							    </div>
							</div>
						</form>
						</div>
						</div>
					</div>

					<!--new row-->
					<div class="row">
						<div class="col-md-6">
						<div class="box box-info">
						<form class="form-horizontal" method="post" action="<?php echo base_url()."Download/detail";?>">
							<div class="box-header with-border">
								<h3 class="box-title">Detail</h3>
							</div>
							<div class="box-body">
								<div class="form-group" style="margin-top: 10px">
									<label class="control-label col-sm-3" style="margin-top: 5px">Dosen </label>
				                    <div class="col-sm-8">
				                    <select name="lecture" class="form-control" required>
				                        <option value="">--Pilih Dosen--</option> 
				                        <?php
				                            foreach ($dosen as $d) {
				                            echo"<option value='".$d['nidn']."'>".$d['nm_ptk']."</option>";
				                            }
				                        ?>
				                    </select>
				                    <span class="help-block"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                    <label class="control-label col-sm-3" style="margin-top: 5px">Tahun </label>
				                    <div class="col-sm-8">
				                    <select name="year" class="form-control" required>
				                        <option value="">--Pilih Tahun--</option> 
				                        <?php
				                            foreach ($tahun as $d) {
				                            echo"<option value='".$d['Tahun_ID']."'>".$d['Tahun_ID']."</option>";
				                            }
				                        ?>
				                    </select>
				                    <span class="help-block"></span>
				                    </div>
				                </div>
				                <div class="box-footer">
				                <div class="pull-right">
								    <button type="submit" name="submit" class="btn btn-success" >Proses</button>
								    <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
								</div>
								</div>
							</div>
						</form>
						</div>

						</div>
					</div>
					
				</div>
			</div>
		    <!--box-->
			
		</div>
              
    </div>
            <!-- /.tab-content -->
</div>




</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url()."assets/backend/bower_components/jquery/dist/jquery.min.js"?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()."assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()."assets/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url()."assets/backend/bower_components/fastclick/lib/fastclick.js"?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()."assets/backend/dist/js/adminlte.min.js"?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()."assets/backend/dist/js/demo.js"?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()."assets/backend/bower_components/jquery-ui/jquery-ui.min.js"?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/datatables.net/js/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.js') ?>"></script>
<!-- <script>
  $(document).ready(function () {
    $('#table_hasil').DataTable({
    });
    });

   $(document).ready(function () {
    $('#table_detail').DataTable({
    				"processing": true, //Feature control the processing indicator.
			        "serverSide": true,
			        "order": [], //Initial no order.
                    "ajax": 
                    {
		                "url": "<?php echo base_url()."Download/detail";?>", // URL file untuk proses select datanya
		                "type": "POST"
            		},
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
    var tableId = document.getElementsByClassName("table")[1].id;
    document.getElementById("demo").innerHTML = tableId;

  });
});
</script> -->

<!-- <script type="text/javascript">

	$('[data-toggle="tab"]').click(function (e) {
  	$(this).tab('show');
  	document.getElementById("demo").innerHTML = 5 + 6;
    //var tableId = $(this).data("table");
    document.write("tableID:");
    //initiateTable(tableId);s


	});

  function initiateTable(tableId) {
                var table = $("#" + tableId).DataTable({
                    "ajax": 
                    {
		                "url": "<?php echo base_url()."Download/detail";?>", // URL file untuk proses select datanya
		                "type": "POST"
            		}
                    order: [],
                    columnDefs: [{
                        orderable: false,
                        targets: [0]
                    }],
                    "destroy": true,
                    "bFilter": true,
                    "bLengthChange": false,
                    "bPaginate": false
                });
            }
</script> -->
</body>
</html>