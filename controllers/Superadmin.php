<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include APPPATH . '/third_party/PHPExcel/IOFactory.php';
class Superadmin extends CI_Controller {

	var $setting = array();

	function __construct(){
		parent::__construct();
		$this->load->model('pegawai_model');
		$this->load->model('presensi_pegawai_model');
		$this->load->model('penilaian/presensi_siswa_model');
		$this->load->model('tahunajaran_model');
		$this->load->model('tanggal_libur_model');
		$this->load->model('tanggal_libur_nasional_model');
		$this->load->model('jabatan_model');
		$this->load->model('ppdb/model_pendaftar_ppdb');
		$this->load->model('ppdb/model_form_ppdb');
		$this->load->model('ppdb/model_ketentuan_ppdb');
		$this->load->model('ppdb/model_form_ujian');
		$this->load->model('ppdb/model_pengumuman_ppdb');
		$this->load->model('ppdb/model_tahunajaran');
		
		$this->load->model('ppdb/Model_siswa');
		$this->load->model('setting_model');
		$this->load->model('penjadwalan/mod_jammengajar');


		$this->load->helper('url');
		if ($this->session->userdata('isLogin') != TRUE) {
			$this->session->set_flashdata("warning",'<script> swal( "Maaf Anda Belum Login!" ,  "Silahkan Login Terlebih Dahulu" ,  "error" )</script>');
			redirect('login');
			exit;
		}
		if ($this->session->userdata('jabatan') != 'Superadmin') {
			$this->session->set_flashdata("warning",'<script> swal( "Anda Tidak Berhak!" ,  "Silahkan Login dengan Akun Anda" ,  "error" )</script>');
			//$this->load->view('login');
			redirect('login');
			exit;
		}
		$this->load->helper('setting_helper');
		$this->setting = get_setting();
	}


	public	function uploadPegawai(){
		$this->load->library('upload', [
			'allowed_types' => 'xls|xlsx',
			'upload_path' => './assets/Superadmin/importdatpeg'
		]);

		if ($this->upload->do_upload('file')) {
			$data = $this->upload->data();

			$inputFileName = $data['full_path'];
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

			$duplicates  = [];
			$errorFormat = false;
			foreach (array_slice($sheetData, 1) as $key => $item) {
				$NIP = $item['A'];

			    // Cek format dokumen
				if (empty($item['A'])) {
					$errorFormat = true;
					break;
				}

				if (is_null($NIP)) continue;

				$exist = $this->pegawai_model->rowPegawai($NIP);

				if (! is_null($exist)) {
					$duplicates[] = $NIP;
				} else {


					$data = [
						'NIP' => $item['A'],
						"nuptk" => $item['B'],
						'Nama' => $item['C'],
						'nama_panggilan	' => $item['D'],
						'No_SK' => $item['E'],
						'kode_guru	' => $item['F'],
						// 'matapelajaran	' => $item['G'],
						'Jenis_kelamin' => $item['H'],
						'Golongan' => $item['I'],
						'pangkat' => $item['J'],
						'tempatlahir' => $item['K'],
						'TTL' => $item['L'],
						'TMT_capeg	' => $item['M'],
						'pendidikan' => $item['N'],
						'Agama' => $item['O'],
						'kontak' => $item['P'],
						'Status' => $item['Q'],
						'alamat' => $item['R'],
						'foto' => null,
						'namaayah'=> $item['S'],
						'tempatlahirayah'=>$item['T'],
						'tanggallahirayah'=>$item['U'],
						'agamaayah'=>$item['V'],
						'nomorayah'=>$item['W'],
						'pekerjaanayah'=>$item['X'],
						'alamatayah'=>$item['Y'],

						'namaibu'=>$item['Z'],
						'tempatlahiribu'=>$item['AA'],
						'tanggallahiribu'=>$item['AB'],
						'agamaibu'=>$item['AC'],
						'nomoribu'=>$item['AD'],
						'pekerjaanibu'=>$item['AE'],
						'alamatibu'=>$item['AF']
// 'namaayah'=> null,
						// 'tempatlahirayah'=>null,
						// 'tanggallahirayah'=>null,
						// 'agamaayah'=>null,
						// 'nomorayah'=>null,
						// 'pekerjaanayah'=>null,
						// 'alamatayah'=>null,

						// 'namaibu'=>null,
						// 'tempatlahiribu'=>null,
						// 'tanggallahiribu'=>null,
						// 'agamaibu'=>null,
						// 'nomoribu'=>null,
						// 'pekerjaanibu'=>null,
						// 'alamatibu'=>null


						
					];

					$this->pegawai_model->insert($data);
					echo $this->db->last_query();
					echo "<br/>";
				}
			}

			if (count($duplicates) > 0) 
			{
				$NIP = json_encode($duplicates);
				// Hapus file yang sudah diupload
				
				$this->session->set_flashdata("status", "<script> swal( 'Maaf!' ,  'NIP Yang Anda Masukkan Sudah Ada :$NIP' ,  'error' )</script>");
			} elseif ($errorFormat) {
				$this->session->set_flashdata("status", "<script> swal( 'Maaf Format Tidak Sesuai!' ,  'Periksa Kembali Data Yang Anda Import' ,  'error' )</script>");
			} else {
				$this->session->set_flashdata("status", "<script>swal('Berhasil!', 'Import Data Telah Berhasil ', 'success')</script>");
			}
		} else {
			$this->session->set_flashdata("status","<script> swal( 'Maaf!' ,  'Data Gagal Di Upload' ,  'error' )</script>");
		}
		@unlink('./assets/Superadmin/importdatpeg/'.$data['file_name']);
		// var_dump($this->session->flashdata('status')); exit;
		redirect('superadmin/pegawaibaru');
	}

	public function importdatpeg()
	{
		

		$this->load->view('superadmin/importdatpeg');
	}

	public function index()
	{

		
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$datpeg = $this->pegawai_model->Getdatpeg("Status_pensiun = '' OR Status_pensiun IS NULL");
		$data['datpeg'] = $datpeg;
		//$thn = date('Y');
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }
		$tgl = date('Y-m-d');
		if ($this->input->post('tgl') != "") { $tgl = $this->input->post('tgl'); }
		
		$datsemester = $this->tahunajaran_model->Getsemester();
		//print_r($datsemester);
		//print_r($datpeg->result());

		$tablepeg = $datpeg->result();
		foreach ($tablepeg as $rowpeg) {
			$datpresensi = $this->presensi_pegawai_model->getpresensi($tgl, $rowpeg->NIP);
			//echo $this->db->last_query()."<br/>";
			if ($datpresensi) {
				//echo $rowpeg->NIP."===<br/>";
				$data['presensipeg'][$rowpeg->NIP] = $datpresensi->Rangkuman_presensi;
				$data['waktupeg'][$rowpeg->NIP] = $datpresensi->Waktu_presensi;
				$data['keteranganpeg'][$rowpeg->NIP] = $datpresensi->keterangan_presensi;
			}

			//for($i=1;$i<=date('t');$i++) {
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
				//echo $rowpeg->NIP."<br/>";
				//$datpresensi = $this->presensi_pegawai_model->getpresensi(date('Y-m-').substr($i+100, 1, 2), $rowpeg->NIP);
				$datpresensi = $this->presensi_pegawai_model->getpresensi($thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowpeg->NIP);
				//echo $this->db->last_query()."<br/>";
				if ($datpresensi) {
					//echo $rowpeg->NIP."===<br/>";
					$data['datpresensi'][$rowpeg->NIP][$i] = $datpresensi->Rangkuman_presensi;
					$data['datwaktu'][$rowpeg->NIP][$i] = $datpresensi->Waktu_presensi;
				}
			}
			for ($i=1;$i<=12;$i++) {
				
				$data['datpresensibulan'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'H')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'S')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'I')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'A')->jml;
			}

			for ($i=1;$i<=2;$i++) {
				
				$data['datpresensisemester'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'H')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'S')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'I')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'A')->jml;
			}

		}

		for ($i=1;$i<=12;$i++) {
			
			$data['datpresensitotalbulan'][$i]['H'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'H')->jml;
			$data['datpresensitotalbulan'][$i]['S'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'S')->jml;
			$data['datpresensitotalbulan'][$i]['I'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'I')->jml;
			$data['datpresensitotalbulan'][$i]['A'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'A')->jml;

			$data['datpresensitotal'][$i] = @$this->presensi_pegawai_model->getpresensitotal($i, $thn)->jml;
			
		}

		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
			$datlibur = $this->tanggal_libur_model->getlibur($thn.'-'.substr($bln+100, 1, 2).'-'.substr($i+100, 1, 2));
			if ($datlibur) {
				$data['datlibur'][$i] = $datlibur->nama_libur;
			} else {
				$data['datlibur'][$i] = "";
			}

			$datliburnasional = $this->tanggal_libur_nasional_model->getlibur($i, $bln);
			if ($datliburnasional) {
				$data['datlibur'][$i] = $data['datlibur'][$i]." ".$datliburnasional->nama_libur_nasional;
			} 
			//echo $data['datlibur'][$i]."<br/>";
			//echo $this->db->last_query()."<br/>";
		}
		$this->load->model('pegawai_model');      
		$usersNo =  $this->pegawai_model->gettotaluser();   
		$data['totaluser'] = $usersNo->no - $usersNo->ps;
		$data['totaluserlk'] = $usersNo->lk;
		$data['totaluserpr'] = $usersNo->pr;
		$data['totaluserps'] = $usersNo->ps;

		$usersJabatan= $this->pegawai_model->gettotaljabatan();
		$data['totaljabatan'] = $usersJabatan->no - $usersNo->ps ;

		$userstanpaJabatan= $this->pegawai_model->gettotaltanpajabatan();
		$data['totaltanpajabatan'] = $userstanpaJabatan->no;

		$total_sma= $this->pegawai_model->getjumlahpendidikan('SMA')->jml;
		$total_d3= $this->pegawai_model->getjumlahpendidikan('D3')->jml;
		$total_s1= $this->pegawai_model->getjumlahpendidikan('S1')->jml;
		$total_s2= $this->pegawai_model->getjumlahpendidikan('S2')->jml;
		$total_s3= $this->pegawai_model->getjumlahpendidikan('S3')->jml;
		$data['total_sma'] = $total_sma;
		$data['total_d3'] = $total_d3;
		$data['total_s1'] = $total_s1;
		$data['total_s2'] = $total_s2;
		$data['total_s3'] = $total_s3;
		
		$belumakanpensiun= $this->pegawai_model->getjumlahbelumakanpensiun();
		$sudahakanpensiun= $this->pegawai_model->getjumlahsudahakanpensiun();
		$data['belumakanpensiun'] = $belumakanpensiun;
		$data['sudahakanpensiun'] = $sudahakanpensiun;
 

		$pegawai_20_30= $this->pegawai_model->getjmlpegawaiumur(20, 30);
		$pegawai_31_40= $this->pegawai_model->getjmlpegawaiumur(31, 40);
		$pegawai_41_50= $this->pegawai_model->getjmlpegawaiumur(41, 50);
		$pegawai_51_60= $this->pegawai_model->getjmlpegawaiumur(51, 60);
		$data['pegawai_20_30'] = $pegawai_20_30;
		$data['pegawai_31_40'] = $pegawai_31_40;
		$data['pegawai_41_50'] = $pegawai_41_50;
		$data['pegawai_51_60'] = $pegawai_51_60;

		$data['grafikpresensipegawai'] = TRUE;
		$data['persentase'] = TRUE;
		$data['grafikusia'] = TRUE;
		$data['grafikpendidikan'] = TRUE;
		$data['grafikpensiun'] = TRUE;
		$data['rekap'] = TRUE;
		// $data['persentase'] = TRUE;


		$this->pegawai_model->otomatispensiun();

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		
		$data['datpeg'] = $this->pegawai_model->Getdatpeg();
		$this->template->load('superadmin/dashboard','superadmin/home', $data);
	}

	public function grafikusia()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		
		$data['umur20ke30'] = $this->pegawai_model->getpegawaiumur(20,30);
		$data['umur31ke40'] = $this->pegawai_model->getpegawaiumur(31,40);
		$data['umur41ke50'] = $this->pegawai_model->getpegawaiumur(41,50);
		$data['umur51ke60'] = $this->pegawai_model->getpegawaiumur(51,60);
		$this->template->load('superadmin/dashboard','superadmin/grafikusia', $data);
	}

	

	public function grafikpendidikan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		
		$data['sma'] = $this->pegawai_model->getbypendidikan("SMA");
		$data['d3'] = $this->pegawai_model->getbypendidikan("D3");
		$data['s1'] = $this->pegawai_model->getbypendidikan("S1");
		$data['s2'] = $this->pegawai_model->getbypendidikan("S2");
		$data['s3'] = $this->pegawai_model->getbypendidikan("S3");
		$this->template->load('superadmin/dashboard','superadmin/grafikpendidikan', $data);
	}

	public function grafikpensiun()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		
		$data['belum'] = $this->pegawai_model->getbybelumakanpensiun();
		$data['sudah'] = $this->pegawai_model->getbysudahakanpensiun();
		
		$this->template->load('superadmin/dashboard','superadmin/grafikpensiun', $data);
	}





	public function profile()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$data['datpeg'] = $this->pegawai_model->rowPegawai($this->session->userdata('NIP'));
		$this->template->load('superadmin/dashboard','pegawai/profile', $data);
	}


	public function editprofil(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$data['rowpeg'] = $this->pegawai_model->rowPegawai($this->session->userdata('NIP'));
		$this->template->load('superadmin/dashboard','superadmin/editprofil', $data);
		if($this->input->post('submit')){
			$this->load->model('pegawai_model');
			$this->pegawai_model->updatedatpeg();	
			$this->session->set_flashdata('warning',"<script>swal('Berhasil!', 'Data Berhasil Disimpan','success')</script>");	
			redirect("superadmin/profile");
		} 
	}

// KEPEGAWAIAN RIDHO

// home
	public function homelihatjabatan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['datajabatan'] = $this->pegawai_model->Getjabatan();
		$this->template->load('superadmin/dashboard','superadmin/home_lihatjabatan', $data);
	}

	public function hometanpajabatan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['datatanpajabatan'] = $this->pegawai_model->GetTanpaJabatan();
		$this->template->load('superadmin/dashboard','superadmin/home_lihattanpajabatan', $data);
	}

	public function homedatapegawai()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datpegtot'] = $this->pegawai_model->Getdatpeg("Status_pensiun = '' OR Status_pensiun IS NULL");
		$this->template->load('superadmin/dashboard','superadmin/home_lihatdatapegawai', $data);
	}

	public function homedataguru()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datpeguru'] = $this->pegawai_model->Getdatpeg("Status = 'Guru' OR (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$this->template->load('superadmin/dashboard','superadmin/home_lihatdataguru', $data);
	}

	public function homedatapensiun()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datpegpensiun'] = $this->pegawai_model->Getdatpeg("Status_pensiun = 'Pensiun' OR Status_pensiun = 'Keluar' ");
		$this->template->load('superadmin/dashboard','superadmin/home_lihatdatapensiun', $data);
	}

	public function homedatakaryawan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datpegkaryawan'] = $this->pegawai_model->Getdatpeg("Status = 'Karyawan' AND (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$this->template->load('superadmin/dashboard','superadmin/home_lihatdatakaryawan', $data);
	}
