<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing extends CI_Controller {

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
		$this->load->model('pegawai_model');
		if ($this->session->userdata('isLogin') != TRUE) {
			$this->session->set_flashdata("warning",'<script> swal( "Maaf Anda Belum Login!" ,  "Silahkan Login Terlebih Dahulu" ,  "error" )</script>');
			redirect('login');
			exit;
		}
		if ($this->session->userdata('jabatan') != 'Pembimbing') {
			$this->session->set_flashdata("warning",'<script> swal( "Anda Tidak Berhak!" ,  "Silahkan Login dengan Akun Anda" ,  "error" )</script>');
			//$this->load->view('login');
			redirect('login');
			exit;
		}
		// if ($this->session->userdata('jabatan') != 'Konseling') {
		// 	$this->session->set_flashdata("warning",'<script> swal( "Anda Tidak Berhak!" ,  "Silahkan Login dengan Akun Anda" ,  "error" )</script>');
		// 	//$this->load->view('login');
		// 	redirect('login');
		// 	exit;
		// }
	}
	public function index()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','pembimbing/home', $data);
	}

	public function profile()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['username'] = $this->session->username; 
		$data['datpeg'] = $this->pegawai_model->rowPegawai($this->session->userdata('NIP'));
		$this->template->load('pembimbing/dashboard','pegawai/profile', $data);
	}

	public function editprofil(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$data['rowpeg'] = $this->pegawai_model->rowPegawai($this->session->userdata('NIP'));
		$this->template->load('pembimbing/dashboard','pembimbing/editprofil', $data);
		if($this->input->post('submit')){
			$this->load->model('pegawai_model');
			$this->pegawai_model->updatedatpeg();	
			$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');			
			redirect('pembimbing/editprofil');
		} 
	}

	public function gantipassword()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard','pembimbing/gantipassword', $data);
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
				redirect('pembimbing/gantipassword');
			}else{
				// $this->session->set_flashdata("warning","<b>Kombinasi Username dan Password Anda tidak ditemukan, Pastikan Anda memasukkan Username dan Password yang benar</b>");

				$this->session->set_flashdata("warning",'<script> swal( "Oops" ,  "Password Lama Salah !" ,  "error" )</script>');



				redirect('pembimbing/gantipassword');
			}
		} else {
			$this->session->set_flashdata("warning",'<script> swal( "Oops" ,  "password Baru Harus Ganti !" ,  "error" )</script>');

			redirect('pembimbing/gantipassword');
		}
		
	}


	// mia
	public function jammengajar()
	{
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

		$this->load->model('penjadwalan/mod_jammengajar');
		$tabel_jammengajar = $this->mod_jammengajar->get(array("id_tahun_ajaran"=>$tahun_ajaran));
		$data['tabel_jammengajar'] = $tabel_jammengajar;




		
		$this->load->model('penjadwalan/mod_pegawai');
		$tabel_pegawai = $this->mod_pegawai->get(array("Status"=>"Guru"));
		$data['tabel_pegawai'] = $tabel_pegawai;

		$this->load->model('penjadwalan/mod_jadwalmapel');
		
		

		$this->load->model('penjadwalan/mod_namamapel');
		$data['tabel_namamapel'] = $this->mod_namamapel->get();
		$this->template->load('pembimbing/dashboard','kepsek/kurikulum/penjadwalan/jammengajar', $data);
	}

	public function jadwalmapel()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/kurikulum/jadwalmapel' ,$data);
	}

	public function jadwalpiketguru()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/kurikulum/jadwalpiketguru' ,$data);
	}

	public function jadwaltambahan()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard','superadmin/kurikulum/jadwaltambahan' ,$data);
	}


// tutup mia



	// Non AKADEMIK NOVEN
	// Pembimbing

	public function pendaftaran(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/pembimbing/pendaftaran', $data);
	}

	public function jadwal(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/pembimbing/jadwal', $data);
	}

	public function presensi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/pembimbing/presensi', $data);
	}

	public function nilai(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/pembimbing/nilai', $data);
	}

	public function pembayaran(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/pembimbing/pembayaran', $data);
	}
	// TUTUP PEMBIMBING

	// Konseling

	public function keterlambatan(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/konseling/keterlambatan', $data);
	}

	public function absensi_harian(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/konseling/absensi_harian', $data);
	}

	public function pelanggaran(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/konseling/pelanggaran', $data);
	}

	public function prestasi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','superadmin/konseling/prestasi', $data);
	}

	// Tutup Konseling


	// SIA ANggrek
	public function ppdbujian(){
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
		$this->template->load('pembimbing/dashboard','kepsek/kesiswaan/ppdbujian', $data);
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
		$this->template->load('pembimbing/dashboard','kepsek/kesiswaan/ppdbneg', $data);
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
		$this->template->load('pembimbing/dashboard','kepsek/kesiswaan/daftarulang', $data);

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
		$this->template->load('pembimbing/dashboard','kepsek/kesiswaan/daftarkenaikan', $data);

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
		$this->template->load('pembimbing/dashboard','superadmin/kesiswaan/bukuinduk', $data);
	}



// Nadya Aya 



	public function distribusi_reg(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','kepsek/rancang/distribusi_reg', $data);
	}

	public function distribusi_tam(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','kepsek/rancang/distribusi_tam', $data);
	}

	public function klinik_un(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','kepsek/rancang/klinik_un', $data);
	}

	public function mutasi_masuk(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','kepsek/rancang/mutasi_masuk', $data);
	}

	public function mutasi_keluar(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard','kepsek/rancang/mutasi_keluar', $data);
	}


	


	// Penilaian Hafiz

	public function kaldik(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('pembimbing/dashboard', 'kepsek/rancang/kaldik',$data);
	}

	public function kurikulum(){
				$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard', 'kepsek/rancang/kurikulum',$data);
	}

	public function nilaisiswa(){
				$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard', 'kepsek/rancang/nilaisiswa',$data);
	}


	public function kategorinilai(){
				$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard', 'kepsek/rancang/kategorinilai',$data);
	}

	public function jenisnilaiakhir(){
				$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard', 'kepsek/rancang/jenisnilaiakhir',$data);
	}

	public function deskripsinilai(){
				$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard', 'kepsek/rancang/deskripsinilai',$data);
	}

	public function rapor(){
				$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('pembimbing/dashboard', 'kepsek/rancang/Rapor',$data);
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
		$data['username'] = $this->session->username; 
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
		
		$this->template->load('pembimbing/dashboard','superadmin/kurikulum/penilaian/presensisiswa', $data);
	}
	
}
