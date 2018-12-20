 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pendaftar_daftarulang_kenaikan extends CI_Model {

	public function get()
	{
		return $this->db->get('pendaftar_daftarulang_kenaikan')->result(); 
	}

	public function insert($data) {
		$this->db->insert('pendaftar_daftarulang_kenaikan', $data);
	}

	public function select($id)
	{
		$this->db->where('nisn', $id);
		return $this->db->get('pendaftar_daftarulang_kenaikan')->row(); 
	}

	public function update($data, $id) {
		$this->db->where('nisn', $id);
		$this->db->update('pendaftar_daftarulang_kenaikan', $data);
	}	

	public function delete($id) {
		$this->db->where('nisn', $id);
		$this->db->delete('pendaftar_daftarulang_kenaikan');
	}	

	public function getsiswa($tahun_ajaran = NULL)   // nama dan tahun ajaran
	{
		$this->db->join('siswa', 'pendaftar_daftarulang_kenaikan.nisn = siswa.nisn', 'left'); //nama
		$this->db->select('*, A.tahun_ajaran AS angkatan, T.tahun_ajaran AS tahunajaran');
		$this->db->join('tahunajaran T', 'pendaftar_daftarulang_kenaikan.id_tahun_ajaran = T.id_tahun_ajaran', 'left'); //tahun angkatan
		$this->db->join('tahunajaran A', 'siswa.id_tahunajaran = A.id_tahun_ajaran', 'left'); //tahun ajaran
		if ($tahun_ajaran != NULL) {
			$this->db->where('T.tahun_ajaran', $tahun_ajaran);
		}
		return $this->db->get('pendaftar_daftarulang_kenaikan')->result(); 
	}

	public function cek($nisn, $id_tahun_ajaran)
	{
		$this->db->where('nisn', $nisn);
		$this->db->where('id_tahun_ajaran', $id_tahun_ajaran);
		return $this->db->get('pendaftar_daftarulang_kenaikan')->row(); 
	}

}
