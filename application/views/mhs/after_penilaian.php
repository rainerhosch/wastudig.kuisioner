<?php $this->load->view('mhs/head'); ?>
<?php $this->load->view('mhs/header'); ?>
<div class="container-well" style="min-height: 916px;">
    <!--box-->
	<div class="box">
		<div class="box-header">
			<div class="col-md-6">
	            <h2 style="margin-top:0px">Daftar Dosen Yang Telah Dinilai</h2>
	        </div>
	        <div class="col-md-6 text-right">
                <a type="button" href="<?php echo base_url()."Penilaian"?>" class="btn btn-warning"><i class="fa fa-share"></i> Isi penilaian dosen lainnya</a>
            </div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-hover dataTable" id="table_after">
				<thead>
					<tr>
						<th style="text-align: center">No</th>
						<th style="text-align: center">Nama Dosen</th>
						<th style="text-align: center">Mata Kuliah</th>
						<th style="text-align: center">Kelas</th>
						<th style="text-align: center">Tahun akademik</th>
						<th style="text-align: center">Semester</th>
						<th style="text-align: center">Status</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					foreach ($record as $r) {
						echo"<tr>
								<td align='center'>$no</td>
								<td align='center'>".$r['nm_ptk']."</td>
								<td align='center'>".$r['nm_mk']."</td>
								<td align='center'>".$r['nama_kelas']."</td>
								<td align='center'>".$r['id_tahun']."</td>
								<td align='center'>".$r['smtr']."</td>
								<td align='center'><a class='btn btn-sm btn-danger disabled' id='".$r['id_krs']."' name='active'><i class='glyphicon glyphicon-eye-close'></i> Survey Terisi</a></td>
							</tr>";
							$no++;
					}
				?>
				</tbody>
			</table>
		</div>
	<!--/.box-->
	</div>
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
<script>
  $(document).ready(function () {
    $('#table_after').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
  });
</script>
</body>
</html>