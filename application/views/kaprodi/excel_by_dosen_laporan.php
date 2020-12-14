<?php
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
?>
<table>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td style="text-align: center" colspan="10"><b>LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER DOSEN)</b></td>
	</tr>
	<tr>
		<td style="text-align: center" colspan="10">Tahun Akademik: <?php echo $tahun_dari?> - <?php echo $tahun_sampai?></td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
</table>
<table border="1">
				<thead>
					<tr>
						<th colspan="2" style="background-color: #D8BFD8">NIDN:</th>
						<th colspan="9" style="background-color: #B0E0E6"><?php echo "'".$dosen['NIDN']."'"?></th>
					</tr>
					<tr>
						<th colspan="2" style="background-color: #D8BFD8">Nama Dosen:</th>
						<th colspan="9" style="background-color: #B0E0E6"><?php echo $dosen['nm_ptk']?></th>
					</tr>
					<tr style="background-color: #00FA9A">
						<th style="text-align: center; width: 30px">No</th>
						<th style="text-align: center">Tahun Akademik</th>
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
								<td colspan='11' style='text-align: center'>Record Kosong</td>
							  </tr>";
					}else{
						$no=1;
						foreach ($record as $r) {
							$get_baris=$this->db->query('SELECT sum.nidn, k.id_kompetensi, k.kompetensi, sum.jumlah, sum.rata_per_kompetensi, sum.id_tahun,sum.kode_mtk,sum.id_jur, sum.kategori_per_komp
															FROM k__sum_jawaban sum 
															JOIN k__kompetensi k ON k.id_kompetensi=sum.id_kompetensi 
															WHERE sum.nidn="'.$r['NIDN'].'" AND sum.id_tahun="'.$r['id_tahun'].'" AND sum.kode_mtk="'.$r['kode_mtk'].'" AND sum.id_jur="'.$r['id_jur'].'"');	
							$jumlah_baris=$get_baris->num_rows(); //mencari banyaknya baris data dengan nidn yang sama
							$rowspan=true;
							echo "<tr>
										<td rowspan='".$jumlah_baris."' style='text-align: center'>$no</td>
										<td rowspan='".$jumlah_baris."' style='text-align: center'>".$r['id_tahun']."</td>
										<td rowspan='".$jumlah_baris."' style='text-align: center'>".$r['nm_mk']."</td>";

										foreach ($get_baris->result_array() as $row) {
											$jumlah_ques=$this->db->query("SELECT pertanyaan, id_tahun
			 										FROM k__master_pertanyaan
			 										WHERE id_kompetensi=".$row['id_kompetensi']." AND id_tahun=".$row['id_tahun']."")->num_rows();

											echo"
												<td >".$row['kompetensi']."</td>
												<td style='text-align: right'>".$jumlah_ques."</td>
												<td style='text-align: right'>".$row['jumlah']."</td>
												<td style='text-align: right'>".number_format($row['rata_per_kompetensi'],2)."</td>
												<td style='text-align: right'>".$row['kategori_per_komp']."</td>
												";

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
						}
					?>
				</tbody>
			</table>