// tutup home

	public function pegawaibaru()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datpeg'] = $this->pegawai_model->Getdatpeg("Status = 'Karyawan' AND (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$data['datguru'] = $this->pegawai_model->Getdatpeg("Status = 'Guru' AND (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$data['datpensiun'] = $this->pegawai_model->Getdatpeg("Status_pensiun = 'Pensiun' OR Status_pensiun = 'Keluar' ");
		$this->template->load('superadmin/dashboard','superadmin/pegawaibaru', $data);
	}

	public function printpegawaibaru()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datpeg'] = $this->pegawai_model->Getdatpeg("Status = 'Karyawan' AND (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$data['datguru'] = $this->pegawai_model->Getdatpeg("Status = 'Guru' AND (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$data['datpensiun'] = $this->pegawai_model->Getdatpeg("Status_pensiun = 'Pensiun' OR Status_pensiun = 'Keluar' ");
		$this->template->load('superadmin/dashboard','superadmin/printpegawaibaru', $data);
	}


	public function detailspegawai($id)
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datpeg'] = $this->pegawai_model->rowPegawai($id);
		$this->template->load('superadmin/dashboard','superadmin/detailspegawai', $data);
	}

	public function jabatan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['datajabatan'] = $this->pegawai_model->Getjabatan();
		$data['datatanpajabatan'] = $this->pegawai_model->GetTanpaJabatan();
		$data['jenisjabatan'] = $this->jabatan_model->get();

		$this->template->load('superadmin/dashboard','superadmin/jabatan', $data);
	}

	public function editjabatan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['datjab'] = $this->pegawai_model->getjab();
		$data['rowpeg'] = $this->pegawai_model->rowPegawaiJabatan($this->uri->segment(3));
		$this->template->load('superadmin/dashboard','superadmin/editjabatan', $data);
	}

	public function editjenisjabatan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['rowjab'] = $this->jabatan_model->select($this->uri->segment(3));
		$this->template->load('superadmin/dashboard','superadmin/editjenisjabatan', $data);
	}

	public function updatejab() {
		$this->load->model('akun_model');
		$cek = $this->akun_model->selectakun($this->input->post('NIP'));
		print_r($cek);
		if ($cek) {
			$data = array(
				"id_jabatan" => $this->input->post('id_jabatan'),
				"password" => $this->input->post('password')
			);
			$this->akun_model->update($data, $cek->id_akun);
		} else {
			$data = array(
				"id_jabatan" => $this->input->post('id_jabatan'),
				"NIP" => $this->input->post('NIP'),
				"password" => $this->input->post('password')
			);
			$this->akun_model->insert($data);
		}
		//$this->pegawai_model->updatedatpeg();		
		redirect("superadmin/jabatan");
		//jika sdh ada akun maka update
		//jika belum ada akun maka insert 
	}

	public function setjabatan() {

		$this->load->model('akun_model');
		$this->load->model('pegawai_model');
		$peg = $this->pegawai_model->getsetjab();
		//print_r($peg);

		foreach ($peg as $rowpeg) {			
			//$cek = $this->akun_model->selectakun($rowpeg->NIP);
			//print_r($cek);
			//if ($cek) {
				// $data = array(
				// 	"id_jabatan" => $this->input->post('id_jabatan'),
				// 	"password" => $this->input->post('password')
				// );
				// $this->akun_model->update($data, $cek->id_akun);
			//} else {
			if ($rowpeg->id_jabatan == "") {
				$data = array(
					"id_jabatan" => 4,
					"NIP" => $rowpeg->NIP,
					"password" => $rowpeg->NIP
				);
				//print_r($data);
				$this->akun_model->insert($data);
			}
			//}
		}
		//$this->pegawai_model->updatedatpeg();		
		redirect("superadmin/jabatan");
		//jika sdh ada akun maka update
		//jika belum ada akun maka insert 
	}

	public function updatejenisjab() {
		$this->load->model('jabatan_model');
		$menuakses = implode(",", $this->input->post("menuakses"));
		$data = array(
			"nama_jabatan" => $this->input->post('nama_jabatan'),
			// "url" => $this->input->post('url'),
				"menuakses" => $menuakses //$this->input->post('menuakses')
			);
		$this->jabatan_model->update($data, $this->input->post('id_jabatan'));
		
		//$this->pegawai_model->updatedatpeg();		
		redirect("superadmin/jabatan");
		//jika sdh ada akun maka update
		//jika belum ada akun maka insert 
	}

	public function presensipegawai()
	{
		

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$datpeg = $this->pegawai_model->Getdatpeg("Status_pensiun = '' OR Status_pensiun IS NULL");
		$data['datpeg'] = $datpeg;
		//$thn = date('Y');
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }
		$tgl = date('Y-m-d');
		if ($this->input->post('tgl') != "") { $tgl = $this->input->post('tgl'); }
		
		$datsemester = $this->tahunajaran_model->Getsemester();
		//print_r($datsemester);
		//print_r($datpeg->result());

		$tablepeg = $datpeg->result();
		foreach ($tablepeg as $rowpeg) {
			$datpresensi = $this->presensi_pegawai_model->getpresensi($tgl, $rowpeg->NIP);
			//echo $this->db->last_query()."<br/>";
			if ($datpresensi) {
				//echo $rowpeg->NIP."===<br/>";
				$data['presensipeg'][$rowpeg->NIP] = $datpresensi->Rangkuman_presensi;
				$data['waktupeg'][$rowpeg->NIP] = $datpresensi->Waktu_presensi;
				$data['keteranganpeg'][$rowpeg->NIP] = $datpresensi->keterangan_presensi;
			}

			//for($i=1;$i<=date('t');$i++) {
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
				//echo $rowpeg->NIP."<br/>";
				//$datpresensi = $this->presensi_pegawai_model->getpresensi(date('Y-m-').substr($i+100, 1, 2), $rowpeg->NIP);
				$datpresensi = $this->presensi_pegawai_model->getpresensi($thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowpeg->NIP);
				//echo $this->db->last_query()."<br/>";
				if ($datpresensi) {
					//echo $rowpeg->NIP."===<br/>";
					$data['datpresensi'][$rowpeg->NIP][$i] = $datpresensi->Rangkuman_presensi;
					$data['datwaktu'][$rowpeg->NIP][$i] = $datpresensi->Waktu_presensi;
				}
			}
			for ($i=1;$i<=12;$i++) {
				
				$data['datpresensibulan'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'H')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'S')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'I')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'A')->jml;
			}

			for ($i=1;$i<=2;$i++) {
				
				$data['datpresensisemester'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'H')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'S')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'I')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'A')->jml;
			}

		}

		for ($i=1;$i<=12;$i++) {
			
			$data['datpresensitotalbulan'][$i]['H'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'H')->jml;
			$data['datpresensitotalbulan'][$i]['S'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'S')->jml;
			$data['datpresensitotalbulan'][$i]['I'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'I')->jml;
			$data['datpresensitotalbulan'][$i]['A'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'A')->jml;

			$data['datpresensitotal'][$i] = @$this->presensi_pegawai_model->getpresensitotal($i, $thn)->jml;
			
		}

		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
			$datlibur = $this->tanggal_libur_model->getlibur($thn.'-'.substr($bln+100, 1, 2).'-'.substr($i+100, 1, 2));
			if ($datlibur) {
				$data['datlibur'][$i] = $datlibur->nama_libur;
			} else {
				$data['datlibur'][$i] = "";
			}

			$datliburnasional = $this->tanggal_libur_nasional_model->getlibur($i, $bln);
			if ($datliburnasional) {
				$data['datlibur'][$i] = $data['datlibur'][$i]." ".$datliburnasional->nama_libur_nasional;
			} 
			//echo $data['datlibur'][$i]."<br/>";
			//echo $this->db->last_query()."<br/>";
		}

		$data['grafikpresensipegawai'] = TRUE;
		
		$this->template->load('superadmin/dashboard','superadmin/presensipegawai', $data);
	}

	public function printlihatpresensipegawai()
	{
		

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$datpeg = $this->pegawai_model->Getdatpeg("Status_pensiun = '' OR Status_pensiun IS NULL");
		$data['datpeg'] = $datpeg;
		//$thn = date('Y');
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }
		$tgl = date('Y-m-d');
		if ($this->input->post('tgl') != "") { $tgl = $this->input->post('tgl'); }
		
		$datsemester = $this->tahunajaran_model->Getsemester();
		//print_r($datsemester);
		//print_r($datpeg->result());

		$tablepeg = $datpeg->result();
		foreach ($tablepeg as $rowpeg) {
			$datpresensi = $this->presensi_pegawai_model->getpresensi($tgl, $rowpeg->NIP);
			//echo $this->db->last_query()."<br/>";
			if ($datpresensi) {
				//echo $rowpeg->NIP."===<br/>";
				$data['presensipeg'][$rowpeg->NIP] = $datpresensi->Rangkuman_presensi;
				$data['waktupeg'][$rowpeg->NIP] = $datpresensi->Waktu_presensi;
				$data['keteranganpeg'][$rowpeg->NIP] = $datpresensi->keterangan_presensi;
			}

			//for($i=1;$i<=date('t');$i++) {
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
				//echo $rowpeg->NIP."<br/>";
				//$datpresensi = $this->presensi_pegawai_model->getpresensi(date('Y-m-').substr($i+100, 1, 2), $rowpeg->NIP);
				$datpresensi = $this->presensi_pegawai_model->getpresensi($thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowpeg->NIP);
				//echo $this->db->last_query()."<br/>";
				if ($datpresensi) {
					//echo $rowpeg->NIP."===<br/>";
					$data['datpresensi'][$rowpeg->NIP][$i] = $datpresensi->Rangkuman_presensi;
					$data['datwaktu'][$rowpeg->NIP][$i] = $datpresensi->Waktu_presensi;
				}
			}
			for ($i=1;$i<=12;$i++) {
				
				$data['datpresensibulan'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'H')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'S')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'I')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'A')->jml;
			}

			for ($i=1;$i<=2;$i++) {
				
				$data['datpresensisemester'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'H')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'S')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'I')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'A')->jml;
			}

		}

		for ($i=1;$i<=12;$i++) {
			
			$data['datpresensitotalbulan'][$i]['H'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'H')->jml;
			$data['datpresensitotalbulan'][$i]['S'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'S')->jml;
			$data['datpresensitotalbulan'][$i]['I'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'I')->jml;
			$data['datpresensitotalbulan'][$i]['A'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'A')->jml;
		}

		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
			$datlibur = $this->tanggal_libur_model->getlibur($thn.'-'.substr($bln+100, 1, 2).'-'.substr($i+100, 1, 2));
			if ($datlibur) {
				$data['datlibur'][$i] = $datlibur->nama_libur;
			} else {
				$data['datlibur'][$i] = "";
			}

			$datliburnasional = $this->tanggal_libur_nasional_model->getlibur($i, $bln);
			if ($datliburnasional) {
				$data['datlibur'][$i] = $data['datlibur'][$i]." ".$datliburnasional->nama_libur_nasional;
			} 
			//echo $data['datlibur'][$i]."<br/>";
			//echo $this->db->last_query()."<br/>";
		}

		$data['grafikpresensipegawai'] = TRUE;
		
		$this->template->load('superadmin/dashboard','superadmin/printlihatpresensipegawai', $data);
	}


	public function printpresensipegawaibulan()
	{
		

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$datpeg = $this->pegawai_model->Getdatpeg("Status_pensiun = '' OR Status_pensiun IS NULL");
		$data['datpeg'] = $datpeg;
		//$thn = date('Y');
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }
		$tgl = date('Y-m-d');
		if ($this->input->post('tgl') != "") { $tgl = $this->input->post('tgl'); }
		
		$datsemester = $this->tahunajaran_model->Getsemester();
		//print_r($datsemester);
		//print_r($datpeg->result());

		$tablepeg = $datpeg->result();
		foreach ($tablepeg as $rowpeg) {
			$datpresensi = $this->presensi_pegawai_model->getpresensi($tgl, $rowpeg->NIP);
			//echo $this->db->last_query()."<br/>";
			if ($datpresensi) {
				//echo $rowpeg->NIP."===<br/>";
				$data['presensipeg'][$rowpeg->NIP] = $datpresensi->Rangkuman_presensi;
				$data['waktupeg'][$rowpeg->NIP] = $datpresensi->Waktu_presensi;
				$data['keteranganpeg'][$rowpeg->NIP] = $datpresensi->keterangan_presensi;
			}

			//for($i=1;$i<=date('t');$i++) {
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
				//echo $rowpeg->NIP."<br/>";
				//$datpresensi = $this->presensi_pegawai_model->getpresensi(date('Y-m-').substr($i+100, 1, 2), $rowpeg->NIP);
				$datpresensi = $this->presensi_pegawai_model->getpresensi($thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowpeg->NIP);
				//echo $this->db->last_query()."<br/>";
				if ($datpresensi) {
					//echo $rowpeg->NIP."===<br/>";
					$data['datpresensi'][$rowpeg->NIP][$i] = $datpresensi->Rangkuman_presensi;
					$data['datwaktu'][$rowpeg->NIP][$i] = $datpresensi->Waktu_presensi;
				}
			}
			for ($i=1;$i<=12;$i++) {
				
				$data['datpresensibulan'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'H')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'S')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'I')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'A')->jml;
			}

			for ($i=1;$i<=2;$i++) {
				
				$data['datpresensisemester'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'H')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'S')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'I')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'A')->jml;
			}

		}

		for ($i=1;$i<=12;$i++) {
			
			$data['datpresensitotalbulan'][$i]['H'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'H')->jml;
			$data['datpresensitotalbulan'][$i]['S'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'S')->jml;
			$data['datpresensitotalbulan'][$i]['I'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'I')->jml;
			$data['datpresensitotalbulan'][$i]['A'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'A')->jml;
		}

		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
			$datlibur = $this->tanggal_libur_model->getlibur($thn.'-'.substr($bln+100, 1, 2).'-'.substr($i+100, 1, 2));
			if ($datlibur) {
				$data['datlibur'][$i] = $datlibur->nama_libur;
			} else {
				$data['datlibur'][$i] = "";
			}

			$datliburnasional = $this->tanggal_libur_nasional_model->getlibur($i, $bln);
			if ($datliburnasional) {
				$data['datlibur'][$i] = $data['datlibur'][$i]." ".$datliburnasional->nama_libur_nasional;
			} 
			//echo $data['datlibur'][$i]."<br/>";
			//echo $this->db->last_query()."<br/>";
		}

		$data['grafikpresensipegawai'] = TRUE;
		
		$this->template->load('superadmin/dashboard','superadmin/printpresensipegawaibulan', $data);
	}




	public function homeresumepresensi()
	{
		

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$datpeg = $this->pegawai_model->Getdatpeg("Status_pensiun = '' OR Status_pensiun IS NULL");
		$data['datpeg'] = $datpeg;
		//$thn = date('Y');
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }
		$tgl = date('Y-m-d');
		if ($this->input->post('tgl') != "") { $tgl = $this->input->post('tgl'); }
		
		$datsemester = $this->tahunajaran_model->Getsemester();
		//print_r($datsemester);
		//print_r($datpeg->result());

		$tablepeg = $datpeg->result();
		foreach ($tablepeg as $rowpeg) {
			$datpresensi = $this->presensi_pegawai_model->getpresensi($tgl, $rowpeg->NIP);
			//echo $this->db->last_query()."<br/>";
			if ($datpresensi) {
				//echo $rowpeg->NIP."===<br/>";
				$data['presensipeg'][$rowpeg->NIP] = $datpresensi->Rangkuman_presensi;
				$data['waktupeg'][$rowpeg->NIP] = $datpresensi->Waktu_presensi;
				$data['keteranganpeg'][$rowpeg->NIP] = $datpresensi->keterangan_presensi;
			}

			//for($i=1;$i<=date('t');$i++) {
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
				//echo $rowpeg->NIP."<br/>";
				//$datpresensi = $this->presensi_pegawai_model->getpresensi(date('Y-m-').substr($i+100, 1, 2), $rowpeg->NIP);
				$datpresensi = $this->presensi_pegawai_model->getpresensi($thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowpeg->NIP);
				//echo $this->db->last_query()."<br/>";
				if ($datpresensi) {
					//echo $rowpeg->NIP."===<br/>";
					$data['datpresensi'][$rowpeg->NIP][$i] = $datpresensi->Rangkuman_presensi;
					$data['datwaktu'][$rowpeg->NIP][$i] = $datpresensi->Waktu_presensi;
				}
			}
			for ($i=1;$i<=12;$i++) {
				
				$data['datpresensibulan'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'H')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'S')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'I')->jml;
				$data['datpresensibulan'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensibulan($i, $thn, $rowpeg->NIP, 'A')->jml;
			}

			for ($i=1;$i<=2;$i++) {
				
				$data['datpresensisemester'][$rowpeg->NIP][$i]['H'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'H')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['S'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'S')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['I'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'I')->jml;
				$data['datpresensisemester'][$rowpeg->NIP][$i]['A'] = @$this->presensi_pegawai_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowpeg->NIP, 'A')->jml;
			}

		}

		for ($i=1;$i<=12;$i++) {
			
			$data['datpresensitotalbulan'][$i]['H'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'H')->jml;
			$data['datpresensitotalbulan'][$i]['S'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'S')->jml;
			$data['datpresensitotalbulan'][$i]['I'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'I')->jml;
			$data['datpresensitotalbulan'][$i]['A'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'A')->jml;
		}

		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
			$datlibur = $this->tanggal_libur_model->getlibur($thn.'-'.substr($bln+100, 1, 2).'-'.substr($i+100, 1, 2));
			if ($datlibur) {
				$data['datlibur'][$i] = $datlibur->nama_libur;
			} else {
				$data['datlibur'][$i] = "";
			}

			$datliburnasional = $this->tanggal_libur_nasional_model->getlibur($i, $bln);
			if ($datliburnasional) {
				$data['datlibur'][$i] = $data['datlibur'][$i]." ".$datliburnasional->nama_libur_nasional;
			} 
			//echo $data['datlibur'][$i]."<br/>";
			//echo $this->db->last_query()."<br/>";
		}

		//$data['grafikpresensipegawai'] = TRUE;
		
		$this->template->load('superadmin/dashboard','superadmin/homeresumepresensi', $data);
	}

	public function resumepresensipegawai($nip, $thn, $bln)
	{
		

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
	
		
		$data['datpresensi'] = $this->presensi_pegawai_model->getresumepresensi($nip, $thn, $bln);
	
		$this->template->load('superadmin/dashboard','superadmin/resumepresensipegawai', $data);
	}

	public function rekapkehadiran()
	{
		

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 

		$tahun_ajaran = $this->tahunajaran_model->Gettahunajaran(array())->result();
		$data['tahun_ajaran'] = $tahun_ajaran;
		
		$row_aktif = $this->tahunajaran_model->gettahunajaranaktif();
	
		$id_tahun_ajaran = $this->input->post('id_tahun_ajaran');

		if ($id_tahun_ajaran == "") { $id_tahun_ajaran = $row_aktif->id_tahun_ajaran; }

		$data['id_tahun_ajaran'] = $id_tahun_ajaran;

		$row_tahun_ajaran = $this->tahunajaran_model->Gettahunajaran(array('tahunajaran.id_tahun_ajaran'=>$id_tahun_ajaran))->row();
		$data['nama_tahun_ajaran'] = "Semester ".$row_tahun_ajaran->semester." ".$row_tahun_ajaran->tahun_ajaran;
		

		$nip = $this->session->userdata('NIP');
		$datpeg = $this->pegawai_model->Getdatpeg("Status_pensiun = '' OR Status_pensiun IS NULL");
		$data['datpeg'] = $datpeg;
		//$thn = date('Y');
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }
		$tgl = date('Y-m-d');
		if ($this->input->post('tgl') != "") { $tgl = $this->input->post('tgl'); }
		
		
		$data['datpresensitotaltanggal']['H'] = @$this->presensi_pegawai_model->getpresensitanggal($nip, $row_tahun_ajaran->tanggal_mulai, $row_tahun_ajaran->tanggal_selesai, 'H')->jml;
		$data['datpresensitotaltanggal']['S'] = @$this->presensi_pegawai_model->getpresensitanggal($nip, $row_tahun_ajaran->tanggal_mulai, $row_tahun_ajaran->tanggal_selesai, 'S')->jml;
		$data['datpresensitotaltanggal']['I'] = @$this->presensi_pegawai_model->getpresensitanggal($nip, $row_tahun_ajaran->tanggal_mulai, $row_tahun_ajaran->tanggal_selesai, 'I')->jml;
		$data['datpresensitotaltanggal']['A'] = @$this->presensi_pegawai_model->getpresensitanggal($nip, $row_tahun_ajaran->tanggal_mulai, $row_tahun_ajaran->tanggal_selesai, 'A')->jml;

		$data['datpresensitotal'] = @$this->presensi_pegawai_model->getpresensitotaltanggal($nip, $row_tahun_ajaran->tanggal_mulai, $row_tahun_ajaran->tanggal_selesai)->jml;

		// for ($i=1;$i<=12;$i++) {
			
		// 	$data['datpresensitotalbulan'][$i]['H'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'H')->jml;
		// 	$data['datpresensitotalbulan'][$i]['S'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'S')->jml;
		// 	$data['datpresensitotalbulan'][$i]['I'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'I')->jml;
		// 	$data['datpresensitotalbulan'][$i]['A'] = @$this->presensi_pegawai_model->getpresensitotalbulan($i, $thn, 'A')->jml;
		// }



		$data['grafikpresensipegawai'] = TRUE;
		//$data['datpresensi'] = $this->presensi_pegawai_model->getresumepresensitahun($nip, $thn);
		$data['datpresensi'] = $this->presensi_pegawai_model->getresumepresensitahunajaran($nip, $row_tahun_ajaran->tanggal_mulai, $row_tahun_ajaran->tanggal_selesai);
		$this->template->load('superadmin/dashboard','superadmin/rekapkehadiran', $data);
	}

	public function resumepresensipegawaisemester($tanggal_mulai, $tanggal_selesai, $nip)
	{
		

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
	
		
		$data['datpresensisemester'] = $this->presensi_pegawai_model->getresumepresensisemester($tanggal_mulai, $tanggal_selesai, $nip);
	
		$this->template->load('superadmin/dashboard','superadmin/resumepresensipegawaisemester', $data);
	}

	
	public function submitpresensipegawai(){
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }
		$tgl = date('Y-m-d');
		if ($this->input->post('tgl') != "") { $tgl = $this->input->post('tgl'); }
		

		$datpeg = $this->pegawai_model->Getdatpeg();
		foreach ($datpeg->result() as $rowpeg) {
			
			if($this->input->post("presensi_".$rowpeg->NIP) != "") {
					
				$datpresensi = $this->presensi_pegawai_model->getpresensi($tgl, $rowpeg->NIP);
					
				if ($datpresensi) {
					$arrdata = array(
						'keterangan_presensi'=>$this->input->post("presensiket_".$rowpeg->NIP),
						'Rangkuman_presensi'=>$this->input->post("presensi_".$rowpeg->NIP)
					);
						//$this->presensi_pegawai_model->updatepresensi($arrdata, date('Y-m-').substr($i+100, 1, 2), $rowpeg->NIP);
						//print_r($arrdata)."<br/>";
					$this->presensi_pegawai_model->updatepresensi($arrdata, $tgl, $rowpeg->NIP);
						//echo $this->db->last_query()."<br/>";
				} else {
					$arrdata = array(
						//'Tanggal_presensi'=>date('Y-m-').substr($i+100, 1, 2),
						'Tanggal_presensi'=>($tgl),
						'keterangan_presensi'=>$this->input->post("presensiket_".$rowpeg->NIP),
						'Rangkuman_presensi'=>$this->input->post("presensi_".$rowpeg->NIP),
						'NIP'=>$rowpeg->NIP,
					);
						//print_r($arrdata)."<br/>";
					$this->presensi_pegawai_model->insertpresensi($arrdata);
						//echo $this->db->last_query()."<br/>";
				}
			}
			//}
		}
		redirect('superadmin/presensipegawai');

	}





	public function gantipassword()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/gantipassword', $data);
	}

	public function updatepassword() {
		$username = $this->input->post('username',true);
		$password = $this->input->post('password',true);
		$passwordbaru = $this->input->post('passwordbaru',true);
		$confirmpassword = $this->input->post('confirmpassword',true);
		if ($passwordbaru == $confirmpassword) {
			$cek =$this->login_model->proseslogin($username,$password);
			$hasil = count($cek); 
			if ($hasil > 0){
				// $this->login_model->cekPegawai($cek);
				
				$this->load->model('akun_model');
				$this->akun_model->update(array("password"=>$passwordbaru), $cek->id_akun);
				$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');
				redirect('superadmin/gantipassword');
			}else{
				

				$this->session->set_flashdata("warning",'<script> swal( "Oops" ,  "Password Lama Salah !" ,  "error" )</script>');



				redirect('superadmin/gantipassword');
			}
		} else {
			$this->session->set_flashdata("warning",'<script> swal( "Oops" ,  "Password Baru Salah !" ,  "error" )</script>');

			redirect('superadmin/gantipassword');
		}
		
	}

	public function tahunajaran()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;;
		$data['dat'] = $this->tahunajaran_model->Gettahunajaran();
		$this->template->load('superadmin/dashboard','superadmin/tahunajaran', $data);
	}

	public function tambahtahunajaran(){
			//if($this->input->post('submit')){
		$this->load->model('tahunajaran_model');
		$this->tahunajaran_model->tambahtahunajaran();
		$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');			
		redirect("superadmin/tahunajaran");
			//}
	}

	public function aktifkantahunajaran() {
		$this->load->model('setting_model');
		$this->setting_model->aktifkantahunajaran($this->uri->segment(3));

		redirect('superadmin/tahunajaran');
	}

	public function tambahdatpegValidate(){
		$this->load->library('form_validation');
		$array = array(
			array(
				'field' => 'NIP',
				'label' => 'NIP',
				'rules' => 'is_unique[pegawai.NIP]',
				'error' => array(
					'is_unique' => 'NIP sudah ada',
				)
			),

			array(
				'field' => 'nuptk',
				'label' => 'nuptk',
				'rules' => 'is_unique[pegawai.nuptk]',
				'error' => array(
					'is_unique' => 'nuptk sudah ada',
				)
			)





			
		);

		
		$this->form_validation->set_rules($array);
		return $this->form_validation->run();
	}

	public function tambahdatpeg(){
		

		if($this->input->post('submit')){
			if(!$this->tambahdatpegValidate()){
				$this->session->set_flashdata('warning',"<script>swal('Error','Cek Lagi  ', 'error')</script>");
				redirect("superadmin/pegawaibaru");
			}
			$this->load->model('pegawai_model');
			$this->pegawai_model->tambahdatpeg();
			$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');			
			redirect("superadmin/pegawaibaru");
		}
	}

	public function updatedatpeg(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['rowpeg'] = $this->pegawai_model->rowPegawai($this->uri->segment(3));
		$this->template->load('superadmin/dashboard','superadmin/updatedatpeg', $data);
		if($this->input->post('submit')){
			$this->load->model('pegawai_model');
			$this->pegawai_model->updatedatpeg();
			$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');		
			redirect("superadmin/pegawaibaru");
		} 
	}


	public function gantipasswordsiswa()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datajabatansiswa'] = $this->pegawai_model->Getjabatansiswa();		
		$this->template->load('superadmin/dashboard','superadmin/gantipasswordsiswa', $data);
	}

	public function editpasswordsiswa()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datjab'] = $this->pegawai_model->getjab();
		$data['rowpeg'] = $this->pegawai_model->rowJabatansiswa($this->uri->segment(3));
		$this->template->load('superadmin/dashboard','superadmin/editpasswordsiswa', $data);
	}

	public function updatepasswordsiswa() {
		$this->load->model('akun_model');
		$cek = $this->akun_model->selectakunsiswa($this->input->post('nisn'));
		// print_r($cek);
		if ($cek) {
			$data = array(
				"password" => $this->input->post('password')
			);
			$this->akun_model->update($data, $cek->id_akun);
		} else {
			$data = array(
				"nisn" => $this->input->post('nisn'),
				"password" => $this->input->post('password')
			);
			$this->akun_model->insert($data);
		}
		redirect('superadmin/gantipasswordsiswa');
		
	}


	public function deletedatpeg($id) {
		$this->load->model('pegawai_model');
		$this->pegawai_model->deletedatpeg($id);
		$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Dihapus", "success")</script>');
		redirect('superadmin/pegawaibaru#editdatpeg');
	}

	public function harilibur()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['datlibur'] = $this->tanggal_libur_model->getalllibur();
		$data['datliburnasional'] = $this->tanggal_libur_nasional_model->getalllibur();
		$this->template->load('superadmin/dashboard','superadmin/harilibur', $data);
	}

	public function simpanharilibur(){
			//if($this->input->post('submit')){
		$this->load->model('tanggal_libur_model');
		$data = array(
			"tanggal_awal" => $this->input->post('tanggal_awal'),
			"tanggal_akhir" => $this->input->post('tanggal_akhir'),
			"nama_libur" => $this->input->post('nama_libur')
		);
		$this->tanggal_libur_model->insertlibur($data);
		$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');			
		redirect("superadmin/harilibur");
			//}
	}

	public function simpanhariliburnasional(){
			//if($this->input->post('submit')){
		$this->load->model('tanggal_libur_nasional_model');
		$data = array(
			"tanggal_libur_nasional" => $this->input->post('tanggal_libur_nasional'),
			"bulan_libur_nasional" => $this->input->post('bulan_libur_nasional'),
			"nama_libur_nasional" => $this->input->post('nama_libur_nasional')
		);
		$this->tanggal_libur_nasional_model->insertlibur($data);
		$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');			
		redirect("superadmin/harilibur");
			//}
	}

	public function deleteharilibur(){
			//if($this->input->post('submit')){
		$this->load->model('tanggal_libur_model');
		$this->tanggal_libur_model->deletelibur($this->uri->segment(3));
		$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Dihapus", "success")</script>');			
		redirect("superadmin/harilibur");
			//}
	}

	public function deletehariliburnasional(){
			//if($this->input->post('submit')){
		$this->load->model('tanggal_libur_nasional_model');
		$this->tanggal_libur_nasional_model->deletelibur($this->uri->segment(3));
		$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Dihapus", "success")</script>');			
		redirect("superadmin/harilibur");
			//}
	}


