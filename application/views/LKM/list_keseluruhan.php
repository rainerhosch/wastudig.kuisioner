<?php $this->load->view('kaprodi/head'); ?>
<?php $this->load->view('kaprodi/header'); ?>
<div class="container-well" style="min-height: 916px;">
	<div class="box">
		<div class="box-header with-border">
			<div class="row">
				<div class="col-md-10">
	               <h3 style="margin-top:0px">Download Hasil Kuesioner Berdasarkan Program studi dan Tahun Kademik</h3>
	            </div>
            </div>
		</div>
		<div class="box-body">
			<div class="row">
				<form class="form-horizontal" method="post" action="<?php echo base_url()."Download/export_excel_lkm";?>">
					<div class="col-sm-5" >
						<div class="form-group">
							<label class="control-label col-sm-3" >Program studi</label>
		                    <div class="col-sm-8">
		                    <select name="jurusan" class="form-control" required>
		                        <option value="">--Pilih Prodi--</option> 
		                        <?php
		                            foreach ($jurusan as $j) {
		                            echo"<option value='".$j['id_jur']."'>".$j['nm_jur']."</option>";
		                            }
		                        ?>
		                    </select>
		                    <span class="help-block"></span>
		                    </div>
						</div>
					</div>
					<div class="col-sm-5" >
						<div class="form-group">
							<label class="control-label col-sm-3" >Tahun </label>
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
					</div>
			</div>
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<button type="submit" name="submit" class="btn btn-success" >Proses</button>
                <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
            </div>
		</div>
		</form>
	</div>
    <!--box-->
	<div class="box">
		<div class="box-header">
			<div class="row">
				<div class="col-md-6">
	               <h2 style="margin-top:0px">Download hasil kuesioner per Dosen</h2>
	            </div>
            </div>		
		</div>
		<div class="box-body">
			<div class="row">
				<form class="form-horizontal" method="post" action="<?php echo base_url()."Download/detail";?>">
					<div class="col-sm-5" >
						<div class="form-group">
							<label class="control-label col-sm-3" >Dosen</label>
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
					</div>
					<div class="col-sm-5" >
						<div class="form-group">
							<label class="control-label col-sm-3" >Program Studi</label>
		                    <div class="col-sm-8">
		                    <select name="prodi" class="form-control" required>
		                        <option value="">--Pilih prodi--</option> 
		                        <?php
		                            foreach ($jurusan as $j) {
		                            echo"<option value='".$j['id_jur']."'>".$j['nm_jur']."</option>";
		                            }
		                        ?>
		                    </select>
		                    <span class="help-block"></span>
		                    </div>
						</div>
					</div>
					<div class="col-sm-5" >
						<div class="form-group">
							<label class="control-label col-sm-3" >Tahun </label>
		                    <div class="col-sm-8">
		                    <select name="year" class="form-control" required>
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
					</div>
			</div>
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<button type="submit" name="submit" class="btn btn-success" >Proses</button>
                <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
            </div>
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
    $('#table_hasil').DataTable({
    });
  });
</script>
</body>
</html>