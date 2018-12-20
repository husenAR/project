<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct(){
		parent::__construct();
		if ($this->session->userdata('isLogin') != TRUE) {
			$this->session->set_flashdata("warning",'<script> swal( "Maaf Anda Belum Login!" ,  "Silahkan Login Terlebih Dahulu" ,  "error" )</script>');
			redirect('login');
			exit;
		}
		if ($this->session->userdata('jabatan') != 'Siswa') {
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
		$this->template->load('siswa/dashboard','siswa/home', $data);
	}

	public function klinik_un_siswa(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['username'] = $this->session->username;

		$this->template->load('siswa/dashboard','siswa/klinik_un_siswa', $data);
	}

	public function save_klinik_un_siswa(){
		$data = array(
				'nisn'=>$this->input->post('nisn'),
				'nama_siswa'=>$this->input->post('nama_siswa'),
				'kelas'=>$this->input->post('kelas'),
				'req_materi'=>$this->input->post('req_materi'),
				'jumlah_peserta'=>$this->input->post('jumlah_peserta'),
				'NIP'=>$this->session->userdata('NIP')
			);
		$this->load->model('distribusi/mod_klinik_un');
		$this->mod_klinik_un->insert($data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Data berhasil disimpan.
              </div>');
		redirect('siswa/klinik_un_siswa');
	}

	public function siswa_mutasi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['username'] = $this->session->username;
		$this->template->load('siswa/dashboard','siswa/siswa_mutasi', $data);
	}

	public function save_siswa_mutasi_1(){
		$data = array(

		'nisn'=>$this->input->post('nisn'),
		'no_induk_siswa'=>$this->input->post('no_induk_siswa'),
		'foto'=>$this->input->post('foto'),
		'nik'=>$this->input->post('nik'),
		'nama'=>$this->input->post('nama'),
		'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
		'tempat_lahir'=>$this->input->post('tempat_lahir'),
		'tanggal_lahir'=>$this->input->post('tanggal_lahir'),
		'agama'=>$this->input->post('agama'),
		'berkebutuhan_khusus'=>$this->input->post('berkebutuhan_khusus'),
		'alamat'=>$this->input->post('alamat'),
		'rt'=>$this->input->post('rt'),
		'rw'=>$this->input->post('rw'),
		'nama_dusun'=>$this->input->post('nama_dusun'),
		'desa_kelurahan'=>$this->input->post('desa_kelurahan'),
		'kecamatan'=>$this->input->post('kecamatan'),
		'kode_pos'=>$this->input->post('kode_pos'),
		'tempat_tinggal'=>$this->input->post('tempat_tinggal'),
		'kategori_penduduk'=>$this->input->post('kategori_penduduk'),
		'transportasi'=>$this->input->post('transportasi'),
		'no_telepon'=>$this->input->post('no_telepon'),
		'email'=>$this->input->post('email'),
		'pernah_paud'=>$this->input->post('pernah_paud'),
		'no_skhun_mi'=>$this->input->post('no_skhun_mi'),
		'no_seri_skhun_s'=>$this->input->post('no_seri_skhun_s'),
		'no_seri_ijazah_sd_mi'=>$this->input->post('no_seri_ijazah_sd_mi'),
		'penerima_kps_kks_pkh_kip'=>$this->input->post('penerima_kps_kks_pkh_kip'),
		'no_penerima'=>$this->input->post('no_penerima'),
		'anak_ke'=>$this->input->post('anak_ke'),
		'jumlah_saudara_kandung'=>$this->input->post('jumlah_saudara_kandung'),
		'jumlah_saudara_tiri'=>$this->input->post('jumlah_saudara_tiri'),
		'jumlah_saudara_angkat'=>$this->input->post('jumlah_saudara_angkat'),
		'status_dalam_keluarga'=>$this->input->post('status_dalam_keluarga'),
		'pernah_menderita_sakit'=>$this->input->post('pernah_menderita_sakit'),
		'pernah_mengaji'=>$this->input->post('pernah_mengaji'),
		'keterangan_mengaji'=>$this->input->post('keterangan_mengaji'),
		'anak_yatim_piatu'=>$this->input->post('anak_yatim_piatu'),
		'bahasa_sehari_hari_dirumah'=>$this->input->post('bahasa_sehari_hari_dirumah'),
		'prestasi_disekolah'=>$this->input->post('prestasi_disekolah'),
		'tinggi_badan'=>$this->input->post('tinggi_badan'),
		'berat_badan'=>$this->input->post('berat_badan'),
		'hobi'=>$this->input->post('hobi'),
		'asal_sekolah'=>$this->input->post('asal_sekolah'),
		'lama_belajar_disd_mi'=>$this->input->post('lama_belajar_disd_mi'),
		'id_orangtua'=>$this->session->userdata('id_orangtua')

			);
		$this->load->model('distribusi/mod_siswa');
		$this->mod_siswa->insert($data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Data berhasil disimpan.
              </div>');
		redirect('siswa/siswa_mutasi');
	}

	
	
}