// tutup Kepegawaian



	// Kurikulum MIA
	// public function mapel()
	// {
		

	// 	$data['nama'] = $this->session->Nama;
	// 	$data['foto'] = $this->session->foto; 

	// 	$this->template->load('superadmin/dashboard','superadmin/kurikulum/mapel', $data);
		
		
	// }
	public function mapel($id_kelas_reguler = "", $jenjang = "", $id_namamapel = "")
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		if ($id_kelas_reguler == "" ) {
			$this->load->model('penjadwalan/mod_namamapel');
			$data['tabel_namamapel'] = $this->mod_namamapel->get();
			$this->load->model('penjadwalan/mod_mapel');
			$data['tabel_mapel'] = $this->mod_mapel->getgroupbyjenjang2();
			$this->load->model('penjadwalan/mod_kelasreguler');
			$data['tabel_kelasreguler'] = $this->mod_kelasreguler->getgroupby();
			$data['edit_mapel'] = null;
			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/mapel', $data);	
		} else {
			$this->load->model('penjadwalan/mod_namamapel');
			$data['tabel_namamapel'] = $this->mod_namamapel->get();
			$this->load->model('penjadwalan/mod_mapel');
			$data['tabel_mapel'] = $this->mod_mapel->getgroupbyjenjang2();
			$this->load->model('penjadwalan/mod_kelasreguler');
			$data['tabel_kelasreguler'] = $this->mod_kelasreguler->getgroupby();
			
			//$data['edit_mapel'] = $this->mod_mapel->selectbynamajenjang(str_replace("_", " ", $nama_mapel), $jenjang);
			$data['edit_mapel'] = $this->mod_mapel->selectbyidnamajenjang(str_replace("_", " ", $id_namamapel), $jenjang);

			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/mapel', $data);
			
		}
		
	}

	

