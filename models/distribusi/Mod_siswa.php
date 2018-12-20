<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_siswa extends CI_Model {

	public function get() {
		return $this->db->get('siswa')->result();
		}

	public function insert($data) {
		$this->db->insert('siswa', $data);
	}

	public function delete($id) {
		$this->db->where('nisn', $id);
		$this->db->delete('siswa');
	}

	public function select($id) {
		$this->db->where('nisn', $id);
		return $this->db->get('siswa')->row();		
	}

	public function update($data, $id) {
		$this->db->where('nisn', $id);
		$this->db->update('siswa', $data);
	}
	
}


