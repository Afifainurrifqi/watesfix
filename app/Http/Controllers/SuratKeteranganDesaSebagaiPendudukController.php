<?php

namespace App\Http\Controllers;

use App\Models\status;
use App\Models\SuratKeteranganDesaSebagaiPenduduk;
use Illuminate\Http\Request;

class SuratKeteranganDesaSebagaiPendudukController extends Controller
{
    public function index() // Admin
    {
        $status = status::all();
        return view('surat.surat_keterangan_desa_sebagai_penduduk', compact('status'));
    }

    public function userForm()
    {
        $status = status::all();
        return view('surat.user_surat_keterangan_desa_sebagai_penduduk', compact('status'));
    }

    public function userstore(Request $request)
    {
        $validated = $request->validate([
            'nik'                  => 'required|string|max:16',
            'nama_lengkap'         => 'required|string|max:255',
            'jenis_kelamin'        => 'required|string|max:30',
            'tempat_lahir'         => 'required|string|max:100',
            'tanggal_lahir'        => 'required|date',
            'agama'                => 'required|string|max:50',
            'kewarganegaraan'      => 'required|string|max:50',
            'pekerjaan'            => 'required|string|max:100',
            'status'               => 'required|string|max:50',
            'alamat'               => 'required|string',
            'keterangan_tambahan'  => 'required|string',
            'nowa'                 => 'required|string|max:20',
        ]);

        $validated['status_surat'] = 'Pending';
        $validated['status_verif'] = 'Belum Verifikasi';

        $validated['nomor_surat'] =
            '470 / --- / 409.41.2 / ' . now()->year;

        $surat = SuratKeteranganDesaSebagaiPenduduk::create($validated);

        if (!$surat) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Pengajuan surat gagal disimpan.');
        }

        return redirect()->route('surat.suratberhasil')
            ->with('success', 'Pengajuan Surat Keterangan Desa Sebagai Penduduk berhasil dikirim.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'                  => 'required|string|max:16',
            'nama_lengkap'         => 'required|string|max:255',
            'jenis_kelamin'        => 'required|string|max:30',
            'tempat_lahir'         => 'required|string|max:100',
            'tanggal_lahir'        => 'required|date',
            'agama'                => 'required|string|max:50',
            'kewarganegaraan'      => 'required|string|max:50',
            'pekerjaan'            => 'required|string|max:100',
            'status'               => 'required|string|max:50',
            'alamat'               => 'required|string',
            'keterangan_tambahan'  => 'required|string',
            'nowa'                 => 'required|string|max:20',

            'nomor_surat'          => 'nullable|string|max:100',
            'status_surat'         => 'required|string',
            'status_verif'         => 'required|string',
        ]);

        // Nomor surat otomatis jika belum diisi
        if (empty($validated['nomor_surat'])) {
            $validated['nomor_surat'] =
                '470 / --- / 409.41.2 / ' . now()->year;
        }

        // Simpan ke MongoDB
        $surat = SuratKeteranganDesaSebagaiPenduduk::create($validated);

        if (!$surat) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Surat gagal disimpan.');
        }

        return redirect()->route('surat.keluar')
            ->with('success', 'Surat Keterangan Desa Sebagai Penduduk berhasil disimpan.');
    }
    
public function edit($id)
{
    // Cari dokumen berdasarkan ID MongoDB
    $surat = SuratKeteranganDesaSebagaiPenduduk::findOrFail($id);

    $status = \App\Models\Status::all();

    return view(
        'surat.edit_surat_keterangan_desa_sebagai_penduduk',
        compact('surat', 'status')
    );
}

public function update(Request $request, $id)
{
    // Cari dokumen berdasarkan _id MongoDB
    $surat = SuratKeteranganDesaSebagaiPenduduk::findOrFail($id);

    // Validasi seluruh input dari form
    $validated = $request->validate([
        'nik'                  => 'required|string|max:16',
        'nama_lengkap'         => 'required|string|max:255',
        'jenis_kelamin'        => 'required|string|max:30',
        'tempat_lahir'         => 'required|string|max:100',
        'tanggal_lahir'        => 'required|date',
        'agama'                => 'required|string|max:50',
        'kewarganegaraan'      => 'required|string|max:50',
        'pekerjaan'            => 'required|string|max:100',
        'status'               => 'required|string|max:50',
        'alamat'               => 'required|string',
        'keterangan_tambahan'  => 'required|string',
        'nowa'                 => 'required|string|max:20',
        'status_surat'         => 'required|string',
        'status_verif'         => 'required|string',
    ]);

    try {
        // Update dokumen MongoDB
        $surat->fill($validated);
        $surat->save();

        return redirect()
            ->route('surat.keluar')
            ->with('success', 'Surat Keterangan Desa Sebagai Penduduk berhasil diperbarui.');

    } catch (\Throwable $e) {

        \Log::error('Gagal update surat desa sebagai penduduk', [
            'id' => $id,
            'error' => $e->getMessage(),
        ]);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Gagal memperbarui surat. Silakan periksa kembali data dan koneksi database.');
    }
}

}
