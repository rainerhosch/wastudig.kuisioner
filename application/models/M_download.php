<?php
class M_download extends CI_Model
{
	
	function get_filtered_dosen($id_jur,$syear,$eyear) //dulunya get_data_filtered_dosen
	{
		$query="SELECT sum.id_sum, 
		               d.nm_ptk, 
		               d.nidn, 
		               sum.id_jur, 
		               sum.id_tahun, 
		               k.kompetensi, 
		               k.id_kompetensi, 
		               sum.jumlah, 
		               sum.rata_per_kompetensi, 
		               m.nm_mk, 
		               sum.kategori_per_komp
				FROM k__sum_jawaban sum
				JOIN dosen d ON d.nidn=sum.nidn
				JOIN k__kompetensi k ON k.id_kompetensi=sum.id_kompetensi
				JOIN mata_kuliah m ON m.kode_mk=sum.kode_mtk
				WHERE sum.id_jur='".$id_jur."'
				AND (('".$syear."' IS NULL AND sum.id_tahun=(select MAX(id_tahun) from k__tahun where id_jur='".$id_jur."')) or ('".$syear."' IS NOT NULL AND (sum.id_tahun BETWEEN '".$syear."' and 
					'".$eyear."' )))  
				GROUP BY sum.kode_mtk, sum.id_kompetensi,sum.nidn, sum.id_tahun ORDER BY sum.id_sum DESC";
		return $this->db->query($query);
	}

	function get_fildos_detail($id_jur,$NIDN,$TAHUN) 
	{
		
		$query="SELECT Z.* FROM 
		           (SELECT X.nm_ptk,
		                   X.nidn,
		                   X.id_jur,
		                   X.id_tahun,
		                   X.kompetensi,
		                   X.skor_pertanyaan,
		                   X.kode_mtk,
		                   X.id_kompetensi,
		                   X.nm_mk,
		                   X.id_pertanyaan,
		                   X.pertanyaan,
		                   x.penilai,
		                   X.rata_rata,
		                   CASE WHEN X.rata_rata between O.nilai_from 
		                        AND O.nilai_to THEN O.kategori 
                           ELSE 'NULL' END kategori
                    FROM (SELECT D.nm_ptk,
			                     D.nidn,
								 A.id_jur,
								 A.id_tahun,
			 					 K.kompetensi,
			                    (SELECT SUM(J.JAWABAN) 
			                       FROM k__JAWABAN J 
				                       WHERE J.id_tahun = A.id_tahun 
				                       AND J.nidn = A.nidn 
				                       AND J.id_tahun = A.id_tahun 
				                       AND J.id_pertanyaan = A.id_pertanyaan 
				                       AND J.id_kompetensi = A.id_kompetensi) skor_pertanyaan,
			                     A.kode_mtk,
								 A.id_kompetensi,
								 M.nm_mk,
								 A.id_pertanyaan,
								 M_P.pertanyaan,
								 COUNT(DISTINCT(A.nim)) penilai,
								 ROUND(((SELECT SUM(J.JAWABAN) 
								         FROM k__JAWABAN J 
									         WHERE J.id_tahun = A.id_tahun 
									         AND J.nidn = A.nidn 
									         AND J.id_tahun = A.id_tahun 
				                             AND J.id_pertanyaan = A.id_pertanyaan 
				                             AND J.id_kompetensi = A.id_kompetensi) / COUNT(DISTINCT(A.nim))),2) rata_rata
						  FROM k__jawaban A
							  JOIN dosen D ON D.nidn = A.nidn
							  JOIN k__kompetensi K ON K.id_kompetensi = A.id_kompetensi
					  		  JOIN mata_kuliah M ON M.kode_mk = A.kode_mtk
							  JOIN k__master_pertanyaan M_P ON M_P.id_pertanyaan = A.id_pertanyaan
							  WHERE A.id_jur = '".$id_jur."' AND A.nidn = '".$NIDN."' AND A.id_tahun='".$TAHUN."'
		                  	  GROUP BY A.nidn,
		                           A.id_jur,
		                           A.id_tahun,
		                           A.kode_mtk,
		                           A.id_kompetensi,
		                           A.id_pertanyaan
		                      ORDER BY D.nidn DESC)X
		            JOIN k__kriteria_nilai O ON O.id_tahun=X.id_tahun) Z
		            WHERE Z.kategori !='NULL'
		            ORDER BY Z.kompetensi";
		return $this->db->query($query);
	}

