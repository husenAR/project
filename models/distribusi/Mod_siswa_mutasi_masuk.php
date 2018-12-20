<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_siswa_mutasi_masuk extends CI_Model {

	public function get() {
		return $this->db->get('siswa_mutasi_masuk')->result();

		}

	public function insert($data) {
		$this->db->insert('siswa_mutasi_masuk', $data);
	}

	public function delete($id) {
		$this->db->where('id_pendaftar_mutasi', $id);
		$this->db->delete('siswa_mutasi_masuk');
	}

	public function select($id) {
		$this->db->where('id_pendaftar_mutasi', $id);
		return $this->db->get('siswa_mutasi_masuk')->row();		
	}

	public function update($data, $id) {
		$this->db->where('id_pendaftar_mutasi', $id);
		$this->db->update('siswa_mutasi_masuk', $data);
	}

	public function get_pencatatan(){
		return $this->db->select('nisn, nama_pendaftar_mutasi, sekolah_asal')
						->where ('status_siswa','Diterima')
						->get ('siswa_mutasi_masuk')
						->result();
	}
}