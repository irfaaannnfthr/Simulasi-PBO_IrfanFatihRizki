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

    public function hitungTotalBiaya(): float {
        return 0;
    }

    public function tampilkanInfoJalur(): string {
        return "
        Jalur             : Kedinasan
        SK Ikatan Dinas   : {$this->skIkatanDinas}
        Instansi Sponsor  : {$this->instansiSponsor}
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