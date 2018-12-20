 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_orangtua_wali extends CI_Model {

	public function get()
	{
		return $this->db->get('orangtua_wali')->result(); 
	}

	public function insert($data) {
		$this->db->insert('orangtua_wali', $data);
	}

	public function select($id)
	{
		$this->db->where('id_orangtua', $id);
		return $this->db->get('orangtua_wali')->row(); 
	}

	public function update($data, $id) {
		$this->db->where('id_orangtua', $id);
		$this->db->update('orangtua_wali', $data);
	}	

	public function delete($id) {
		$this->db->where('id_orangtua', $id);
		$this->db->delete('orangtua_wali');
	}

	public function searchOrtu(array $data) {
		$this->db->where('nama_ayah', $data['ayah']);
		$this->db->where('nama_ibu', $data['ibu']);

		if (! is_null($wali = $data['wali'])) {
			$this->db->where('nama_wali', $wali);
		}

		return $this->db->get('orangtua_wali')->row();
	}
}
