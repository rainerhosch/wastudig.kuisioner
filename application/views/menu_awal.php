<?php $this->load->view('mhs/head'); ?>
<div id="wrapper" class="container well">
	<header>
		<nav class="navbar navbar-inverse">
			<div class="navbar-collapse collapse">
			</div>
			<!--/.navbar-collapse -->
		</nav>
	</header>

	<div class="jumbotron">
		<p style="text-align:center;"><img src="<?= base_url() . "assets/backend/dist/img/stt-logo.png" ?>" alt="STT LOGO" width="105px"></p>
		<h1 style="text-align: center;">Sistem Penilaian Kinerja Dosen</h1>
		<p>Selamat datang di website Sistem Penilaian Kinerja Dosen STT Wastukancana!<br><?= $awal['catatan'] ?></p>
	</div>
	<div class="jumbotron" style="background-color: #FFEBCD">
		<p style="text-align: center;"><b>Silahkan Login untuk masuk ke dalam Sistem.</b></p>
		<br>
		<div class="row">
			<div class="col-md-3" style="text-align: center;">
				<p><a class="btn btn-primary btn-lg" href="<?= base_url('Kuisioner') . "/login_admin" ?>">Login as Admin</a></p>
			</div>
			<div class="col-md-3" style="text-align: center;">
				<p><a class="btn btn-primary btn-lg" href="<?= base_url('Kuisioner') . "/login_mhs" ?>">Login as Mahasiswa</a></p>
			</div>
			<div class="col-md-3" style="text-align: center;">
				<p><a class="btn btn-primary btn-lg" href="<?= base_url('Kuisioner') . "/login_kaprodi" ?>">Login as Ketua Prodi</a></p>
			</div>
			<div class="col-md-3" style="text-align: center;">
				<p><a class="btn btn-primary btn-lg" href="<?= base_url('Kuisioner') . "/login_lkm" ?>">Login as LKM</a></p>
			</div>
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
</body>

</html>