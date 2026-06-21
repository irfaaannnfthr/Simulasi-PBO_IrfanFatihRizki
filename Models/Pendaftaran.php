<?php
abstract class Pendaftaran {

    protected int    $id_pendaftaran;
    protected string $nama_calon;
    protected string $asal_sekolah;
    protected float  $nilai_ujian;
    protected float  $biayaPendaftaranDasar;

    public function __construct(array $data) {
        $this->id_pendaftaran        = $data['id_pendaftaran'];
        $this->nama_calon            = $data['nama_calon'];
        $this->asal_sekolah          = $data['asal_sekolah'];
        $this->nilai_ujian           = $data['nilai_ujian'];
        $this->biayaPendaftaranDasar = $data['biaya_pendaftaran_dasar'];
    }

    abstract public function hitungTotalBiaya(): float;
    abstract public function tampilkanInfoJalur(): string;

    public function tampilkanInfoUmum(): string {
        return "
        ID Pendaftaran : {$this->id_pendaftaran}
        Nama Calon     : {$this->nama_calon}
        Asal Sekolah   : {$this->asal_sekolah}
        Nilai Ujian    : {$this->nilai_ujian}
        Biaya Dasar    : Rp " . number_format($this->biayaPendaftaranDasar, 0, ',', '.') . "
        ";
    }

    public function getIdPendaftaran(): int    { return $this->id_pendaftaran; }
    public function getNamaCalon(): string     { return $this->nama_calon; }
    public function getAsalSekolah(): string   { return $this->asal_sekolah; }
    public function getNilaiUjian(): float     { return $this->nilai_ujian; }
    public function getBiayaDasar(): float     { return $this->biayaPendaftaranDasar; }
}