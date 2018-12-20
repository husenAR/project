<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

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
		if ($this->session->userdata('isLogin') != TRUE) {
			$this->session->set_flashdata("warning",'<script> swal( "Maaf Anda Belum Login!" ,  "Silahkan Login Terlebih Dahulu" ,  "error" )</script>');
			redirect('login');
			exit;
		}
		if ($this->session->userdata('jabatan') != 'Guru') {
			$this->session->set_flashdata("warning",'<script> swal( "Anda Tidak Berhak!" ,  "Silahkan Login dengan Akun Anda" ,  "error" )</script>');
			//$this->load->view('login');
			redirect('login');
			exit;
		}
	}
	

public function index()
	{

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto; 
		$data['username'] = $this->session->username;
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
		$data['totaluserlk'] = $usersNo->lk - $usersNo->ps;
		$data['totaluserpr'] = $usersNo->pr - $usersNo->ps;
		$data['totaluserps'] = $usersNo->ps ;
		$data['totaluserpg'] = $usersNo->pg - $usersNo->kp;
		$data['totaluserpk'] = $usersNo->pk - $usersNo->kg;



		$usersJabatan= $this->pegawai_model->gettotaljabatan();
		$data['totaljabatan'] = $usersJabatan->no - $usersNo->ps ;

		$userstanpaJabatan= $this->pegawai_model->gettotaltanpajabatan();
		$data['totaltanpajabatan'] = $userstanpaJabatan->no - $usersNo->ps;

		

		$data['grafikpresensipegawai'] = TRUE;
		$data['persentase'] = TRUE;
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$data['datpeg'] = $this->pegawai_model->Getdatpeg();
		$this->template->load('guru/dashboard','guru/home', $data);
	}
	
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
		$this->template->load('karyawan/dashboard','superadmin/kurikulum/penjadwalan/jammengajar', $data);
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
		redirect('karyawan/jammengajar');
	}

	public function hapusjammengajar() {
		$this->load->model('penjadwalan/mod_jammengajar');
		$this->mod_jammengajar->delete($this->uri->segment(3));
		redirect('karyawan/jammengajar');
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

		$this->template->load('karyawan/dashboard','superadmin/kurikulum/penjadwalan/jadwalmapel', $data);
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
		redirect('karyawan/jadwalmapel');
	}
	
	

	public function gantipassword()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','guru/gantipassword', $data);
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
				$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Password Berhasil Di Ganti", "success")</script>');
				redirect('guru/gantipassword');
			}else{
				// $this->session->set_flashdata("warning","<b>Kombinasi Username dan Password Anda tidak ditemukan, Pastikan Anda memasukkan Username dan Password yang benar</b>");

				$this->session->set_flashdata("warning",'<script> swal( "Maaf" ,  "Password Lama Salah !" ,  "error" )</script>');



				redirect('guru/gantipassword');
			}
		} else {
			$this->session->set_flashdata("warning",'<script> swal( "Maaf" ,  "Password Baru Salah !" ,  "error" )</script>');

			redirect('guru/gantipassword');
		}
		
	}

	

	public function profile()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;  
		$data['datpeg'] = $this->pegawai_model->rowPegawai($this->session->userdata('NIP'));
		$this->template->load('guru/dashboard','pegawai/profile', $data);
	}

	public function editprofil(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$data['rowpeg'] = $this->pegawai_model->rowPegawai($this->session->userdata('NIP'));
		$this->template->load('guru/dashboard','guru/editprofil', $data);
		if($this->input->post('submit')){
			$this->load->model('pegawai_model');
			$this->pegawai_model->updatedatpeg();	
			$this->session->set_flashdata('warning','<script>swal("Berhasil!", "Data Berhasil Disimpan", "success")</script>');			
			redirect('guru/editprofil');
		} 
	}

