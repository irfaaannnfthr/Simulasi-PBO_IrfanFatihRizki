<?php
require_once __DIR__ . '/Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {

    protected string $jenisPrestasi;
    protected string $tingkatPrestasi;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->jenisPrestasi   = $data['jenis_prestasi']   ?? '-';
        $this->tingkatPrestasi = $data['tingkat_prestasi'] ?? '-';
    }

    public function hitungTotalBiaya(): float {
        return $this->biayaPendaftaranDasar * 0.80;
    }

    public function tampilkanInfoJalur(): string {
        return "
        Jalur            : Prestasi
        Jenis Prestasi   : {$this->jenisPrestasi}
        Tingkat Prestasi : {$this->tingkatPrestasi}
        Total Biaya      : Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
        ";
    }

    public function getDaftarPrestasi(PDO $db): array {
        $sql  = "SELECT id_pendaftaran, nama_calon, asal_sekolah,
                        nilai_ujian, biaya_pendaftaran_dasar,
                        jenis_prestasi, tingkat_prestasi
                 FROM tabel_pendaftaran
                 WHERE jalur_pendaftaran = 'Prestasi'
                 ORDER BY nilai_ujian DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getJenisPrestasi(): string   { return $this->jenisPrestasi; }
    public function getTingkatPrestasi(): string { return $this->tingkatPrestasi; }
}