<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pernyataan dan Jaminan</title>
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

        /* KOP */
        .kop-table { width: 100%; border-collapse: collapse; }
        .kop-table td { vertical-align: middle; }
        .kop-logo { width: 15%; text-align: center; }
        .kop-logo img { width: 80px; height: auto; }
        .kop-text { text-align: center; }
        .kop-text strong { font-size: 12.3pt; }
        .kop-text small { font-size: 9.3pt; }
        .kop-garis { border: none; border-top: 2.5px solid #000; margin: 6px 0 10px 0; }

        .judul-surat h3 { font-size: 12.3pt; margin: 8px 0; text-decoration: underline; }
        .nomor-surat { margin-bottom: 11px; font-weight: bold; text-align: center; }

        .tulisan { text-align: justify; margin-bottom: 4px; }
        table.tulisan { width: 100%; border-collapse: collapse; margin: 3px 0 7px 0; }
        table.tulisan td { padding: 1.3px 6px; vertical-align: top; }
        table.tulisan td:first-child { width: 170px; font-weight: bold; }

        /* TTD */
        .ttd-table { width: 100%; border-collapse: collapse; margin-top: 14px; }
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

    <div class="judul-surat text-center">
        <h3><u>SURAT PERNYATAAN DAN JAMINAN</u></h3>
    </div>

    <div class="nomor-surat">
        Nomor: {{ $data->nomor_surat ?? '420 / --- / 409.41.2 / ' . now()->year }}
    </div>

    <p class="tulisan">Yang bertanda tangan di bawah ini:</p>

    <table class="tulisan">
        <tr><td>Nama</td><td>: {{ $data->nama_pembuat }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik_pembuat }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat_pembuat }}</td></tr>
    </table>

    <p class="tulisan">Dengan ini menyatakan dan menjamin atas nama:</p>

    <table class="tulisan">
        <tr><td>Nama</td><td>: {{ $data->nama_terjamin }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik_terjamin }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat_terjamin }}</td></tr>
        <tr><td>Hubungan</td><td>: {{ $data->hubungan_dengan_terjamin }}</td></tr>
    </table>

    <p class="tulisan"><strong>Uraian:</strong> {!! nl2br(e($data->uraian_pernyataan)) !!}</p>

    @if($data->bentuk_jaminan)
        <p class="tulisan"><strong>Bentuk Jaminan:</strong> {{ $data->bentuk_jaminan }}</p>
    @endif

    @if($data->berlaku_mulai)
        <p class="tulisan">
            <strong>Masa Berlaku:</strong>
            {{ \Carbon\Carbon::parse($data->berlaku_mulai)->translatedFormat('d F Y') }}
            @if($data->berlaku_sampai) s.d. {{ \Carbon\Carbon::parse($data->berlaku_sampai)->translatedFormat('d F Y') }} @endif
        </p>
    @endif

    <p class="tulisan">
        Demikian surat pernyataan dan jaminan ini dibuat dengan sebenar-benarnya.
    </p>

    <!-- TTD -->
    <table class="ttd-table">
        <tr>
            <td class="ttd-spacer"></td>
            <td class="ttd-cell">
                <p>Wates, {{ now('Asia/Jakarta')->translatedFormat('d F Y') }}</p>
                <p>Kepala Desa Wates</p>

                <div class="ttd-img-wrapper">
                    <img src="{{ public_path('assets/images/ttd.png') }}" class="ttd-img" alt="TTD">
                </div>

                <p class="nama-kades"><u>MOH. HAMID ALMAULUDI S.Pd.I</u></p>

                <div class="barcode">
                    <img src="{{ public_path('assets/images/barcode.png') }}" alt="Barcode">
                    <br><small>Scan untuk verifikasi surat resmi Desa Wates</small>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