public function datapegawai()
	{
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;// 'Kepala Sekolah';
		$data['datpeg'] = $this->pegawai_model->Getdatpeg("Status = 'Karyawan' AND (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$data['datguru'] = $this->pegawai_model->Getdatpeg("Status = 'Guru' AND (Status_pensiun = '' OR Status_pensiun IS NULL)");
		$data['datpensiun'] = $this->pegawai_model->Getdatpeg("Status_pensiun = 'Pensiun' OR Status_pensiun = 'Keluar' ");
		$this->template->load('guru/dashboard','superadmin/pegawaibaru', $data);
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
		$this->template->load('guru/dashboard','superadmin/rekapkehadiran', $data);
	}
	

// +++++++++++++++++++++++++++++++PENJADWALAN MIA+++++++++++++++++++++++++++++++++++++++
	


// +++++++++++++++++++++++++++++++TUTUP PENJADWALAN MIA++++++++++++++++++++++++++++++++++++





	// Non AKADEMIK NOVEN
	// Pembimbing

	public function pendaftaran(){

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/pembimbing/pendaftaran', $data);
	}

	public function jadwal(){

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/pembimbing/jadwal', $data);
	}

	public function presensi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$this->template->load('guru/dashboard','superadmin/pembimbing/presensi', $data);
	}

	public function nilai(){

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/pembimbing/nilai', $data);
	}

	public function pembayaran(){

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/pembimbing/pembayaran', $data);
	}
	// TUTUP PEMBIMBING

	// Konseling

	public function keterlambatan(){

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/konseling/keterlambatan', $data);
	}

	public function absensi_harian(){

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/konseling/absensi_harian', $data);
	}

	public function pelanggaran(){

		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/konseling/pelanggaran', $data);
	}

	public function prestasi(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard','superadmin/konseling/prestasi', $data);
	}

	// Tutup Konseling

	// Penilaian Hafiz

	public function kaldik(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('guru/dashboard', 'kepsek/rancang/kaldik',$data);
	}

	public function kurikulum(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard', 'kepsek/rancang/kurikulum',$data);
	}

	public function nilaisiswa(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard', 'kepsek/rancang/nilaisiswa',$data);
	}


	public function kategorinilai(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard', 'kepsek/rancang/kategorinilai',$data);
	}

	public function jenisnilaiakhir(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard', 'kepsek/rancang/jenisnilaiakhir',$data);
	}

	public function deskripsinilai(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard', 'kepsek/rancang/deskripsinilai',$data);
	}

	public function rapor(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username; 
		$this->template->load('guru/dashboard', 'kepsek/rancang/Rapor',$data);
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
		
		$this->template->load('guru/dashboard','superadmin/kurikulum/penilaian/presensisiswa', $data);
	}
	

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
		$this->template->load('guru/dashboard','kepsek/kesiswaan/ppdbujian', $data);
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
		$this->template->load('guru/dashboard','kepsek/kesiswaan/ppdbneg', $data);
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
		$this->template->load('guru/dashboard','kepsek/kesiswaan/daftarulang', $data);

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
		$this->template->load('guru/dashboard','kepsek/kesiswaan/daftarkenaikan', $data);

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
		$this->template->load('guru/dashboard','superadmin/kesiswaan/bukuinduk', $data);
	}



// Nadya Aya 



	public function distribusi_reg(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('guru/dashboard','kepsek/rancang/distribusi_reg', $data);
	}

	public function distribusi_tam(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('guru/dashboard','kepsek/rancang/distribusi_tam', $data);
	}

	public function klinik_un(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('guru/dashboard','kepsek/rancang/klinik_un', $data);
	}

	public function mutasi_masuk(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('guru/dashboard','kepsek/rancang/mutasi_masuk', $data);
	}

	public function mutasi_keluar(){
		$data['nama'] = $this->session->Nama;
		$data['foto'] = $this->session->foto;
		$data['username'] = $this->session->username;
		$this->template->load('guru/dashboard','kepsek/rancang/mutasi_keluar', $data);
	}


	



	
	
}
