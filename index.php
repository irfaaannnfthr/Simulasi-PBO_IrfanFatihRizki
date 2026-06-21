<?php
require_once __DIR__ . '/Koneksi/koneksi.php';
require_once __DIR__ . '/Models/PendaftaranReguler.php';
require_once __DIR__ . '/Models/PendaftaranPrestasi.php';
require_once __DIR__ . '/Models/PendaftaranKedinasan.php';

// Koneksi database
$database = new Database();
$db       = $database->getConnection();

// Ambil data per jalur menggunakan metode query spesifik (Tahap 4)
$objReguler   = new PendaftaranReguler(['id_pendaftaran' => 0, 'nama_calon' => '', 'asal_sekolah' => '', 'nilai_ujian' => 0, 'biaya_pendaftaran_dasar' => 0]);
$objPrestasi  = new PendaftaranPrestasi(['id_pendaftaran' => 0, 'nama_calon' => '', 'asal_sekolah' => '', 'nilai_ujian' => 0, 'biaya_pendaftaran_dasar' => 0]);
$objKedinasan = new PendaftaranKedinasan(['id_pendaftaran' => 0, 'nama_calon' => '', 'asal_sekolah' => '', 'nilai_ujian' => 0, 'biaya_pendaftaran_dasar' => 0]);