public function simpanmapel() {
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->load->model('penjadwalan/mod_mapel');
		$this->load->model('penjadwalan/mod_kelasreguler');

		$tabel_kelasreguler = $this->mod_kelasreguler->getbyjenjang($this->input->post('grade'));

		//print_r($tabel_kelasreguler);

		foreach ($tabel_kelasreguler as $row_kelasreguler) {

			$data = array(
				'id_namamapel' => $this->input->post('id_namamapel'),
				'kkm' => $this->input->post('kkm'),
				'jam_belajar' => $this->input->post('jam_belajar'),
				'id_kelas_reguler' => $row_kelasreguler->id_kelas_reguler
			);

			//print_r($data);
			//echo "1";

			if ($this->input->post('id_namamapel_old') == "") {
				//echo "2";
				if ($this->mod_mapel->cekdatamapel($this->input->post('id_namamapel'), $row_kelasreguler->id_kelas_reguler) == 0) {
					//echo "3";
					$this->mod_mapel->insert($data);	
				} 

			} else {
				//echo "4";
				$this->mod_mapel->updatebyidnamaidkelasreguler($data, $row_kelasreguler->id_kelas_reguler, $this->input->post('id_namamapel_old'));
			}	
		}

		$this->session->set_flashdata("warning",'<script> swal( "Berhasil" ,  "Data tersimpan !" ,  "success" )</script>');
		redirect('superadmin/mapel');
	}

	public function hapusmapel() {
		$this->load->model('penjadwalan/mod_mapel');
		$this->mod_mapel->delete($this->uri->segment(3));
		redirect('penjadwalan/kurikulum/mapel');
	}

	public function hapusmapelbyidjenjang() {
		$this->load->model('penjadwalan/mod_kelasreguler');
		$id_kelas_reguler = $this->uri->segment(3);
		$id_namamapel = $this->uri->segment(5);
		$row_kelasreguler = $this->mod_kelasreguler->select($id_kelas_reguler);

		$this->load->model('penjadwalan/mod_mapel');
		$tabel_kelasreguler = $this->mod_kelasreguler->getbyjenjang($row_kelasreguler->jenjang);

		//print_r($tabel_kelasreguler);

		foreach ($tabel_kelasreguler as $row_kelasreguler) {
			$this->mod_mapel->deletebyidkelasregulermapel($row_kelasreguler->id_kelas_reguler, $id_namamapel);
		}
		redirect('penjadwalan/kurikulum/mapel');
	}


	public function harirentang()
	{
		$this->load->model('penjadwalan/mod_harirentang');
		$data['tabel_hari_rentang'] = $this->mod_harirentang->get();

		$result = $this->mod_harirentang->get(array("hari"=>"Senin"));
		for ($i=1; $i<=8; $i++) {
			if (@$result[$i-1]) { $hari_rentang['senin'][$i] = $result[$i-1]; }
		}

		$result = $this->mod_harirentang->get(array("hari"=>"Selasa"));
		for ($i=1; $i<=8; $i++) {
			if (@$result[$i-1]) { $hari_rentang['selasa'][$i] = $result[$i-1]; }
		}

		$result = $this->mod_harirentang->get(array("hari"=>"Rabu"));
		for ($i=1; $i<=8; $i++) {
			if (@$result[$i-1]) { $hari_rentang['rabu'][$i] = $result[$i-1]; }
		}

		$result = $this->mod_harirentang->get(array("hari"=>"Kamis"));
		for ($i=1; $i<=8; $i++) {
			if (@$result[$i-1]) { $hari_rentang['kamis'][$i] = $result[$i-1]; }
		}

		$result = $this->mod_harirentang->get(array("hari"=>"Jumat"));
		for ($i=1; $i<=8; $i++) {
			if (@$result[$i-1]) { $hari_rentang['jumat'][$i] = $result[$i-1]; }
		}

		$result = $this->mod_harirentang->get(array("hari"=>"Sabtu"));
		for ($i=1; $i<=8; $i++) {
			if (@$result[$i-1]) { $hari_rentang['sabtu'][$i] = $result[$i-1]; }
		}

		$result = $this->mod_harirentang->get(array("hari"=>"Minggu"));
		for ($i=1; $i<=8; $i++) {
			if (@$result[$i-1]) { $hari_rentang['minggu'][$i] = $result[$i-1]; }
		}



		$data['hari_rentang'] = @$hari_rentang;
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;

		$this->template->load('superadmin/dashboard','superadmin/kurikulum/harirentang', $data);
	}

	public function simpanharirentang() {
		$this->load->model('penjadwalan/mod_harirentang');

		for ($i=1; $i<=8; $i++) {
			$data = array(
				'jam_ke' => $this->input->post('jam_ke_senin_'.$i),
				'jam_mulai' => $this->input->post('jam_mulai_senin_'.$i),
				'jam_selesai' => $this->input->post('jam_selesai_senin_'.$i),
				'hari' => 'senin'
			);
			if ($this->input->post('jam_ke_senin_'.$i) != "") {
				$tabel_hari_rentang = $this->mod_harirentang->get(array("hari"=>"Senin", "jam_ke"=>$this->input->post('jam_ke_senin_'.$i)));
				//print_r($tabel_hari_rentang);
				if ($tabel_hari_rentang) {
					$this->mod_harirentang->update($data, $tabel_hari_rentang[0]->id_rentang_jam);
				} else {
					$this->mod_harirentang->insert($data);
				}
			}
		}

		for ($i=1; $i<=8; $i++) {
			$data = array(
				'jam_ke' => $this->input->post('jam_ke_selasa_'.$i),
				'jam_mulai' => $this->input->post('jam_mulai_selasa_'.$i),
				'jam_selesai' => $this->input->post('jam_selesai_selasa_'.$i),
				'hari' => 'selasa'
			);
			if ($this->input->post('jam_ke_selasa_'.$i) != "") {
				$tabel_hari_rentang = $this->mod_harirentang->get(array("hari"=>"Selasa", "jam_ke"=>$this->input->post('jam_ke_selasa_'.$i)));
				//print_r($tabel_hari_rentang);
				if ($tabel_hari_rentang) {
					$this->mod_harirentang->update($data, $tabel_hari_rentang[0]->id_rentang_jam);
				} else {
					$this->mod_harirentang->insert($data);
				}
			}
		}

		for ($i=1; $i<=8; $i++) {
			$data = array(
				'jam_ke' => $this->input->post('jam_ke_rabu_'.$i),
				'jam_mulai' => $this->input->post('jam_mulai_rabu_'.$i),
				'jam_selesai' => $this->input->post('jam_selesai_rabu_'.$i),
				'hari' => 'rabu'
			);
			if ($this->input->post('jam_ke_rabu_'.$i) != "") {
				$tabel_hari_rentang = $this->mod_harirentang->get(array("hari"=>"Rabu", "jam_ke"=>$this->input->post('jam_ke_rabu_'.$i)));
				//print_r($tabel_hari_rentang);
				if ($tabel_hari_rentang) {
					$this->mod_harirentang->update($data, $tabel_hari_rentang[0]->id_rentang_jam);
				} else {
					$this->mod_harirentang->insert($data);
				}
			}
		}

		for ($i=1; $i<=8; $i++) {
			$data = array(
				'jam_ke' => $this->input->post('jam_ke_kamis_'.$i),
				'jam_mulai' => $this->input->post('jam_mulai_kamis_'.$i),
				'jam_selesai' => $this->input->post('jam_selesai_kamis_'.$i),
				'hari' => 'kamis'
			);
			if ($this->input->post('jam_ke_kamis_'.$i) != "") {
				$tabel_hari_rentang = $this->mod_harirentang->get(array("hari"=>"Kamis", "jam_ke"=>$this->input->post('jam_ke_kamis_'.$i)));
				//print_r($tabel_hari_rentang);
				if ($tabel_hari_rentang) {
					$this->mod_harirentang->update($data, $tabel_hari_rentang[0]->id_rentang_jam);
				} else {
					$this->mod_harirentang->insert($data);
				}
			}
		}

		for ($i=1; $i<=8; $i++) {
			$data = array(
				'jam_ke' => $this->input->post('jam_ke_jumat_'.$i),
				'jam_mulai' => $this->input->post('jam_mulai_jumat_'.$i),
				'jam_selesai' => $this->input->post('jam_selesai_jumat_'.$i),
				'hari' => 'jumat'
			);
			if ($this->input->post('jam_ke_jumat_'.$i) != "") {
				$tabel_hari_rentang = $this->mod_harirentang->get(array("hari"=>"Jumat", "jam_ke"=>$this->input->post('jam_ke_jumat_'.$i)));
				//print_r($tabel_hari_rentang);
				if ($tabel_hari_rentang) {
					$this->mod_harirentang->update($data, $tabel_hari_rentang[0]->id_rentang_jam);
				} else {
					$this->mod_harirentang->insert($data);
				}
			}
		}

		for ($i=1; $i<=8; $i++) {
			$data = array(
				'jam_ke' => $this->input->post('jam_ke_sabtu_'.$i),
				'jam_mulai' => $this->input->post('jam_mulai_sabtu_'.$i),
				'jam_selesai' => $this->input->post('jam_selesai_sabtu_'.$i),
				'hari' => 'sabtu'
			);
			if ($this->input->post('jam_ke_sabtu_'.$i) != "") {
				$tabel_hari_rentang = $this->mod_harirentang->get(array("hari"=>"Sabtu", "jam_ke"=>$this->input->post('jam_ke_sabtu_'.$i)));
				//print_r($tabel_hari_rentang);
				if ($tabel_hari_rentang) {
					$this->mod_harirentang->update($data, $tabel_hari_rentang[0]->id_rentang_jam);
				} else {
					$this->mod_harirentang->insert($data);
				}
			}
		}

		for ($i=1; $i<=8; $i++) {
			$data = array(
				'jam_ke' => $this->input->post('jam_ke_minggu_'.$i),
				'jam_mulai' => $this->input->post('jam_mulai_minggu_'.$i),
				'jam_selesai' => $this->input->post('jam_selesai_minggu_'.$i),
				'hari' => 'minggu'
			);
			if ($this->input->post('jam_ke_minggu_'.$i) != "") {
				$tabel_hari_rentang = $this->mod_harirentang->get(array("hari"=>"Minggu", "jam_ke"=>$this->input->post('jam_ke_minggu_'.$i)));
				//print_r($tabel_hari_rentang);
				if ($tabel_hari_rentang) {
					$this->mod_harirentang->update($data, $tabel_hari_rentang[0]->id_rentang_jam);
				} else {
					$this->mod_harirentang->insert($data);
				}
			}
		}


		redirect('superadmin/harirentang');
	}

	public function jammengajar()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$tahun_ajaran = $this->input->get('tahun_ajaran');

		$tahun_aktif = NULL;
		// Defaultnya ambil tahun yg aktif
		if (empty($tahun_ajaran)) {
			$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
		} else if ($tahun_ajaran != 'semua') {
			$tahun_aktif = $tahun_ajaran;
		}

		$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
		$data['tahun_ajaran_selected'] = $tahun_aktif;

		$this->load->model('kesiswaan/model_tahunajaran');
		$data['tahun_ajaran'] = $this->model_tahunajaran->get();

		$this->load->model('penjadwalan/mod_jammengajar');
		$tabel_jammengajar = $this->mod_jammengajar->get(array("id_tahun_ajaran"=>$tahun_ajaran));
		$data['tabel_jammengajar'] = $tabel_jammengajar;




		
		$this->load->model('penjadwalan/mod_pegawai');
		$tabel_pegawai = $this->mod_pegawai->get(array("Status"=>"Guru"));
		$data['tabel_pegawai'] = $tabel_pegawai;

		$this->load->model('penjadwalan/mod_jadwalmapel');
		
		

		$this->load->model('penjadwalan/mod_namamapel');
		$data['tabel_namamapel'] = $this->mod_namamapel->get();
		$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/jammengajar', $data);
	}

	public function getinfoguru($NIP)
	{
		$this->load->model('penjadwalan/mod_pegawai');
		//$tabel_pegawai = $this->mod_pegawai->get(array("Status"=>"Guru"));
		$row_pegawai = $this->mod_pegawai->get(array("Status"=>"Guru", "NIP"=>$NIP));
		$rows = array();
		//foreach ($tabel_pegawai as $row_pegawai) {
		    //$rows[] = $row_pegawai;
		//}
		$rows = $row_pegawai;
		$data = "{\"data\":".json_encode($rows)."}";
		echo $data;
	}

	public function simpanjammengajar() 
	{
		$this->load->model('penjadwalan/mod_jammengajar');

		for ($i=1; $i<=10; $i++) {
			if (($this->input->post('NIP'.$i) != "") && ($this->input->post('id_namamapel'.$i) != "")) {
				$data = array(
					'NIP' => $this->input->post('NIP'.$i),
					'id_namamapel' => $this->input->post('id_namamapel'.$i),
					'jatah_minim_mgjr' => $this->input->post('jatah_minim_mgjr'.$i),
					'id_tahun_ajaran' => '1'
				);
				$this->mod_jammengajar->insert($data);
			}
		}		
		redirect('superadmin/jammengajar');
	}

	public function hapusjammengajar() {
		$this->load->model('penjadwalan/mod_jammengajar');
		$this->mod_jammengajar->delete($this->uri->segment(3));
		redirect('penjadwalan/kurikulum/jammengajar');
	}

	public function jadwalmapel()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->load->model('penjadwalan/mod_namamapel');
		$data['tabel_namamapel'] = $this->mod_namamapel->get();
		$this->load->model('penjadwalan/mod_mapel');
		$data['tabel_mapel'] = $this->mod_mapel->get();
		$this->load->model('penjadwalan/mod_prioritaskhusus');
		$data['tabel_prioritaskhusus'] = $this->mod_prioritaskhusus->get();
		$this->load->model('penjadwalan/mod_kelasreguler');
		$data['tabel_kelasreguler'] = $this->mod_kelasreguler->get();
		$this->load->model('penjadwalan/mod_pegawai');
		$data['tabel_pegawai'] = $this->mod_pegawai->get(array("Status"=>"Guru"));

		$data['tabel_prioritaskhusus_senin'] = $this->mod_prioritaskhusus->get(array("hari"=>"Senin"));
		$data['tabel_prioritaskhusus_selasa'] = $this->mod_prioritaskhusus->get(array("hari"=>"Selasa"));
		$data['tabel_prioritaskhusus_rabu'] = $this->mod_prioritaskhusus->get(array("hari"=>"Rabu"));
		$data['tabel_prioritaskhusus_kamis'] = $this->mod_prioritaskhusus->get(array("hari"=>"Kamis"));
		$data['tabel_prioritaskhusus_jumat'] = $this->mod_prioritaskhusus->get(array("hari"=>"Jumat"));
		$data['tabel_prioritaskhusus_sabtu'] = $this->mod_prioritaskhusus->get(array("hari"=>"Sabtu"));
		$data['tabel_prioritaskhusus_minggu'] = $this->mod_prioritaskhusus->get(array("hari"=>"Minggu"));

		$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/jadwalmapel', $data);
	}

	// public function getmapelkelas($jenjang)
	// {
	// 	$this->load->model('penjadwalan/mod_mapel');
	// 	//$tabel_pegawai = $this->mod_pegawai->get(array("Status"=>"Guru"));
	// 	$tabel_mapel = $this->mod_mapel->getmapelbyjenjang($jenjang);
	// 	$rows = array();
	// 	foreach ($tabel_mapel as $row_mapel) {
	// 	    $rows[] = $row_mapel;
	// 	}
	// 	$data = "{\"data\":".json_encode($rows)."}";
	// 	echo $data;
	// }

	public function simpanprioritas() {
		$this->load->model('penjadwalan/mod_prioritaskhusus');
		//echo "OKK";
		//print_r($this->input->post('id_namamapel_senin_0'));
		for ($i=0; $i<=8; $i++) {

			$id_namamapel_senin = $this->input->post('id_namamapel_senin_'.$i);
			//print_r($id_namamapel_senin);
			if ($id_namamapel_senin) {
				foreach ($id_namamapel_senin as $nilai) {
					if ($nilai != "") {
						$data = array(
							'jenis_prkh' => 'prioritas',
							'id_namamapel' => $nilai,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Senin'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$id_namamapel_selasa = $this->input->post('id_namamapel_selasa_'.$i);
			if ($id_namamapel_selasa) {
				foreach ($id_namamapel_selasa as $nilai) {
					if ($nilai != "") {
						$data = array(
							'jenis_prkh' => 'prioritas',
							'id_namamapel' => $nilai,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Selasa'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$id_namamapel_rabu = $this->input->post('id_namamapel_rabu_'.$i);
			//print_r($id_namamapel_senin);
			if ($id_namamapel_rabu) {
				foreach ($id_namamapel_rabu as $nilai) {
					if ($nilai != "") {
						$data = array(
							'jenis_prkh' => 'prioritas',
							'id_namamapel' => $nilai,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Rabu'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$id_namamapel_kamis = $this->input->post('id_namamapel_kamis_'.$i);
			//print_r($id_namamapel_senin);
			if ($id_namamapel_kamis) {
				foreach ($id_namamapel_kamis as $nilai) {
					if ($nilai != "") {
						$data = array(
							'jenis_prkh' => 'prioritas',
							'id_namamapel' => $nilai,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Kamis'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$id_namamapel_jumat = $this->input->post('id_namamapel_jumat_'.$i);
			//print_r($id_namamapel_senin);
			if ($id_namamapel_jumat) {
				foreach ($id_namamapel_jumat as $nilai) {
					if ($nilai != "") {
						$data = array(
							'jenis_prkh' => 'prioritas',
							'id_namamapel' => $nilai,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Jumat'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$id_namamapel_sabtu = $this->input->post('id_namamapel_sabtu_'.$i);
			//print_r($id_namamapel_senin);
			if ($id_namamapel_sabtu) {
				foreach ($id_namamapel_sabtu as $nilai) {
					if ($nilai != "") {
						$data = array(
							'jenis_prkh' => 'prioritas',
							'id_namamapel' => $nilai,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Sabtu'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$id_namamapel_minggu = $this->input->post('id_namamapel_minggu_'.$i);
			//print_r($id_namamapel_senin);
			if ($id_namamapel_minggu) {
				foreach ($id_namamapel_minggu as $nilai) {
					if ($nilai != "") {
						$data = array(
							'jenis_prkh' => 'prioritas',
							'id_namamapel' => $nilai,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Minggu'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}
		redirect('penjadwalan/kurikulum/jadwalmapel');
	}

	public function simpankhusus(){
		$this->load->model('penjadwalan/mod_prioritaskhusus');

		for ($i=0; $i<=8; $i++) {

			$NIP_senin = $this->input->post('NIP_senin_'.$i);
			if ($NIP_senin) {
				foreach ($NIP_senin as $hasil) {
					if ($hasil != "") {
						$data = array(
							'jenis_prkh' => 'khusus',
							'NIP' => $hasil,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Senin'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$NIP_selasa = $this->input->post('NIP_selasa_'.$i);
			if ($NIP_selasa) {
				foreach ($NIP_selasa as $hasil) {
					if ($hasil != "") {
						$data = array(
							'jenis_prkh' => 'khusus',
							'NIP' => $hasil,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Selasa'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$NIP_rabu = $this->input->post('NIP_rabu_'.$i);
			if ($NIP_rabu) {
				foreach ($NIP_rabu as $hasil) {
					if ($hasil != "") {
						$data = array(
							'jenis_prkh' => 'khusus',
							'NIP' => $hasil,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Rabu'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$NIP_kamis = $this->input->post('NIP_kamis_'.$i);
			if ($NIP_kamis) {
				foreach ($NIP_kamis as $hasil) {
					if ($hasil != "") {
						$data = array(
							'jenis_prkh' => 'khusus',
							'NIP' => $hasil,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Kamis'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$NIP_jumat = $this->input->post('NIP_jumat_'.$i);
			if ($NIP_jumat) {
				foreach ($NIP_jumat as $hasil) {
					if ($hasil != "") {
						$data = array(
							'jenis_prkh' => 'khusus',
							'NIP' => $hasil,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Jumat'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$NIP_sabtu = $this->input->post('NIP_sabtu_'.$i);
			if ($NIP_sabtu) {
				foreach ($NIP_sabtu as $hasil) {
					if ($hasil != "") {
						$data = array(
							'jenis_prkh' => 'khusus',
							'NIP' => $hasil,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Sabtu'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		for ($i=0; $i<=8; $i++) {

			$NIP_minggu = $this->input->post('NIP_minggu_'.$i);
			if ($NIP_minggu) {
				foreach ($NIP_minggu as $hasil) {
					if ($hasil != "") {
						$data = array(
							'jenis_prkh' => 'khusus',
							'NIP' => $hasil,
							'id_tahun_ajaran' => '1',
							'jam_ke' => "$i",
							'hari' => 'Minggu'

						);	
					}
					$this->mod_prioritaskhusus->insert($data);
				}
			}
			
		}

		redirect('penjadwalan/kurikulum/jadwalmapel');

	}



	
	public function jadwalpiketguru()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;

		$this->load->model('penjadwalan/mod_pegawai');
		$data['tabel_pegawai'] = $this->mod_pegawai->get();
		
		$this->load->model('penjadwalan/mod_jadwalpiketguru');
		$data['tabel_jadwalpiketguru'] = $this->mod_jadwalpiketguru->get();



		$tahun_ajaran = $this->input->get('tahun_ajaran');

		$tahun_aktif = NULL;
		// Defaultnya ambil tahun yg aktif
		if (empty($tahun_ajaran)) {
			$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
		} else if ($tahun_ajaran != 'semua') {
			$tahun_aktif = $tahun_ajaran;
		}

		$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
		$data['tahun_ajaran_selected'] = $tahun_aktif;

		$this->load->model('kesiswaan/model_tahunajaran');
		$data['tahun_ajaran'] = $this->model_tahunajaran->get();
		$this->load->model('penjadwalan/mod_tahunajaran');
		$data['tabel_tahunajaran'] = $this->mod_tahunajaran->get();

		$data['tabel_jadwalpiketguru_senin'] = $this->mod_jadwalpiketguru->get(array("hari"=>"Senin"));
		$data['tabel_jadwalpiketguru_selasa'] = $this->mod_jadwalpiketguru->get(array("hari"=>"Selasa"));
		$data['tabel_jadwalpiketguru_rabu'] = $this->mod_jadwalpiketguru->get(array("hari"=>"Rabu"));
		$data['tabel_jadwalpiketguru_kamis'] = $this->mod_jadwalpiketguru->get(array("hari"=>"Kamis"));
		$data['tabel_jadwalpiketguru_jumat'] = $this->mod_jadwalpiketguru->get(array("hari"=>"Jumat"));
		$data['tabel_jadwalpiketguru_sabtu'] = $this->mod_jadwalpiketguru->get(array("hari"=>"Sabtu"));
		$data['tabel_jadwalpiketguru_minggu'] = $this->mod_jadwalpiketguru->get(array("hari"=>"Minggu"));

		$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/jadwalpiketguru', $data);
	}

	public function simpanjadwalpiketguru() 
	{
		$this->load->model('penjadwalan/mod_jadwalpiketguru');

		for ($i=1; $i<=3; $i++) {
			if (($this->input->post('NIP_senin'.$i) != "")) { // && ($this->input->post('tgl_piketguru_senin') != "")) {
				$data = array(
					'NIP' => $this->input->post('NIP_senin'.$i),
					'hari' => 'Senin',
					'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran'),
				);
				$this->mod_jadwalpiketguru->insert($data);
			}
			if (($this->input->post('NIP_selasa'.$i) != "")) { // && ($this->input->post('tgl_piketguru_selasa') != "")) {

				$data = array(
					'NIP' => $this->input->post('NIP_selasa'.$i),
					'hari' => 'Selasa',
					'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran')
				);
				$this->mod_jadwalpiketguru->insert($data);
			}
			if (($this->input->post('NIP_rabu'.$i) != "")) { // && ($this->input->post('tgl_piketguru_rabu') != "")) {

				$data = array(
					'NIP' => $this->input->post('NIP_rabu'.$i),
					'hari' => 'Rabu',
					'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran')
				);
				$this->mod_jadwalpiketguru->insert($data);
			}
			if (($this->input->post('NIP_kamis'.$i) != "")) { // && ($this->input->post('tgl_piketguru_kamis') != "")) {

				$data = array(
					'NIP' => $this->input->post('NIP_kamis'.$i),
					'hari' => 'Kamis',
					'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran')
				);
				$this->mod_jadwalpiketguru->insert($data);
			}
			if (($this->input->post('NIP_jumat'.$i) != "")) { // && ($this->input->post('tgl_piketguru_jumat') != "")) {

				$data = array(
					'NIP' => $this->input->post('NIP_jumat'.$i),
					'hari' => 'Jumat',
					'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran')
				);
				$this->mod_jadwalpiketguru->insert($data);
			}
			if (($this->input->post('NIP_sabtu'.$i) != "")) { // && ($this->input->post('tgl_piketguru_sabtu') != "")) {

				$data = array(
					'NIP' => $this->input->post('NIP_sabtu'.$i),
					'hari' => 'Sabtu',
					'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran')
				);
				$this->mod_jadwalpiketguru->insert($data);
			}
			if (($this->input->post('NIP_minggu'.$i) != "")) { // && ($this->input->post('tgl_piketguru_minggu') != "")) {

				$data = array(
					'NIP' => $this->input->post('NIP_minggu'.$i),
					'hari' => 'Minggu',
					'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran')
				);
				$this->mod_jadwalpiketguru->insert($data);
			}
		}		
		redirect('superadmin/jadwalpiketguru');
	}

	public function jadwaltambahan($id_jadwal_tambahan = "")
	{

		if ($id_jadwal_tambahan == "" ) {
			$this->load->model('penjadwalan/mod_kelastambahan');
			$data['tabel_kelastambahan'] = $this->mod_kelastambahan->get();
			$this->load->model('penjadwalan/mod_namamapel');
			$data['tabel_namamapel'] = $this->mod_namamapel->get();
			$this->load->model('penjadwalan/mod_pegawai');
			$data['tabel_pegawai'] = $this->mod_pegawai->get();
			$this->load->model('penjadwalan/mod_jadwaltambahan');
			$data['tabel_jadwaltambahan'] = $this->mod_jadwaltambahan->get();
			$data['edit_jadwaltambahan'] = null;
			
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto;
			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/jadwaltambahan', $data);
		} else {
			$this->load->model('penjadwalan/mod_kelastambahan');
			$data['tabel_kelastambahan'] = $this->mod_kelastambahan->get();
			$this->load->model('penjadwalan/mod_namamapel');
			$data['tabel_namamapel'] = $this->mod_namamapel->get();
			$this->load->model('penjadwalan/mod_pegawai');
			$data['tabel_pegawai'] = $this->mod_pegawai->get();
			$this->load->model('penjadwalan/mod_jadwaltambahan');
			$data['tabel_jadwaltambahan'] = $this->mod_jadwaltambahan->get();
			$data['edit_jadwaltambahan'] = $this->mod_jadwaltambahan->select($id_jadwal_tambahan);
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto;

			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/jadwaltambahan', $data);
		}

		
	}

	public function hapusjadwaltambahan() {
		$this->load->model('penjadwalan/mod_jadwaltambahan');
		$this->mod_jadwaltambahan->delete($this->uri->segment(3));
		redirect('superadmin/jadwaltambahan');
	}

	public function getmapelkelastambahan()
	{
		$id = $this->input->post('id');
		$this->load->model('penjadwalan/mod_mapel');
		$data['tabel_pegawai'] = $this->mod_mapel->get();
		$this->template->load('superadmin/dashboard','penjadwalan/kurikulum/jadwaltambahan', $data);
	}

	public function simpanjadwaltambahan()
	{
		$this->load->model('penjadwalan/mod_jadwaltambahan');
		
		
		$data = array(
			'NIP' => $this->input->post('NIP'),
			'id_kelas_tambahan' => $this->input->post('id_kelas_tambahan'),
			'jam_mulai' => $this->input->post('jam_mulai'),
			'jam_selesai' => $this->input->post('jam_selesai'),
			'tgl_tambahan' => $this->input->post('tgl_tambahan'),
				'id_tahun_ajaran' => 1, //$this->input->post('id_tahun_ajaran'),
				'id_namamapel' => $this->input->post('id_namamapel')
			);

			//print_r($data);
			//echo "1";

		if ($this->input->post('id_jadwal_tambahan') == "") {
				//echo "2";
				//if ($this->mod_mapel->cekdatamapel($this->input->post('nama_mapel'), $row_kelasreguler->id_kelas_reguler) == 0) {
					//echo "3";
			$this->mod_jadwaltambahan->insert($data);	
				//} 

		} else {
				//echo "4";
			$this->mod_jadwaltambahan->update($data, $this->input->post('id_jadwal_tambahan'));
		}	
		
		redirect('superadmin/jadwaltambahan');
	}

	public function delharirentang() 
	{
		$id = $this->uri->segment(3);
		$this->load->model('penjadwalan/mod_harirentang');
		$this->mod_harirentang->delete($id);
		redirect('penjadwalan/kurikulum/harirentang');
	}

	public function ekstrakurikuler($id_jadwal_ekskul = "")
	{
		if ($id_jadwal_ekskul == "" ) {
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto;
			$this->load->model('penjadwalan/mod_jadwalekskul');
			$data['tabel_jadwalekskul'] = $this->mod_jadwalekskul->get();

			$this->load->model('penjadwalan/mod_jenisklstambahan');
			$data['tabel_jenisklstambahan'] = $this->mod_jenisklstambahan->get();

			$this->load->model('penjadwalan/mod_pembimbing');
			$data['tabel_pembimbing'] = $this->mod_pembimbing->get();
			$data['edit_jadwalekskul'] = null;
			
			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/ekstrakurikuler', $data);
		} else {
			$this->load->model('penjadwalan/mod_jadwalekskul');
			$data['tabel_jadwalekskul'] = $this->mod_jadwalekskul->get();
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto;

			$this->load->model('penjadwalan/mod_jenisklstambahan');
			$data['tabel_jenisklstambahan'] = $this->mod_jenisklstambahan->get();

			$this->load->model('penjadwalan/mod_pembimbing');
			$data['tabel_pembimbing'] = $this->mod_pembimbing->get();
			$data['tabel_jadwalekskul'] = $this->mod_jadwalekskul->get();
			$data['edit_jadwalekskul'] = $this->mod_jadwalekskul->select($id_jadwal_ekskul);

			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/ekstrakurikuler', $data);
		}
		

		// redirect('penjadwalan/kurikulum/ekstrakurikuler');
	}

	public function hapusjadwalekskul() {
		$this->load->model('penjadwalan/mod_jadwalekskul');
		$this->mod_jadwalekskul->delete($this->uri->segment(3));
		redirect('superadmin/ekstrakurikuler');
	}


	public function simpanjadwalekskul()
	{
		$this->load->model('penjadwalan/mod_jadwalekskul');
		
		
		$data = array(
			'hari' => $this->input->post('hari'),
			'jam_mulai' => $this->input->post('jam_mulai'),
			'jam_selesai' => $this->input->post('jam_selesai'),
			'tempat' => $this->input->post('tempat'),
			'id_jenis_kls_tambahan' => $this->input->post('id_jenis_kls_tambahan'),
			'id_pembimbing' => $this->input->post('id_pembimbing'),
				'id_tahun_ajaran' => 1, //$this->input->post('id_tahun_ajaran'),
				
			);

			//print_r($data);
			//echo "1";

		if ($this->input->post('id_jadwal_ekskul') == "") {
				//echo "2";
				//if ($this->mod_mapel->cekdatamapel($this->input->post('nama_mapel'), $row_kelasreguler->id_kelas_reguler) == 0) {
					//echo "3";
			$this->mod_jadwalekskul->insert($data);	
				//} 

		} else {
				//echo "4";
			$this->mod_jadwalekskul->update($data, $this->input->post('id_jadwal_ekskul'));
		}	
		
		redirect('superadmin/ekstrakurikuler');
	}

	public function namamapel($id_namamapel = "")
	{
		if ($id_namamapel == "" ) {
			$data['edit_mapel'] = null;

			$this->load->model('penjadwalan/mod_namamapel');
			$data['tabel_namamapel'] = $this->mod_namamapel->get();
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto; 

			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/namamapel', $data);
		} else {
			$this->load->model('penjadwalan/mod_namamapel');
			$data['edit_mapel'] = $this->mod_namamapel->select($id_namamapel);
			$data['tabel_namamapel'] = $this->mod_namamapel->get();
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto; 

			$this->template->load('superadmin/dashboard','superadmin/kurikulum/penjadwalan/namamapel', $data);
		}


		
	}

		public function simpannamamapel()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->load->model('penjadwalan/mod_namamapel');
		
		
		$data = array(
			'nama' => $this->input->post('nama'),
			'warna' => $this->input->post('warna')
		);

			//print_r($data);
			//echo "1";

		if ($this->input->post('id_namamapel') == "") {
				//echo "2";
				//if ($this->mod_mapel->cekdatamapel($this->input->post('nama_mapel'), $row_kelasreguler->id_kelas_reguler) == 0) {
					//echo "3";
			$this->mod_namamapel->insert($data);	
				//} 

		} else {
				//echo "4";
			$this->mod_namamapel->update($data, $this->input->post('id_namamapel'));
		}	

		$this->session->set_flashdata("warning",'<script> swal( "Berhasil" ,  "Data tersimpan !" ,  "success" )</script>');
		redirect('superadmin/namamapel');
	}


	public function hapusnamamapel() {
		$this->load->model('penjadwalan/mod_namamapel');
		$this->mod_namamapel->delete($this->uri->segment(3));
		redirect('superadmin/namamapel');
	}
	// tutup mia kurikulum




	// Penilaian Hafiz

	public function kaldik(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard', 'superadmin/rancang/kaldik',$data);
	}

	public function kurikulum(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard', 'superadmin/rancang/kurikulum',$data);
	}

	public function nilaisiswa(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard', 'superadmin/rancang/nilaisiswa',$data);
	}


	public function kategorinilai(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard', 'superadmin/rancang/kategorinilai',$data);
	}

	public function jenisnilaiakhir(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard', 'superadmin/rancang/jenisnilaiakhir',$data);
	}

	public function deskripsinilai(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard', 'superadmin/rancang/deskripsinilai',$data);
	}

	public function rapor(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard', 'superadmin/rancang/Rapor',$data);
	}



	public function presensi_siswa()
	{
		$day_libur = 0;
		if ($this->setting->hari_libur == "Senin") {
			$day_libur = 1;
		}
		else if ($this->setting->hari_libur == "Selasa") {
			$day_libur = 2;
		}
		else if ($this->setting->hari_libur == "Rabu") {
			$day_libur = 3;
		}
		else if ($this->setting->hari_libur == "Kamis") {
			$day_libur = 4;
		}
		else if ($this->setting->hari_libur == "Jumat") {
			$day_libur = 5;
		}
		else if ($this->setting->hari_libur == "Sabtu") {
			$day_libur = 6;
		}
		else { // ($this->setting->hari_libur == "Minggu") {
			$day_libur = 0;
		}
		$data['day_libur'] = $day_libur;
		$data['hari_libur'] = $this->setting->hari_libur;

		//echo date('w');

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$datsis = $this->Model_siswa->Getdatsis();
		$data['datsis'] = $datsis;
		// $data['rowsis'] = $this->model_siswa->rowsiswa($this->session->userdata('nisn'));
		//$thn = date('Y');
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }

		$datsemester = $this->tahunajaran_model->Getsemester();
		//print_r($datsemester);
		//print_r($datpeg->result());

		$tablesis = $datsis->result();
		foreach ($tablesis as $rowsis) {

			//for($i=1;$i<=date('t');$i++) {
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
				//echo $rowpeg->NIP."<br/>";
				//$datpresensi = $this->presensi_pegawai_model->getpresensi(date('Y-m-').substr($i+100, 1, 2), $rowpeg->NIP);
				$datpresensi = $this->presensi_siswa_model->getpresensi($thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowsis->nisn);
				//echo $this->db->last_query()."<br/>";
				if ($datpresensi) {
					//echo $rowpeg->NIP."===<br/>";
					$data['datpresensi'][$rowsis->nisn][$i] = $datpresensi->Rangkuman_presensisiswa;
					$data['datwaktu'][$rowsis->nisn][$i] = $datpresensi->Waktu_presensisiswa;
				}
			}
			for ($i=1;$i<=12;$i++) {
				
				$data['datpresensibulan'][$rowsis->nisn][$i]['H'] = @$this->presensi_siswa_model->getpresensibulan($i, $thn, $rowsis->nisn, 'H')->jml;
				$data['datpresensibulan'][$rowsis->nisn][$i]['S'] = @$this->presensi_siswa_model->getpresensibulan($i, $thn, $rowsis->nisn, 'S')->jml;
				$data['datpresensibulan'][$rowsis->nisn][$i]['I'] = @$this->presensi_siswa_model->getpresensibulan($i, $thn, $rowsis->nisn, 'I')->jml;
				$data['datpresensibulan'][$rowsis->nisn][$i]['A'] = @$this->presensi_siswa_model->getpresensibulan($i, $thn, $rowsis->nisn, 'A')->jml;
			}

			for ($i=1;$i<=2;$i++) {
				
				$data['datpresensisemester'][$rowsis->nisn][$i]['H'] = @$this->presensi_siswa_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowsis->nisn, 'H')->jml;
				$data['datpresensisemester'][$rowsis->nisn][$i]['S'] = @$this->presensi_siswa_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowsis->nisn, 'S')->jml;
				$data['datpresensisemester'][$rowsis->nisn][$i]['I'] = @$this->presensi_siswa_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowsis->nisn, 'I')->jml;
				$data['datpresensisemester'][$rowsis->nisn][$i]['A'] = @$this->presensi_siswa_model->getpresensisemester($datsemester[$i-1]->tanggal_mulai, $datsemester[$i-1]->tanggal_selesai, $rowsis->nisn, 'A')->jml;
			}

		}

		for ($i=1;$i<=12;$i++) {
			
			$data['datpresensitotalbulan'][$i]['H'] = @$this->presensi_siswa_model->getpresensitotalbulan($i, $thn, 'H')->jml;
			$data['datpresensitotalbulan'][$i]['S'] = @$this->presensi_siswa_model->getpresensitotalbulan($i, $thn, 'S')->jml;
			$data['datpresensitotalbulan'][$i]['I'] = @$this->presensi_siswa_model->getpresensitotalbulan($i, $thn, 'I')->jml;
			$data['datpresensitotalbulan'][$i]['A'] = @$this->presensi_siswa_model->getpresensitotalbulan($i, $thn, 'A')->jml;
		}

		for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
			$datlibur = $this->tanggal_libur_model->getlibur($thn.'-'.substr($bln+100, 1, 2).'-'.substr($i+100, 1, 2));
			if ($datlibur) {
				$data['datlibur'][$i] = $datlibur->nama_libur;
			} else {
				$data['datlibur'][$i] = "";
			}

			$datliburnasional = $this->tanggal_libur_nasional_model->getlibur($i, $bln);
			if ($datliburnasional) {
				$data['datlibur'][$i] = $data['datlibur'][$i]." ".$datliburnasional->nama_libur_nasional;
			} 
			//echo $data['datlibur'][$i]."<br/>";
			//echo $this->db->last_query()."<br/>";
		}

		$data['grafikpresensipegawai'] = TRUE;
		
		$this->template->load('superadmin/dashboard','superadmin/kurikulum/penilaian/presensisiswa', $data);
	}

	public function submitpresensisiswa(){
		$bln = date('m');
		$thn = date('Y');
		if ($this->input->post('bln') != "") { $bln = $this->input->post('bln'); }
		if ($this->input->post('thn') != "") { $thn = $this->input->post('thn'); }

		$datsis = $this->Model_siswa->Getdatsis();
		foreach ($datsis->result() as $rowsis) {
			//for($i=1;$i<=date('t');$i++) {
			for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
				if($this->input->post("presensi_".$rowsis->nisn."_".$i) != "") {
					
					//$datpresensi = $this->presensi_pegawai_model->getpresensi(date('Y-m-').substr($i+100, 1, 2), $rowsis->nisn);
					$datpresensi = $this->presensi_siswa_model->getpresensi($thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowsis->nisn);
					if ($datpresensi) {
						$arrdata = array(
							'Waktu_presensisiswa'=>$this->input->post("waktu_".$rowsis->nisn."_".$i),
							'Rangkuman_presensisiswa'=>$this->input->post("presensi_".$rowsis->nisn."_".$i)
						);
						//$this->presensi_pegawai_model->updatepresensi($arrdata, date('Y-m-').substr($i+100, 1, 2), $rowsis->nisn);
						$this->presensi_siswa_model->updatepresensi($arrdata, $thn.'-'.$bln.'-'.substr($i+100, 1, 2), $rowsis->nisn);
					} else {
						$arrdata = array(
						//'Tanggal_presensi'=>date('Y-m-').substr($i+100, 1, 2),
							'Tanggal_presensisiswa'=>($thn.'-'.$bln.'-'.substr($i+100, 1, 2)),
							'Waktu_presensisiswa'=>$this->input->post("waktu_".$rowsis->nisn."_".$i),
							'Rangkuman_presensisiswa'=>$this->input->post("presensi_".$rowsis->nisn."_".$i),
							'nisn'=>$rowsis->nisn,
						);
						$this->presensi_siswa_model->insertpresensi($arrdata);
					}
				}
			}
		}
		redirect('superadmin/presensi_siswa');

	}

//tutup Hafiz





	//kesiswaan NADYA 


	public function distribusi_reg(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/distribusi_reg' ,$data);
	}

	public function pembagian() {
		$tipe = $this->input->post('btntipe');
		if ($tipe == "Berdasarkan Agama dan Jenis Kelamin") {
			if ($this->input->post('penamaan') == "angka") {
				$urutan = array('-1','-2','-3','-4','-5','-6','-7','-8','-9','-10','-11','-12','-13','-14','-15','-16','-17','-18','-19','-20');
			} else if ($this->input->post('penamaan') == "huruf") {
				$urutan = array('-A','-B','-C','-D','-E','-F','-G','-H','-I','-J','-K','-L','-M','-N','-O','-P','-Q','-R','-S','-T');
			} else if ($this->input->post('penamaan') == "romawi") {
				$urutan = array('-I','-II','-III','-IV','-V','-VI','-VII','-VIII','-IX','-X','-XI','-XII','-XII','-XIV','-XV','-XVI','-XVII','-XVIII','-XIV','-XX');
			}
			$jumlah_kelas = $this->input->post('jumlah_kelas');
			$jenjang = $this->input->post('jenjang');
			$nama_kelas = array();
			for ($i=0;$i<$jumlah_kelas;$i++) {
				$nama_kelas[$i] = $jenjang.$urutan[$i];
			}

			$data['jumlah_kelas'] = $jumlah_kelas;			
			$data['jenjang'] = $jenjang;			
			$data['nama_kelas'] = $nama_kelas;	
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto; 		
			$this->template->load('superadmin/dashboard','superadmin/kesiswaan/pembagian_agama', $data);
		} else {
			$data['nama'] = $this->session->Nama;
			$data['foto'] = $this->session->foto; 
			$this->template->load('superadmin/dashboard','superadmin/kesiswaan/pembagian_prestasi', $data);
		}
	}

	public function hasil_pembagian_agama(){
		//$jml_siswa = 32;
		$jml_kelas = $this->input->post('jumlah_kelas'); //3;
		//$jml_sisa = $jml_siswa % $jml_kelas;
		$jml_perkelas = array(); 
		$total_siswa = 0;
		for ($i=0;$i<$jml_kelas;$i++){
			$jml_perkelas[$i] = $this->input->post('jumlah_siswa'.$i); 
			$total_siswa = $total_siswa + $jml_perkelas[$i];
		//	$jml_perkelas[$i] = ($jml_siswa - $jml_sisa) / $jml_kelas;
		//	if ($i < $jml_sisa) { $jml_perkelas[$i]++; }
		}

		print_r($jml_perkelas);

		$this->load->model('distribusi/Mod_tahunajaran');
		$this->load->model('distribusi/mod_kelas_reguler');
		$this->load->model('distribusi/mod_kelas_reguler_berjalan');
		$this->load->model('distribusi/mod_siswa_kelas_reguler_berjalan');
		
		//$arridkelasreguler = array('1', '2', '3');
		//$arridkelasreguler = array('1', '2', '3');
		$arridkelasreguler = array();
		$arridkelasregulerberjalan = array();

		$arrpersenlaki2 = array();
		$arrpersenperempuan = array();
		
		$arrpersenislam =    array();
		$arrpersenkristen =  array();
		$arrpersenkatholik = array();
		$arrpersenhindu =    array();
		$arrpersenbudha =    array();
		$arrpersenlainnya =  array();

		for ($i=0;$i<$jml_kelas;$i++){
			//$jml_perkelas[$i] = $this->input->post('jumlah_siswa'.$i); 
			$arrdata = array(
				"nama_kelas"=>$this->input->post('nama_kelas'.$i),
				"jenjang"=>$this->input->post('jenjang'),
				"kuota_kelas_reguler"=>$jml_perkelas[$i],
				"jumlah_kelas_reguler"=>$jml_kelas,
				"id_tahun_ajaran" => $this->Mod_tahunajaran->getaktif()->id_tahun_ajaran
			);
			//INSERT INTO `kelas_reguler`(`id_kelas_reguler`, `nama_kelas`, `jenjang`, `kuota_kelas_reguler`, `jumlah_kelas_reguler`, `id_tahun_ajaran`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
			$this->mod_kelas_reguler->insert($arrdata);
			$arridkelasreguler[$i] = $this->db->insert_id();

			$arrdata = array(
				"wali_kelas"=>"",
				"id_kelas_reguler"=>$arridkelasreguler[$i],
				"id_tahun_ajaran" => $this->Mod_tahunajaran->getaktif()->id_tahun_ajaran
			);
			//INSERT INTO `kelas_reguler_berjalan`(`id_kelas_reguler_berjalan`, `wali_kelas`, `id_kelas_reguler`, `id_tahun_ajaran`) VALUES ([value-1],[value-2],[value-3],[value-4])
			$this->mod_kelas_reguler_berjalan->insert($arrdata);
			$arridkelasregulerberjalan[$i] = $this->db->insert_id();

		//	$jml_perkelas[$i] = ($jml_siswa - $jml_sisa) / $jml_kelas;
		//	if ($i < $jml_sisa) { $jml_perkelas[$i]++; }

			$arrpersenlaki2[$i] = $this->input->post('persentaselakilaki'.$i);
			$arrpersenperempuan[$i] = $this->input->post('persentaseperempuan'.$i);
			
			$arrpersenislam[$i] =    $this->input->post('persentaseislam'.$i);
			$arrpersenkristen[$i] =  $this->input->post('persentasekristen'.$i);
			$arrpersenkatholik[$i] = $this->input->post('persentasekatholik'.$i);
			$arrpersenhindu[$i] =    $this->input->post('persentasehindu'.$i);
			$arrpersenbudha[$i] =    $this->input->post('persentasebudha'.$i);
			$arrpersenlainnya[$i] =  $this->input->post('persentaselainnya'.$i);

		}
		//print_r($arridkelasreguler);

		// $arrpersenlaki2 = array(50, 30, 70);
		// $arrpersenperempuan = array(50, 70, 30);
		
		// $arrpersenislam =    array(70, 70, 70);
		// $arrpersenkristen =  array(30, 0,  0);
		// $arrpersenkatholik = array(0,  0,  0);
		// $arrpersenhindu =    array(0,  0, 30);
		// $arrpersenbudha =    array(0,  30,  0);
		// $arrpersenlainnya =  array(0,  0,  0);

		//$arralokasi[$i][$j] = array('Laki-Laki', 'Islam');

		$arralokasi = array(array());
		for ($i=0;$i<$jml_kelas;$i++) {
			
			$progress = 0;
			$progressjklainnya = 0;
			$progressjkbudha = 0;
			$progressjkhindu = 0;
			$progressjkkatholik = 0;
			$progressjkkristen = 0;
			$progressjkislam = 0;
			for ($j=0;$j<$jml_perkelas[$i];$j++) {
				$progress = $progress + (100 / $jml_perkelas[$i]);

				if ($progress <= ($arrpersenlainnya[$i])) {
					$arralokasi[$i][$j][0] = 'Lainnya'; 

					$progressjklainnya = $progressjklainnya + (100 / ($jml_perkelas[$i] * ($arrpersenlainnya[$i] / 100)));	
					if ($progressjklainnya <= ($arrpersenlaki2[$i])) {
						$arralokasi[$i][$j][1] = 'Laki-Laki'; 
					} else {
						$arralokasi[$i][$j][1] = 'Perempuan';
					}
				} else if ($progress <= ($arrpersenlainnya[$i] + $arrpersenbudha[$i])) {
					$progressjkbudha = $progressjkbudha + (100 / ($jml_perkelas[$i] * ($arrpersenbudha[$i] / 100)));	
					if ($progressjkbudha <= ($arrpersenlaki2[$i])) {
						$arralokasi[$i][$j][1] = 'Laki-Laki'; 
					} else {
						$arralokasi[$i][$j][1] = 'Perempuan';
					}

					$arralokasi[$i][$j][0] = 'Budha';
				} else if ($progress <= ($arrpersenlainnya[$i] + $arrpersenbudha[$i] + $arrpersenhindu[$i])) {
					$progressjkhindu = $progressjkhindu + (100 / ($jml_perkelas[$i] * ($arrpersenhindu[$i] / 100)));	
					if ($progressjkhindu <= ($arrpersenlaki2[$i])) {
						$arralokasi[$i][$j][1] = 'Laki-Laki'; 
					} else {
						$arralokasi[$i][$j][1] = 'Perempuan';
					}

					$arralokasi[$i][$j][0] = 'Hindu';
				} else if ($progress <= ($arrpersenlainnya[$i] + $arrpersenbudha[$i] + $arrpersenhindu[$i] + $arrpersenkatholik[$i])) {
					$progressjkkatholik = $progressjkkatholik + (100 / ($jml_perkelas[$i] * ($arrpersenkatholik[$i] / 100)));	
					if ($progressjkkatholik <= ($arrpersenlaki2[$i])) {
						$arralokasi[$i][$j][1] = 'Laki-Laki'; 
					} else {
						$arralokasi[$i][$j][1] = 'Perempuan';
					}

					$arralokasi[$i][$j][0] = 'Katholik';
				} else if ($progress <= ($arrpersenlainnya[$i] + $arrpersenbudha[$i] + $arrpersenhindu[$i] + $arrpersenkatholik[$i] + $arrpersenkristen[$i])) {
					$progressjkkristen = $progressjkkristen + (100 / ($jml_perkelas[$i] * ($arrpersenkristen[$i] / 100)));	
					if ($progressjkkristen <= ($arrpersenlaki2[$i])) {
						$arralokasi[$i][$j][1] = 'Laki-Laki'; 
					} else {
						$arralokasi[$i][$j][1] = 'Perempuan';
					}

					$arralokasi[$i][$j][0] = 'Kristen';
		 		} else { //if ($progress <= ($arrpersenlainnya[$i] + $arrpersenbudha[$i] + $arrpersenhindu[$i] + $arrpersenkatholik[$i]) + $arrpersenkristen[$i] + $arrpersenislam[$i])) {
		 			$progressjkislam = $progressjkislam + (100 / ($jml_perkelas[$i] * ($arrpersenislam[$i] / 100)));	
		 			if ($progressjkislam <= ($arrpersenlaki2[$i])) {
		 				$arralokasi[$i][$j][1] = 'Laki-Laki'; 
		 			} else {
		 				$arralokasi[$i][$j][1] = 'Perempuan';
		 			}

		 			$arralokasi[$i][$j][0] = 'Islam';
		 		}
		 	}
		 }
		 
		//echo "Alokasi : <br/>";
		 for ($i=0;$i<$jml_kelas;$i++) {
			//echo "Kelas : ".$i."<br/>";
		 	for ($j=0;$j<$jml_perkelas[$i];$j++) {
		 		 //echo "Alokasi : ".@$arralokasi[$i][$j][0]." ".@$arralokasi[$i][$j][1]."<br/>";
		 	}
		 }

		 $arrdatasiswa = array(array());
		 $this->load->model('distribusi/mod_siswa');
		 $tabelsiswa = $this->mod_siswa->get();
		 foreach ($tabelsiswa as $rowsiswa) {
		 	$arrdatasiswa[] = array($rowsiswa->nisn, $rowsiswa->nama, $rowsiswa->agama, $rowsiswa->jenis_kelamin, '');
		 }

		 for ($i=0;$i<count($arrdatasiswa);$i++) {
			//echo @$arrdatasiswa[$i][0]." ".@$arrdatasiswa[$i][1]." ".@$arrdatasiswa[$i][2]." ".@$arrdatasiswa[$i][3]." ".@$arrdatasiswa[$i][4]."<br/>";
		 }		



		 for ($i=0;$i<$jml_kelas;$i++) {	
			//echo "Kelas $i =======<br/>";
		 	for ($j=0;$j<$jml_perkelas[$i];$j++) {
				//echo "Murid No $j =======<br/>";
		 		if (@$arralokasi[$i][$j][2] == '') {
		 			$ketemu = false;
		 			for ($k=0;$k<count($arrdatasiswa);$k++) {
		 				if (@$arrdatasiswa[$k][4] == '') {
		 					if ((@$arrdatasiswa[$k][2] == $arralokasi[$i][$j][0]) && (@$arrdatasiswa[$k][3] == $arralokasi[$i][$j][1])) {
								$arrdatasiswa[$k][4] = $i+1; //kelas harus mulai dari 1 karena kalau mulai 0 dianggap kosong ''
								$arralokasi[$i][$j][2] = $arrdatasiswa[$k][0];
								$ketemu = true;
								//echo $arrdatasiswa[$k][0]." ".$arrdatasiswa[$k][4]." dua2nya<br/>";
								break;
							}
						}
					}	
					if ($ketemu == false) {
						for ($k=0;$k<count($arrdatasiswa);$k++) {
							if (@$arrdatasiswa[$k][4] == '') {
								if ((@$arrdatasiswa[$k][2] == $arralokasi[$i][$j][0])) {
									$arrdatasiswa[$k][4] = $i+1;
									$arralokasi[$i][$j][2] = $arrdatasiswa[$k][0];
									$ketemu = true;
									//echo $arrdatasiswa[$k][0]." ".$arrdatasiswa[$k][4]."  agama sj<br/>";
									break;
								}
							}
						}	
					}	 		
					if ($ketemu == false) {
						for ($k=0;$k<count($arrdatasiswa);$k++) {
							if (@$arrdatasiswa[$k][4] == '') {
								if ((@$arrdatasiswa[$k][3] == $arralokasi[$i][$j][1])) {
									$arrdatasiswa[$k][4] = $i+1;
									$arralokasi[$i][$j][2] = $arrdatasiswa[$k][0];
									$ketemu = true;
									//echo $arrdatasiswa[$k][0]." ".$arrdatasiswa[$k][4]."  jk sj<br/>";
									break;
								}
							}
						}	
					}
					if ($ketemu == false) {
						for ($k=0;$k<count($arrdatasiswa);$k++) {
							if (@$arrdatasiswa[$k][4] == '') {
								if ((@$arrdatasiswa[$k][2] == "Islam")) {
									$arrdatasiswa[$k][4] = $i+1;
									$arralokasi[$i][$j][2] = $arrdatasiswa[$k][0];
									$ketemu = true;
									//echo $arrdatasiswa[$k][0]." ".$arrdatasiswa[$k][4]."  asal<br/>";
									break;
								}
							}
						}	
					}
				}
			}
		}

		for ($i=0;$i<count($arrdatasiswa);$i++) {
			//echo @$arrdatasiswa[$i][0]." ".@$arrdatasiswa[$i][1]." ".@$arrdatasiswa[$i][2]." ".@$arrdatasiswa[$i][3]." ".@$arrdatasiswa[$i][4]."<br/>";
		}		


		$this->load->model('distribusi/mod_siswa_kelas_reguler_berjalan');
		//echo "Alokasizz : <br/>";
		for ($i=0;$i<$jml_kelas;$i++) {
			//echo "Kelas : ".$i."<br/>";
			for ($j=0;$j<$jml_perkelas[$i];$j++) {
		 		 //echo "Alokasi : ".@$arralokasi[$i][$j][0]." ".@$arralokasi[$i][$j][1]." ".@$arralokasi[$i][$j][2]."<br/>";
		 		 //karena index array dari nol, sedangkan kelas dari 1.
		 		 //$this->mod_siswa_kelas_reguler_berjalan->insert(array('id_kelas_reguler_berjalan'=>$arridkelasreguler[$i], 'nisn' => @$arralokasi[$i][$j][2]));
				if (@$arralokasi[$i][$j][2] != "") {
					$this->mod_siswa_kelas_reguler_berjalan->insert(array('id_kelas_reguler_berjalan'=>$arridkelasregulerberjalan[$i], 'nisn' => @$arralokasi[$i][$j][2]));
				}
			}
		}

		$data['siswa'] = $this->mod_siswa_kelas_reguler_berjalan->get_siswa_kelas_reguler_berjalan();
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 

		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/hasil_pembagian_agama', $data);	
	}


	public function pembagian_prestasi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/pembagian_prestasi',$data);
	}

	public function hasil_pembagian_prestasi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/hasil_pembagian_prestasi',$data);	
	}

	public function distribusi_tam(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/distribusi_tam', $data);
	}

	public function hasil_pembagian_tambahan(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/hasil_pembagian_tambahan', $data);	
	}


	public function klinik_un(){
		$this->load->model('distribusi/mod_klinik_un');
		$data['klinik_un'] = $this->mod_klinik_un->get();
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/klinik_un', $data);
	}

	public function hasil_klinik_un() {
		$key = $this->input->post('id_klinik_un');
		$data['nisn'] = $this->input->post('nisn');
		$data['nama_siswa'] = $this->input->post('nama_siswa');
		$data['kelas'] = $this->input->post('kelas');
		$data['req_materi'] = $this->input->post('req_materi');
		$data['jumlah_peserta'] = $this->input->post('jumlah_peserta');
		$data['status_req'] = $this->input->post('status_req');
		$data['respon'] = $this->input->post('respon');
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 


		$this->load->model('distribusi/mod_klinik_un');
		
		$this->mod_klinik_un->insert($data);
		$this->session->set_flashdata('info','<script>swal("Tersimpan !", "Data berhasil disimpan!", "success")</script>');
		redirect('superadmin/kesiswaan/klinik_un');

	}

	public function simpan_respon(){
		$key = $this->uri->segment(4);
		if ($this->input->post('tanggal') != "") {
			$data['tanggal'] = $this->input->post('tanggal');	
		}
		
		$data['respon'] = $this->input->post('respon');
		$data['status_req'] = 'Sudah Direspon';
		
		$this->load->model('distribusi/mod_klinik_un');
		
		$this->mod_klinik_un->update($data, $key);
		$this->session->set_flashdata('info','<script>swal("Tersimpan !", "Data berhasil disimpan!", "success")</script>');
		redirect('superadmin/kesiswaan/klinik_un');		
	}

	public function hapus_klinik_un($id){
		$this->load->model('distribusi/mod_klinik_un');
		$this->mod_klinik_un->delete($id);
		$this->session->set_flashdata('warning','<script>swal("Berhasil", "Data Berhasil Dihapus", "success")</script>');
		redirect('superadmin/klinik_un');
	}


	

	public function mutasi_masuk(){

		$this->load->model('distribusi/Mod_form_mutasi_masuk');
		$this->load->model('distribusi/Mod_siswa_mutasi_masuk');
		$data['data_pencatatan'] = $this->Mod_siswa_mutasi_masuk->get_pencatatan();

		$data['form_pendaftaran_mutasi_masuk'] = $this->Mod_form_mutasi_masuk->get();
		$data['tabel_siswa_mutasi_masuk'] = $this->Mod_siswa_mutasi_masuk->get();
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/mutasi_masuk', $data);


	}

	public function simpan_form_mutasi() 
	{
		$this->load->model('distribusi/Mod_form_mutasi_masuk');
		$i=1;
		foreach ($this->db->get('form_pendaftaran_mutasi_masuk')->result() as $form) 
		{ 
			if ($this->input->post('nilai'.$form->id_form_pendaftaran_mutasi_masuk) == "1") 
			{
				$nilai = 1;
			} 
			else 
			{ 
				$nilai = 0; 
			}

			$arrdata = array
			(
				'nilai' => $nilai
			);
			if ($this->input->post('atribut'.$form->id_form_pendaftaran_mutasi_masuk) != "") 
			{
				$arrdata['atribut'] = $this->input->post('atribut'.$form->id_form_pendaftaran_mutasi_masuk); 
			}
			$this->load->model('distribusi/Mod_form_mutasi_masuk');
			$this->Mod_form_mutasi_masuk->update($arrdata, $form->id_form_pendaftaran_mutasi_masuk);

			$i=$i+1;
		}
		redirect('superadmin/kesiswaan/mutasi_masuk');
	}


	public function simpan_respon_mutasi(){
		$key = $this->uri->segment(4);
		
		$data['status_siswa'] = 'Diterima';
		
		$this->load->model('distribusi/mod_klinik_un');
		
		$this->mod_klinik_un->update($data, $key);
		$this->session->set_flashdata('info','<script>swal("Tersimpan !", "Data berhasil disimpan!", "success")</script>');
		redirect('superadmin/kesiswaan/klinik_un');		
	}


	public function ubah_status_siswa_mutasi($id, $status){
		$data['status_siswa'] = $status;
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->load->model('distribusi/Mod_siswa_mutasi_masuk');

		$this->Mod_siswa_mutasi_masuk->update($data, $id);
		redirect('superadmin/kesiswaan/mutasi_masuk');
	}



	public function editnilai(){

	}

	public function editberkas(){

	}


	public function mutasi_keluar(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/mutasi_keluar',$data);
	}


	public function upload_file()
	{
		$config['upload_path'] = './assets/files';
		$config['allowed_types'] = '*';

		$this->load->library('upload', $config);

		$upload = $this->upload->do_upload('pengumuman');

		if ($upload) {
			echo 'Upload berhasil';
			// Masukkan namanya ke DB
			
		} else {
			echo 'Upload gagal!';
			printf($this->upload->display_errors());
		}
	}
	// tutup kesiswaan NADYA

	// KEESISWAAN ANGGREK
	// public function ppdbujian()
	// {	
	// 	$this->load->model('kesiswaan/model_pendaftar_ppdb');

	// 	// VALUES: empty, semua, e.g. 2016/2017, dst...
	// 	$tahun_ajaran = $this->input->get('tahun_ajaran');

	// 	$tahun_aktif = NULL;
	// 	// Defaultnya ambil tahun yg aktif
	// 	if (empty($tahun_ajaran)) {
	// 		$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
	// 	} else if ($tahun_ajaran != 'semua') {
	// 		$tahun_aktif = $tahun_ajaran;
	// 	}

	// 	$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
	// 	$data['tahun_ajaran_selected'] = $tahun_aktif;

	// 	$this->load->model('kesiswaan/model_form_ppdb');
	// 	$data['tabel_form_ppdb'] = $this->model_form_ppdb->get();

	// 	$this->load->model('kesiswaan/model_ketentuan_ppdb');
	// 	$data['tabel_ketentuan_ppdb'] = $this->model_ketentuan_ppdb->get();

	// 	$this->load->model('kesiswaan/model_form_ujian');
	// 	$data['tabel_form_ujian'] = $this->model_form_ujian->get();

	// 	$this->load->model('kesiswaan/model_pengumuman_ppdb');
	// 	$data['tabel_pengumuman_ppdb'] = $this->model_pengumuman_ppdb->get();

	// 	$this->load->model('kesiswaan/model_tahunajaran');
	// 	$data['tahun_ajaran'] = $this->model_tahunajaran->get();

	// 	$this->load->model('kesiswaan/model_pendaftar_ppdb');
	// 	$data['tabel_pendaftar_ppdb_lolos'] = $this->model_pendaftar_ppdb->getlolos($tahun_aktif);

	// 		$data['nama'] = $this->session->Nama;
	// 	$data['foto'] = $this->session->foto; 
	// 	$this->template->load('superadmin/dashboard', 'superadmin/kesiswaan/ppdb/view_pendaftar_jalur_ujian', $data);
	// }



	// public function nonaktifform() 
	// {
	// 	$this->load->model('kesiswaan/model_form_ppdb');
	// 	$i=1;
 //        foreach ($this->db->get('form_ppdb')->result() as $form) 
 //         { 
 //         	if ($form->nilai == "1") 
	//          {
 //         		$nilai = 0;
 //         		$atribut = "";
	//          	$arrdata = array
	//          	( 'nilai' => $nilai );
	// 			if (($form->id_form_ppdb >= 29) && ($form->id_form_ppdb <= 33)) 
	// 				{ $arrdata['atribut'] = ''; }
	// 			$this->model_form_ppdb->update($arrdata, $form->id_form_ppdb);
 //         	} 
	// 		$i=$i+1;
 //         }

	// 	$this->load->model('kesiswaan/model_form_ppdb');

	// 	$this->session->set_flashdata('nonaktif', "<script>alert('Formulir berhasil dinon-aktifkan!');</script>");
	// 	redirect('superadmin/ppdbujian');
	// }

	// public function saveformswasta() 
	// {
	// 	$this->load->model('kesiswaan/model_form_ppdb');
	// 	$i=1;
 //        foreach ($this->db->get('form_ppdb')->result() as $form) 
 //         { 
 //         	if (($i>=29) && ($i<34))
 //         	{ //input text dari admin
	//          	if ($this->input->post('nilai'.$form->id_form_ppdb) == "1") 
	//          	{
	//          		$nilai = 1;
	//          		$atribut = $this->input->post('atribut'.$form->id_form_ppdb);
	//          	} 
	//          	else 
	//          	{ 
	//          		$nilai = 0; 
	//          		$atribut = "";
	//          	}

	//          	$arrdata = array
	//          	(
	// 				'nilai' => $nilai,
	// 				'atribut' => $atribut

	// 			);
	// 		} else {
	// 			if ($this->input->post('nilai'.$form->id_form_ppdb) == "1") 
	//          	{ $nilai = 1; } 
	//          	else 
	//          	{ $nilai = 0; }

	//          	$arrdata = array
	//          	( 'nilai' => $nilai );
	// 			if ($this->input->post('atribut'.$form->id_form_ppdb) != "") 
	// 			{ $arrdata['atribut'] = $this->input->post('atribut'.$form->id_form_ppdb); }			
	// 		}
	// 		$this->load->model('kesiswaan/model_form_ppdb');
	// 		$this->model_form_ppdb->update($arrdata, $form->id_form_ppdb);
 //            $i=$i+1;
 //         }         
	// 	$this->session->set_flashdata('aktif', "<script>alert('Formulir berhasil diaktifkan!');</script>");
	// 	redirect('superadmin/ppdbujian');
	// }


	
	public function ppdbujian(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 

		$tahun_ajaran = $this->input->get('tahun_ajaran');

		$tahun_aktif = NULL;
		// Defaultnya ambil tahun yg aktif
		if (empty($tahun_ajaran)) {
			$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
		} else if ($tahun_ajaran != 'semua') {
			$tahun_aktif = $tahun_ajaran;
		}

		$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
		//echo $this->db->last_query();
		$data['tahun_ajaran_selected'] = $tahun_aktif;

		$this->load->model('kesiswaan/model_tahunajaran');
		$data['tahun_ajaran'] = $this->model_tahunajaran->get();

		$this->load->model('kesiswaan/model_pendaftar_ppdb');
		$data['tabel_pendaftar_ppdb_lolos'] = $this->model_pendaftar_ppdb->getlolos($tahun_aktif);
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/ppdbujian', $data);
	}

	

	public function ubahstatus() 
	{
		$this->load->model('ppdb/model_pendaftar_ppdb');
		foreach ($this->input->post('nisn_ubah') as $nisn_siswa) {
			$arrdata=array("status_siswa" => $this->input->post('button'));
			$this->model_pendaftar_ppdb->update($arrdata, $nisn_siswa);	
		}
		$this->session->set_flashdata('status', "<script>alert('Status siswa berhasil diubah!');</script>");
		redirect('superadmin/ppdbujian');

	}




	public function ppdbneg(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;

		$tahun_ajaran = $this->input->get('tahun_ajaran');

		$tahun_aktif = NULL;
		// Defaultnya ambil tahun yg aktif
		if (empty($tahun_ajaran)) {
			$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
		} else if ($tahun_ajaran != 'semua') {
			$tahun_aktif = $tahun_ajaran;
		}

		$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
		$data['tahun_ajaran_selected'] = $tahun_aktif;

		$this->load->model('kesiswaan/model_tahunajaran');
		$data['tahun_ajaran'] = $this->model_tahunajaran->get();

		$this->load->model('kesiswaan/model_pendaftar_ppdb');
		$data['tabel_pendaftar_ppdb_lolos'] = $this->model_pendaftar_ppdb->getlolos($tahun_aktif);
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/ppdbneg', $data);
	}

	public function daftarulang(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;

		$tahun_ajaran = $this->input->get('tahun_ajaran');

		$tahun_aktif = NULL;
		// Defaultnya ambil tahun yg aktif
		if (empty($tahun_ajaran)) {
			$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
		} else if ($tahun_ajaran != 'semua') {
			$tahun_aktif = $tahun_ajaran;
		}

		$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
		$data['tahun_ajaran_selected'] = $tahun_aktif;

		$this->load->model('kesiswaan/model_tahunajaran');
		$data['tahun_ajaran'] = $this->model_tahunajaran->get();

		$this->load->model('kesiswaan/model_pendaftar_ppdb');
		$data['tabel_pendaftar_ppdb_lolos'] = $this->model_pendaftar_ppdb->getlolos($tahun_aktif);
		$this->template->load('superadmin/dashboard','superadmin/rancang/daftarulang', $data);

	}

	public function daftarkenaikan(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;

		$tahun_ajaran = $this->input->get('tahun_ajaran');

		$tahun_aktif = NULL;
		// Defaultnya ambil tahun yg aktif
		if (empty($tahun_ajaran)) {
			$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
		} else if ($tahun_ajaran != 'semua') {
			$tahun_aktif = $tahun_ajaran;
		}

		$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
		$data['tahun_ajaran_selected'] = $tahun_aktif;

		$this->load->model('kesiswaan/model_tahunajaran');
		$data['tahun_ajaran'] = $this->model_tahunajaran->get();

		$this->load->model('kesiswaan/model_pendaftar_ppdb');
		$data['tabel_pendaftar_ppdb_lolos'] = $this->model_pendaftar_ppdb->getlolos($tahun_aktif);
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/daftarkenaikan', $data);

	}
	public function bukuinduk(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;

		$tahun_ajaran = $this->input->get('tahun_ajaran');

		$tahun_aktif = NULL;
		// Defaultnya ambil tahun yg aktif
		if (empty($tahun_ajaran)) {
			$tahun_aktif  = $this->model_pendaftar_ppdb->get_tahun_ajaran_aktif()->tahun_ajaran;
		} else if ($tahun_ajaran != 'semua') {
			$tahun_aktif = $tahun_ajaran;
		}

		$data['tabel_pendaftar_ppdb'] = $this->model_pendaftar_ppdb->getsiswaangkatan($tahun_aktif);
		$data['tahun_ajaran_selected'] = $tahun_aktif;

		$this->load->model('kesiswaan/model_tahunajaran');
		$data['tahun_ajaran'] = $this->model_tahunajaran->get();

		$this->load->model('kesiswaan/model_pendaftar_ppdb');
		$data['tabel_pendaftar_ppdb_lolos'] = $this->model_pendaftar_ppdb->getlolos($tahun_aktif);
		$this->template->load('superadmin/dashboard','superadmin/kesiswaan/bukuinduk', $data);
	}
	 // TUTP KESISWAAN ANGGREK









	// Non AKADEMIK NOVEN
	// Pembimbing

	public function pendaftaran(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;

		$this->load->model('setting_model');
		$data['setting'] = $this->setting_model->get_setting();

		$this->template->load('superadmin/dashboard','superadmin/pembimbing/pendaftaran', $data);
	}

	public function jadwal(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/pembimbing/jadwal', $data);
	}

	public function presensi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/pembimbing/presensi', $data);
	}

	public function nilai(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/pembimbing/nilai', $data);
	}

	public function pembayaran(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/pembimbing/pembayaran', $data);
	}
	// TUTUP PEMBIMBING

	// Konseling

	public function keterlambatan(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/konseling/keterlambatan', $data);
	}

	public function absensi_harian(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/konseling/absensi_harian', $data);
	}

	public function pelanggaran(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/konseling/pelanggaran', $data);
	}

	public function prestasi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('superadmin/dashboard','superadmin/konseling/prestasi', $data);
	}

	// Tutup Konseling




	// nonakademik Noven

	function presensiakademik($action = null)
	{
		$this->load->model('Mod_ekskul','me');

		if ($action == null)
		{
			$data["jadwal_ekskul"] = $this->me->jdwal_ekskul();
			$data["data_pembimbing"] = $this->me->data_pembimbing();
			$data["tahun_presensi"] = $this->me->get_presensi_tahun();
			$data["data_ekskul"] = $this->me->data_ekskul();
			$this->load->template('superadmin/dashboard, superadmin/presensi', $data);
		}
		else if ($action == "save")
		{
			$dt_save["pembimbing"] = $_POST["pp_pembimbing"];
			$pp_tanggal = explode("-", $_POST["pp_tanggal"]);
			$dt_save["tanggal"] = $pp_tanggal[2]."-".$pp_tanggal[1]."-".$pp_tanggal[0];
			$dt_save["status"] = $_POST["pp_status"];
			$dt_save["jadwal_id"] = $_POST["pp_jadwal_id"];

			$this->me->simpan_presensi_pembimbing($dt_save);
		}
		else if ($action == "pp_report")
		{
			$tahun = $_POST["tahun"];
			$bulan = $_POST["bulan"];
			$hasil = $this->me->get_presensi_pembimbing_report($tahun, $bulan);

			$result = "";
			$i = 0;
			foreach ($hasil as $prensesi)
			{
				$i++;
				$tgl = date_create($prensesi->tgl_kegiatan);
				$result .= "<tr>
				<td>".$i.".</td>
				<td>".$tgl->format("d-m-Y")."</td>
				<td>".$prensesi->nama_pembimbing."</td> 
				<td>".$prensesi->jabatan."</td>  
				</tr>";
			}

			echo $result;
		}
		else if ($action == "siswa")
		{
			$thnajaran = $_POST["thnajaran"];
			$semester = $_POST["semester"];
			$idjadwal = $_POST["idjadwal"];
			$tanggal = $_POST["tanggal"];

			$pp_tanggal = explode("-", $tanggal);
			$stanggal = $pp_tanggal[2]."-".$pp_tanggal[1]."-".$pp_tanggal[0];
			//print_r($_POST);

			$arr_hasil = $this->me->get_presensi_siswa($thnajaran, $semester, $idjadwal, $stanggal);
			$result = "";
			foreach ($arr_hasil as $siswa)
			{
				$result .= '<tr>
				<td>'.$siswa->nama.'</td>
				<td>
				<label style="margin-right: 10px;"><input type="radio" name="siswa['.$siswa->nisn.']" value="h" '.($siswa->status_kehadiran == "h" ? "checked" : "").' > H</label>
				<label style="margin-right: 10px;"><input type="radio" name="siswa['.$siswa->nisn.']" value="i" '.($siswa->status_kehadiran == "i" ? "checked" : "").'> I</label>
				<label style="margin-right: 10px;"><input type="radio" name="siswa['.$siswa->nisn.']" value="s" '.($siswa->status_kehadiran == "s" ? "checked" : "").'> S</label>
				<label style="margin-right: 10px;"><input type="radio" name="siswa['.$siswa->nisn.']" value="a" '.($siswa->status_kehadiran == "a" ? "checked" : "").'> A</label>
				</td>
				</tr>';
			}
			echo $result;
		}
		else if ($action == "siswa_save")
		{
			//print_r($_POST["siswa"]);
			if (!empty($_POST["siswa"]))
			{
				foreach ($_POST["siswa"] as $nisn => $status)
				{
					$pp_tanggal = explode("-", $_POST["tanggal"]);
					$tanggal = $pp_tanggal[2]."-".$pp_tanggal[1]."-".$pp_tanggal[0];
					$arr_hasil = $this->me->simpan_presensi_siswa(array("nisn" => $nisn, "jadwal_id" => $_POST["pp_jadwal_id"], "tanggal" => $tanggal, "status" => $status));
				}
			}
		}
		else if ($action == "siswa_report")
		{
			$tanggal = $_POST["tanggal"];
			$tgl = explode("-", $tanggal);
			$stgl = $tgl[2]."-".$tgl[1]."-".$tgl[0];
			$ekskul = $_POST["ekskul"];
			$arr_hasil = $this->me->presensi_siswa($stgl,$ekskul);

			$content = "";
			$i = 0;
			foreach ($arr_hasil as $hasil)
			{
				$i++;
				$content .= "<tr>
				<td>".$i."</td>
				<td>".$hasil->nisn."</td>
				<td>".$hasil->nama."</td>
				<td>".strtoupper($hasil->status_kehadiran)."</td>
				</tr>";
			}

			echo $content;
		}
		else if ($action == "siswa_report_pertemuan")
		{
			$dt = array();
			$dt["thn_ajaran"] = $_POST["thn_ajaran"];
			$dt["semester"] = $_POST["semester"];
			$dt["jenis_kls_tambahan"] = $_POST["ekskul"];

			if ($_POST["subaction"] == "jum_pertemuan")
			{
				$arr_jum_prtemuan = $this->me->report_presensi("siswa_jum_pertemuan", $dt);
				echo json_encode($arr_jum_prtemuan);
			}
			else if ($_POST["subaction"] == "siswa_pertemuan")
			{
				$arr_siswa_pertemuan = $this->me->report_presensi("siswa_pertemuan", $dt);
				echo json_encode($arr_siswa_pertemuan);
			}
			
			
			// print_r($arr_jum_prtemuan);
			
		}


	}

	


}
