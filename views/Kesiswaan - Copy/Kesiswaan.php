<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kesiswaan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('pegawai_model');
		if ($this->session->userdata('isLogin') != TRUE) {
			$this->session->set_flashdata("warning",'<script> swal( "Maaf Anda Belum Login!" ,  "Silahkan Login Terlebih Dahulu" ,  "error" )</script>');
			redirect('login');
			exit;
		}
		if ($this->session->userdata('jabatan') != 'Kesiswaan') {
			$this->session->set_flashdata("warning",'<script> swal( "Anda Tidak Berhak!" ,  "Silahkan Login dengan Akun Anda" ,  "error" )</script>');
			//$this->load->view('login');
			redirect('login');
			exit;
		}
	}

	public function index(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/home' ,$data);
	}

	// Distribusi Kelas NADya
	public function distribusi_reg(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/distribusi_reg' ,$data);
	}

	public function distribusi_tam(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/distribusi_tam', $data);
	}

	public function gantipassword()
	{
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/gantipassword', $data);
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

				// redirect($result->url.'/');
				redirect('kesiswaan/gantipassword');
			}else{
				// $this->session->set_flashdata("warning","<b>Kombinasi Username dan Password Anda tidak ditemukan, Pastikan Anda memasukkan Username dan Password yang benar</b>");

				$this->session->set_flashdata("warning",'<script> swal( "Oops" ,  "Password Lama Salah !" ,  "error" )</script>');
				redirect('kesiswaan/gantipassword');
			}
		} else {
			$this->session->set_flashdata("warning",'<script> swal( "Oops" ,  "password Baru Harus Ganti !" ,  "error" )</script>');

			redirect('kesiswaan/gantipassword');
		}
		
	}

	public function profile()
	{
		$data['nama'] = $this->session->jabatan; 
		$data['datpeg'] = $this->pegawai_model->rowPegawai($this->session->userdata('NIP'));
		$this->template->load('kesiswaan/dashboard','kesiswaan/profile', $data);
	}

	public function klinik_un(){
		$data['nama'] = $this->session->jabatan; 
		$this->load->model('distribusi/mod_klinik_un');
		$data['klinik_un'] = $this->mod_klinik_un->get();
		$this->template->load('kesiswaan/dashboard','kesiswaan/klinik_un', $data);
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


		$this->load->model('distribusi/mod_klinik_un');
		
		$this->mod_klinik_un->insert($data);
		$this->session->set_flashdata('info','<script>swal("Tersimpan !", "Data berhasil disimpan!", "success")</script>');
		redirect('kesiswaan/klinik_un');

	}

	public function simpan_respon(){
		$key = $this->uri->segment(3);
		$data['respon'] = $this->input->post('respon');
		$data['status_req'] = 'Sudah Direspon';
		
		$this->load->model('distribusi/mod_klinik_un');
		
		$this->mod_klinik_un->update($data, $key);
		$this->session->set_flashdata('info','<script>swal("Tersimpan !", "Data berhasil disimpan!", "success")</script>');
		redirect('kesiswaan/klinik_un');		
	}

	
	public function mutasi_masuk(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/mutasi_masuk', $data);
	}

	public function mutasi_keluar(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/mutasi_keluar' ,$data);
	}

	// tutup Nadya

	// Anggrek PPDB

	public function ppdbujian(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/ppdbujian', $data);
	}

	public function ppdbneg(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/ppdbneg', $data);
	}

	public function daftarulang(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/daftarulang', $data);
	}

	public function daftarkenaikan(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/daftarkenaikan', $data);
	}

	public function bukuinduk(){
		$data['nama'] = $this->session->jabatan; 
		$this->template->load('kesiswaan/dashboard','kesiswaan/bukuinduk', $data);
	}

	
	

}

