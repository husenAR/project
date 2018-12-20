<?php

class Mod_ekskul extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                // Your own constructor code
        }

        function data_ekskul()
        {
                $query = $this->db->get('jenis_kls_tambahan')->result();
                return $query;
        }

        function data_pembimbing()
        {
                $query = $this->db->get('pembimbing')->result();
                return $query;
        }

        function get_siswa($nisn)
        {
                $this->db->where("nisn",$nisn);
                $query = $this->db->get('siswa')->row();
                return $query;
        }

        function simpan($data)
        {
                $nisn = $data["nisn"];
                $thn_ajaran = $data["thn_ajaran"];
                $semester = $data["semester"];
                $ekskul = $data["ekskul"];
                $jadwal_ekskul = $data["jadwal_ekskul"];

                $this->db->delete('ekstrakurikuler', array('nisn' => $nisn, "thn_ajaran" => $thn_ajaran, "semester" => $semester)); 

                $hasil = false;
                foreach ($ekskul as $eks => $veks)
                {
                        $data = array(
                           'nisn' => $nisn,
                           'id_jenis_kls_tambahan' => $eks,
                           'thn_ajaran' => $thn_ajaran,
                           'semester' => $semester,
                           'id_jadwal_ekskul' => $jadwal_ekskul
                        );

                        $hasil = $this->db->insert('ekstrakurikuler', $data);
                }

                return $hasil;
        }

        function statistik_ekskul($thn_ajaran = "", $semester = "")
        {
                $kueri = "select a.id_jenis_kls_tambahan, count(a.nisn) as jumlah, b.jenis_kls_tambahan
                        from ekstrakurikuler a
                        left join jenis_kls_tambahan b on b.id_jenis_kls_tambahan = a.id_jenis_kls_tambahan
                        where a.thn_ajaran = '$thn_ajaran' and a.semester = '$semester'
                        group by a.id_jenis_kls_tambahan";
                return $this->db->query($kueri)->result();
        }

        function jdwal_ekskul($mode = "jadwal1")
        {
            $arrhari = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');

            $hasil = array();
            foreach ($arrhari as $hari)
            {
                $kueri = "select a.*,b.jenis_kls_tambahan,c.nama_pembimbing
                            from jadwal_ekskul a
                            inner join jenis_kls_tambahan b on b.id_jenis_kls_tambahan = a.id_jenis_kls_tambahan
                            left join pembimbing c on c.id_pembimbing = a.id_pembimbing
                            where a.hari = '".$hari."'
                            order by a.jam_mulai";
                $arrjadwal = $this->db->query($kueri)->result();

                if ($mode == "jadwal1")
                {
                    $waktu = array();
                    $ekskul = array();
                    $tempat = array();
                    $pembimbing = array();
                    $id_jadwal = array();
                    foreach ($arrjadwal as $jadwal)
                    {
                        $jam1 = explode(":", $jadwal->jam_mulai);
                        $jam2 = explode(":", $jadwal->jam_selesai);
                        $waktu[] = $jam1[0].":".$jam1[1] . " - " . $jam2[0].":".$jam2[1];

                        $ekskul[] = $jadwal->jenis_kls_tambahan;
                        $tempat[] = $jadwal->tempat;
                        $pembimbing[] = $jadwal->nama_pembimbing;
                        $id_jadwal[] = $jadwal->id_jadwal_ekskul;
                    }

                    if (!empty($waktu))
                    {
                        $hasil[$hari] = array("waktu" => $waktu,
                                              "ekskul" => $ekskul,
                                              "tempat" => $tempat,
                                              "pembimbing" => $pembimbing,
                                              "id_jadwal" => $id_jadwal);
                    }
                }
                else if ($mode == "jadwal2")
                {
                    $hasil[$hari] = $arrjadwal;
                }
                    
                    
            }

            return $hasil;
                
        }

        function simpan_presensi_pembimbing($dt_save)
        {
            $data = array(
               'id_pembimbing' => $dt_save["pembimbing"],
               'id_jadwal_ekskul' => $dt_save["jadwal_id"],
               'tgl_kegiatan' => $dt_save["tanggal"],
               'status_kehadiran' => $dt_save["status"]
            );

            $hasil = $this->db->insert('presensi_kls_tambahan', $data);
            return $hasil;
        }

        function get_presensi_tahun()
        {
            $k_cari = "select year(a.tgl_kegiatan) as tahun
                        from presensi_kls_tambahan a
                        union
                        select year(current_date) - 1 as tahun
                        union
                        select year(current_date) as tahun
                        union
                        select year(current_date) + 1 as tahun
                        order by tahun";
            $q_cari = $this->db->query($k_cari)->result();
            return $q_cari;
        }

        function get_presensi_pembimbing_report($tahun, $bulan)
        {
            $k_cari = "select a.*,b.nama_pembimbing,b.jabatan
                        from presensi_kls_tambahan a
                        inner join pembimbing b on b.id_pembimbing = a.id_pembimbing
                        where year(a.tgl_kegiatan) = ".$tahun." and month(a.tgl_kegiatan) = ".$bulan."
                        order by a.tgl_kegiatan";
            $q_cari = $this->db->query($k_cari)->result();
            return $q_cari;
        }

        function get_presensi_siswa($thn_ajaran, $semester, $idjadwal, $tanggal)
        {
            $k_cari = "select a.*,c.nama,d.status_kehadiran #GROUP_CONCAT(d.status_kehadiran) as status
                        from ekstrakurikuler a
                        inner join jadwal_ekskul b on b.id_jenis_kls_tambahan = a.id_jenis_kls_tambahan and b.id_jadwal_ekskul = $idjadwal
                        inner join siswa c on c.nisn = a.nisn
                        left join presensi_kls_tambahan d on d.nisn = a.nisn and d.tgl_kegiatan = '$tanggal' and d.id_jadwal_ekskul = b.id_jadwal_ekskul
                        where a.thn_ajaran = '$thn_ajaran' and a.semester = '$semester' and a.id_jadwal_ekskul = $idjadwal
                        #group by a.nisn";
            $q_cari = $this->db->query($k_cari)->result();
            return $q_cari;
        }

        function simpan_presensi_siswa($dt_save)
        {
            $data = array(
               'nisn' => $dt_save["nisn"],
               'id_jadwal_ekskul' => $dt_save["jadwal_id"],
               'tgl_kegiatan' => $dt_save["tanggal"],
               'status_kehadiran' => $dt_save["status"]
            );

            $cari = "select * from presensi_kls_tambahan where nisn = '".$dt_save["nisn"]."' and id_jadwal_ekskul = '".$dt_save["jadwal_id"]."' and tgl_kegiatan = '".$dt_save["tanggal"]."'";
            $q_cari = $this->db->query($cari)->row();
            // print_r($q_cari);

            if (!$q_cari)
                $hasil = $this->db->insert('presensi_kls_tambahan', $data);
            else
            {
                $this->db->where('id_presensikls_tambahan', $q_cari->id_presensikls_tambahan);
                $hasil = $this->db->update('presensi_kls_tambahan', $data);
            }
            return $hasil;
        }

        function presensi_siswa($tanggal, $id_ekskul)
        {
            $cari = "select a.*,b.nama
                    from presensi_kls_tambahan a
                    inner join siswa b on b.nisn = a.nisn
                    inner join jadwal_ekskul c on c.id_jadwal_ekskul = a.id_jadwal_ekskul and c.id_jenis_kls_tambahan = $id_ekskul
                    where a.tgl_kegiatan = '$tanggal'";
            $q_cari = $this->db->query($cari)->result();
            return $q_cari;
        }

        function report_presensi($report = "", $data = array())
        {
            if ($report == "siswa_jum_pertemuan")
            {
                $thn_ajaran = isset($data["thn_ajaran"]) ? $data["thn_ajaran"] : "2016 - 2017";
                $semester = isset($data["semester"]) ? $data["semester"] : "genap";
                $jenis_kls_tambahan = isset($data["jenis_kls_tambahan"]) ? $data["jenis_kls_tambahan"] : "0";

                $k_cari_ekskul = "select distinct a.id_jadwal_ekskul
                                from ekstrakurikuler a
                                where a.thn_ajaran = '".$thn_ajaran."' and a.semester = '".$semester."' and a.id_jenis_kls_tambahan = ".$jenis_kls_tambahan;
                $q_cari_ekskul = $this->db->query($k_cari_ekskul)->row();
                
                if ($q_cari_ekskul)
                    $id_jadwal_ekskul = $q_cari_ekskul->id_jadwal_ekskul;
                else
                    $id_jadwal_ekskul = 0;

                $k_pertemuan = "select a.tgl_kegiatan
                                from presensi_kls_tambahan a
                                where a.id_jadwal_ekskul = ".$id_jadwal_ekskul."
                                group by a.tgl_kegiatan";
                $q_pertemuan = $this->db->query($k_pertemuan)->result();

                return $q_pertemuan;
            }
            else if ($report == "siswa_pertemuan")
            {
                $thn_ajaran = isset($data["thn_ajaran"]) ? $data["thn_ajaran"] : "2016 - 2017";
                $semester = isset($data["semester"]) ? $data["semester"] : "genap";
                $jenis_kls_tambahan = isset($data["jenis_kls_tambahan"]) ? $data["jenis_kls_tambahan"] : "0";

                $k_siswa = "select a.*,b.nama
                            from ekstrakurikuler a
                            inner join siswa b on b.nisn = a.nisn
                            where a.thn_ajaran = '".$thn_ajaran."' and a.semester = '".$semester."' and a.id_jenis_kls_tambahan = ".$jenis_kls_tambahan."
                            order by b.nama";
                $q_siswa = $this->db->query($k_siswa)->result();

                return $q_siswa;
            }
        }

}