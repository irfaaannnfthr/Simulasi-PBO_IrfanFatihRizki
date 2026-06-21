<?php
require_once __DIR__ . '/Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {

    protected string $skIkatanDinas;
    protected string $instansiSponsor;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->skIkatanDinas   = $data['sk_ikatan_dinas']  ?? '-';
        $this->instansiSponsor = $data['instansi_sponsor'] ?? '-';
    }

    // =============================================
    // OVERRIDE: Surcharge 25% untuk administrasi dinas
    // Total Biaya = biayaPendaftaranDasar * 1.25
    // =============================================
    public function hitungTotalBiaya(): float {
        return $this->biayaPendaftaranDasar * 1.25;
    }

    public function tampilkanInfoJalur(): string {
        return "
        Jalur             : Kedinasan
        SK Ikatan Dinas   : {$this->skIkatanDinas}
        Instansi Sponsor  : {$this->instansiSponsor}
        Biaya Dasar       : Rp " . number_format($this->biayaPendaftaranDasar, 0, ',', '.') . "
        Surcharge (25%)   : Rp " . number_format($this->biayaPendaftaranDasar * 0.25, 0, ',', '.') . "
        Total Biaya       : Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "
        ";
    }

    public function getDaftarKedinasan(PDO $db): array {
        $sql  = "SELECT id_pendaftaran, nama_calon, asal_sekolah,
                        nilai_ujian, biaya_pendaftaran_dasar,
                        sk_ikatan_dinas, instansi_sponsor
                 FROM tabel_pendaftaran
                 WHERE jalur_pendaftaran = 'Kedinasan'
                 ORDER BY nilai_ujian DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSkIkatanDinas(): string   { return $this->skIkatanDinas; }
    public function getInstansiSponsor(): string { return $this->instansiSponsor; }
}