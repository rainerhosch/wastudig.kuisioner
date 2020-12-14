<?php
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
?>	
<table>
	<tr>
		<td colspan="11"></td>
	</tr>
	<tr>
		<td style="text-align: center" colspan="11"><b>LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER JURUSAN)</b></td>
	</tr>
	<tr>
		<td style="text-align: center" colspan="11">Program studi: <?php echo $jurusan['nama_jurusan'] ?></td>
	</tr>
	<tr>
		<td style="text-align: center" colspan="11">Tahun: <?php echo $tahun?></td>
	</tr>
	<tr>
		<td colspan="11"></td>
	</tr>
</table>		
			<table border="1">
				<thead>
					<tr>
						<th colspan="3" style="background-color: #ADFF2F">Program Studi :</th>
						<th colspan="9" style="background-color: #B0C4DE"><?php echo $jurusan['nama_jurusan'] ?></th>
					</tr>
					<tr>
						<th colspan="3" style="background-color: #ADFF2F">Tahun Akademik :</th>
						<th colspan="9" style="background-color: #B0C4DE"><?php echo $tahun ?></th>
					</tr>
					<tr style="background-color: #FA8072">
						<th style="text-align: center; width: 30px">No</th>
						<th style="text-align: center">NIDN</th>
						<th style="text-align: center">Nama Dosen</th>
						<th style="text-align: center">Matakuliah</th>
						<th style="text-align: center">Kompetensi</th>
						<th style="text-align: center">Jumlah Pertanyaan</th>
						<th style="text-align: center">Jumlah Bobot Jawaban</th>
						<th style="text-align: center">Rata-Rata per Kompetensi</th>
						<th style="text-align: center" >Kategori per Kompetensi</th>
						<th style="text-align: center">Rata-Rata Keseluruhan</th>
						<th style="text-align: center">Jumlah Responden</th>
						<th style="text-align: center" >Kategori</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($jum_record==0) {
						echo "<tr>
								<td colspan='12' style='text-align: center'>Record Kosong</td>
							  </tr>";
					}else{
						$no=1;
						foreach ($record as $r) {
							$get_baris=$this->db->query('SELECT sum.nidn, k.id_kompetensi, k.kompetensi, sum.jumlah, sum.rata_per_kompetensi, sum.kode_jurusan, sum.id_tahun, sum.kode_mtk, sum.kategori_per_komp
														FROM sum_jawaban sum 
														JOIN kompetensi k ON k.id_kompetensi=sum.id_kompetensi 
														WHERE sum.nidn="'.$r['NIDN'].'" AND sum.id_tahun="'.$r['id_tahun'].'" AND sum.kode_jurusan="'.$r['kode_jurusan'].'" AND sum.kode_mtk="'.$r['kode_mtk'].'"');
							$jumlah_baris=$get_baris->num_rows();		//mencari banyaknya baris data dengan nidn yang sama
							$rowspan=true;
							echo "<tr>
										<td rowspan='".$jumlah_baris."' style='text-align: center'>$no</td>
										<td rowspan='".$jumlah_baris."' style='text-align: center'>'".$r['NIDN']."'</td>
										<td rowspan='".$jumlah_baris."' style='text-align: center'>".$r['nama_lengkap']."</td>
										<td rowspan='".$jumlah_baris."' style='text-align: center'>".$r['Nama_matakuliah']."</td>";
										foreach ($get_baris->result_array() as $row) {
										$jumlah_ques=$this->db->query("SELECT pertanyaan
		 										FROM master_pertanyaan
		 										WHERE id_kompetensi=".$row['id_kompetensi']." AND id_tahun=".$row['id_tahun']."")->num_rows();
										echo"<td >".$row['kompetensi']."</td>
											<td style='text-align: right'>".$jumlah_ques."</td>
											<td style='text-align: right'>".$row['jumlah']."</td>
											<td style='text-align: right'>".number_format($row['rata_per_kompetensi'],2)."</td>
											<td style='text-align: right'>".$row['kategori_per_komp']."</td>";

											if ($rowspan) {
								                    echo "
														<td rowspan='".$jumlah_baris."' style='text-align: center'>".number_format($r['rata_keseluruhan'],2)."</td>
														<td rowspan='".$jumlah_baris."' style='text-align: center'>".$r['responden']."</td>
														<td rowspan='".$jumlah_baris."' style='text-align: center'>".$r['kategori']."</td>";
								                }
								                echo "</tr>";
								                    $rowspan = false;
										}
										if ($jumlah_baris==0) {
											echo "</tr>";
										}
									$no++;
							}
							echo "<tr style='background-color: #FFD700'>
									<td colspan='9'>Rata-rata tahun akademik ".$tahun.":</td>
									<td colspan='3' style='text-align: center'>".$rata_tahun['rata_rata']."</td>
								</tr>
								<tr style='background-color: #90EE90'>
									<td colspan='9'>Kategori :</td>
									<td colspan='3' style='text-align: center'>".$rata_tahun['kategori']."</td>
								</tr>";
						}
					?>
				</tbody>
			</table>