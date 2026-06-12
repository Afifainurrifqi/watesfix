<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class NomorSuratService
{
    protected string $globalKey = 'global_surat_keluar';

    /**
     * Inisialisasi nomor awal (jalankan sekali saja)
     */
    public function initializeGlobalCounter(int $startFrom = 127): void
    {
        $col = DB::connection('mongodb')->getMongoDB()->selectCollection('counters');

        $existing = $col->findOne(['_id' => $this->globalKey]);

        if (!$existing) {
            $col->insertOne([
                '_id'        => $this->globalKey,
                'seq'        => $startFrom - 1,   // 126 agar next = 127
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function nextGlobal(): int
    {
        $col = DB::connection('mongodb')->getMongoDB()->selectCollection('counters');

        $doc = $col->findOneAndUpdate(
            ['_id' => $this->globalKey],
            ['$inc' => ['seq' => 1], '$set' => ['updated_at' => now()]],
            ['upsert' => true, 'returnDocument' => 1]
        );

        return (int)($doc['seq'] ?? 127);
    }

    public function format(string $jenis, int $urut, int $tahun = null): string
    {
        $tahun   = $tahun ?? now('Asia/Jakarta')->year;
        $prefix  = $this->prefixMap[$jenis] ?? 400;
        $nnn     = str_pad((string)$urut, 3, '0', STR_PAD_LEFT);

        return "{$prefix} / {$nnn} / 409.41.2 / {$tahun}";
    }

    public function maybeAssignNomorSurat($modelOrNull, array &$payload, string $jenis = 'default'): void
    {
        $status = $payload['status_surat'] ?? ($modelOrNull->status_surat ?? null);
        $verif  = $payload['status_verif'] ?? ($modelOrNull->status_verif ?? null);

        if (
            $status === 'Di terima' &&
            $verif === 'Terverifikasi' &&
            empty($payload['nomor_surat']) &&
            empty($modelOrNull?->nomor_surat)
        ) {
            $urut  = $this->nextGlobal();
            $tahun = now('Asia/Jakarta')->year;

            $payload['nomor_urut']  = $urut;
            $payload['tahun_nomor'] = $tahun;
            $payload['nomor_surat'] = $this->format($jenis, $urut, $tahun);
        }
    }

    // Prefix Map
    protected array $prefixMap = [
        'sktm'       => 475,
        'spktp'      => 300,
        'numpangkk'  => 400,
        'alias'      => 410,
        'alias_ortu' => 411,
        'jaminan'    => 420,
        'kehilangan' => 430,
        'belumakta' => 410,
        'bedanama' => 440,
        'anakseorangibu' => 450,
        'aktabarcode' => 460,
        'sptjmkematian' => 470,
        'perubahdatapendidikan' => 480,
    ];
}
