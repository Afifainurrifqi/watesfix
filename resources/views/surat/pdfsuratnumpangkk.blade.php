<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pernyataan Numpang Kartu Keluarga</title>
    <style>
        @page { margin: 1.2cm 1.5cm 1cm 1.5cm; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11.3pt;
            line-height: 1.28;
            color: #000;
        }
        p { margin: 0; padding: 0; }
        .text-center { text-align: center; }

        /* KOP SURAT - SAMA DENGAN SURAT SEBELUMNYA */
        .kop-table { width: 100%; border-collapse: collapse; }
        .kop-table td { vertical-align: middle; }
        .kop-logo { width: 15%; text-align: center; }
        .kop-logo img { width: 80px; height: auto; }
        .kop-text { text-align: center; }
        .kop-text strong { font-size: 12.3pt; line-height: 1.15; }
        .kop-text small { font-size: 9.3pt; line-height: 1.1; }
        .kop-garis { border: none; border-top: 2.5px solid #000; margin: 6px 0 10px 0; }

        .judul-surat { margin-top: 2px; margin-bottom: 2px; }
        .judul-surat h3 { margin: 0; padding: 0; font-size: 12.3pt; }

        .nomor-surat { margin-bottom: 11px; font-weight: bold; text-align: center; }

        .tulisan { text-align: justify; margin-bottom: 4px; }
        table.tulisan { width: 100%; border-collapse: collapse; margin: 3px 0 7px 0; }
        table.tulisan td { padding: 1.3px 6px; vertical-align: top; line-height: 1.2; }
        table.tulisan td:first-child { width: 170px; font-weight: bold; }

        /* TTD - SAMA DENGAN SURAT SEBELUMNYA */
        .ttd-table { width: 100%; border-collapse: collapse; margin-top: 14px; }
        .ttd-spacer { width: 54%; }
        .ttd-cell { width: 46%; text-align: center; vertical-align: top; }
        .ttd-cell p { margin: 0; padding: 0; line-height: 1.12; }
        .ttd-tanggal { margin-bottom: 2px; }
        .ttd-jabatan { margin-bottom: 0; }
        .ttd-img-wrapper { width: 100%; text-align: center; height: 68px; overflow: visible; margin-top: -2px; margin-bottom: -3px; }
        .ttd-img { width: 235px; height: auto; display: block; margin-left: auto; margin-right: auto; }
        .nama-kades { font-weight: bold; font-size: 11pt; line-height: 1.1; margin-top: 0; }
        .jabatan-bawah { font-size: 10.3pt; line-height: 1.05; margin-top: 0; }
        .barcode { margin-top: 6px; text-align: center; line-height: 1; }
        .barcode img { width: 72px; height: auto; }
        .barcode small { font-size: 7.5pt; line-height: 1; }
    </style>
</head>
<body>

    <!-- KOP SURAT (SAMA) -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td class="kop-logo">
                    <img src="{{ public_path('assets/images/blitar.jpg') }}" alt="Logo Kabupaten">
                </td>
                <td class="kop-text">
                    <strong>
                        PEMERINTAH KABUPATEN BLITAR<br>
                        KECAMATAN WATES<br>
                        KANTOR KEPALA DESA WATES
                    </strong><br>
                    <small>
                        Jln. Merdeka No. 74 Telp. 082139324445<br>
                        Email : watesberkelas@gmail.com Website : wates-blitarkab.desa.id
                    </small>
                </td>
                <td class="kop-logo">
                    <img src="{{ public_path('assets/images/Wates.png') }}" alt="Logo Desa">
                </td>
            </tr>
        </table>
        <hr class="kop-garis">
    </div>

    <br><br>

    <!-- JUDUL -->
    <div class="text-center judul-surat">
        <h3><u>SURAT PERNYATAAN</u></h3>
        <strong>NUMPANG KARTU KELUARGA</strong>
    </div>

    <!-- NOMOR SURAT -->
    <div class="nomor-surat text-center">
        Nomor: {{ $data->nomor_surat ?? '400 / --- / 409.41.2 / ' . now()->year }}
    </div>

    <br><br>

    <!-- ISI SURAT -->
    <p class="tulisan">Yang bertanda tangan di bawah ini, saya:</p>

    <table class="tulisan">
        <tr><td>Nama</td><td>: {{ $data->nama_pemilik_kk }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik_pemilik_kk }}</td></tr>
        <tr><td>No. KK</td><td>: {{ $data->no_kk }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan_pemilik_kk }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat_pemilik_kk }}</td></tr>
    </table>

    <p class="tulisan">
        Selaku Kepala Keluarga, dengan ini menyatakan <strong>tidak keberatan</strong> memasukkan nama berikut ke dalam Kartu Keluarga saya:
    </p>

    <table class="tulisan">
        <tr><td>Nama</td><td>: {{ $data->nama_penumpang_kk }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik_penumpang_kk }}</td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $data->tempat_lahir_penumpang_kk }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir_penumpang_kk)->translatedFormat('d F Y') }}</td></tr>
        <tr><td>Agama</td><td>: {{ $data->agama_penumpang_kk }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan_penumpang_kk }}</td></tr>
    </table>

    <p class="tulisan">
        Demikian surat pernyataan ini saya buat dengan sebenar-benarnya dan tanpa paksaan dari pihak manapun.
    </p>

    <br><br>

    <!-- TTD (SAMA DENGAN SURAT SEBELUMNYA) -->
    <table class="ttd-table">
        <tr>
            <td class="ttd-spacer"></td>
            <td class="ttd-cell">
                <p class="ttd-tanggal">Wates, {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
                <p class="ttd-jabatan">Kepala Desa Wates</p>

                <div class="ttd-img-wrapper">
                    <img src="{{ public_path('assets/images/ttd.png') }}" class="ttd-img" alt="Tanda Tangan">
                </div>

                <p class="nama-kades"><u>MOH. HAMID ALMAULUDI S.Pd.I</u></p>
                <p class="jabatan-bawah">Kepala Desa Wates</p>

                <div class="barcode">
                    <img src="{{ public_path('assets/images/barcode.png') }}" alt="Barcode">
                    <br>
                    <small>Scan untuk verifikasi surat resmi Desa Wates</small>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
