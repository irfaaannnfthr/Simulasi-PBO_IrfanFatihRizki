<?php

require_once __DIR__ . '/Koneksi/koneksi.php';
require_once __DIR__ . '/Models/Pendaftaran.php';
require_once __DIR__ . '/Models/PendaftaranReguler.php';
require_once __DIR__ . '/Models/PendaftaranPrestasi.php';
require_once __DIR__ . '/Models/PendaftaranKedinasan.php';

// Koneksi database
$database = new Database();
$db       = $database->getConnection();

// Ambil data per jalur menggunakan metode query spesifik
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
    <title>Sistem PMB - Dashboard Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fe; /* Warna background modern ala SaaS */
            color: #2b3674;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* HEADER */
        header {
            background: linear-gradient(135deg, #111c44, #1a237e);
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        header .header-titles h1 { font-size: 20px; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px; }
        header .header-titles p  { font-size: 13px; color: #a3aed1; font-weight: 400; }

        /* LAYOUT UTAMA */
        .main-layout {
            display: flex;
            flex: 1;
            align-items: flex-start;
        }

        /* SIDEBAR MODERN */
        .sidebar {
            width: 270px;
            background: #ffffff;
            box-shadow: 4px 0 24px rgba(112, 144, 176, 0.08);
            position: sticky;
            top: 80px;
            height: calc(100vh - 80px);
            overflow-y: auto;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e9edf7;
        }

        /* User Profile Area */
        .sidebar-user {
            background: linear-gradient(180deg, #f4f7fe 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 30px 24px;
            border-bottom: 1px solid #e9edf7;
            margin-bottom: 20px;
        }

        .sidebar-user img {
            width: 50px;
            height: 50px;
            border-radius: 12px; /* Square membulat */
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(26, 35, 126, 0.15);
        }

        .sidebar-user .user-info {
            display: flex;
            flex-direction: column;
        }

        .sidebar-user .user-name {
            font-weight: 700;
            font-size: 15px;
            color: #2b3674;
        }

        .sidebar-user .user-role {
            font-size: 12px;
            color: #05cd99;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
        }

        .sidebar-user .user-role::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #05cd99;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(5, 205, 153, 0.5);
        }

        /* Menu Navigasi */
        .sidebar-title {
            padding: 0 24px 12px 24px;
            font-size: 12px;
            font-weight: 700;
            color: #a3aed1;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            list-style: none;
            margin-bottom: 20px;
        }

        .sidebar-menu li { margin-bottom: 4px; }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 24px;
            color: #707e94;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-menu li a:hover {
            color: #4318ff;
            background: rgba(67, 24, 255, 0.04);
            transform: translateX(4px);
        }

        .sidebar-menu li a.active {
            color: #4318ff;
            font-weight: 700;
            border-left: 4px solid #4318ff;
            background: rgba(67, 24, 255, 0.08);
        }

        /* KONTEN UTAMA & ANIMASI */
        .main-content {
            flex: 1;
            padding: 35px 40px;
            max-width: calc(100% - 270px);
        }

        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* KARTU SECTION */
        .section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(112, 144, 176, 0.05);
            margin-bottom: 40px;
            overflow: hidden;
            scroll-margin-top: 110px;
            animation: slideUpFade 0.6s ease-out forwards;
        }

        .section-header {
            padding: 20px 24px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header .title-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Gradien Baru untuk Tiap Jalur */
        .section-header.reguler   { background: linear-gradient(135deg, #4318ff, #3911d8); }
        .section-header.prestasi  { background: linear-gradient(135deg, #ff7a00, #e06a00); }
        .section-header.kedinasan { background: linear-gradient(135deg, #05cd99, #04a97e); }

        .section-header h2 { font-size: 18px; font-weight: 600; }
        
        .section-header span.badge {
            background: rgba(255,255,255,0.2);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            backdrop-filter: blur(5px);
        }

        /* TABEL ELEGAN */
        .table-wrap { overflow-x: auto; padding: 0 10px 10px 10px; }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }

        thead th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #a3aed1;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9edf7;
        }

        tbody tr:nth-child(even) { background-color: #fafbfc; } /* Zebra Striping */
        
        tbody tr { transition: all 0.2s ease; }
        
        tbody tr:hover { 
            background-color: #f4f7fe; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.02) inset;
        }

        tbody td { 
            padding: 16px; 
            vertical-align: middle; 
            color: #2b3674;
            border-bottom: 1px solid #e9edf7;
        }
        
        tbody tr:last-child td { border-bottom: none; }

        /* INFO JALUR BOX */
        .info-jalur {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            white-space: pre-line;
            line-height: 1.6;
            font-weight: 500;
        }

        .info-jalur.reguler   { background: #eff4ff; color: #4318ff; }
        .info-jalur.prestasi  { background: #fff5eb; color: #ff7a00; }
        .info-jalur.kedinasan { background: #e6faf5; color: #05cd99; }

        /* BADGE TOTAL BIAYA */
        .biaya {
            font-weight: 700;
            font-size: 14px;
            padding: 8px 14px;
            border-radius: 8px;
            display: inline-block;
        }

        .biaya.reguler   { background: #eff4ff; color: #4318ff; }
        .biaya.prestasi  { background: #fff5eb; color: #ff7a00; }
        .biaya.kedinasan { background: #e6faf5; color: #05cd99; }

        .nilai { font-weight: 700; color: #2b3674; }
        .no    { color: #a3aed1; font-size: 14px; font-weight: 600; text-align: center; }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 24px;
            color: #a3aed1;
            font-size: 13px;
            font-weight: 500;
            background: transparent;
            margin-top: auto;
        }

        /* RESPONSIVE LAYOUT */
        @media (max-width: 992px) {
            .main-layout { flex-direction: column; }
            .sidebar { 
                width: 100%; 
                height: auto; 
                position: relative; 
                top: 0; 
                border-right: none; 
            }
            .sidebar-user { justify-content: center; }
            .sidebar-menu { display: flex; flex-wrap: wrap; justify-content: center; }
            .sidebar-menu li a { border-left: none; border-bottom: 3px solid transparent; }
            .sidebar-menu li a.active { border-left: none; border-bottom: 3px solid #4318ff; }
            .main-content { max-width: 100%; padding: 20px; }
        }
    </style>
</head>
<body>

<header>
    <div class="header-titles">
        <h1>Sistem PMB Administrator</h1>
        <p>Dashboard Pengelolaan Data Calon Mahasiswa</p>
    </div>
</header>

<div class="main-layout">

    <aside class="sidebar">
        <div class="sidebar-user">
            <img src="https://ui-avatars.com/api/?name=Admin+App&background=4318ff&color=fff&bold=true" alt="Admin Profil">
            <div class="user-info">
                <span class="user-name">Adminstrator</span>
                <span class="user-role">Online Aktif</span>
            </div>
        </div>

        <div class="sidebar-title">Menu Utama</div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active">📊 Dashboard</a></li>
            <li><a href="#jalur-reguler">📋 Data Reguler</a></li>
            <li><a href="#jalur-prestasi">🏆 Data Prestasi</a></li>
            <li><a href="#jalur-kedinasan">🎖️ Data Kedinasan</a></li>
        </ul>

        <div class="sidebar-title" style="margin-top: 10px;">Sistem</div>
        <ul class="sidebar-menu">
            <li><a href="#">⚙️ Pengaturan</a></li>
        </ul>
    </aside>

    <main class="main-content">

        <div class="section" id="jalur-reguler" style="animation-delay: 0.1s;">
            <div class="section-header reguler">
                <div class="title-area">
                    <h2>📋 Jalur Pendaftaran Reguler</h2>
                </div>
                <span class="badge"><?= count($dataReguler) ?> Pendaftar</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Calon</th>
                            <th width="20%">Asal Sekolah</th>
                            <th width="10%">Nilai Ujian</th>
                            <th width="25%">Info Penilaian & Syarat</th>
                            <th width="20%">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($dataReguler)): ?>
                        <tr><td colspan="6" style="text-align:center; padding: 40px; color:#a3aed1;">Belum ada pendaftar di jalur ini.</td></tr>
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
                                <div class="info-jalur reguler">
                                    <?= nl2br(htmlspecialchars(trim($obj->tampilkanInfoJalur()))) ?>
                                </div>
                            </td>
                            <td>
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

        <div class="section" id="jalur-prestasi" style="animation-delay: 0.2s;">
            <div class="section-header prestasi">
                <div class="title-area">
                    <h2>🏆 Jalur Pendaftaran Prestasi</h2>
                </div>
                <span class="badge"><?= count($dataPrestasi) ?> Pendaftar</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Calon</th>
                            <th width="20%">Asal Sekolah</th>
                            <th width="10%">Nilai Ujian</th>
                            <th width="25%">Info Penilaian & Syarat</th>
                            <th width="20%">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($dataPrestasi)): ?>
                        <tr><td colspan="6" style="text-align:center; padding: 40px; color:#a3aed1;">Belum ada pendaftar di jalur ini.</td></tr>
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
                                <div class="info-jalur prestasi">
                                    <?= nl2br(htmlspecialchars(trim($obj->tampilkanInfoJalur()))) ?>
                                </div>
                            </td>
                            <td>
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

        <div class="section" id="jalur-kedinasan" style="animation-delay: 0.3s;">
            <div class="section-header kedinasan">
                <div class="title-area">
                    <h2>🎖️ Jalur Pendaftaran Kedinasan</h2>
                </div>
                <span class="badge"><?= count($dataKedinasan) ?> Pendaftar</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Calon</th>
                            <th width="20%">Asal Sekolah</th>
                            <th width="10%">Nilai Ujian</th>
                            <th width="25%">Info Penilaian & Syarat</th>
                            <th width="20%">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($dataKedinasan)): ?>
                        <tr><td colspan="6" style="text-align:center; padding: 40px; color:#a3aed1;">Belum ada pendaftar di jalur ini.</td></tr>
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
                                <div class="info-jalur kedinasan">
                                    <?= nl2br(htmlspecialchars(trim($obj->tampilkanInfoJalur()))) ?>
                                </div>
                            </td>
                            <td>
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

    </main>
</div>

<footer>
    &copy; <?= date('Y') ?> Sistem Manajemen Mahasiswa Baru. Crafted with PHP & Modern CSS.
</footer>

</body>
</html>