<?php
require_once __DIR__ . '/Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {

    protected string $pilihanProdi;
    protected string $lokasiKampus;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->pilihanProdi = $data['pilihan_prodi'] ?? '-';
        $this->lokasiKampus = $data['lokasi_kampus'] ?? '-';
    }

    // =============================================
    // OVERRIDE: Tarif standar murni tanpa tambahan
    // Total Biaya = biayaPendaftaranDasar
    // =============================================
    public function hitungTotalBiaya(): float {
        return $this->biayaPendaftaranDasar;
    }

    public function tampilkanInfoJalur(): string {
        return "
        Jalur          : Reguler
        Pilihan Prodi  : {$this->pilihanProdi}
        Lokasi Kampus  : {$this->lokasiKampus}
        Total Biaya    : Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
        ";
    }

    public function getDaftarReguler(PDO $db): array {
        $sql  = "SELECT id_pendaftaran, nama_calon, asal_sekolah,
                        nilai_ujian, biaya_pendaftaran_dasar,
                        pilihan_prodi, lokasi_kampus
                 FROM tabel_pendaftaran
                 WHERE jalur_pendaftaran = 'Reguler'
                 ORDER BY nilai_ujian DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPilihanProdi(): string { return $this->pilihanProdi; }
    public function getLokasiKampus(): string { return $this->lokasiKampus; }
}