	function tahun_default($id_jur) 
	{
		
		$query="SELECT DISTINCT(id_tahun) Tahun_ID 
		        FROM k__jawaban WHERE id_jur='".$id_jur."' order by id_tahun DESC";
		return $this->db->query($query);
	}

	function get_all_dosen() // dulunya get_data_all_dosen
	{
		$query="SELECT sum.id_sum, d.nm_ptk, d.nidn, sum.id_jur, jr.nm_jur, sum.id_tahun, k.kompetensi, k.id_kompetensi, sum.jumlah, sum.rata_per_kompetensi, sum.kode_mtk, m.nm_mk, sum.kategori_per_komp
				FROM k__sum_jawaban sum
				JOIN dosen d ON d.nidn=sum.nidn
				JOIN k__kompetensi k ON k.id_kompetensi=sum.id_kompetensi
				JOIN jurusan jr ON jr.id_jur=sum.id_jur
				JOIN mata_kuliah m ON m.kode_mk=sum.kode_mtk
				GROUP BY sum.kode_mtk, sum.id_kompetensi, sum.nidn 
				ORDER BY sum.id_sum DESC";
		return $this->db->query($query);
	}

	function get_one_filter_dospro_by_nidn($id_jur,$nidn_dosen,$from_tahun,$to_tahun) // dulunya get_one_filtered_dosen_prodi_by_nidn
	{
		$query="SELECT sum.id_sum, 
		               d.nm_ptk, 
		               d.nidn, 
		               sum.id_jur, 
		               sum.id_tahun, 
		               k.kompetensi, 
		               k.id_kompetensi, 
		               sum.jumlah, 
		               sum.kode_mtk, 
		               m.nm_mk, 
		               sum.rata_keseluruhan, 
		               sum.kategori, 
		               sum.responden
				FROM k__sum_jawaban sum
				JOIN dosen d ON d.nidn=sum.nidn
				JOIN k__kompetensi k ON k.id_kompetensi=sum.id_kompetensi
				JOIN mata_kuliah m ON m.kode_mk=sum.kode_mtk
				WHERE sum.id_jur='".$id_jur."' AND sum.nidn=".$nidn_dosen." AND sum.id_tahun BETWEEN ".$from_tahun." AND ".$to_tahun."
				GROUP BY sum.nidn,sum.id_tahun,sum.kode_mtk
				ORDER BY sum.id_tahun ASC";
		return $this->db->query($query);
	}


	function get_one_filter_dospro_by_nidn_N($id_jur,$nidn_dosen,$from_tahun,$to_tahun) // dulunya get_one_filtered_dosen_prodi_by_nidn
	{
		$query="SELECT s.id_sum, 
		               d.nm_ptk, 
		               d.nidn, 
		               s.id_jur, 
		               s.id_tahun, 
		               k.kompetensi, 
		               k.id_kompetensi, 
		               s.jumlah, 
				       (select count(id_pertanyaan) 
				          from k__master_pertanyaan 
				          where id_kompetensi=s.id_kompetensi 
				            and id_tahun=s.id_tahun 
				          group by id_tahun) quest_count ,
				       s.kode_mtk, 
				       m.nm_mk, 
				       s.rata_per_kompetensi, 
				       s.rata_keseluruhan, 
				       s.kategori_per_komp,
				       s.kategori, 
				       s.responden 
				FROM k__sum_jawaban s 
				JOIN dosen d ON d.nidn=s.nidn 
				JOIN k__kompetensi k ON k.id_kompetensi=s.id_kompetensi
				JOIN mata_kuliah m ON m.kode_mk=s.kode_mtk 
				WHERE s.id_jur='".$id_jur."' AND s.nidn=".$nidn_dosen." AND s.id_tahun BETWEEN ".$from_tahun." AND ".$to_tahun."
				GROUP BY s.id_sum,s.nidn,s.id_tahun,s.kode_mtk,s.id_kompetensi 
				ORDER BY s.id_tahun ASC";
		return $this->db->query($query);
	}

