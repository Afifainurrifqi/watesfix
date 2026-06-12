<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SPTJM Kematian</title>
    <style>
        @page {
            margin: 0.7cm 1.2cm 0.6cm 1.2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10.2pt;
            line-height: 1.18;
            color: #000;
        }

        .kop-container {
            width: 100%;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-logo {
            width: 11%;
            text-align: center;
        }

        .kop-logo img {
            width: 55px;
            height: auto;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text strong {
            font-size: 10.6pt;
        }

        .kop-text small {
            font-size: 7.8pt;
        }

        .kop-garis {
            border: none;
            border-top: 2px solid #000;
            margin: 2px 0 5px 0;
        }

        .judul-surat {
            text-align: center;
            margin-bottom: 4px;
        }

        .judul-surat h3 {
            font-size: 11.5pt;
            font-weight: bold;
            text-decoration: underline;
            margin: 0;
        }

        .nomor-surat {
            text-align: center;
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 9.8pt;
        }

        .tulisan {
            text-align: justify;
            margin-bottom: 2px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin: 1px 0 5px 0;
        }

        table.data td {
            padding: 1px 3px;
            vertical-align: top;
        }

        table.data td:first-child {
            width: 148px;
            font-weight: bold;
        }

        .ttd-wrapper {
            width: 100%;
            margin-top: 8px;
        }

        .ttd-left {
            width: 48%;
            float: left;
            text-align: center;
        }

        .ttd-right {
            width: 48%;
            float: right;
            text-align: center;
        }

        .materai {
            border: 1px solid #000;
            padding: 3px 10px;
            display: inline-block;
            margin: 3px 0;
            font-weight: bold;
            font-size: 8.5pt;
        }

        .signature-line {
            margin-top: 22px;
            border-bottom: 1px solid #000;
            width: 165px;
            margin-left: auto;
            margin-right: auto;
        }

        .catatan {
            font-size: 8pt;
            margin-top: 6px;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT -->
    <div class="kop-container">
        <table class="kop-table">
            <tr>
                <td class="kop-logo">
                    <img src="{{ public_path('assets/images/blitar.jpg') }}" alt="Logo Blitar">
                </td>
                <td class="kop-text">
                    <strong>PEMERINTAH KABUPATEN BLITAR</strong><br>
                    <strong>KECAMATAN WATES</strong><br>
                    <strong>KANTOR KEPALA DESA WATES</strong><br>
                    <small>Jln. Merdeka No. 74 Telp. 082139324445 | Email: watesberkelas@gmail.com</small>
                </td>
                <td class="kop-logo">
                    <img src="{{ public_path('assets/images/Wates.png') }}" alt="Logo Desa Wates">
                </td>
            </tr>
        </table>
        <hr class="kop-garis">
    </div>

    <!-- JUDUL -->
    <div class="judul-surat">
        <h3>SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK (SPTJM)</h3>
        <strong>KEBENARAN DATA KEMATIAN</strong>
    </div>

    <!-- NOMOR SURAT -->
    <div class="nomor-surat">
        Nomor: {{ $data->nomor_surat ?? '470 / --- / 409.41.2 / ' . now()->year }}
    </div>

    <!-- DATA PELAPOR -->
    <p class="tulisan"><strong>Saya yang bertanda tangan di bawah ini:</strong></p>

    <table class="data">
        <tr>
            <td>Nama</td>
            <td>: {{ $data->nama ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data->nik ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>Tempat / Tanggal Lahir</td>
            <td>: {{ $data->ttl_tempat ?? '' }},
                {{ isset($data->ttl_tanggal) ? \Carbon\Carbon::parse($data->ttl_tanggal)->translatedFormat('d F Y') : '...........................................' }}
            </td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>: {{ $data->pekerjaan ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $data->alamat ?? '...........................................' }}</td>
        </tr>
    </table>

    <!-- DATA JENAZAH -->
    <p class="tulisan"><strong>Menyatakan dengan ini, bahwa:</strong></p>

    <table class="data">
        <tr>
            <td>Nama Jenazah</td>
            <td>: {{ $data->nama_jenazah ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data->nik_jenazah ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>Tempat / Tanggal Lahir</td>
            <td>: {{ $data->ttl_tempat_jenazah ?? '' }},
                {{ isset($data->ttl_tanggal_jenazah) ? \Carbon\Carbon::parse($data->ttl_tanggal_jenazah)->translatedFormat('d F Y') : '...........................................' }}
            </td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $data->jenis_kelamin ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>Anak Ke *)</td>
            <td>: {{ $data->anak_ke ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>Nama Ayah Kandung</td>
            <td>: {{ $data->nama_ayah_kandung ?? '...........................................' }}</td>
        </tr>
        <tr>
            <td>Nama Ibu Kandung</td>
            <td>: {{ $data->nama_ibu_kandung ?? '...........................................' }}</td>
        </tr>
    </table>

    <p class="tulisan">
        Meninggal dunia pada tanggal :
        <strong>{{ isset($data->tanggal_kematian) ? \Carbon\Carbon::parse($data->tanggal_kematian)->translatedFormat('d F Y') : '...........................................' }}</strong>
    </p>

    <p class="tulisan">
        Terlampir surat kematian dari :
        {{ $data->surat_kematian_dari ?? '...........................................' }}
    </p>

    <p class="tulisan">
        Demikian surat pernyataan ini saya buat dengan sebenar-benarnya dan apabila dikemudian hari ternyata pernyataan
        saya tidak benar, maka saya bersedia diproses secara hukum sesuai dengan peraturan perundang-undangan yang
        berlaku.
    </p>

    <!-- TANDA TANGAN -->
    <div class="ttd-wrapper">
        <!-- Kiri: Saksi -->
        <div class="ttd-left">
            <p><strong>Saksi I,</strong></p>
            <div class="signature-line" style="margin-top: 32px;"></div>
            <p>( {{ $data->nama_saksi_1 ?? '....................................' }} )</p>


            <br>

            <p><strong>Saksi II,</strong></p>
            <div class="signature-line" style="margin-top: 32px;"></div>
            <p>( {{ $data->nama_saksi_2 ?? '....................................' }} )</p>

        </div>

        <!-- Kanan: Yang Menyatakan -->
        <div class="ttd-right">
            <p>Wates, {{ now('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
            <p><strong>Saya yang menyatakan,</strong></p>

            <div class="materai">Materai<br>10.000</div>

            <div class="signature-line"></div>
            <p><strong>( {{ $data->nama ?? '...........................................' }} )</strong></p>

        </div>
    </div>

    <div class="catatan">
        <strong>Keterangan:</strong><br>
        -) Ditulis dengan huruf besar/balok &nbsp;&nbsp; *) Ditulis urutan kelahiran anak.
    </div>

</body>

</html>