$dataReguler   = $objReguler->getDaftarReguler($db);
$dataPrestasi  = $objPrestasi->getDaftarPrestasi($db);
$dataKedinasan = $objKedinasan->getDaftarKedinasan($db);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem PMB - Pendaftaran Mahasiswa Baru</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #1a237e, #283593);
            color: white;
            padding: 20px 40px;
            text-align: center;
        }

        header h1 { font-size: 24px; margin-bottom: 5px; }
        header p  { font-size: 13px; opacity: 0.8; }

        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }

        /* KARTU SECTION */
        .section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 35px;
            overflow: hidden;
        }

        .section-header {
            padding: 16px 24px;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-header.reguler   { background: linear-gradient(135deg, #1565c0, #1976d2); }
        .section-header.prestasi  { background: linear-gradient(135deg, #e65100, #f57c00); }
        .section-header.kedinasan { background: linear-gradient(135deg, #1b5e20, #388e3c); }

        .section-header h2 { font-size: 18px; }
        .section-header span.badge {
            background: rgba(255,255,255,0.25);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* TABEL */
        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead tr { background: #f5f5f5; }
        thead th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #e0e0e0;
        }

        tbody tr { border-bottom: 1px solid #f0f0f0; transition: background 0.2s; }
        tbody tr:hover { background: #fafafa; }
        tbody td { padding: 12px 16px; vertical-align: top; }

        /* INFO JALUR BOX */
        .info-jalur {
            background: #f9f9f9;
            border-left: 4px solid #ccc;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 12px;
            white-space: pre-line;
            line-height: 1.8;
        }

        .info-jalur.reguler   { border-color: #1976d2; background: #e3f2fd; }
        .info-jalur.prestasi  { border-color: #f57c00; background: #fff3e0; }
        .info-jalur.kedinasan { border-color: #388e3c; background: #e8f5e9; }

        /* BADGE TOTAL BIAYA */
        .biaya {
            font-weight: 700;
            font-size: 13px;
            padding: 5px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        .biaya.reguler   { background: #e3f2fd; color: #1565c0; }
        .biaya.prestasi  { background: #fff3e0; color: #e65100; }
        .biaya.kedinasan { background: #e8f5e9; color: #1b5e20; }

        .nilai { font-weight: 600; }
        .no    { color: #999; font-size: 12px; }

        footer {
            text-align: center;
            padding: 20px;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>

<header>
    <h1>🎓 Sistem Manajemen Pendaftaran Mahasiswa Baru</h1>
    <p>Data Calon Mahasiswa per Jalur Pendaftaran</p>
</header>

<div class="container">

    <!-- =============================== -->
    <!-- TABEL JALUR REGULER             -->
    <!-- =============================== -->
    <div class="section">
        <div class="section-header reguler">
            <h2>📋 Jalur Reguler</h2>
            <span class="badge"><?= count($dataReguler) ?> Pendaftar</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Calon</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Ujian</th>
                        <th>Info Jalur</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($dataReguler)): ?>
                    <tr><td colspan="6" style="text-align:center; color:#999;">Tidak ada data</td></tr>
                <?php else: ?>
                    <?php foreach ($dataReguler as $no => $row):
                        $obj = new PendaftaranReguler($row);
                    ?>
                    <tr>
                        <td class="no"><?= $no + 1 ?></td>
                        <td><strong><?= htmlspecialchars($obj->getNamaCalon()) ?></strong></td>
                        <td><?= htmlspecialchars($obj->getAsalSekolah()) ?></td>
                        <td class="nilai"><?= $obj->getNilaiUjian() ?></td>
                        <td>
                            <!-- tampilkanInfoJalur() - Tahap 6 -->
                            <div class="info-jalur reguler">
                                <?= nl2br(htmlspecialchars(trim($obj->tampilkanInfoJalur()))) ?>
                            </div>
                        </td>
                        <td>
                            <!-- hitungTotalBiaya() - Tahap 5 -->
                            <span class="biaya reguler">
                                Rp <?= number_format($obj->hitungTotalBiaya(), 0, ',', '.') ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- =============================== -->
    <!-- TABEL JALUR PRESTASI            -->
    <!-- =============================== -->
    <div class="section">
        <div class="section-header prestasi">
            <h2>🏆 Jalur Prestasi</h2>
            <span class="badge"><?= count($dataPrestasi) ?> Pendaftar</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Calon</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Ujian</th>
                        <th>Info Jalur</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($dataPrestasi)): ?>
                    <tr><td colspan="6" style="text-align:center; color:#999;">Tidak ada data</td></tr>
                <?php else: ?>
                    <?php foreach ($dataPrestasi as $no => $row):
                        $obj = new PendaftaranPrestasi($row);
                    ?>
                    <tr>
                        <td class="no"><?= $no + 1 ?></td>
                        <td><strong><?= htmlspecialchars($obj->getNamaCalon()) ?></strong></td>
                        <td><?= htmlspecialchars($obj->getAsalSekolah()) ?></td>
                        <td class="nilai"><?= $obj->getNilaiUjian() ?></td>
                        <td>
                            <!-- tampilkanInfoJalur() - Tahap 6 -->
                            <div class="info-jalur prestasi">
                                <?= nl2br(htmlspecialchars(trim($obj->tampilkanInfoJalur()))) ?>
                            </div>
                        </td>
                        <td>
                            <!-- hitungTotalBiaya() - Tahap 5 -->
                            <span class="biaya prestasi">
                                Rp <?= number_format($obj->hitungTotalBiaya(), 0, ',', '.') ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- =============================== -->
    <!-- TABEL JALUR KEDINASAN           -->
    <!-- =============================== -->
    <div class="section">
        <div class="section-header kedinasan">
            <h2>🎖️ Jalur Kedinasan</h2>
            <span class="badge"><?= count($dataKedinasan) ?> Pendaftar</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Calon</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Ujian</th>
                        <th>Info Jalur</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($dataKedinasan)): ?>
                    <tr><td colspan="6" style="text-align:center; color:#999;">Tidak ada data</td></tr>
                <?php else: ?>
                    <?php foreach ($dataKedinasan as $no => $row):
                        $obj = new PendaftaranKedinasan($row);
                    ?>
                    <tr>
                        <td class="no"><?= $no + 1 ?></td>
                        <td><strong><?= htmlspecialchars($obj->getNamaCalon()) ?></strong></td>
                        <td><?= htmlspecialchars($obj->getAsalSekolah()) ?></td>
                        <td class="nilai"><?= $obj->getNilaiUjian() ?></td>
                        <td>
                            <!-- tampilkanInfoJalur() - Tahap 6 -->
                            <div class="info-jalur kedinasan">
                                <?= nl2br(htmlspecialchars(trim($obj->tampilkanInfoJalur()))) ?>
                            </div>
                        </td>
                        <td>
                            <!-- hitungTotalBiaya() - Tahap 5 -->
                            <span class="biaya kedinasan">
                                Rp <?= number_format($obj->hitungTotalBiaya(), 0, ',', '.') ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<footer>
    <p>Sistem PMB &copy; <?= date('Y') ?> - Implementasi PHP OOP</p>
</footer>

</body>
</html>