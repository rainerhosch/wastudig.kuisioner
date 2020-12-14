<?php $this->load->view('mhs/head'); ?>
<?php $this->load->view('mhs/header'); ?>
<div class="container-well" style="min-height: 916px;">

	<!--jumbotron-->
	<div class="jumbotron">
		<div class="row">
			<form method="post">
				<div class="col-xs-6">
					<div class="form-grup">
						<label class="control-label col-xs-3" style="margin-top: 10px">NIM</label>
						<div class="col-xs-8">
							<input type="text" name="nim" id="nim" class="form-control" disabled="true" value='<?= $mhs['nipd']; ?>' />
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-grup">
						<label class="control-label col-xs-3" style="margin-top: 10px">Nama</label>
						<div class="col-xs-8">
							<input type="text" name="nama" id="nama" class="form-control" disabled="true" value="<?= $mhs['nm_pd']; ?>" />
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-grup">
						<label class="control-label col-xs-3" style="margin-top: 10px">Prodi</label>
						<div class="col-xs-8">
							<input type="text" name="prodi" id="prodi" class="form-control" disabled="true" value="<?= $mhs['nm_jur']; ?>" />
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-grup">
						<label class="control-label col-xs-3" style="margin-top: 10px">Dosen Wali</label>
						<div class="col-xs-8">
							<input type="text" name="dosen_wali" id="dosen_wali" class="form-control" disabled="true" value="<?= $mhs['nm_ptk']; ?>" />
							<span class="help-block"></span>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!--/.jumbotron-->
	</div>

	<!--callout-->
	<div class="callout callout-info">
		<h4>Info!</h4>

		<p>Penilaian kinerja dosen oleh mahasiswa bertujuan untuk mengevaluasi performa kinerja dosen dalam kurun waktu satu semester dan kemudian digunakan sebagai acuan untuk meningkatkan mutu dosen.</p>
		<!--/.callout-->
	</div>

	<!--box-->
	<div class="box">
		<div class="box-body table-responsive">
			<table class="table table-bordered table-hover dataTable" id="table_awal">
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
					$no = 1;
					foreach ($record as $r) {
						$cek = $this->db->query("SELECT nidn, id_jur, id_tahun, kode_mtk, nim
												FROM k__jawaban
												WHERE nidn='" . $r['NIDN'] . "' AND id_jur='" . $r['id_jurusan'] . "' AND id_tahun=" . $r['id_tahun_ajaran'] . " AND kode_mtk='" . $r['kode_mk'] . "' AND nim='" . $r['nipd'] . "'")->num_rows(); //cek ada atau tidaknya jawaban dengan kriteria diatas
						if ($cek == 0) {
							echo "<tr>
								<td align='center'>$no</td>
								<td align='center'>" . $r['nm_ptk'] . "</td>
								<td align='center'>" . $r['nm_mk'] . "</td>
								<td align='center'>" . $r['nama_kelas'] . "</td>
								<td align='center'>" . $r['id_tahun_ajaran'] . "</td>
								<td align='center'>" . $r['smtr'] . "</td>
								<td align='center'><a class='btn btn-sm btn-success nonactive' name='nonactive' href='Penilaian/penilaian/" . $r['id_krs'] . "'><i class='glyphicon glyphicon-eye-open'></i> Isi survey</a></td>
							</tr>";
							$no++;
						}
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
<script src="<?= base_url() . "assets/backend/bower_components/jquery/dist/jquery.min.js" ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() . "assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js" ?>"></script>
<!-- SlimScroll -->
<script src="<?= base_url() . "assets/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js" ?>"></script>
<!-- FastClick -->
<script src="<?= base_url() . "assets/backend/bower_components/fastclick/lib/fastclick.js" ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() . "assets/backend/dist/js/adminlte.min.js" ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() . "assets/backend/dist/js/demo.js" ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() . "assets/backend/bower_components/jquery-ui/jquery-ui.min.js" ?>"></script>
<script src="<?= base_url('assets/backend/bower_components/datatables.net/js/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('assets/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.js') ?>"></script>
<script>
	$(document).ready(function() {
		$('#table_awal').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': false,
			'ordering': true,
			'info': true,
			'autoWidth': false,
			"columnDefs": [{
				"targets": [6], //last column
				"orderable": false, //set not orderable
			}]
		});
	});
</script>
</body>

</html>