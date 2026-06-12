<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pernyataan Pembetulan Data</title>
    <style>
        @page { margin: 1.2cm 1.6cm 1.2cm 1.6cm; }
        body { font-family: 'Times New Roman', Times, serif; font-size: 11.5pt; line-height: 1.35; }
        .kop-container { width: 100%; }
        .kop-table { width: 100%; border-collapse: collapse; }
        .kop-logo { width: 14%; text-align: center; }
        .kop-logo img { width: 70px; height: auto; }
        .kop-text { text-align: center; }
        .kop-text strong { font-size: 11.8pt; }
        .kop-text small { font-size: 8.8pt; }
        .kop-garis { border: none; border-top: 2.5px solid #000; margin: 5px 0 10px 0; }
        .judul-surat { text-align: center; margin-bottom: 8px; }
        .judul-surat h3 { font-size: 13.5pt; font-weight: bold; text-decoration: underline; margin: 0; }
        .tulisan { text-align: justify; margin-bottom: 6px; }
        table.data { width: 100%; border-collapse: collapse; margin: 5px 0 9px 0; }
        table.data td { padding: 2.5px 5px; vertical-align: top; }
        table.data td:first-child { width: 145px; font-weight: bold; }
        .ttd-table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        .ttd-spacer { width: 54%; }
        .ttd-cell { width: 46%; text-align: center; vertical-align: top; }
        .ttd-img-wrapper { height: 68px; text-align: center; margin: -2px 0 -3px 0; }
        .ttd-img { width: 235px; height: auto; }
        .nama-kades { font-weight: bold; font-size: 11pt; }
        .barcode img { width: 72px; height: auto; }
    </style>
</head>
<body>

    <!-- KOP -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td class="kop-logo"><img src="{{ public_path('assets/images/blitar.jpg') }}" alt="Logo"></td>
                <td class="kop-text">
                    <strong>PEMERINTAH KABUPATEN BLITAR<br>KECAMATAN WATES<br>KANTOR KEPALA DESA WATES</strong><br>
                    <small>Jln. Merdeka No. 74 Telp. 082139324445 | Email: watesberkelas@gmail.com</small>
                </td>
                <td class="kop-logo"><img src="{{ public_path('assets/images/Wates.png') }}" alt="Logo"></td>
            </tr>
        </table>
        <hr class="kop-garis">
    </div>

    <div class="judul-surat"><h3>SURAT PERNYATAAN</h3></div>

    <p class="tulisan"><strong>Yang bertanda tangan di bawah ini, Saya:</strong></p>

    <table class="data">
        <tr><td>Nama</td><td>: {{ $data->nama ?? '...........................................' }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik ?? '...........................................' }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat ?? '...........................................' }}</td></tr>
    </table>

    <div class="tulisan">
        Dengan ini menyatakan dengan sesungguhnya bahwa saya dengan sadar melakukan permohonan pembetulan data kependudukan berupa:
    </div>
    <p class="tulisan"><strong>{{ $data->uraian_pembetulan ?? '...........................................' }}</strong></p>

    <div class="tulisan">Yang didasarkan pada data pendukung berupa:</div>
    <ol>
        <li>{{ $data->data_pendukung_1 ?? '...........................................' }}</li>
        <li>{{ $data->data_pendukung_2 ?? '...........................................' }}</li>
        <li>{{ $data->data_pendukung_3 ?? '...........................................' }}</li>
        <li>{{ $data->data_pendukung_4 ?? '...........................................' }}</li>
        <li>{{ $data->data_pendukung_5 ?? '...........................................' }}</li>
    </ol>

    <div class="tulisan">
        Dan saya menyatakan bahwa tidak akan melakukan perubahan data ke data semula sebelum perubahan ini dilakukan. Apabila dikemudian hari saya melakukan perubahan dimaksud, maka saya bersedia untuk melakukan pemrosesan tersebut melalui penetapan pengadilan negeri.
    </div>

    <div class="tulisan">
        Demikian Surat Pernyataan ini saya buat dengan sebenar-benarnya dan apabila dikemudian hari ternyata pernyataan saya ini tidak benar, maka saya bersedia diproses secara hukum sesuai dengan peraturan perundang-undangan dan dokumen yang diterbitkan akibat dari pernyataan ini menjadi tidak sah.
    </div>

    <!-- TTD -->
    <table class="ttd-table">
        <tr>
            <td class="ttd-spacer"></td>
            <td class="ttd-cell">
                <p>Blitar, {{ now('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
                <p>Saya yang menyatakan,</p>

                <div class="ttd-img-wrapper">
                    <img src="{{ public_path('assets/images/ttd.png') }}" class="ttd-img" alt="TTD">
                </div>

                <p class="nama-kades"><u>{{ $data->nama ?? '...........................................' }}</u></p>

            </td>
        </tr>
    </table>

</body>
</html>
