<?php $this->load->view('mhs/head'); ?>
<?php $this->load->view('mhs/header'); ?>
<div class="container-well" style="min-height: 916px;">
	<!--jumbotron-->
	<div class="jumbotron">
		<div class="row">
			<form method="post" id="form" name="form" action="<?php echo base_url('Penilaian/input_action'); ?>" onsubmit="document.getElementById('btnSave').disabled=true; document.getElementById('btnSave').value='Sedang menyimpan...';">
				<div class="col-xs-6">
				<table class="table table-bordered">
					<tr>
						<td><label class="control-label col-xs-4" style="margin-top: 10px" >NIDN</label>
		                    <div class="col-xs-8">
		                    <input type="text" name="nidn" id="nidn" class="form-control" disabled="true" value="<?php echo $record['nidn']?>"/>
		                    <input type="hidden" name="nidn1" id="nidn1" class="form-control" value="<?php echo $record['nidn']?>"/>
		                    <input type="hidden" name="id_dosen" id="id_dosen" class="form-control" value="<?php echo $record['id_dosen']?>"/>
		                    <span class="help-block"></span>
	                    </div></td>
					</tr>
					<tr>
						<td><label class="control-label col-xs-4" style="margin-top: 10px" >Nama Dosen</label>
		                    <div class="col-xs-8">
		                    <input type="text" name="nama" id="nama" class="form-control" disabled="true" value="<?php echo $record['nm_ptk']?>"/>
		                    <input type="hidden" name="kd_kelas" id="kd_kelas" class="form-control" value="<?php echo $record['kode_kelas']?>"/>
		                    <span class="help-block"></span>
		                    </div>
						</td>
					</tr>
				</table>	
				</div>
				<div class="col-xs-6">
					<table class="table table-bordered">
						<tr>
							<td><label class="control-label col-xs-4" style="margin-top: 10px" >Tahun Akademik</label>
			                    <div class="col-xs-8">
			                    <input type="text" name="tahun" id="tahun" class="form-control" disabled="true" value="<?php echo $record['id_tahun_ajaran']?>"/>
			                    <input type="hidden" name="id_tahun" id="id_tahun" class="form-control" value="<?php echo $record['id_tahun_ajaran']?>"/>
			                    <input type="hidden" name="id_krs" id="id_krs" class="form-control" value="<?php echo $record['id_krs']?>"/>
			                    <span class="help-block"></span>
			                    </div>
							</td>
						</tr>
						<tr>
							<td><label class="control-label col-xs-4" style="margin-top: 10px;" >Matakuliah</label>
			                    <div class="col-xs-8">
			                    <input type="text" name="matkul" id="matkul" class="form-control" disabled="true" value="<?php echo $record['nm_mk']?>"/>
			                    <input type="hidden" name="kode_matkul" id="kode_matkul" class="form-control" value="<?php echo $record['kode_mk']?>"/>
			                    <input type="hidden" name="jurusan" id="jurusan" class="form-control"  value="<?php echo $record['id_jurusan']?>"/>
			                    <span class="help-block"></span>
			                    </div>
							</td>
						</tr>
					</table>
				</div>
		</div>
	<!--/.jumbotron-->
	</div>

	<!--callout-->
	<div class="callout callout-warning">
        <h4>Catatan cara pengisian kuesioner:</h4>

        <p><?php echo $cara_isi['catatan']?></p>
    <!--/.callout-->
    </div>

    <!--box-->
	<div class="box">
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="text-align: center">No</th>
						<th style="text-align: center">Pernyataan</th>
						<th style="text-align: center">Skala Penilaian</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if ($jum_kuesioner==0 && $jum_pilihan==0) {
						echo "<tr>
								<td colspan='3' style='text-align: center'>Pertanyaan untuk tahun ".$record['id_tahun_ajaran']." belum dibuat</td>
							  </tr>";
					}
					if (($jum_kuesioner==0 && $jum_pilihan!=0) || ($jum_kuesioner!=0 && $jum_pilihan==0)){
						echo "<tr>
								<td colspan='3' style='text-align: center'>Pertanyaan untuk tahun ".$record['id_tahun_ajaran']." belum dibuat</td>
							  </tr>";
					}
					else{
					foreach ($kuesioner as $k) {
						echo "<tr>
									<td style='background-color: #E9967A'></td>
									<td colspan='2' style='background-color: #E9967A'><font size='4'><b>".$k['kompetensi']."</b></font></td>
							 </tr>";
							 $query=$this->db->query("SELECT p.id_pertanyaan, k.kompetensi, p.id_kompetensi, p.pertanyaan, p.id_tahun
				                FROM k__master_pertanyaan p
				                JOIN k__kompetensi k ON p.id_kompetensi=k.id_kompetensi
				                WHERE p.id_tahun=".$k['id_tahun']." AND p.id_kompetensi=".$k['id_kompetensi']."");

				                foreach ($query->result_array() as $row) {
				                	echo "<tr>
				                			<td align='center'>$no</td>
											<td ><input type='hidden' name='kompetensi$no' value='".$row['id_kompetensi']."'><input type='hidden' name='pertanyaan$no' value='".$row['id_pertanyaan']."'>".$row['pertanyaan']."</td>";
								foreach ($pilihan as $p) {
									echo "<td align='center' width='40%'><label style='margin-right: 30px;'>
										<input type='radio' name='Radio$no' value='".$p['pilihan1']."' required='true' title='pilih salah satu'><br> ".$p['pilihan1']."
									</label>
									<label style='margin-right: 30px;'>
									    <input type='radio' name='Radio$no' value='".$p['pilihan2']."' required='true' title='pilih salah satu'><br> ".$p['pilihan2']."
									</label>";
									if ($p['pilihan3']!=0) {
									echo"<label style='margin-right: 30px;'>
											<input type='radio' name='Radio$no' value='".$p['pilihan3']."' required='true' title='pilih salah satu'><br> ".$p['pilihan3']."
										</label>";}
									if ($p['pilihan4']!=0) {
									echo"<label style='margin-right: 30px;'>
											<input type='radio' name='Radio$no' value='".$p['pilihan4']."' required='true' title='pilih salah satu'><br> ".$p['pilihan4']."
										</label>";}
									if ($p['pilihan5']!=0) {
									echo"<label style='margin-right: 30px;'>
											<input type='radio' name='Radio$no' value='".$p['pilihan5']."' required='true' title='pilih salah satu'><br> ".$p['pilihan5']."
										</label>";}
									if ($p['pilihan6']!=0) {
									echo"<label style='margin-right: 30px;'>
											<input type='radio' name='Radio$no' value='".$p['pilihan6']."' required='true' title='pilih salah satu'><br> ".$p['pilihan6']."
										</label>";}
									if ($p['pilihan7']!=0) {
									echo"<label style='margin-right: 30px;'>
											<input type='radio' name='Radio$no' value='".$p['pilihan7']."' required='true' title='pilih salah satu'><br> ".$p['pilihan7']."
										</label>";}
									if ($p['pilihan8']!=0) {
									echo"<label style='margin-right: 30px;'>
											<input type='radio' name='Radio$no' value='".$p['pilihan8']."' required='true' title='pilih salah satu'><br> ".$p['pilihan8']."
										</label>";}
									if ($p['pilihan9']!=0) {
									echo"<label style='margin-right: 30px;'>
											<input type='radio' name='Radio$no' value='".$p['pilihan9']."' required='true' title='pilih salah satu'><br> ".$p['pilihan9']."
										</label>";}
									if ($p['pilihan10']!=0) {
									echo"<label>
											<input type='radio' name='Radio$no' value='".$p['pilihan10']."' required='true' title='pilih salah satu'><br> ".$p['pilihan10']."
										</label>";}
								"</td>";}
				                echo "</tr>";
				                	$no++;
				                }
					}
				}
				?>
				</tbody>
			</table>
		</div>
		<div class="box-footer">
                <div class="pull-right">
                    <input type="hidden" name="jumlah" id="jumlah" value="<?php echo $no;?>" />
                    <input type="submit" name="submit" class="btn btn-success" id="btnSave" value="Simpan" >
                    <button type="reset" class="btn btn-danger" id="cancel" >Batal</button>
                </div>
                <!-- /box-footer -->
        </div>
	<!--/.box-->
	</div>
	</form>
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
<script type="text/javascript">

$(document).ready(function(){
	$('.form').submit(function(){
		$('#btnSave').text('Menyimpan...'); //change button text
    	$('#btnSave').attr('disabled',true); //set button disable
        return true;
    });
});
	function save(){
		$('#btnSave').text('Menyimpan...'); //change button text
    	$('#btnSave').attr('disabled',true); //set button disable

    	// ajax adding data to database
        $.ajax({
            url : "<?php echo base_url('Penilaian/input_action'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    window.location="<?php echo base_url()."Penilaian/after_penilaian"?>";
                }
                /*else
                {
                    $('[name="'+data.inputerror+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror+'"]').next().text(data.error_string); //select span help-block class set text error string
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable*/


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Penilaian belum terisi semua!');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

            }
        });
	}
</script>
</body>
</html>