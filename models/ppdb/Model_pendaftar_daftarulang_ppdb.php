 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pendaftar_daftarulang_ppdb extends CI_Model {

	public function get()
	{
		return $this->db->get('pendaftar_daftarulang_ppdb')->result(); 
	}

	public function insert($data)
	{
		$this->db->insert('pendaftar_daftarulang_ppdb', $data);
	}

	public function select($id)
	{
		$this->db->where('nisn', $id);
		return $this->db->get('pendaftar_daftarulang_ppdb')->row(); 
	}

	public function update($data, $id)
	{
		$this->db->where('nisn', $id);
		$this->db->update('pendaftar_daftarulang_ppdb', $data);
	}	

	public function delete($id)
	{
		$this->db->where('nisn', $id);
		$this->db->delete('pendaftar_daftarulang_ppdb');
	}	

	public function getnamalulusppdb($tahun_ajaran = NULL)	//nyari nisn yang statusnya lulus pas ppdb
	{
		$this->db->select('*, pendaftar_daftarulang_ppdb.terverifikasi AS statusver');
		if ($tahun_ajaran != NULL) {
			$this->db->where('tahunajaran.tahun_ajaran', $tahun_ajaran);
		}
		$this->db->order_by('nomor_pendaftar asc');
		$this->db->join('siswa', 'siswa.nisn = pendaftar_daftarulang_ppdb.nisn', 'left');
		$this->db->join('tahunajaran', 'siswa.id_tahunajaran = tahunajaran.id_tahun_ajaran', 'left'); //myari tahun
		return $this->db->get('pendaftar_daftarulang_ppdb')->result(); 
	}

	public function cekterdaftar($nisn) //nyari udah dafatr ulang ppdb atau belum
	{
		$this->db->where('nisn', $nisn);
		return $this->db->get('pendaftar_daftarulang_ppdb')->result(); 	
	}
	
}
