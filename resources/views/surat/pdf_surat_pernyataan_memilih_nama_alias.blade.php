<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pernyataan Memilih Nama Alias</title>
    <style>
        @page { margin: 2cm; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
            background: #fff;
        }

        h3, p { margin: 0; padding: 0; }

        .text-center { text-align: center; }
        .text-right  { text-align: right; }
        .text-justify{ text-align: justify; }

        .kop-container { width: 100%; }
        .kop-logo { width: 130px; }
        .kop-header { text-align: center; line-height: 1.4; }
        .kop-garis { border: 2px solid #000; margin-top: 5px; margin-bottom: 20px; }

        .judul-surat {
            margin-top: 10px;
            margin-bottom: 6px;
            text-align: center;
            text-decoration: underline;
            font-weight: bold;
            font-size: 16pt;
            text-transform: uppercase;
        }

        .nomor {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .isi { text-align: justify; margin-bottom: 20px; }

        table.data-diri {
            width: 100%;
            margin: 10px 0 15px 0;
            border-collapse: collapse;
        }
        table.data-diri td {
            vertical-align: top;
            padding: 4px 8px;
        }
        table.data-diri td.label  { width: 35%; }
        table.data-diri td.colon  { width: 2%; }
        table.data-diri td.value  { width: 63%; }

        .ttd-container {
            width: 100%;
            margin-top: 40px;
            text-align: right;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        .materai {
            margin-top: 20px;
            margin-bottom: 50px;
            text-align: right;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop-container">
        <table width="100%">
            <tr>
                <td width="15%" align="center">
                    <img src="{{ public_path('assets/images/blitar.jpg') }}" class="kop-logo" alt="Logo Kiri">
                </td>
                <td class="kop-header">
                    <strong>PEMERINTAH KABUPATEN BLITAR<br>
                        KECAMATAN WATES<br>
                        KANTOR KEPALA DESA WATES</strong><br>
                    <small>
                        Jln. Merdeka No. 74 Telp. 082139324445<br>
                        Email: watesberkelas@gmail.com | Website: wates-blitarkab.desa.id
                    </small>
                </td>
                <td width="15%" align="center">
                    <img src="{{ public_path('assets/images/wates.png') }}" class="kop-logo" alt="Logo Kanan">
                </td>
            </tr>
        </table>
        <hr class="kop-garis">
    </div>

    {{-- JUDUL --}}
    <div class="judul-surat">SURAT PERNYATAAN MEMILIH NAMA ALIAS</div>

    {{-- NOMOR (opsional) --}}
    @php $nomor = data_get($data, 'nomor'); @endphp
    @if(!empty($nomor))
        <div class="nomor">Nomor : {{ $nomor }}</div>
    @endif

    {{-- PARAGRAF PEMBUKA --}}
    <div class="isi">
        <p>Yang bertanda tangan di bawah ini, saya:</p>
    </div>

    {{-- IDENTITAS PEMBUAT PERNYATAAN --}}
    <table class="data-diri">
        <tr>
            <td class="label">Nama</td>
            <td class="colon">:</td>
            <td class="value">{{ data_get($data, 'nama', '................................................') }}</td>
        </tr>
        <tr>
            <td class="label">NIK</td>
            <td class="colon">:</td>
            <td class="value">{{ data_get($data, 'nik', '................................................') }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="colon">:</td>
            <td class="value">{{ data_get($data, 'alamat', '................................................') }}</td>
        </tr>
    </table>

    {{-- BAGIAN AKTA KELAHIRAN --}}
    <div class="isi">
        <p>Menyatakan dengan sebenar-benarnya bahwa pada Akta Kelahiran:</p>
    </div>

    <table class="data-diri">
        <tr>
            <td class="label">Nama pada Akta</td>
            <td class="colon">:</td>
            <td class="value">{{ data_get($data, 'nama_pemilih', '................................................') }}</td>
        </tr>
        <tr>
            <td class="label">No. Akta Kelahiran</td>
            <td class="colon">:</td>
            <td class="value">{{ data_get($data, 'no_akta_kelahiran', '................................................') }}</td>
        </tr>
    </table>

    {{-- ORANG TUA + ALIAS --}}
    <div class="isi">
        <p>Nama orang tua yang tercatat adalah:</p>
    </div>

    <div class="isi" style="margin-left: 10px;">
        <p>
            {{ data_get($data, 'nama_orang_tua', '................................................') }}
            @php $alias = trim((string) data_get($data, 'alias', '')); @endphp
            @if($alias !== '')
                &nbsp;alias&nbsp;<strong>{{ $alias }}</strong>
            @endif
        </p>
    </div>

    {{-- PERNYATAAN PENGHAPUSAN ALIAS --}}
    <div class="isi">
        <p>Selanjutnya saya mengajukan pembetulan nama orang tua pada Akta Kelahiran dengan
            <strong>menghapus bagian nama alias</strong> menjadi:</p>
    </div>

    <div class="isi" style="margin-left: 10px;">
        <p><strong>{{ data_get($data, 'data_alias_dihapus', '................................................') }}</strong></p>
    </div>

    {{-- DASAR / BERDASARKAN --}}
    @php $berdasarkan = data_get($data, 'berdasarkan', ''); @endphp
    @if($berdasarkan !== '')
        <div class="isi">
            <p><em>Berdasarkan</em> {{ $berdasarkan }}.</p>
        </div>
    @endif

    {{-- PENUTUP --}}
    <div class="isi">
        <p>Demikian surat pernyataan ini saya buat dengan sebenar-benarnya. Apabila di kemudian hari ternyata pernyataan
            ini tidak benar, saya bersedia diproses sesuai ketentuan peraturan perundang-undangan dan seluruh dokumen
            yang diterbitkan akibat pernyataan ini menjadi tidak sah.</p>
    </div>

    {{-- TANDA TANGAN (disesuaikan seperti referensi) --}}
    <div class="ttd-container">
        @php
            use Carbon\Carbon;
            $kota = data_get($data, 'kota_terbit', 'Wates');
            $tanggal = Carbon::now('Asia/Jakarta')->translatedFormat('d F Y');
        @endphp

        <p>{{ $kota }}, {{ $tanggal }}</p>
        <p>Yang Membuat Pernyataan</p>
        <br><br><br>
        <p><strong><u>{{ data_get($data, 'nama', '( ................................. )') }}</u></strong></p>
    </div>

</body>
</html>
