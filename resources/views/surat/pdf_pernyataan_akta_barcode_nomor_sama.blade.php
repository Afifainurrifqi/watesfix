<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pernyataan Akta Barcode Nomor Sama</title>
    <style>
        @page {
            margin: 1.2cm 1.5cm 1cm 1.5cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11.3pt;
            line-height: 1.28;
            color: #000;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .text-center {
            text-align: center;
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
        }

        .kop-text small {
            font-size: 9.3pt;
        }

        .kop-garis {
            border: none;
            border-top: 2.5px solid #000;
            margin: 6px 0 10px 0;
        }

        .judul-surat {
            margin: 10px 0 6px;
            text-align: center;
        }

        .judul-surat h3 {
            font-size: 13pt;
            text-decoration: underline;
        }

        .nomor-surat {
            margin-bottom: 14px;
            font-weight: bold;
            text-align: center;
        }

        .tulisan {
            text-align: justify;
            margin-bottom: 6px;
        }

        table.tulisan {
            width: 100%;
            border-collapse: collapse;
            margin: 6px 0 10px 0;
        }

        table.tulisan td {
            padding: 2px 6px;
            vertical-align: top;
        }

        table.tulisan td:first-child {
            width: 170px;
            font-weight: bold;
        }

        .ttd-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .ttd-spacer {
            width: 54%;
        }

        .ttd-cell {
            width: 46%;
            text-align: center;
            vertical-align: top;
        }

        .ttd-img-wrapper {
            height: 68px;
            text-align: center;
            margin: -2px 0 -3px 0;
        }

        .ttd-img {
            width: 235px;
            height: auto;
        }

        .nama-kades {
            font-weight: bold;
            font-size: 11pt;
        }

        .barcode img {
            width: 72px;
            height: auto;
        }
    </style>
</head>

<body>

    <!-- KOP -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td class="kop-logo"><img src="{{ public_path('assets/images/blitar.jpg') }}" alt="Logo"></td>
                <td class="kop-text">
                    <strong>PEMERINTAH KABUPATEN BLITAR<br>
                        KECAMATAN WATES<br>
                        KANTOR KEPALA DESA WATES</strong><br>
                    <small>Jln. Merdeka No. 74 Telp. 082139324445<br>
                        Email: Watesberkelas@gmail.com</small>
                </td>
                <td class="kop-logo"><img src="{{ public_path('assets/images/Wates.png') }}" alt="Logo"></td>
            </tr>
        </table>
        <hr class="kop-garis">
    </div>

    <br><br>

    <div class="judul-surat">
        <h3><u>SURAT PERNYATAAN</u></h3>
    </div>

    <div class="nomor-surat">
        Nomor: {{ $data->nomor_surat ?? '460 / --- / 409.41.2 / ' . now()->year }}
    </div>

    <p class="tulisan">Yang bertanda tangan di bawah ini, Saya:</p>

    <table class="tulisan">
        <tr>
            <td>Nama</td>
            <td>: {{ $data->nama }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data->nik }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $data->alamat }}</td>
        </tr>
    </table>

    <p class="tulisan">Menyatakan dengan sebenarnya bahwa Akta Kelahiran:</p>

    <table class="tulisan">
        <tr>
            <td>Nama</td>
            <td>: {{ $data->nama_dalam_akta }}</td>
        </tr>
        <tr>
            <td>No. Akta Kelahiran</td>
            <td>: {{ $data->no_akta }}</td>
        </tr>
    </table>

    <p class="tulisan">
        ternyata tidak dapat ditemukan / tidak tercatat di Dinas Kependudukan dan Pencatatan Sipil Kabupaten Blitar.
    </p>

    <p class="tulisan">
        Selanjutnya saya mengurus Akta Kelahiran dengan nomor <strong>{{ $data->nomor }}</strong> sesuai dengan asas
        domisili dan ketentuan perundang-undangan yang berlaku.
    </p>

    <p class="tulisan">
        Demikian surat pernyataan ini saya buat dengan sebenar-sebenarnya dan
        apabila dikemudian hari ternyata pernyataan saya ini tidak benar, maka saya

        bersedia diproses secara hukum sesuai dengan peraturan perundang-
        undangan dan dokumen yang diterbitkan akibat dari pernyataan ini menjadi

        tidak sah.
    </p>

    <!-- TTD -->
    <table class="ttd-table">
        <tr>
            <td class="ttd-spacer"></td>
            <td class="ttd-cell">
                <p>Wates, {{ now('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
                <p>Saya yang menyatakan,</p>

                <div class="ttd-img-wrapper">
                    <img src="{{ public_path('assets/images/ttd.png') }}" class="ttd-img" alt="TTD">
                </div>

                <p class="nama-kades"><u>{{ $data->nama }}</u></p>
                <p>NIK: {{ $data->nik }}</p>

                <div class="barcode">
                    <img src="{{ public_path('assets/images/barcode_surat.png') }}" alt="Barcode">
                    <br><small>Scan untuk verifikasi surat resmi Desa Wates</small>
                </div>
            </td>
        </tr>
    </table>

</body>

</html>
