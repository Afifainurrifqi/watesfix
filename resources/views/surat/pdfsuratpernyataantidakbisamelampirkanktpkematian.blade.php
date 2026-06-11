<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pernyataan Tidak Bisa Melampirkan KTP</title>

    <style>
        @page {
            margin: 1.2cm 1.5cm 1cm 1.5cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11.3pt;
            line-height: 1.28;
            color: #000;
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .text-center {
            text-align: center;
        }

        .kop-container {
            width: 100%;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-table td {
            vertical-align: middle;
        }

        .kop-logo {
            width: 15%;
            text-align: center;
        }

        .kop-logo img {
            width: 80px;
            height: auto;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text strong {
            font-size: 12.3pt;
            line-height: 1.15;
        }

        .kop-text small {
            font-size: 9.3pt;
            line-height: 1.1;
        }

        .kop-garis {
            border: none;
            border-top: 2.5px solid #000;
            margin: 6px 0 10px 0;
        }

        .judul-surat {
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .judul-surat h3 {
            margin: 0;
            padding: 0;
            font-size: 12.3pt;
            line-height: 1.1;
        }

        .nomor-surat {
            margin-bottom: 11px;
            font-weight: bold;
            text-align: center;
            line-height: 1.15;
        }

        .tulisan {
            text-align: justify;
            margin-bottom: 4px;
        }

        table.tulisan {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0 7px 0;
        }

        table.tulisan td {
            padding: 1.3px 6px;
            vertical-align: top;
            line-height: 1.2;
        }

        table.tulisan td:first-child {
            width: 170px;
            font-weight: bold;
        }

        .ttd-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
            page-break-inside: avoid;
            page-break-before: avoid;
        }

        .ttd-spacer {
            width: 54%;
        }

        .ttd-cell {
            width: 46%;
            text-align: center;
            vertical-align: top;
            page-break-inside: avoid;
        }

        .ttd-cell p {
            margin: 0;
            padding: 0;
            line-height: 1.12;
        }

        .ttd-tanggal {
            margin-bottom: 2px;
        }

        .ttd-jabatan {
            margin-bottom: 0;
        }

        .ttd-img-wrapper {
            width: 100%;
            text-align: center;
            height: 68px;
            overflow: visible;
            margin-top: -2px;
            margin-bottom: -3px;
        }

        .ttd-img {
            width: 235px;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .nama-kades {
            font-weight: bold;
            font-size: 11pt;
            line-height: 1.1;
            margin-top: 0;
            position: relative;
            z-index: 2;
        }

        .jabatan-bawah {
            font-size: 10.3pt;
            line-height: 1.05;
            margin-top: 0;
        }

        .barcode {
            margin-top: 6px;
            text-align: center;
            line-height: 1;
        }

        .barcode img {
            width: 72px;
            height: auto;
        }

        .barcode small {
            font-size: 7.5pt;
            line-height: 1;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT -->
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
                    </strong>
                    <br>
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
    <!-- JUDUL SURAT -->
    <div class="text-center judul-surat">
        <h3><u>SURAT PERNYATAAN</u></h3>
    </div>

    <div class="nomor-surat">
        Nomor: {{ $data->nomor_surat ?? '300 / --- / 409.41.2 / ' . now()->year }}
    </div>
<br><br>
    <!-- ISI SURAT -->
    <p class="tulisan">
        Yang bertanda tangan di bawah ini, saya:
    </p>

    <br>

    <table class="tulisan">
        <tr>
            <td>Nama</td>
            <td>: {{ $data->nama_pelapor }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data->nik_pelapor }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: {{ $data->tempat_lahir_pelapor }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir_pelapor)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $data->jenis_kelamin_pelapor }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $data->pekerjaan_pelapor }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $data->alamat_pelapor }}</td>
        </tr>
    </table>

    <p class="tulisan">
        Menyatakan dengan sebenarnya bahwa tidak bisa melampirkan KTP termohon yang akan digunakan untuk
        pengurusan Akta Kematian dikarenakan <strong>{{ $data->alasan }}</strong> atas nama:
    </p>
<br>
    <table class="tulisan">
        <tr>
            <td>NIK</td>
            <td>: {{ $data->nik_jenazah }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: {{ $data->nama_jenazah }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>: {{ \Carbon\Carbon::parse($data->tanggal_lahir_jenazah)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $data->jenis_kelamin_jenazah }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $data->alamat_jenazah }}</td>
        </tr>
    </table>

    <p class="tulisan">
        Demikian surat pernyataan ini saya buat dengan sebenar-benarnya. Apabila dikemudian hari ternyata
        pernyataan saya tidak benar, saya bersedia diproses secara hukum sesuai peraturan yang berlaku.
    </p>
<br><br>
    <!-- TANDA TANGAN DI KANAN -->
    <table class="ttd-table">
        <tr>
            <td class="ttd-spacer"></td>

            <td class="ttd-cell">
                <p class="ttd-tanggal">
                    Wates, {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d F Y') }}
                </p>

                <p class="ttd-jabatan">
                    Kepala Desa Wates
                </p>

                <div class="ttd-img-wrapper">
                    <img src="{{ public_path('assets/images/ttd.png') }}" class="ttd-img" alt="Tanda Tangan Kades">
                </div>

                <p class="nama-kades">
                    <u>MOH. HAMID ALMAULUDI S.Pd.I</u>
                </p>

                <p class="jabatan-bawah">
                    Kepala Desa Wates
                </p>

                <div class="barcode">
                    <img src="{{ public_path('assets/images/barcode.png') }}" alt="Barcode Verifikasi">
                    <br>
                    <small> Dokumen ini resmi di TTD dikeluarkan oleh pemerintah desa wates</small>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
