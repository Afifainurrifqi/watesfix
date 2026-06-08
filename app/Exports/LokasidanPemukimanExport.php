<?php

namespace App\Exports;

use App\Models\datapenduduk;
use App\Models\lokasipemukiman;
use App\Models\dataindividu;
use App\Models\akses_pendidikan;
use App\Models\akseskesehatan;
use App\Models\aksessarpras;
use App\Models\aksestenagakerja;
use App\Models\laink;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class LokasidanPemukimanExport extends DefaultValueBinder implements
    FromQuery, WithHeadings, WithMapping, ShouldAutoSize,
    WithColumnFormatting, WithCustomValueBinder
{
    public function __construct(protected ?string $filterNik = null) {}

    public function query()
    {
        $allowed = ['tetap', 'tidaktetap'];

        $q = datapenduduk::query()
            ->with(['detailkk.kk'])
            ->whereIn('Datak', $allowed)
            ->where('hubungan', 'Kepala Keluarga');   // ← Hanya Kepala Keluarga

        if ($this->filterNik) {
            $q->where('nik', $this->filterNik);
        }

        return $q;
    }

    public function headings(): array
    {
        return [
            'NO KK', 'NIK', 'NAMA', 'ALAMAT', 'NO. HP', 'NO. Telpon Rumah',
            'NIK Kepala Keluarga', 'TEMPAT TINGGAL YANG DITEMPATI', 'STATUS LAHAN',
            'LUAS LANTAI TEMPAT TINGGAL (m2)', 'LUAS TANAH TEMPAT TINGGAL (m2)',
            'JENIS LANTAI TEMPAT TINGGAL TERLUAS', 'DINDING SEBAGIAN BESAR RUMAH',
            'JENDELA', 'ATAP', 'PENERANGAN RUMAH', 'ENERGI UNTUK MEMASAK',
            'JIKA MENGGUNAKAN KAYU BAKAR, SUMBER KAYU BAKAR', 'TEMPAT PEMBUANGAN SAMPAH',
            'FASILITAS MCK', 'SUMBER AIR MANDI TERBANYAK DARI', 'FASILITAS BUANG AIR BESAR',
            'SUMBER AIR MINUM TERBANYAK', 'TEMPAT PEMBUANGAN AIR LIMBAH',
            'RUMAH DILEWATI SUTET', 'RUMAH DIPANTARAN SUNGAI', 'RUMAH DI LERENG GUNUNG / BUKIT',
            'KONDISI RUMAH KUMUH / TIDAK',

            // Pendidikan
            'PAUD - JARAK (KM)', 'PAUD - WAKTU (JAM)', 'PAUD - KEMUDAHAN',
            'TK/RA - JARAK (KM)', 'TK/RA - WAKTU (JAM)', 'TK/RA - KEMUDAHAN',
            'SD/MI - JARAK (KM)', 'SD/MI - WAKTU (JAM)', 'SD/MI - KEMUDAHAN',
            'SMP/MTs - JARAK (KM)', 'SMP/MTs - WAKTU (JAM)', 'SMP/MTs - KEMUDAHAN',
            'SMA/MA - JARAK (KM)', 'SMA/MA - WAKTU (JAM)', 'SMA/MA - KEMUDAHAN',
            'PERGURUAN TINGGI - JARAK (KM)', 'PERGURUAN TINGGI - WAKTU (JAM)', 'PERGURUAN TINGGI - KEMUDAHAN',
            'PESANTREN - JARAK (KM)', 'PESANTREN - WAKTU (JAM)', 'PESANTREN - KEMUDAHAN',
            'SEMINARI - JARAK (KM)', 'SEMINARI - WAKTU (JAM)', 'SEMINARI - KEMUDAHAN',
            'PEND. KEAGAMAAN LAIN - JARAK (KM)', 'PEND. KEAGAMAAN LAIN - WAKTU (JAM)', 'PEND. KEAGAMAAN LAIN - KEMUDAHAN',

            // Kesehatan
            'RUMAH SAKIT - JARAK (KM)', 'RUMAH SAKIT - WAKTU (JAM)', 'RUMAH SAKIT - KEMUDAHAN',
            'RS BERSALIN - JARAK (KM)', 'RS BERSALIN - WAKTU (JAM)', 'RS BERSALIN - KEMUDAHAN',
            'POLIKLINIK - JARAK (KM)', 'POLIKLINIK - WAKTU (JAM)', 'POLIKLINIK - KEMUDAHAN',
            'PUSKESMAS - JARAK (KM)', 'PUSKESMAS - WAKTU (JAM)', 'PUSKESMAS - KEMUDAHAN',
            'POSKESDES - JARAK (KM)', 'POSKESDES - WAKTU (JAM)', 'POSKESDES - KEMUDAHAN',
            'POSYANDU - JARAK (KM)', 'POSYANDU - WAKTU (JAM)', 'POSYANDU - KEMUDAHAN',
            'APOTIK - JARAK (KM)', 'APOTIK - WAKTU (JAM)', 'APOTIK - KEMUDAHAN',
            'TOKO OBAT - JARAK (KM)', 'TOKO OBAT - WAKTU (JAM)', 'TOKO OBAT - KEMUDAHAN',

            // Tenaga Kesehatan
            'DOKTER SPESIALIS - JARAK (KM)', 'DOKTER SPESIALIS - WAKTU (JAM)', 'DOKTER SPESIALIS - KEMUDAHAN',
            'DOKTER UMUM - JARAK (KM)', 'DOKTER UMUM - WAKTU (JAM)', 'DOKTER UMUM - KEMUDAHAN',
            'BIDAN - JARAK (KM)', 'BIDAN - WAKTU (JAM)', 'BIDAN - KEMUDAHAN',
            'TENAGA KESEHATAN - JARAK (KM)', 'TENAGA KESEHATAN - WAKTU (JAM)', 'TENAGA KESEHATAN - KEMUDAHAN',
            'DUKUN - JARAK (KM)', 'DUKUN - WAKTU (JAM)', 'DUKUN - KEMUDAHAN',

            // Sarpras
            'LOKASI PEKERJAAN - JENIS TRANS', 'LOKASI PEKERJAAN - TRANS UMUM', 'LOKASI PEKERJAAN - WAKTU (JAM)', 'LOKASI PEKERJAAN - BIAYA (Rp)', 'LOKASI PEKERJAAN - KEMUDAHAN',
            'LAHAN PERTANIAN - JENIS TRANS', 'LAHAN PERTANIAN - TRANS UMUM', 'LAHAN PERTANIAN - WAKTU (JAM)', 'LAHAN PERTANIAN - BIAYA (Rp)', 'LAHAN PERTANIAN - KEMUDAHAN',
            'SEKOLAH - JENIS TRANS', 'SEKOLAH - TRANS UMUM', 'SEKOLAH - WAKTU (JAM)', 'SEKOLAH - BIAYA (Rp)', 'SEKOLAH - KEMUDAHAN',
            'BEROBAT - JENIS TRANS', 'BEROBAT - TRANS UMUM', 'BEROBAT - WAKTU (JAM)', 'BEROBAT - BIAYA (Rp)', 'BEROBAT - KEMUDAHAN',
            'BERIBADAH - JENIS TRANS', 'BERIBADAH - TRANS UMUM', 'BERIBADAH - WAKTU (JAM)', 'BERIBADAH - BIAYA (Rp)', 'BERIBADAH - KEMUDAHAN',
            'REKREASI - JENIS TRANS', 'REKREASI - TRANS UMUM', 'REKREASI - WAKTU (JAM)', 'REKREASI - BIAYA (Rp)', 'REKREASI - KEMUDAHAN',

            // Lain-lain
            'TRANSPORT SEBELUMNYA', 'TRANSPORT SEKARANG',
            'BLT', 'PKH', 'BST', 'BANTUAN PRESIDEN', 'BANTUAN UMKM',
            'BANTUAN PEKERJA', 'BANTUAN ANAK', 'LAINNYA',
            'RATA-RATA PENGELUARAN / BULAN (Rp)'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (in_array($cell->getColumn(), ['A','B','E','F','G'])) {
            $cell->setValueExplicit((string)$value, DataType::TYPE_STRING);
            return true;
        }
        return parent::bindValue($cell, $value);
    }

    public function map($row): array
    {
        $kk   = optional(optional($row->detailkk)->kk)->nokk ?? '';
        $lok  = lokasipemukiman::where('nik', $row->nik)->first();
        $ind  = dataindividu::where('nik', $row->nik)->first();
        $pend = akses_pendidikan::where('nik', $row->nik)->first();
        $kes  = akseskesehatan::where('nik', $row->nik)->first();
        $ten  = aksestenagakerja::where('nik', $row->nik)->first();
        $sar  = aksessarpras::where('nik', $row->nik)->first();
        $lnk  = laink::where('nik', $row->nik)->first();

        return [
            (string)$kk,
            (string)$row->nik,
            $row->nama ?? '',
            $lok->alamat ?? '',
            (string)($ind->nohp ?? $lok->nohp ?? ''),
            (string)($ind->nowa ?? $lok->nowa ?? ''),
            (string)($lok->nik_kepala ?? $row->nik),
            $lok->tempat_tinggal ?? '',
            $lok->status_lahan ?? '',
            $lok->luas_lantai_tinggal ?? '',
            $lok->luas_tanah_tinggal ?? '',
            $lok->jenis_lantai_tinggal ?? '',
            $lok->dinding_sebagian ?? '',
            $lok->jendela ?? '',
            $lok->atap ?? '',
            $lok->penerangan ?? '',
            $lok->energi_masak ?? '',
            $lok->jika_kayu_jenis ?? '',
            $lok->tempat_sampah ?? '',
            $lok->mck ?? '',
            $lok->sumber_air_mandi ?? '',
            $lok->sumber_air_mck ?? '',
            $lok->sumber_air_minum ?? '',
            $lok->tempat_pembuangan_limbah ?? '',
            $lok->rumah_sutet ?? '',
            $lok->rumah_sungai ?? '',
            $lok->rumah_lereng_gunung ?? '',
            $lok->kondi_rumah_kumuh ?? '',

            // Pendidikan
            $pend->jaraktempuh_paud ?? '', $pend->waktutempuh_paud ?? '', $pend->kemudahan_paud ?? '',
            $pend->jaraktempuh_tk ?? '', $pend->waktutempuh_tk ?? '', $pend->kemudahan_tk ?? '',
            $pend->jaraktempuh_sd ?? '', $pend->waktutempuh_sd ?? '', $pend->kemudahan_sd ?? '',
            $pend->jaraktempuh_smp ?? '', $pend->waktutempuh_smp ?? '', $pend->kemudahan_smp ?? '',
            $pend->jaraktempuh_sma ?? '', $pend->waktutempuh_sma ?? '', $pend->kemudahan_sma ?? '',
            $pend->jaraktempuh_pt ?? '', $pend->waktutempuh_pt ?? '', $pend->kemudahan_pt ?? '',
            $pend->jaraktempuh_ps ?? '', $pend->waktutempuh_ps ?? '', $pend->kemudahan_ps ?? '',
            $pend->jaraktempuh_seminari ?? '', $pend->waktutempuh_seminari ?? '', $pend->kemudahan_seminari ?? '',
            $pend->jaraktempuh_pagamalain ?? '', $pend->waktutempuh_pagamalain ?? '', $pend->kemudahan_pagamalain ?? '',

            // Kesehatan
            $kes->jaraktempuh_rumahs ?? '', $kes->waktutempuh_rumahs ?? '', $kes->kemudahan_rumahs ?? '',
            $kes->jaraktempuh_rumahb ?? '', $kes->waktutempuh_rumahb ?? '', $kes->kemudahan_rumahb ?? '',
            $kes->jaraktempuh_poliklinik ?? '', $kes->waktutempuh_poliklinik ?? '', $kes->kemudahan_poliklinik ?? '',
            $kes->jaraktempuh_puskesmas ?? '', $kes->waktutempuh_puskesmas ?? '', $kes->kemudahan_puskesmas ?? '',
            $kes->jaraktempuh_poskedes ?? '', $kes->waktutempuh_poskedes ?? '', $kes->kemudahan_poskedes ?? '',
            $kes->jaraktempuh_posyandu ?? '', $kes->waktutempuh_posyandu ?? '', $kes->kemudahan_posyandu ?? '',
            $kes->jaraktempuh_apotik ?? '', $kes->waktutempuh_apotik ?? '', $kes->kemudahan_apotik ?? '',
            $kes->jaraktempuh_toko_obat ?? '', $kes->waktutempuh_toko_obat ?? '', $kes->kemudahan_toko_obat ?? '',

            // Tenaga Kesehatan
            $ten->jaraktempuh_dr_spesialis ?? '', $ten->waktutempuh_dr_spesialis ?? '', $ten->kemudahan_dr_spesialis ?? '',
            $ten->jaraktempuh_dr_umum ?? '', $ten->waktutempuh_dr_umum ?? '', $ten->kemudahan_dr_umum ?? '',
            $ten->jaraktempuh_bidan ?? '', $ten->waktutempuh_bidan ?? '', $ten->kemudahan_bidan ?? '',
            $ten->jaraktempuh_tenagakes ?? '', $ten->waktutempuh_tenagakes ?? '', $ten->kemudahan_tenagakes ?? '',
            $ten->jaraktempuh_dukun ?? '', $ten->waktutempuh_dukun ?? '', $ten->kemudahan_dukun ?? '',

            // Sarpras
            $sar->jenistrasport_lokasipu ?? '', $sar->pengtransportumum_lokasipu ?? '', $sar->waktutempuh_lokasipu ?? '', $sar->biaya_lokasipu ?? '', $sar->kemudahan_lokasipu ?? '',
            $sar->jenistrasport_lahanpertanian ?? '', $sar->pengtransportumum_lahanpertanian ?? '', $sar->waktutempuh_lahanpertanian ?? '', $sar->biaya_lahanpertanian ?? '', $sar->kemudahan_lahanpertanian ?? '',
            $sar->jenistrasport_sekolah ?? '', $sar->pengtransportumum_sekolah ?? '', $sar->waktutempuh_sekolah ?? '', $sar->biaya_sekolah ?? '', $sar->kemudahan_sekolah ?? '',
            $sar->jenistrasport_berobat ?? '', $sar->pengtransportumum_berobat ?? '', $sar->waktutempuh_berobat ?? '', $sar->biaya_berobat ?? '', $sar->kemudahan_berobat ?? '',
            $sar->jenistrasport_beribadah ?? '', $sar->pengtransportumum_beribadah ?? '', $sar->waktutempuh_beribadah ?? '', $sar->biaya_beribadah ?? '', $sar->kemudahan_beribadah ?? '',
            $sar->jenistrasport_rekreasi ?? '', $sar->pengtransportumum_rekreasi ?? '', $sar->waktutempuh_rekreasi ?? '', $sar->biaya_rekreasi ?? '', $sar->kemudahan_rekreasi ?? '',

            // Lain-lain
            $lnk->pengtransportsebelum ?? '',
            $lnk->pengtransportsesudah ?? '',
            $lnk->blt ?? '',
            $lnk->pkh ?? '',
            $lnk->bst ?? '',
            $lnk->bantuan_presiden ?? '',
            $lnk->bantuan_umkm ?? '',
            $lnk->bantuan_pekerja ?? '',
            $lnk->bantuan_anak ?? '',
            $lnk->lainnya ?? '',
            $lnk->rata_rata ?? '',
        ];
    }
}