	function get_one_filter_dospro_by_th($id_jur,$tahun) // dulunya get_one_filtered_dosen_prodi_by_th
	{ 
		$query="SELECT sum.id_sum, d.nm_ptk, d.nidn, sum.id_jur, sum.id_tahun, k.kompetensi, k.id_kompetensi, sum.jumlah, sum.kode_mtk, m.nm_mk, sum.rata_keseluruhan, sum.kategori, sum.responden
				FROM k__sum_jawaban sum
				JOIN dosen d ON d.nidn=sum.nidn
				JOIN k__kompetensi k ON k.id_kompetensi=sum.id_kompetensi
				JOIN mata_kuliah m ON m.kode_mk=sum.kode_mtk
				WHERE sum.id_jur='".$id_jur."' AND sum.id_tahun=".$tahun." GROUP BY sum.nidn,sum.id_tahun,sum.kode_mtk,sum.id_jur";
		return $this->db->query($query);
	}

	function get_one_filter_dospro_by_th_N($id_jur,$tahun) // dulunya get_one_filtered_dosen_prodi_by_th
	{ 
		$query="SELECT s.id_sum, d.nm_ptk, d.nidn, s.id_jur, s.id_tahun, k.kompetensi, k.id_kompetensi, s.jumlah, 
				(select count(id_pertanyaan) from k__master_pertanyaan where id_kompetensi=s.id_kompetensi and id_tahun=s.id_tahun group by id_tahun) quest_count ,
				s.kode_mtk, m.nm_mk, s.rata_per_kompetensi, s.rata_keseluruhan, s.kategori_per_komp,s.kategori, s.responden 
				FROM k__sum_jawaban s 
				JOIN dosen d ON d.nidn=s.nidn 
				JOIN k__kompetensi k ON k.id_kompetensi=s.id_kompetensi
				JOIN mata_kuliah m ON m.kode_mk=s.kode_mtk 
				WHERE s.id_jur='".$id_jur."' AND s.id_tahun=".$tahun." 
				GROUP BY s.id_sum,s.nidn,s.id_tahun,s.kode_mtk,s.id_kompetensi 
				ORDER BY d.nidn,k.id_kompetensi ASC";
		return $this->db->query($query);
	}

	function get_rata_dospro_th($id_jur,$tahun){
		$query="SELECT rata_rata,kategori
				FROM k__hasil_pertahun_jur
				WHERE id_jur='".$id_jur."' AND id_tahun=".$tahun."";
		return $this->db->query($query);
	}

	function get_one_filtered_dosen($jurusan,$tahun)
	{
		$query="SELECT sum.id_sum, 
		               d.nm_ptk, 
		               d.nidn, 
		               sum.id_jur, 
		               jr.nm_jur, 
		               sum.id_tahun, 
		               k.kompetensi, 
		               k.id_kompetensi, 
				       (select count(x.id_pertanyaan) from k__master_pertanyaan x where x.id_kompetensi=sum.id_kompetensi and x.id_tahun=sum.id_tahun ) jum_quest,
				       sum.jumlah, 
				       sum.rata_per_kompetensi, 
				       sum.kategori_per_komp, 
				       sum.kode_mtk, 
				       m.nm_mk, 
				       sum.rata_keseluruhan, 
				       sum.kategori, 
				       sum.responden
				FROM k__sum_jawaban sum
				JOIN dosen d ON d.nidn=sum.nidn
				JOIN k__kompetensi k ON k.id_kompetensi=sum.id_kompetensi
				JOIN jurusan jr ON jr.id_jur=sum.id_jur
				JOIN mata_kuliah m ON m.kode_mk=sum.kode_mtk
				WHERE sum.id_jur=".$jurusan." AND sum.id_tahun=".$tahun."";
		return $this->db->query($query);
	}

}