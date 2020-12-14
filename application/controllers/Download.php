<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load plugin PHPExcel nya
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Download extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_download');
    }

    public function index()
    {
        if ($this->session->userdata('status') != "login") {
            redirect(base_url());
        } else {
            if ($this->session->userdata('jabatan') != "6") { //untuk kaprodi
                $id_jur = $this->session->userdata("id_jur");
                if (isset($_POST['submit'])) {
                    $syear = $this->input->post('syear');
                    $eyear = $this->input->post('eyear');
                } else {
                    $syear = $this->session->userdata("tahun");
                    $eyear = $this->session->userdata("tahun");
                }

                $data['dosen'] = $this->db->query("SELECT nidn, nm_ptk FROM dosen ORDER BY nm_ptk")->result_array();
                $data['tahun'] = $this->db->get_where('k__tahun', array('id_jur' => $id_jur))->result_array();
                $data['record'] = $this->M_download->get_filtered_dosen($id_jur, $syear, $eyear)->result_array();
                $data['TAHUN'] = $this->M_download->tahun_default($id_jur)->result_array();
                $this->load->view('kaprodi/list_dosen', $data);
            } else { //untuk LKM
                $data['dosen'] = $this->db->query("SELECT nidn, nm_ptk FROM dosen ORDER BY nm_ptk")->result_array();
                $data['jurusan'] = $this->db->get('jurusan')->result_array();
                $data['tahun'] = $this->db->query("SELECT * FROM k__tahun GROUP BY Tahun_ID")->result_array();
                $data['record'] = $this->M_download->get_all_dosen()->result_array();
                $this->load->view('LKM/list_keseluruhan', $data);
            }
        }
    }

    function detail()
    {
        // Panggil class PHPExcel nya
        $exceln = new Spreadsheet();

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("Login"));
        } else {
            if (isset($_POST['submit'])) {
                if ($this->session->userdata('jabatan') != "6") { //untuk kaprodi
                    $id_jur = $this->session->userdata("id_jur");
                } else { //untuk LKM
                    $id_jur = $this->input->post('prodi');
                }

                $nidn_dosen = $this->input->post('lecture');
                $tahun = $this->input->post('year');

                $jurusan = $this->db->select("nm_jur")->from("jurusan")->where(array('id_jur' => $id_jur))->get()->row_array();
                $dosen_dr = $this->db->select("nidn, nm_ptk")->from("dosen")->where(array("nidn" => $nidn_dosen))->get()->row_array();

                //test
                //echo "id_jur = $id_jur,nidn = $nidn_dosen,Tahun_ID = $tahun";
                //test

                $record = $this->M_download->get_fildos_detail($id_jur, $nidn_dosen, $tahun)->result_array();
                $data = array();

                //print_r($record);

                // Settingan awal fil excel
                $exceln->getProperties()->setCreator('My Notes Code')
                    ->setLastModifiedBy('My Notes Code')
                    ->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN (DETAIL)")
                    ->setSubject("Dosen")
                    ->setDescription("LAPORAN HASIL PENILAIAN KINERJA DOSEN (DETAIL)")
                    ->setKeywords("Laporan Kinerja Dosen");

                // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
                $style_col = array(
                    'font' => array('bold' => true), // Set font nya jadi bold

                    'alignment' => array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                    ),
                    'borders' => array(
                        'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                        'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                        'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                        'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                    )
                );

                // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
                $style_row = array(
                    'alignment' => array(
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                    ),
                    'borders' => array(
                        'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                        'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                        'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                        'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                    )
                );

                $exceln->setActiveSheetIndex(0)->setCellValue('A2', "LAPORAN HASIL PENILAIAN KINERJA DOSEN (DETAIL)"); // Set kolom A2 dengan tulisan "LAPORAN HASIL PENILAIAN KINERJA DOSEN (DETAIL)"
                $exceln->getActiveSheet()->mergeCells('A2:J2'); // Set Merge Cell pada kolom A2 sampai J2
                $exceln->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A2
                $exceln->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 12 untuk kolom A2
                $exceln->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A2

                //$exceln->setActiveSheetIndex(0)->setCellValue('A3', "Tahun Akademik :".$tahun.""); // Set kolom A3 dengan tulisan Tahun akademik"

                $exceln->getActiveSheet()->mergeCells('A3:J3'); // Set Merge Cell pada kolom A3 sampai J3
                $exceln->getActiveSheet()->getStyle('A3')->getFont()->setBold(FALSE); // Set bold kolom A3
                $exceln->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 12 untuk kolom A3
                $exceln->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A3

                $exceln->setActiveSheetIndex(0)->setCellValue('A4', "Program Studi :" . $jurusan['nm_jur'] . ""); // Set kolom A4 dengan tulisan Program Studi"
                $exceln->getActiveSheet()->mergeCells('A4:J4'); // Set Merge Cell pada kolom A4 sampai J4
                $exceln->getActiveSheet()->getStyle('A4')->getFont()->setBold(FALSE); // Set bold kolom A4
                $exceln->getActiveSheet()->getStyle('A4')->getFont()->setSize(12); // Set font size 12 untuk kolom A4
                $exceln->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A4

                $exceln->setActiveSheetIndex(0)->setCellValue('A5', "NIDN:"); // Set kolom A5 dengan tulisan "NIDN"
                $exceln->getActiveSheet()->mergeCells('A5:B5'); // Set Merge Cell pada kolom A5 sampai J5
                $exceln->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE); // Set bold kolom A5
                $exceln->getActiveSheet()->getStyle('A5')->getFont()->setSize(11); // Set font size 11 untuk kolom A5
                $exceln->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A5
                $exceln->getActiveSheet()->getStyle('A5:B5')->applyFromArray($style_col); //setting style cell A5 to B5

                $exceln->setActiveSheetIndex(0)->setCellValue('C5', $dosen_dr['nidn']); // Set kolom C1 dengan tulisan "NIDN dosen"
                $exceln->getActiveSheet()->mergeCells('C5:H5'); // Set Merge Cell pada kolom C5 sampai H2
                $exceln->getActiveSheet()->getStyle('C5')->getFont()->setBold(TRUE); // Set bold kolom C2
                $exceln->getActiveSheet()->getStyle('C5')->getFont()->setSize(11); // Set font size 11 untuk kolom C2
                $exceln->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom C5
                //$exceln->getActiveSheet()->getStyle('C5:H5')->applyFromArray($style_col);

                $exceln->setActiveSheetIndex(0)->setCellValue('A6', "Nama Dosen:"); // Set kolom A6 dengan tulisan "NAMA DOSEN
                $exceln->getActiveSheet()->mergeCells('A6:B6'); // Set Merge Cell pada kolom A6 sampai B6
                $exceln->getActiveSheet()->getStyle('A6')->getFont()->setBold(TRUE); // Set bold kolom A6
                $exceln->getActiveSheet()->getStyle('A6')->getFont()->setSize(11); // Set font size 11 untuk kolom A6
                $exceln->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A6
                $exceln->getActiveSheet()->getStyle('A6:B6')->applyFromArray($style_col);

                $exceln->setActiveSheetIndex(0)->setCellValue('C6', $dosen_dr['nm_ptk']); // Set kolom C6 dengan tulisan "NAMA LENGKAP DOSEN"

                $exceln->getActiveSheet()->mergeCells('C6:H6'); // Set Merge Cell pada kolom C6 sampai H6
                $exceln->getActiveSheet()->getStyle('C6')->getFont()->setBold(TRUE); // Set bold kolom C6
                $exceln->getActiveSheet()->getStyle('C6')->getFont()->setSize(11); // Set font size 11 untuk kolom C6
                $exceln->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom C6
                // $exceln->getActiveSheet()->getStyle('C6:H7')->applyFromArray($style_col);

                // Buat header tabel nya pada baris ke 7
                $exceln->setActiveSheetIndex(0)->setCellValue('A7', "NO"); // Set kolom A7 dengan tulisan "NO"
                $exceln->getActiveSheet()->mergeCells('A7:A8');
                $exceln->setActiveSheetIndex(0)->setCellValue('B7', "Matakuliah"); // Set kolom B7 dengan tulisan "MATAKULIAH"
                $exceln->getActiveSheet()->mergeCells('B7:B8');
                $exceln->setActiveSheetIndex(0)->setCellValue('C7', "Kompetensi"); // Set kolom C7 dengan tulisan "KOMPETENSI"
                $exceln->getActiveSheet()->mergeCells('C7:C8');
                $exceln->setActiveSheetIndex(0)->setCellValue('D7', "Pertanyaan/Point penilaian"); // Set kolom D7 dengan tulisan "PERTANYAAN"
                $exceln->getActiveSheet()->mergeCells('D7:D8');
                $exceln->getActiveSheet()->getStyle('D7:D8')->getAlignment()->setWrapText(true);
                $exceln->setActiveSheetIndex(0)->setCellValue('E7', "Jumlah Skor Jawaban"); // Set kolom E7 dengan tulisan "JUMLAH SKOR JAWABAN"
                $exceln->getActiveSheet()->mergeCells('E7:E8');
                $exceln->getActiveSheet()->getStyle('E7:E8')->getAlignment()->setWrapText(true);
                $exceln->setActiveSheetIndex(0)->setCellValue('F7', "Jumlah Penilai"); // Set kolom F7 dengan tulisan "JUMLAH PENILAI"
                $exceln->getActiveSheet()->mergeCells('F7:F8');
                $exceln->getActiveSheet()->getStyle('F7:F8')->getAlignment()->setWrapText(true);
                $exceln->setActiveSheetIndex(0)->setCellValue('G7', "Rata-rata"); // Set kolom G7 dengan tulisan "RATA-RATA"
                $exceln->getActiveSheet()->mergeCells('G7:G8');
                $exceln->getActiveSheet()->getStyle('G7:G8')->getAlignment()->setWrapText(true);
                $exceln->setActiveSheetIndex(0)->setCellValue('H7', "Kategori"); // Set kolom H7 dengan tulisan "KATEGORI"
                $exceln->getActiveSheet()->mergeCells('H7:H8');
                $exceln->getActiveSheet()->getStyle('H7:H8')->getAlignment()->setWrapText(true);


                // Apply style header yang telah kita buat tadi ke masing-masing kolom header
                $exceln->getActiveSheet()->getStyle('A7:A8')->applyFromArray($style_col);
                $exceln->getActiveSheet()->getStyle('B7:B8')->applyFromArray($style_col);
                $exceln->getActiveSheet()->getStyle('C7:C8')->applyFromArray($style_col);
                $exceln->getActiveSheet()->getStyle('D7:D8')->applyFromArray($style_col);
                $exceln->getActiveSheet()->getStyle('E7:E8')->applyFromArray($style_col);
                $exceln->getActiveSheet()->getStyle('F7:F8')->applyFromArray($style_col);
                $exceln->getActiveSheet()->getStyle('G7:G8')->applyFromArray($style_col);
                $exceln->getActiveSheet()->getStyle('H7:H8')->applyFromArray($style_col);

                $no = 1; // Untuk penomoran tabel, di awal set dengan 1
                $numrow = 9; // Set baris pertama untuk isi tabel adalah baris ke 9  

                foreach ($record as $data) { // Lakukan looping pada variabel siswa
                    $exceln->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                    $exceln->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['nm_mk']);
                    $exceln->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['kompetensi']);
                    $exceln->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['pertanyaan']);
                    $exceln->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['skor_pertanyaan']);
                    $exceln->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['penilai']);
                    $exceln->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['rata_rata']);
                    $exceln->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['kategori']);

                    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                    $exceln->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $exceln->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getColumnDimension('c')->setWidth(15);
                    $exceln->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getColumnDimension('D')->setWidth(50);
                    $exceln->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                    $exceln->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                    $exceln->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                    $exceln->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                    $exceln->getActiveSheet()->getColumnDimension('H')->setWidth(15);

                    $no++; // Tambah 1 setiap kali looping
                    $numrow++; // Tambah 1 setiap kali looping
                }
                // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
                $exceln->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

                // Set orientasi kertas jadi LANDSCAPE
                $exceln->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                // Set judul file excel nya
                // $exceln->getActiveSheet(0)->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN");
                $exceln->setActiveSheetIndex(0);



                // Proses file excel
                $write = new Xlsx($exceln);
                header('Content-Type: application/application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="LAPORAN HASIL PENILAIAN KINERJA DOSEN (DETAIL).xlsx"'); // Set nama file excel nya
                header('Cache-Control: max-age=0');
                $write->save('php://output');
            }
        }
    }

    function export_excel_by_one()
    {
        // Panggil class PHPExcel nya
        $excel = new Spreadsheet();

        if ($this->session->userdata('status') != "login") {
            redirect(base_url());
        } else {
            if (isset($_POST['submit'])) {
                //$jabatan= $this->session->userdata("jabatan");
                $id_jur = $this->session->userdata("id_jur");
                $nidn_dosen = $this->input->post("dosen1");
                $tahun = $this->input->post("tahun");
                $from_tahun = $this->input->post("fromth");
                $to_tahun = $this->input->post("toth");

                //echo "nidn_dosen : ". $nidn_dosen."<BR>";
                //echo "from_tahun : ". $from_tahun."<BR>";
                //echo "to_tahun : ". $to_tahun;

                $data = array();
                if ($nidn_dosen != '') {
                    $dosen_dr = $this->db->select("nidn, nm_ptk")->from("dosen")->where(array('nidn' => $nidn_dosen))->get()->row_array();
                    $record = array();
                    $record = $this->M_download->get_one_filter_dospro_by_nidn_N($id_jur, $nidn_dosen, $from_tahun, $to_tahun)->result_array();


                    // Settingan awal fil excel
                    $excel->getProperties()->setCreator('My Notes Code')
                        ->setLastModifiedBy('My Notes Code')
                        ->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER DOSEN)")
                        ->setSubject("Dosen")
                        ->setDescription("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER DOSEN)")
                        ->setKeywords("Laporan Kinerja Dosen");

                    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
                    $style_col = array(
                        'font' => array('bold' => true), // Set font nya jadi bold

                        'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                        ),
                        'borders' => array(
                            'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                            'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                            'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                            'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                        )
                    );

                    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
                    $style_row = array(
                        'alignment' => array(
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                        ),
                        'borders' => array(
                            'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                            'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                            'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                            'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                        )
                    );

                    $excel->setActiveSheetIndex(0)->setCellValue('A2', "LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER DOSEN)"); // Set kolom A2 dengan tulisan "LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER DOSEN)"
                    $excel->getActiveSheet()->mergeCells('A2:J2'); // Set Merge Cell pada kolom A2 sampai J2
                    $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A2
                    $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 12 untuk kolom A2
                    $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

                    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Tahun Akademik :" . $from_tahun . " - " . $to_tahun . ""); // Set kolom A3 dengan tulisan "TAHUN AKADEMIK"
                    $excel->getActiveSheet()->mergeCells('A3:J3'); // Set Merge Cell pada kolom A3 sampai J3
                    $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(FALSE); // Set bold kolom A3
                    $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 12 untuk kolom A3
                    $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

                    $excel->setActiveSheetIndex(0)->setCellValue('A5', "NIDN:"); // Set kolom A5 dengan tulisan "NIDN"
                    $excel->getActiveSheet()->mergeCells('A5:B5'); // Set Merge Cell pada kolom A5 sampai B5
                    $excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE); // Set bold kolom A5
                    $excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(11); // Set font size 12 untuk kolom A5
                    $excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A5
                    $excel->getActiveSheet()->getStyle('A5:B5')->applyFromArray($style_col);

                    $excel->setActiveSheetIndex(0)->setCellValue('C5', $dosen_dr['nidn']); // Set kolom C5 dengan tulisan "NIDN"
                    $excel->getActiveSheet()->mergeCells('C5:K5'); // Set Merge Cell pada kolom C5 sampai K5
                    $excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(TRUE); // Set bold kolom C5
                    $excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(11); // Set font size 11 untuk kolom C5
                    $excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom C5
                    $excel->getActiveSheet()->getStyle('C5:K5')->applyFromArray($style_col);

                    $excel->setActiveSheetIndex(0)->setCellValue('A6', "Nama Dosen:"); // Set kolom A6 dengan tulisan "NAMA DOSEN"
                    $excel->getActiveSheet()->mergeCells('A6:B6'); // Set Merge Cell pada kolom A6 sampai B6
                    $excel->getActiveSheet()->getStyle('A6')->getFont()->setBold(TRUE); // Set bold kolom A6
                    $excel->getActiveSheet()->getStyle('A6')->getFont()->setSize(11); // Set font size 11 untuk kolom A6
                    $excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A6
                    $excel->getActiveSheet()->getStyle('A6:B6')->applyFromArray($style_col);

                    $excel->setActiveSheetIndex(0)->setCellValue('C6', $dosen_dr['nm_ptk']); // Set kolom C6 dengan tulisan "NAMA LENGAP DOSEN"
                    $excel->getActiveSheet()->mergeCells('C6:K6'); // Set Merge Cell pada kolom C6 sampai K6
                    $excel->getActiveSheet()->getStyle('C6')->getFont()->setBold(TRUE); // Set bold kolom C6
                    $excel->getActiveSheet()->getStyle('C6')->getFont()->setSize(11); // Set font size 11 untuk kolom C6
                    $excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom C6
                    $excel->getActiveSheet()->getStyle('C6:K7')->applyFromArray($style_col);

                    // Buat header tabel nya pada baris ke 7
                    $excel->setActiveSheetIndex(0)->setCellValue('A7', "NO"); // Set kolom A7 dengan tulisan "NO"
                    $excel->getActiveSheet()->mergeCells('A7:A8');
                    $excel->setActiveSheetIndex(0)->setCellValue('B7', "Tahun Akademik"); // Set kolom B7 dengan tulisan "TAHUN AKADEMIK"
                    $excel->getActiveSheet()->mergeCells('B7:B8');
                    $excel->setActiveSheetIndex(0)->setCellValue('C7', "Matakuliah"); // Set kolom C7 dengan tulisan "MATAKULIAH"
                    $excel->getActiveSheet()->mergeCells('C7:C8');
                    $excel->setActiveSheetIndex(0)->setCellValue('D7', "Kompetensi"); // Set kolom D7 dengan tulisan "KOMPETENSI"
                    $excel->getActiveSheet()->mergeCells('D7:D8');
                    $excel->setActiveSheetIndex(0)->setCellValue('E7', "Jumlah Pertayaan"); // Set kolom E7 dengan tulisan "JUMLAH PERTANYAAN"
                    $excel->getActiveSheet()->mergeCells('E7:E8');
                    $excel->getActiveSheet()->getStyle('E7:E8')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('F7', "Jumlah Bobot Jawaban"); // Set kolom F7 dengan tulisan "JUMLAH BOBOT JAWABAN"
                    $excel->getActiveSheet()->mergeCells('F7:F8');
                    $excel->getActiveSheet()->getStyle('F7:F8')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('G7', "Rata-rata per Kompetensi"); // Set kolom G7 dengan tulisan "RATA-RATA PER KOMPETENSI"
                    $excel->getActiveSheet()->mergeCells('G7:G8');
                    $excel->getActiveSheet()->getStyle('G7:G8')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('H7', "Kategori per Kompetensi"); // Set kolom H7 dengan tulisan "KATEGORI PER KOMPETENSI"
                    $excel->getActiveSheet()->mergeCells('H7:H8');
                    $excel->getActiveSheet()->getStyle('H7:H8')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('I7', "Rata-rata Keseluruhan"); // Set kolom I7 dengan tulisan "RATA-RATA KESELURUHAN"
                    $excel->getActiveSheet()->mergeCells('I7:I8');
                    $excel->getActiveSheet()->getStyle('I7:I8')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('J7', "Jumlah Responden"); // Set kolom J7 dengan tulisan "JUMLAH RESPONDEN"
                    $excel->getActiveSheet()->mergeCells('J7:J8');
                    $excel->getActiveSheet()->getStyle('J7:J8')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('K7', "Kategori"); // Set kolom K7 dengan tulisan "KATEGORI"
                    $excel->getActiveSheet()->mergeCells('K7:K8');


                    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
                    $excel->getActiveSheet()->getStyle('A7:A8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('B7:B8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('C7:C8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('D7:D8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('E7:E8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('F7:F8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('G7:G8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('H7:H8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('I7:I8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('J7:J8')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('K7:K8')->applyFromArray($style_col);

                    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
                    $numrow = 9; // Set baris pertama untuk isi tabel adalah baris ke 9  

                    foreach ($record as $data) { // Lakukan looping pada variabel siswa
                        $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['id_tahun']);
                        $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['nm_mk']);
                        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['kompetensi']);
                        $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['quest_count']);
                        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['jumlah']);
                        $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['rata_per_kompetensi']);
                        $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['kategori_per_komp']);
                        $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data['rata_keseluruhan']);
                        $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data['responden']);
                        $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data['kategori']);

                        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                        $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                        $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('c')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

                        $no++; // Tambah 1 setiap kali looping
                        $numrow++; // Tambah 1 setiap kali looping
                    }
                    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
                    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

                    // Set orientasi kertas jadi LANDSCAPE
                    $excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                    // Set judul file excel nya
                    // $excel->getActiveSheet(0)->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER DOSEN)"); //error
                    $excel->setActiveSheetIndex(0);

                    // Proses file excel
                    $write = new Xlsx($excel);
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment; filename="LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER DOSEN).xlsx"'); // Set nama file excel nya
                    header('Cache-Control: max-age=0');
                    $write->save('php://output');

                    //$this->load->view('kaprodi/excel_by_dosen_prev',$data);
                } else if ($tahun != '') {
                    $data['tahun'] = $tahun;
                    $jurusan = $this->db->select("nm_jur")->from("jurusan")->where(array('id_jur' => $id_jur))->get()->row_array();
                    $record2 = array();
                    $record2 = $this->M_download->get_one_filter_dospro_by_th_N($id_jur, $tahun)->result_array();
                    $rata_tahun = $this->M_download->get_rata_dospro_th($id_jur, $tahun)->row_array();

                    // Settingan awal fil excel
                    $excel->getProperties()->setCreator('My Notes Code')
                        ->setLastModifiedBy('My Notes Code')
                        ->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER TAHUN)")
                        ->setSubject("Dosen")
                        ->setDescription("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER TAHUN)")
                        ->setKeywords("Laporan Kinerja Dosen");

                    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
                    $style_col = array(
                        'font' => array('bold' => true), // Set font nya jadi bold

                        'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                        ),
                        'borders' => array(
                            'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                            'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                            'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                            'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                        )
                    );

                    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
                    $style_row = array(
                        'alignment' => array(
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                        ),
                        'borders' => array(
                            'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                            'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                            'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                            'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                        )
                    );

                    $excel->setActiveSheetIndex(0)->setCellValue('A2', "LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER TAHUN)"); // Set kolom A2 dengan tulisan "LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER TAHUN)"
                    $excel->getActiveSheet()->mergeCells('A2:J2'); // Set Merge Cell pada kolom A2 sampai J2
                    $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A2
                    $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 12 untuk kolom A2
                    $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A2

                    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Program Studi :" . $jurusan['nm_jur'] . ""); // Set kolom A3 dengan tulisan "PROGRAM STUDI"
                    $excel->getActiveSheet()->mergeCells('A3:J3'); // Set Merge Cell pada kolom A3 sampai J3
                    $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(FALSE); // Set bold kolom A3
                    $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12); // Set font size 12 untuk kolom A3
                    $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A3

                    $excel->setActiveSheetIndex(0)->setCellValue('A5', "Tahun Akademik:"); // Set kolom A5 dengan tulisan "TAHUN AKADEMIK"
                    $excel->getActiveSheet()->mergeCells('A5:B5'); // Set Merge Cell pada kolom A5 sampai B5
                    $excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(TRUE); // Set bold kolom A5
                    $excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(11); // Set font size 11 untuk kolom A5
                    $excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A5
                    $excel->getActiveSheet()->getStyle('A5:B5')->applyFromArray($style_col);

                    $excel->setActiveSheetIndex(0)->setCellValue('C5', $tahun); // Set kolom C5 dengan tulisan "TAHUN AKADEMIK"
                    $excel->getActiveSheet()->mergeCells('C5:L5'); // Set Merge Cell pada kolom C5 sampai L5
                    $excel->getActiveSheet()->getStyle('C5')->getFont()->setBold(TRUE); // Set bold kolom C5
                    $excel->getActiveSheet()->getStyle('C5')->getFont()->setSize(11); // Set font size 11 untuk kolom C5
                    $excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom C5
                    $excel->getActiveSheet()->getStyle('C5:L5')->applyFromArray($style_col);

                    // Buat header tabel nya pada baris ke 3
                    $excel->setActiveSheetIndex(0)->setCellValue('A6', "NO"); // Set kolom A6 dengan tulisan "NO"
                    $excel->getActiveSheet()->mergeCells('A6:A7');
                    $excel->setActiveSheetIndex(0)->setCellValue('B6', "NIDN"); // Set kolom B6 dengan tulisan "NIDN"
                    $excel->getActiveSheet()->mergeCells('B6:B7');
                    $excel->setActiveSheetIndex(0)->setCellValue('C6', "Nama Dosen"); // Set kolom C6 dengan tulisan "NAMA DOSEN"
                    $excel->getActiveSheet()->mergeCells('C6:C7');
                    $excel->getActiveSheet()->getStyle('C6:C7')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('D6', "Matakuliah"); // Set kolom D6 dengan tulisan "MATAKULIAH"
                    $excel->getActiveSheet()->mergeCells('D6:D7');
                    $excel->setActiveSheetIndex(0)->setCellValue('E6', "Kompetensi"); // Set kolom E6 dengan tulisan "KOMPETENSI"
                    $excel->getActiveSheet()->mergeCells('E6:E7');
                    $excel->setActiveSheetIndex(0)->setCellValue('F6', "Jumlah Pertanyaan"); // Set kolom F6 dengan tulisan "JUMLAH PERTANYAAN"
                    $excel->getActiveSheet()->mergeCells('F6:F7');
                    $excel->getActiveSheet()->getStyle('F6:F7')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('G6', "Jumlah Bobot Jawaban"); // Set kolom G6 dengan tulisan "JUMLAH BOBOT JAWABAN"
                    $excel->getActiveSheet()->mergeCells('G6:G7');
                    $excel->getActiveSheet()->getStyle('G6:G7')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('H6', "Rata-rata per Kompetensi"); // Set kolom H6 dengan tulisan "RATA-RATA PER KOMPETENSI"
                    $excel->getActiveSheet()->mergeCells('H6:H7');
                    $excel->getActiveSheet()->getStyle('H6:H7')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('I6', "Kategori per Kompetensi"); // Set kolom I6 dengan tulisan "KATEGORI PER KOMPETENSI"
                    $excel->getActiveSheet()->mergeCells('I6:I7');
                    $excel->getActiveSheet()->getStyle('I6:I7')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('J6', "Rata-rata Keseluruhan"); // Set kolom J6 dengan tulisan "RATA-RATA KESELURUHAN"
                    $excel->getActiveSheet()->mergeCells('J6:J7');
                    $excel->getActiveSheet()->getStyle('J6:J7')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('K6', "Jumlah Responden"); // Set kolom K6 dengan tulisan "JUMLAH RESPONDEN"
                    $excel->getActiveSheet()->mergeCells('K6:K7');
                    $excel->getActiveSheet()->getStyle('K6:K7')->getAlignment()->setWrapText(true);
                    $excel->setActiveSheetIndex(0)->setCellValue('L6', "Kategori"); // Set kolom L6 dengan tulisan "KATEGORI"
                    $excel->getActiveSheet()->mergeCells('L6:L7');


                    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
                    $excel->getActiveSheet()->getStyle('A6:A7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('B6:B7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('C6:C7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('D6:D7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('E6:E7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('F6:F7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('G6:G7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('H6:H7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('I6:I7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('J6:J7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('K6:K7')->applyFromArray($style_col);
                    $excel->getActiveSheet()->getStyle('L6:L7')->applyFromArray($style_col);

                    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
                    $numrow = 8; // Set baris pertama untuk isi tabel adalah baris ke 8   
                    foreach ($record2 as $data) { // Lakukan looping pada variabel DATA
                        $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['nidn']);
                        $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['nm_ptk']);
                        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['nm_mk']);
                        $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['kompetensi']);
                        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['quest_count']);
                        $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['jumlah']);
                        $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['rata_per_kompetensi']);
                        $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data['kategori_per_komp']);
                        $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data['rata_keseluruhan']);
                        $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data['responden']);
                        $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data['kategori']);

                        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                        $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                        $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('c')->setWidth(20);
                        $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                        $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
                        $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
                        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);

                        $no++; // Tambah 1 setiap kali looping
                        $numrow++; // Tambah 1 setiap kali looping
                    }
                    $numrow2 = $numrow + 1;

                    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, "Rata-rata Tahun Akademik " . $tahun . " :");
                    $excel->getActiveSheet()->mergeCells('A' . $numrow . ':I' . $numrow);
                    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow2, "Kategori :");
                    $excel->getActiveSheet()->mergeCells('A' . $numrow2 . ':I' . $numrow2);
                    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $rata_tahun['rata_rata']);
                    $excel->getActiveSheet()->mergeCells('J' . $numrow . ':L' . $numrow);
                    $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow2, $rata_tahun['kategori']);
                    $excel->getActiveSheet()->mergeCells('J' . $numrow2 . ':L' . $numrow2);
                    $excel->getActiveSheet()->getStyle('A' . $numrow . ':I' . $numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('J' . $numrow . ':L' . $numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('A' . $numrow2 . ':I' . $numrow2)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('J' . $numrow2 . ':L' . $numrow2)->applyFromArray($style_row);

                    //$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow2, $rata_tahun['kategori']);
                    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
                    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

                    // Set orientasi kertas jadi LANDSCAPE
                    $excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                    // Set judul file excel nya
                    // $excel->getActiveSheet(0)->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER TAHUN)");
                    $excel->setActiveSheetIndex(0);

                    // Proses file excel
                    $write = new Xlsx($excel);
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment; filename="LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER TAHUN).xlsx"'); // Set nama file excel nya
                    header('Cache-Control: max-age=0');
                    $write->save('php://output');

                    //$this->load->view('kaprodi/excel_by_th_prev',$data);
                }
            }
        }
    }

    function export_excel_lkm()
    {
        // Panggil class PHPExcel nya
        $excl = new Spreadsheet;;

        if ($this->session->userdata('status') != "login") {
            redirect(base_url());
        } else {
            if (isset($_POST['submit'])) {
                $tahun = $this->input->post('tahun');
                $jurusan = $this->input->post('jurusan');
                // $this->session->set_flashdata('jurusan', $jurusan);
                // $this->session->set_flashdata('tahun', $tahun);
                $data = array();
                $jur = $this->db->select("nm_jur")->from("jurusan")->where(array('id_jur' => $jurusan))->get()->row_array();
                $record = $this->M_download->get_one_filtered_dosen($jurusan, $tahun)->result_array();
                $sum_record = $this->M_download->get_one_filtered_dosen($jurusan, $tahun)->num_rows();
                $rata_tahun = $this->M_download->get_rata_dospro_th($jurusan, $tahun)->row_array();

                // Settingan awal fil excel
                $excl->getProperties()->setCreator('My Notes Code')
                    ->setLastModifiedBy('My Notes Code')
                    ->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER JURUSAN)")
                    ->setSubject("Jurusan")
                    ->setDescription("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER JURUSAN)")
                    ->setKeywords("Laporan Kinerja Dosen");

                // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
                $style_col = array(
                    'font' => array('bold' => true), // Set font nya jadi bold

                    'alignment' => array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                    ),
                    'borders' => array(
                        'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                        'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                        'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                        'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                    )
                );

                // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
                $style_row = array(
                    'alignment' => array(
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
                    ),
                    'borders' => array(
                        'top' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border top dengan garis tipis
                        'right' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN),  // Set border right dengan garis tipis
                        'bottom' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN), // Set border bottom dengan garis tipis
                        'left' => array('style'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN) // Set border left dengan garis tipis
                    )
                );

                $excl->setActiveSheetIndex(0)->setCellValue('A2', "LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER JURUSAN)");
                $excl->getActiveSheet()->mergeCells('A2:J2');
                $excl->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
                $excl->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
                $excl->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $excl->setActiveSheetIndex(0)->setCellValue('A3', "Program Studi :" . $jur['nm_jur'] . "");
                $excl->getActiveSheet()->mergeCells('A3:J3');
                $excl->getActiveSheet()->getStyle('A3')->getFont()->setBold(FALSE);
                $excl->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
                $excl->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $excl->setActiveSheetIndex(0)->setCellValue('A4', "Tahun :" . $tahun . "");
                $excl->getActiveSheet()->mergeCells('A4:J4');
                $excl->getActiveSheet()->getStyle('A4')->getFont()->setBold(FALSE);
                $excl->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
                $excl->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Buat header tabel nya pada baris ke 6
                $excl->setActiveSheetIndex(0)->setCellValue('A6', "NO");
                $excl->getActiveSheet()->mergeCells('A6:A7');
                $excl->setActiveSheetIndex(0)->setCellValue('B6', "NIDN");
                $excl->getActiveSheet()->mergeCells('B6:B7');
                $excl->setActiveSheetIndex(0)->setCellValue('C6', "Nama Dosen");
                $excl->getActiveSheet()->mergeCells('C6:C7');
                $excl->setActiveSheetIndex(0)->setCellValue('D6', "Matakuliah");
                $excl->getActiveSheet()->mergeCells('D6:D7');
                $excl->getActiveSheet()->getStyle('D6:D7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('E6', "Kompetensi");
                $excl->getActiveSheet()->mergeCells('E6:E7');
                $excl->getActiveSheet()->getStyle('E6:E7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('F6', "Jumlah pertanyaan");
                $excl->getActiveSheet()->mergeCells('F6:F7');
                $excl->getActiveSheet()->getStyle('F6:F7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('G6', "Jumlah bobot jawaban");
                $excl->getActiveSheet()->mergeCells('G6:G7');
                $excl->getActiveSheet()->getStyle('G6:G7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('H6', "Rata-rata per kompetensi");
                $excl->getActiveSheet()->mergeCells('H6:H7');
                $excl->getActiveSheet()->getStyle('H6:H7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('I6', "Kategori per kompetensi");
                $excl->getActiveSheet()->mergeCells('I6:I7');
                $excl->getActiveSheet()->getStyle('I6:I7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('J6', "Rata-rata keseluruhan");
                $excl->getActiveSheet()->mergeCells('J6:J7');
                $excl->getActiveSheet()->getStyle('J6:J7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('K6', "Kategori keseluruhan");
                $excl->getActiveSheet()->mergeCells('K6:K7');
                $excl->getActiveSheet()->getStyle('K6:K7')->getAlignment()->setWrapText(true);
                $excl->setActiveSheetIndex(0)->setCellValue('L6', "Jumlah responden");
                $excl->getActiveSheet()->mergeCells('L6:L7');
                $excl->getActiveSheet()->getStyle('L6:L7')->getAlignment()->setWrapText(true);


                // Apply style header yang telah kita buat tadi ke masing-masing kolom header
                $excl->getActiveSheet()->getStyle('A6:A7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('B6:B7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('C6:C7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('D6:D7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('E6:E7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('F6:F7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('G6:G7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('H6:H7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('I6:I7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('J6:J7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('K6:K7')->applyFromArray($style_col);
                $excl->getActiveSheet()->getStyle('L6:L7')->applyFromArray($style_col);

                $no = 1; // Untuk penomoran tabel, di awal set dengan 1
                $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 7  

                foreach ($record as $data) { // Lakukan looping pada variabel DATA
                    $excl->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                    $excl->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['nidn']);
                    $excl->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data['nm_ptk']);
                    $excl->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data['nm_mk']);
                    $excl->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data['kompetensi']);
                    $excl->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['jum_quest']);
                    $excl->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data['jumlah']);
                    $excl->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data['rata_per_kompetensi']);
                    $excl->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data['kategori_per_komp']);
                    $excl->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data['rata_keseluruhan']);
                    $excl->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $data['kategori']);
                    $excl->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $data['responden']);

                    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                    $excl->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $excl->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('c')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('D')->setWidth(50);
                    $excl->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('I')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('J')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('K')->setWidth(15);
                    $excl->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
                    $excl->getActiveSheet()->getColumnDimension('L')->setWidth(15);


                    $no++; // Tambah 1 setiap kali looping
                    $numrow++; // Tambah 1 setiap kali looping
                }

                $numrow2 = $numrow + 1;

                $excl->setActiveSheetIndex(0)->setCellValue('A' . $numrow, "Rata-rata Tahun Akademik " . $tahun . " :");
                $excl->getActiveSheet()->mergeCells('A' . $numrow . ':J' . $numrow);
                $excl->getActiveSheet()->getStyle('A' . $numrow . ':J' . $numrow)->getFont()->setBold(TRUE);
                $excl->setActiveSheetIndex(0)->setCellValue('A' . $numrow2, "Kategori :");
                $excl->getActiveSheet()->mergeCells('A' . $numrow2 . ':J' . $numrow2);
                $excl->getActiveSheet()->getStyle('A' . $numrow2 . ':J' . $numrow2)->getFont()->setBold(TRUE);
                $excl->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $rata_tahun['rata_rata']);
                $excl->getActiveSheet()->mergeCells('K' . $numrow . ':L' . $numrow);
                $excl->getActiveSheet()->getStyle('K' . $numrow . ':L' . $numrow)->getFont()->setBold(TRUE);
                $excl->setActiveSheetIndex(0)->setCellValue('K' . $numrow2, $rata_tahun['kategori']);
                $excl->getActiveSheet()->mergeCells('K' . $numrow2 . ':L' . $numrow2);
                $excl->getActiveSheet()->getStyle('K' . $numrow2 . ':L' . $numrow2)->getFont()->setBold(TRUE);
                $excl->getActiveSheet()->getStyle('A' . $numrow . ':J' . $numrow)->applyFromArray($style_row);
                $excl->getActiveSheet()->getStyle('K' . $numrow . ':L' . $numrow)->applyFromArray($style_row);
                $excl->getActiveSheet()->getStyle('A' . $numrow2 . ':J' . $numrow2)->applyFromArray($style_row);
                $excl->getActiveSheet()->getStyle('K' . $numrow2 . ':L' . $numrow2)->applyFromArray($style_row);
                // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
                $excl->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

                // Set orientasi kertas jadi LANDSCAPE
                $excl->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                // Set judul file excel nya
                // $excl->getActiveSheet(0)->setTitle("LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER JURUSAN)"); //error
                $excl->setActiveSheetIndex(0);

                // tulis file ke xlsx
                $write = new Xlsx($excl);
                // Proses file excel
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="LAPORAN HASIL PENILAIAN KINERJA DOSEN (PER JURUSAN).xlsx"'); // Set nama file excel nya
                header('Cache-Control: max-age=0');
                // $write = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excl, 'excel2007');
                $write->save('php://output');

                $this->load->view('LKM/excel_by_jr_prev', $data);
            }
        }
    }

    function test()
    {
        echo "TEST";
    }
}
