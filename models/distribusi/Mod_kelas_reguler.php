<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_kelas_reguler extends CI_Model {

	public function get() {
		return $this->db->get('kelas_reguler')->result();
		}

	public function insert($data) {
		$this->db->insert('kelas_reguler', $data);
	}

	public function delete($id) {
		$this->db->where('id_kelas_reguler', $id);
		$this->db->delete('kelas_reguler');
	}

	public function select($id) {
		$this->db->where('id_kelas_reguler', $id);
		return $this->db->get('siswa')->row();		
	}

	public function update($data, $id) {
		$this->db->where('id_kelas_reguler', $id);
		$this->db->update('kelas_reguler', $data);
	}
	
}


