<?php

namespace App\Http\Controllers;

use App\Models\suratmasuk;
use App\Http\Requests\StoresuratmasukRequest;
use App\Http\Requests\UpdatesuratmasukRequest;
use App\Models\nama_alias_ortu;
use App\Models\surat_keterangan_ahli_waris;
use App\Models\surat_keterangan_desa_pernah_menikah;
use App\Models\surat_keterangan_harga_kepemilikan_tanah;
use App\Models\surat_keterangan_kehilangan;
use App\Models\surat_keterangan_kematian_desa;
use App\Models\surat_keterangan_numpang_nikah;
use App\Models\surat_keterangan_penghasilan;
use App\Models\surat_kuasa;
use App\Models\surat_permohonan_pembukaan_rekening;
use App\Models\surat_permohonan_pengantar_keabsahan_akta_kelahiran;
use App\Models\surat_pernyataan_akta_barcode_nomor_sama;
use App\Models\surat_pernyataan_anak_seorang_nama_ibu;
use App\Models\surat_pernyataan_beda_nama_buku_nikah;
use App\Models\surat_pernyataan_belum_akta;
use App\Models\surat_pernyataan_dan_jaminan;
use App\Models\surat_pernyataan_kesanggupan;
use App\Models\surat_pernyataan_memilih_nama_alias;
use App\Models\surat_pernyataan_mengizinkan_ikut_kk;
use App\Models\surat_pernyataan_numpang_kk;
use App\Models\surat_pernyataan_pembetulan_data_tidak_merubah_lagi;
use App\Models\surat_pernyataan_perubahan_data_pendidikan;
use App\Models\surat_pernyataan_tidak_bisa_melampirkan_ktp_kematian;
use App\Models\surat_sptjm_kematian;
use App\Models\SuratIjinKeluarga;
use App\Models\SuratKeteranganDesaMiskin;
use App\Models\SuratKeteranganDesaSebagaiPenduduk;
use App\Models\SuratKeteranganDomisiliLembaga;
use App\Models\SuratKeteranganDomisiliWarga;
use App\Models\SuratKeteranganKepemilikanAset;
use App\Models\SuratKeteranganMiskinSkm;
use App\Models\suratketerangantidakmampu;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratPengantarSkck;
use App\Models\SuratPernyataanKepemilikanDokumenAsli;
use App\Models\SuratPernyataanKesanggupan;
use App\Models\SuratPernyataanMiskin;
use App\Models\SuratPernyataanTidakPunyaKartuJkn;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratmasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SuratMasuk::all(); // Ambil semua data dari MongoDB
        return view('surat.suratmasuk', compact('data'));
    }


    public function suratkeluar()
    {
        $pernyataan_tidak_bisa_ktp = surat_pernyataan_tidak_bisa_melampirkan_ktp_kematian::where('status_verif', '!=', 'Terverifikasi')->get();
        $keterangan_kehilangan = surat_keterangan_kehilangan::where('status_verif', '!=', 'Terverifikasi')->get();
        $numpang_kk = surat_pernyataan_numpang_kk::where('status_verif', '!=', 'Terverifikasi')->get();
        $tidakmampu = suratketerangantidakmampu::where('status_verif', '!=', 'Terverifikasi')->get();
        $namaalias = surat_pernyataan_memilih_nama_alias::where('status_verif', '!=', 'Terverifikasi')->get();
        $namaalias_satu_ortu = nama_alias_ortu::where('status_verif', '!=', 'Terverifikasi')->get();
        $pernyataandanjaminan      = surat_pernyataan_dan_jaminan::where('status_verif', '!=', 'Terverifikasi')->get();
        $pernah_menikah = surat_keterangan_desa_pernah_menikah::where('status_verif', '!=', 'Terverifikasi')->get();
        $kematian_desa             = surat_keterangan_kematian_desa::where('status_verif', '!=', 'Terverifikasi')->get(); // ⬅️ baru
        $ahliwaris = surat_keterangan_ahli_waris::where('status_verif', '!=', 'Terverifikasi')->get();
        $kuasa = surat_kuasa::where('status_verif', '!=', 'Terverifikasi')->get();
        $bukaanrekening = surat_permohonan_pembukaan_rekening::where('status_verif', '!=', 'Terverifikasi')->get();
        $belumAkta = surat_pernyataan_belum_akta::where('status_verif', '!=', 'Terverifikasi')->get();
        $bedaNamaBukuNikah = surat_pernyataan_beda_nama_buku_nikah::where('status_verif', '!=', 'Terverifikasi')->get();
        $anakSeorangIbu = surat_pernyataan_anak_seorang_nama_ibu::where('status_verif', '!=', 'Terverifikasi')->get();
        $aktaBarcode    = surat_pernyataan_akta_barcode_nomor_sama::where('status_verif', '!=', 'Terverifikasi')->get();
        $sptjmKematian = surat_sptjm_kematian::where('status_verif', '!=', 'Terverifikasi')->get();
        $kepemilikantanah = surat_keterangan_harga_kepemilikan_tanah::where('status_verif', '!=', 'Terverifikasi')->get();
        $skck = SuratPengantarSkck::where('status_verif', '!=', 'Terverifikasi')->get();
        $perubahdatapendidikan = surat_pernyataan_perubahan_data_pendidikan::where('status_verif', '!=', 'Terverifikasi')->get();
        $pembetulanData = \App\Models\surat_pernyataan_pembetulan_data_tidak_merubah_lagi::where('status_verif', '!=', 'Terverifikasi')->get(); // lalu merge ke $data
        $izinkanIkutKk = surat_pernyataan_mengizinkan_ikut_kk::where('status_verif', '!=', 'Terverifikasi')->get();
        $pengantarKeabsahan = surat_permohonan_pengantar_keabsahan_akta_kelahiran::where('status_verif', '!=', 'Terverifikasi')->get();
        $pengantarKeabsahanAnak = \App\Models\surat_permohonan_pengantar_keabsahan_akta_kelahiran_anak::where('status_verif', '!=', 'Terverifikasi')->get();
        $batalPindah = \App\Models\surat_pernyataan_batal_pindah_penduduk::where('status_verif', '!=', 'Terverifikasi')->get();
        $formulirUserId = \App\Models\surat_formulir_pengajuan_user_id::where('status_verif', '!=', 'Terverifikasi')->get();

        $sptjmSuamiIstri = \App\Models\surat_sptjm_suami_istri::where('status_verif', '!=', 'Terverifikasi')->get();
        $numpangNikah = surat_keterangan_numpang_nikah::where('status_verif', '!=', 'Terverifikasi')->get();
        $usaha = SuratKeteranganUsaha::where('status_verif', '!=', 'Terverifikasi')->get();
        $miskinDesa = SuratKeteranganDesaMiskin::where('status_verif', '!=', 'Terverifikasi')->get();
        $skm = SuratKeteranganMiskinSkm::where('status_verif', '!=', 'Terverifikasi')->get();
        $ahliwarisDesa = \App\Models\surat_keterangan_ahli_waris_desa::where('status_verif', '!=', 'Terverifikasi')->get();
        $ghoib = \App\Models\surat_keterangan_ghoib::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah baris $ghoib = ...
        $penghasilan = surat_keterangan_penghasilan::where('status_verif', '!=', 'Terverifikasi')->get();
        $desaPenduduk = SuratKeteranganDesaSebagaiPenduduk::where('status_verif', '!=', 'Terverifikasi')->get(); // untuk suratkeluar
        $domisiliLembaga = SuratKeteranganDomisiliLembaga::where('status_verif', '!=', 'Terverifikasi')->get();
        $domisiliWarga = SuratKeteranganDomisiliWarga::where('status_verif', '!=', 'Terverifikasi')->get(); // untuk suratkeluar
        $kepemilikanAset = SuratKeteranganKepemilikanAset::where('status_verif', '!=', 'Terverifikasi')->get();
        $pernyataanKepemilikanDokumen = SuratPernyataanKepemilikanDokumenAsli::where('status_verif', '!=', 'Terverifikasi')->get();
        $kesanggupan = SuratPernyataanKesanggupan::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah baris kesanggupan
        $tidakPunyaKartuJkn = SuratPernyataanTidakPunyaKartuJkn::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah baris tidakPunyaKartuJkn
        $pernyataanMiskin = SuratPernyataanMiskin::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah tidakPunyaKartuJkn
        $ijinKeluarga = SuratIjinKeluarga::where('status_verif', '!=', 'Terverifikasi')->get();

        $data = collect()
            ->merge($pernyataan_tidak_bisa_ktp)
            ->merge($keterangan_kehilangan)
            ->merge($numpang_kk)
            ->merge($tidakmampu)
            ->merge($namaalias)
            ->merge($pernyataanMiskin)
            ->merge($namaalias_satu_ortu)
            ->merge($pernyataandanjaminan)
            ->merge($pernah_menikah)
            ->merge($kematian_desa)
            ->merge($ahliwaris)
            ->merge($kesanggupan)
            ->merge($kuasa)
            ->merge($bukaanrekening)
            ->merge($belumAkta)
            ->merge($bedaNamaBukuNikah)
            ->merge($anakSeorangIbu)
            ->merge($aktaBarcode)
            ->merge($sptjmKematian)
            ->merge($kepemilikantanah)
            ->merge($skck)
            ->merge($perubahdatapendidikan)
            ->merge($pembetulanData)
            ->merge($izinkanIkutKk)
            ->merge($pengantarKeabsahan)
            ->merge($pengantarKeabsahanAnak)
            ->merge($batalPindah)
            ->merge($formulirUserId)
            ->merge($sptjmSuamiIstri)
            ->merge($numpangNikah)
            ->merge($usaha)
            ->merge($miskinDesa)
            ->merge($skm)
            ->merge($ahliwarisDesa)
            ->merge($ghoib)
            ->merge($penghasilan)
            ->merge($desaPenduduk)
            ->merge($domisiliLembaga)
            ->merge($domisiliWarga)
            ->merge($ijinKeluarga)
            ->merge($kepemilikanAset)
            ->merge($tidakPunyaKartuJkn)
            ->merge($pernyataanKepemilikanDokumen); // ← BARU


        return view('surat.suratkeluar', compact('data'));
    }


    public function arsipsuratmasuk()
    {
        return view('surat.arsipsuratmasuk');
    }

    public function arsipsuratkeluar()
    {
        $ktp_kematian = surat_pernyataan_tidak_bisa_melampirkan_ktp_kematian::where('status_verif', 'Terverifikasi')->get();
        $numpang_kk   = surat_pernyataan_numpang_kk::where('status_verif', 'Terverifikasi')->get();

        $pernyataan_tidak_bisa_ktp = surat_pernyataan_tidak_bisa_melampirkan_ktp_kematian::where('status_verif', 'Terverifikasi')->get();
        $keterangan_kehilangan = surat_keterangan_kehilangan::where('status_verif', 'Terverifikasi')->get();
        $numpang_kk = surat_pernyataan_numpang_kk::where('status_verif', 'Terverifikasi')->get();
        $tidakmampu = suratketerangantidakmampu::where('status_verif', 'Terverifikasi')->get();
        $namaalias = surat_pernyataan_memilih_nama_alias::where('status_verif', 'Terverifikasi')->get();
        $namaalias_satu_ortu = nama_alias_ortu::where('status_verif', 'Terverifikasi')->get();
        $pernyataandanjaminan      = surat_pernyataan_dan_jaminan::where('status_verif', 'Terverifikasi')->get();
        $pernah_menikah = surat_keterangan_desa_pernah_menikah::where('status_verif', 'Terverifikasi')->get();
        $kematian_desa             = surat_keterangan_kematian_desa::where('status_verif', 'Terverifikasi')->get(); // ⬅️ baru
        $ahliwaris = surat_keterangan_ahli_waris::where('status_verif', 'Terverifikasi')->get();
        $kuasa = surat_kuasa::where('status_verif', 'Terverifikasi')->get();
        $bukaanrekening = surat_permohonan_pembukaan_rekening::where('status_verif', 'Terverifikasi')->get();
        $belumAkta = surat_pernyataan_belum_akta::where('status_verif', 'Terverifikasi')->get();
        $bedaNamaBukuNikah = surat_pernyataan_beda_nama_buku_nikah::where('status_verif', 'Terverifikasi')->get();
        $anakSeorangIbu = surat_pernyataan_anak_seorang_nama_ibu::where('status_verif', 'Terverifikasi')->get();
        $aktaBarcode    = surat_pernyataan_akta_barcode_nomor_sama::where('status_verif', 'Terverifikasi')->get();
        $sptjmKematian = surat_sptjm_kematian::where('status_verif', 'Terverifikasi')->get();
        $kepemilikantanah = surat_keterangan_harga_kepemilikan_tanah::where('status_verif', 'Terverifikasi')->get();
        $skck = SuratPengantarSkck::where('status_verif', 'Terverifikasi')->get();
        $perubahdatapendidikan = surat_pernyataan_perubahan_data_pendidikan::where('status_verif', '!=', 'Terverifikasi')->get();
        $pembetulanData = \App\Models\surat_pernyataan_pembetulan_data_tidak_merubah_lagi::where('status_verif', 'Terverifikasi')->get();
        $izinkanIkutKk = surat_pernyataan_mengizinkan_ikut_kk::where('status_verif', '!=', 'Terverifikasi')->get();
        $pengantarKeabsahan = surat_permohonan_pengantar_keabsahan_akta_kelahiran::where('status_verif', '!=', 'Terverifikasi')->get();
        $pengantarKeabsahanAnak = \App\Models\surat_permohonan_pengantar_keabsahan_akta_kelahiran_anak::where('status_verif', '!=', 'Terverifikasi')->get();
        $batalPindah = \App\Models\surat_pernyataan_batal_pindah_penduduk::where('status_verif', '!=', 'Terverifikasi')->get();
        $formulirUserId = \App\Models\surat_formulir_pengajuan_user_id::where('status_verif', '!=', 'Terverifikasi')->get();
        $sptjmSuamiIstri = \App\Models\surat_sptjm_suami_istri::where('status_verif', '!=', 'Terverifikasi')->get();
        $numpangNikah = surat_keterangan_numpang_nikah::where('status_verif', '!=', 'Terverifikasi')->get();
        $usaha = SuratKeteranganUsaha::where('status_verif', '!=', 'Terverifikasi')->get();
        $miskinDesa = SuratKeteranganDesaMiskin::where('status_verif', '!=', 'Terverifikasi')->get();
        $skm = SuratKeteranganMiskinSkm::where('status_verif', '!=', 'Terverifikasi')->get();
        $ahliwarisDesa = \App\Models\surat_keterangan_ahli_waris_desa::where('status_verif', '!=', 'Terverifikasi')->get();
        $ghoib = \App\Models\surat_keterangan_ghoib::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah baris $ghoib = ...
        $penghasilan = surat_keterangan_penghasilan::where('status_verif', '!=', 'Terverifikasi')->get();
        $desaPenduduk = SuratKeteranganDesaSebagaiPenduduk::where('status_verif', '!=', 'Terverifikasi')->get(); // untuk suratkeluar
        $domisiliLembaga = SuratKeteranganDomisiliLembaga::where('status_verif', '!=', 'Terverifikasi')->get();
        $domisiliWarga = SuratKeteranganDomisiliWarga::where('status_verif', '!=', 'Terverifikasi')->get(); // untuk suratkeluar
        $kepemilikanAset = SuratKeteranganKepemilikanAset::where('status_verif', '!=', 'Terverifikasi')->get();
        $pernyataanKepemilikanDokumen = SuratPernyataanKepemilikanDokumenAsli::where('status_verif', '!=', 'Terverifikasi')->get(); // atau 'Terverifikasi' untuk arsip
        $kesanggupan = SuratPernyataanKesanggupan::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah baris kesanggupan
        $tidakPunyaKartuJkn = SuratPernyataanTidakPunyaKartuJkn::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah baris tidakPunyaKartuJkn
        $pernyataanMiskin = SuratPernyataanMiskin::where('status_verif', '!=', 'Terverifikasi')->get();
        // Tambahkan setelah tidakPunyaKartuJkn
        $ijinKeluarga = SuratIjinKeluarga::where('status_verif', '!=', 'Terverifikasi')->get();

        $data = collect()
            ->merge($pernyataan_tidak_bisa_ktp)
            ->merge($keterangan_kehilangan)
            ->merge($numpang_kk)
            ->merge($pernyataanMiskin)
            ->merge($tidakmampu)
            ->merge($namaalias)
            ->merge($namaalias_satu_ortu)
            ->merge($pernyataandanjaminan)
            ->merge($ijinKeluarga)
            ->merge($pernah_menikah)
            ->merge($kematian_desa)
            ->merge($ahliwaris)
            ->merge($kesanggupan)
            ->merge($kuasa)
            ->merge($bukaanrekening)
            ->merge($belumAkta)
            ->merge($bedaNamaBukuNikah)
            ->merge($anakSeorangIbu)
            ->merge($aktaBarcode)
            ->merge($sptjmKematian)
            ->merge($kepemilikantanah)
            ->merge($skck)
            ->merge($perubahdatapendidikan)
            ->merge($pembetulanData)
            ->merge($izinkanIkutKk)
            ->merge($pengantarKeabsahan)
            ->merge($pengantarKeabsahanAnak)
            ->merge($batalPindah)
            ->merge($formulirUserId)
            ->merge($sptjmSuamiIstri)
            ->merge($numpangNikah)
            ->merge($usaha)
            ->merge($miskinDesa)
            ->merge($skm)
            ->merge($ahliwarisDesa)
            ->merge($ghoib)
            ->merge($penghasilan)
            ->merge($desaPenduduk)
            ->merge($domisiliLembaga)
            ->merge($domisiliWarga)
            ->merge($kepemilikanAset)
            ->merge($tidakPunyaKartuJkn)
            ->merge($pernyataanKepemilikanDokumen);   // ← BARU  // ← BARU

        return view('surat.arsipsuratkeluar', compact('data'));
    }


    public function prosesForm(Request $request)
    {
        $request->validate([
            'kategori'   => 'required|string',
            'jenis_form' => 'required|string',
        ]);

        $kategori   = $request->kategori;
        $jenis_form = $request->jenis_form;

        // =====================================================
        // ==================== ADMINDUK =======================
        // =====================================================

        // Pengantar Keabsahan
        if ($kategori === 'adminduk' && Str::contains($jenis_form, 'pengantar_keabsahan_untuk_diri')) {
            return redirect()->route('surat.pengantar_keabsahan.index');
        }

        if ($kategori === 'adminduk' && Str::contains($jenis_form, 'pengantar_keabsahan_untuk_anak')) {
            return redirect()->route('surat.pengantar_keabsahan_anak.index');
        }

        // Formulir Pengajuan User ID (F-3.01)
        if ($kategori === 'adminduk' && Str::contains($jenis_form, 'formulir_pengajuan_user_id')) {
            return redirect()->route('surat.formulir_pengajuan_user_id.index');
        }

        if ($kategori === 'pernyataan' && $jenis_form === 'surat_pernyataan_miskin') {
            return redirect()->route('surat.pernyataan_miskin.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_ahli_waris_desa') {
            return redirect()->route('surat.ahliwarisdesa.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_penghasilan') {
            return redirect()->route('surat.penghasilan.index');   // sesuaikan nama route loe
        }

        // Batal Pindah Penduduk
        if ($kategori === 'adminduk' && Str::contains($jenis_form, 'batal_pindah')) {
            return redirect()->route('surat.batal_pindah.index');
        }

        // Lainnya (Adminduk)
        if ($kategori === 'adminduk' && $jenis_form === 'pernyataan_pembetulan_data_tidak_merubah_lagi') {
            return redirect()->route('surat.pembetulandata.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_domisili_warga') {
            return redirect()->route('surat.domisili_warga.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'pernyataan_mengizinkan_ikut_kk_suami-istri-keluarga') {
            return redirect()->route('surat.izinkk.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_numpang_kk') {
            return redirect()->route('surat.numpangkk.create');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_tidak_bisa_melampirkan_ktp_kematian') {
            return redirect()->route('surat.suratpernyataantidakbisamelampirkanktpkematian');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_desa_warga_miskin') {
            return redirect()->route('surat.miskindesa.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_memilih_nama_alias') {
            return redirect()->route('surat.namaalias.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_memilih_nama_alias_satu_orang_tua') {
            return redirect()->route('surat.namaaliasortu.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_dan_jaminan') {
            return redirect()->route('surat.pernyataandanjaminan.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_belum_pernah_mengurus_akta_kelahiran') {
            return redirect()->route('surat.belumakta.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_beda_nama_buku_nikah') {
            return redirect()->route('surat.bedanama.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_anak_seorang_nama_ibu_baru') {
            return redirect()->route('surat.anakseorangibu.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'surat_pernyataan_akta_barcode_nomor_samabaru_isi_sendiri') {
            return redirect()->route('surat.aktabarcode.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'sptjm_kematian') {
            return redirect()->route('surat.sptjm.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_ghoib') {
            return redirect()->route('surat.ghoib.index');
        }

        if ($kategori === 'adminduk' && $jenis_form === 'pernyataan_perubahan_data_pendidikan') {
            return redirect()->route('surat.perubahdatapendidikan.index');
        }

        // =====================================================
        // ==================== KETERANGAN =====================
        // =====================================================

        if ($kategori == 'keterangan' && $jenis_form == 'surat_keterangan_kehilangan') {
            return redirect()->route('surat.surat_keterangan_kehilangan');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_tidak_mampu') {
            return redirect()->route('surat.tidakmampu.create');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_desa_pernah_menikah') {
            return redirect()->route('surat.pernahmenikah.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_kematian_desa') {
            return redirect()->route('surat.kematian.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_ahli_waris') {
            return redirect()->route('surat.ahliwaris.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_harga_kepemilikan_tanah') {
            return redirect()->route('surat.kepemilikantanah.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'keterangan_pengantar_skck') {
            return redirect()->route('surat.skck.index');
        }

        // =====================================================
        // ==================== PERNYATAAN =====================
        // =====================================================

        if ($kategori === 'pernyataan' && $jenis_form === 'surat_pernyataan_kesanggupan') {
            return redirect()->route('surat.pernyataan_kesanggupan.index');
        }

        if ($kategori === 'pernyataan' && $jenis_form === 'surat__kuasa') {
            return redirect()->route('surat.kuasa.index');
        }


        if ($kategori === 'pernyataan' && $jenis_form === 'permohonan_pembukaan_rekening_tabungan') {
            return redirect()->route('surat.bukaanrekening.index');
        }
        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_numpang_nikah') {
            return redirect()->route('surat.numpangnikah.index');
        }

        if ($kategori === 'adminduk' && Str::contains($jenis_form, 'sptjm_suami_istri')) {
            return redirect()->route('surat.sptjm_suami_istri.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_usaha') {
            return redirect()->route('surat.usaha.index');
        }
        if ($kategori === 'keterangan' && Str::contains($jenis_form, 'surat_keterangan_miskin')) {
            return redirect()->route('surat.skm.index');
        }
        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_desa_sebagai_penduduk') {
            return redirect()->route('surat.desa_penduduk.index');
        }

        if ($kategori === 'pernyataan' && $jenis_form === 'surat_ijin_keluarga') {
            return redirect()->route('surat.ijin_keluarga.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_domisili_lembaga') {
            return redirect()->route('surat.domisili_lembaga.index');
        }

        if ($kategori === 'keterangan' && $jenis_form === 'surat_keterangan_kepemilikan_aset') {
            return redirect()->route('surat.kepemilikan_aset.index');
        }

        if ($kategori === 'pernyataan' && $jenis_form === 'surat_pernyataan_kesanggupan') {
            return redirect()->route('surat.pernyataan_kesanggupan.index');
        } // ← TAMBAHKAN DI BAWAH INI


        if (
            $kategori === 'pernyataan' &&
            ($jenis_form === 'surat_pernyataan_tidak_punya_kartu_jkn' ||
                Str::contains($jenis_form, 'jamkesmas') ||
                Str::contains($jenis_form, 'tidak_punya_kartu'))
        ) {

            return redirect()->route('surat.pernyataan_tidak_punya_kartu_jkn.index');
        }

        if (
            $kategori === 'pernyataan' &&
            (Str::contains($jenis_form, 'kepemilikan_dokumen_asli') ||
                $jenis_form === 'surat_pernyataan_kepemilikan_dokumen_asli')
        ) {

            return redirect()->route('surat.pernyataan_kepemilikan_dokumen.index');
        }
        // Jika tidak ada yang cocok
        return redirect()->back()->withErrors(['jenis_form' => 'Form tidak ditemukan.']);
    }




    public function tambahsuratmasuk()
    {
        return view('surat.tambahsuratmasuk');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function exportPdf($jenis, $id)
    {

        if (
            $jenis === 'suratpernyataanmengizinkanikutkk' ||
            $jenis === 'pernyataan_mengizinkan_ikut_kk_suami_istri_keluarga'
        ) {
            $data = surat_pernyataan_mengizinkan_ikut_kk::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_pernyataan_mengizinkan_ikut_kk', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_pernyataan_mengizinkan_ikut_kk_' . $filename . '.pdf');
        }

        if (
            $jenis === 'suratketerangandesasebagaipenduduk' ||
            $jenis === 'surat_keterangan_desa_sebagai_penduduk' ||
            $jenis === 'desa_penduduk' ||
            $jenis === 'desa-sebagai-penduduk'
        ) {
            $data = SuratKeteranganDesaSebagaiPenduduk::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_desa_sebagai_penduduk', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama_lengkap ?? 'desa_penduduk', '_');

            return $pdf->download('surat_keterangan_desa_sebagai_penduduk_' . $filename . '.pdf');
        }

        // SURAT PERNYATAAN MISKIN
        if (
            $jenis === 'surat_pernyataan_miskin' ||
            $jenis === 'pernyataan_miskin' ||
            $jenis === 'suratpernyataanmiskin'
        ) {
            $data = SuratPernyataanMiskin::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_pernyataan_miskin', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'pernyataan_miskin', '_');

            return $pdf->download('surat_pernyataan_miskin_' . $filename . '.pdf');
        }

        // SURAT IJIN KELUARGA
        if (
            $jenis === 'surat_ijin_keluarga' ||
            $jenis === 'ijin_keluarga' ||
            $jenis === 'suratijin_keluarga' ||
            $jenis === 'suratijinkeluarga'
        ) {
            $data = SuratIjinKeluarga::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_ijin_keluarga', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama_suami ?? 'ijin_keluarga', '_');

            return $pdf->download('surat_ijin_keluarga_' . $filename . '.pdf');
        }

        if (in_array($jenis, ['surat_keterangan_kepemilikan_aset', 'kepemilikan_aset', 'suratketerangankepemilikanaset'])) {
            $data = SuratKeteranganKepemilikanAset::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_kepemilikan_aset', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'kepemilikan_aset', '_');

            return $pdf->download('surat_keterangan_kepemilikan_aset_' . $filename . '.pdf');
        }

        if (in_array($jenis, ['surat_pernyataan_kepemilikan_dokumen_asli', 'pernyataan_kepemilikan_dokumen', 'suratpernyataankepemilikandokumenasli'])) {
            $data = SuratPernyataanKepemilikanDokumenAsli::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_pernyataan_kepemilikan_dokumen_asli', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'pernyataan_dokumen', '_');

            return $pdf->download('surat_pernyataan_kepemilikan_dokumen_asli_' . $filename . '.pdf');
        }

        if (
            $jenis === 'surat_keterangan_penghasilan' ||
            $jenis === 'suratketeranganpenghasilan' ||
            $jenis === 'penghasilan'
        ) {
            $data = surat_keterangan_penghasilan::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_penghasilan', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama_lengkap ?? 'keterangan_penghasilan', '_');

            return $pdf->download('surat_keterangan_penghasilan_' . $filename . '.pdf');
        }

        if (
            $jenis === 'surat_keterangan_domisili_warga' ||
            $jenis === 'domisili_warga' ||
            $jenis === 'suratketerangandomisiliwarga'
        ) {
            $data = SuratKeteranganDomisiliWarga::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_domisili_warga', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama_lengkap ?? 'domisili_warga', '_');

            return $pdf->download('surat_keterangan_domisili_warga_' . $filename . '.pdf');
        }

        if ($jenis === 'surat_keterangan_ghoib' || $jenis === 'ghoib') {
            $data = \App\Models\surat_keterangan_ghoib::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_ghoib', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama_pemohon ?? 'ghoib', '_');

            return $pdf->download('surat_keterangan_ghoib_' . $filename . '.pdf');
        }
        if (
            $jenis === 'suratketerangandesamiskin' ||
            $jenis === 'surat_keterangan_desa_miskin' ||
            $jenis === 'miskindesa'
        ) {
            $data = SuratKeteranganDesaMiskin::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_desa_miskin', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'surat_keterangan_desa_miskin', '_');

            return $pdf->download('surat_keterangan_desa_miskin_' . $filename . '.pdf');
        }

        if (
            $jenis === 'surat_keterangan_ahli_waris_desa' ||
            $jenis === 'ahliwarisdesa' ||
            $jenis === 'suratketeranganahliwarisdesa'
        ) {
            $data = \App\Models\surat_keterangan_ahli_waris_desa::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_ahli_waris_desa', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama_almarhum ?? 'ahli_waris_desa', '_');

            return $pdf->download('surat_keterangan_ahli_waris_desa_' . $filename . '.pdf');
        }

        if (
            $jenis === 'suratketeranganmiskinskm' ||
            $jenis === 'surat_keterangan_miskin_skm' ||
            $jenis === 'skm'
        ) {
            $data = SuratKeteranganMiskinSkm::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_miskin_skm', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'surat_keterangan_miskin_skm', '_');

            return $pdf->download('surat_keterangan_miskin_skm_' . $filename . '.pdf');
        }

        if (
            $jenis === 'suratketerangannumpangnikah' ||
            $jenis === 'surat_keterangan_numpang_nikah' ||
            $jenis === 'numpang_nikah'
        ) {
            $data = surat_keterangan_numpang_nikah::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_numpang_nikah', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = 'Surat_Keterangan_Numpang_Nikah_'
                . Str::slug($data->nama ?? $id, '_')
                . '.pdf';

            return $pdf->download($filename);
        }

        if (
            $jenis === 'suratketerangankematiandesa' ||
            $jenis === 'surat_keterangan_kematian_desa' ||
            $jenis === 'kematian_desa'
        ) {
            $data = surat_keterangan_kematian_desa::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_kematian_desa', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = 'Surat_Keterangan_Kematian_Desa_'
                . Str::slug($data->nama_lengkap ?? $id, '_')
                . '.pdf';

            return $pdf->download($filename);
        }
        if (
            $jenis === 'surat_sptjm_suami_istri' ||
            $jenis === 'sptjm_suami_istri'
        ) {
            $data = \App\Models\surat_sptjm_suami_istri::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_sptjm_suami_istri', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama_deklaran ?? 'dokumen', '_');
            return $pdf->download('sptjm_suami_istri_' . $filename . '.pdf');
        }
        if (
            $jenis === 'suratpernyataanpembetulandatatidakmerubahlagi' ||
            $jenis === 'pernyataan_pembetulan_data_tidak_merubah_lagi'
        ) {
            $data = surat_pernyataan_pembetulan_data_tidak_merubah_lagi::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_pernyataan_pembetulan_data_tidak_merubah_lagi', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_pernyataan_pembetulan_data_' . $filename . '.pdf');
        }

        if (
            $jenis === 'surat_permohonan_pengantar_keabsahan_akta_kelahiran' ||
            $jenis === 'permohonan_pengantar_keabsahan_akta_kelahiran'
        ) {
            $data = surat_permohonan_pengantar_keabsahan_akta_kelahiran::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_permohonan_pengantar_keabsahan_akta_kelahiran', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('surat_permohonan_pengantar_keabsahan_akta_kelahiran_' . $filename . '.pdf');
        }

        if (
            $jenis === 'surat_pernyataan_batal_pindah_penduduk' ||
            $jenis === 'pernyataan_batal_pindah_penduduk'
        ) {
            $data = \App\Models\surat_pernyataan_batal_pindah_penduduk::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_pernyataan_batal_pindah_penduduk', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('surat_pernyataan_batal_pindah_penduduk_' . $filename . '.pdf');
        }

        if (
            $jenis === 'surat_formulir_pengajuan_user_id' ||
            $jenis === 'formulir_pengajuan_user_id'
        ) {
            $data = \App\Models\surat_formulir_pengajuan_user_id::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_formulir_pengajuan_user_id', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->instansi_pemohon ?? 'dokumen', '_');
            return $pdf->download('formulir_pengajuan_user_id_' . $filename . '.pdf');
        }

        if ($jenis === 'suratpernyataanperubahandatapendidikan') {
            $data = surat_pernyataan_perubahan_data_pendidikan::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_pernyataan_perubahan_data_pendidikan', compact('data'))
                ->setPaper('A4', 'portrait');
            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_pernyataan_perubahan_data_pendidikan_' . $filename . '.pdf');
        }
        if ($jenis === 'suratketerangankehilangan') {
            $data = surat_keterangan_kehilangan::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdfsuratketerangankehilangan', compact('data'))
                ->setPaper('A4');
            return $pdf->download('pdfsuratketerangankehilangan' . $data->nama_pelapor . '.pdf');
        }

        if ($jenis === 'suratpernyataantidakbisamelampirkanktpkematian') {
            $data = surat_pernyataan_tidak_bisa_melampirkan_ktp_kematian::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdfsuratpernyataantidakbisamelampirkanktpkematian', compact('data'))->setPaper('A4');
            return $pdf->download('Surat_Pernyataan_KTP_' . $data->nama_pelapor . '.pdf');
        }

        if (
            $jenis === 'surat_permohonan_pengantar_keabsahan_akta_kelahiran_anak' ||
            $jenis === 'permohonan_pengantar_keabsahan_akta_kelahiran_anak'
        ) {
            $data = \App\Models\surat_permohonan_pengantar_keabsahan_akta_kelahiran_anak::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_permohonan_pengantar_keabsahan_akta_kelahiran_anak', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('surat_permohonan_pengantar_keabsahan_akta_kelahiran_anak_' . $filename . '.pdf');
        }

        if ($jenis === 'suratpernyataannumpangkk') {
            $data = surat_pernyataan_numpang_kk::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdfsuratnumpangkk', compact('data'))->setPaper('A4');
            return $pdf->download('pdfsuratnumpangkk_' . $data->nama_pelapor . '.pdf');
        }

        if ($jenis === 'surat_keterangan_tidakmampu') {
            $data = suratketerangantidakmampu::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_tidakmampu', compact('data'))->setPaper('A4');
            return $pdf->download('pdf_surat_keterangan_tidakmampu' . $data->nama_pelapor . '.pdf');
        }

        if ($jenis === 'surat_pernyataan_memilih_nama_alias') {
            $data = surat_pernyataan_memilih_nama_alias::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_pernyataan_memilih_nama_alias', compact('data'))->setPaper('A4');
            return $pdf->download('pdf_surat_pernyataan_memilih_nama_alias' . $data->nama_pelapor . '.pdf');
        }


        if (
            $jenis === 'surat_pernyataan_memilih_nama_alias_satu_orang_tua' ||
            $jenis === 'surat_pernyataan_memilih_nama_alias_satu_ortu'
        ) {
            $data = nama_alias_ortu::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_pernyataan_memilih_nama_alias_satu_ortu', compact('data'))->setPaper('A4');
            // pakai nama yang tersedia: nama_menyatakan → fallback nama → fallback 'dokumen'
            $filenameName = $data->nama_menyatakan ?? $data->nama ?? 'dokumen';
            return $pdf->download('pdf_surat_pernyataan_memilih_nama_alias_satu_ortu_' . $filenameName . '.pdf');
        }

        if ($jenis === 'suratketerangandesapernahmenikah') {
            $data = surat_keterangan_desa_pernah_menikah::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_surat_keterangan_desa_pernah_menikah', compact('data'))->setPaper('A4');
            $filenameName = $data->nama_lengkap ?? 'dokumen';
            return $pdf->download('pdf_surat_keterangan_desa_pernah_menikah_' . $filenameName . '.pdf');
        }

        if ($jenis === 'suratpernyataandanjaminan') {
            $data = surat_pernyataan_dan_jaminan::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_surat_pernyataan_dan_jaminan', compact('data'))->setPaper('A4');
            $filename = $data->nama_lengkap ?? 'dokumen';
            return $pdf->download('pdf_surat_pernyataan_dan_jaminan_' . $filename . '.pdf');
        }


        if ($jenis === 'suratketeranganahliwaris') {
            $data = surat_keterangan_ahli_waris::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_surat_keterangan_ahli_waris', compact('data'))->setPaper('A4');
            $filename = $data->nama_lengkap ?? 'dokumen';
            return $pdf->download('pdf_surat_keterangan_ahli_waris_' . $filename . '.pdf');
        }
        if (
            $jenis === 'surat_pernyataan_kesanggupan' ||
            $jenis === 'pernyataan_kesanggupan' ||
            $jenis === 'suratpernyataankesanggupan' ||   // ← TAMBAHKAN INI
            $jenis === 'kesanggupan'
        ) {
            $data = SuratPernyataanKesanggupan::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_pernyataan_kesanggupan', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'kesanggupan', '_');

            return $pdf->download('surat_pernyataan_kesanggupan_' . $filename . '.pdf');
        }

        // ================================================
        // SURAT PERNYATAAN TIDAK MEMILIKI KARTU JAMKESMAS
        // ================================================
        // ================================================
        // SURAT PERNYATAAN TIDAK MEMILIKI KARTU JAMKESMAS
        // ================================================
        if (
            $jenis === 'surat_pernyataan_tidak_punya_kartu_jkn' ||
            $jenis === 'pernyataan_tidak_punya_kartu_jkn' ||
            $jenis === 'tidak_punya_kartu' ||
            $jenis === 'jamkesmas' ||
            $jenis === 'jkn' ||
            $jenis === 'suratpernyataantidakpunyakartujkn' ||   // ← TAMBAHKAN INI
            $jenis === 'suratpernyataantidakpunyakartu'          // ← TAMBAHKAN INI
        ) {
            $data = SuratPernyataanTidakPunyaKartuJkn::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_pernyataan_tidak_punya_kartu_jkn', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'pernyataan_kartu', '_');

            return $pdf->download('surat_pernyataan_tidak_punya_kartu_' . $filename . '.pdf');
        }

        if ($jenis === 'suratkuasa') {
            $data = surat_kuasa::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_surat_kuasa', compact('data'))->setPaper('A4');
            $filename = $data->p1_nama_lengkap ?? 'dokumen';
            return $pdf->download('pdf_surat_kuasa_' . $filename . '.pdf');
        }

        if ($jenis === 'permohonanpembukaanrekening') {
            $data = surat_permohonan_pembukaan_rekening::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_permohonan_pembukaan_rekening', compact('data'))->setPaper('A4');
            $filename = Str::slug($data->ybt_nama ?? 'dokumen', '_');
            return $pdf->download('pdf_permohonan_pembukaan_rekening_' . $filename . '.pdf');
        }

        if ($jenis === 'suratpernyataanbelumakta') {
            $data = surat_pernyataan_belum_akta::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_surat_pernyataan_belum_akta', compact('data'))->setPaper('A4');
            $filename = Str::slug($data->ybt_nama ?? 'dokumen', '_');
            return $pdf->download('pdf_pernyataan_belum_akta_' . $filename . '.pdf');
        }

        if ($jenis === 'suratpernyataanbedanamabukunikah') {
            $data = surat_pernyataan_beda_nama_buku_nikah::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_pernyataan_beda_nama_buku_nikah', compact('data'))->setPaper('A4');
            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_pernyataan_beda_nama_buku_nikah_' . $filename . '.pdf');
        }

        if ($jenis === 'surat_pernyataan_anak_seorang_nama_ibu') {
            $data = surat_pernyataan_anak_seorang_nama_ibu::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_pernyataan_anak_seorang_nama_ibu', compact('data'))->setPaper('A4');
            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_pernyataan_anak_seorang_nama_ibu_' . $filename . '.pdf');
        }

        if ($jenis === 'suratpernyataanaktabarcodenomorsama') {
            $data = surat_pernyataan_akta_barcode_nomor_sama::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_pernyataan_akta_barcode_nomor_sama', compact('data'))->setPaper('A4');
            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_pernyataan_akta_barcode_nomor_sama_' . $filename . '.pdf');
        }

        if ($jenis === 'sptjmkematian') {
            $data = surat_sptjm_kematian::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_sptjm_kematian', compact('data'))->setPaper('A4');
            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_sptjm_kematian_' . $filename . '.pdf');
        }

        if ($jenis === 'suratketeranganhargakepemilikantanah') {
            $data = \App\Models\surat_keterangan_harga_kepemilikan_tanah::findOrFail($id);
            $pdf  = Pdf::loadView('surat.pdf_surat_keterangan_harga_kepemilikan_tanah', compact('data'))->setPaper('A4');
            $filename = Str::slug($data->nama ?? 'dokumen', '_');
            return $pdf->download('pdf_surat_keterangan_harga_kepemilikan_tanah_' . $filename . '.pdf');
        }

        if (
            $jenis === 'suratpengantarskck' ||
            $jenis === 'surat_pengantar_skck' ||
            $jenis === 'skck'
        ) {
            $surat = SuratPengantarSkck::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_skck', compact('surat'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($surat->nama ?? 'surat_pengantar_skck', '_');

            return $pdf->download('surat_pengantar_skck_' . $filename . '.pdf');
        }

        if (
            $jenis === 'suratketeranganusaha' ||
            $jenis === 'surat_keterangan_usaha' ||
            $jenis === 'usaha'
        ) {
            $data = SuratKeteranganUsaha::findOrFail($id);

            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_usaha', compact('data'))
                ->setPaper('A4', 'portrait');

            $filename = Str::slug($data->nama ?? 'surat_keterangan_usaha', '_');

            return $pdf->download('surat_keterangan_usaha_' . $filename . '.pdf');
        }

        if (
            $jenis === 'surat_keterangan_domisili_lembaga' ||
            $jenis === 'domisili_lembaga' ||
            $jenis === 'suratketerangandomisililembaga'
        ) {
            $data = SuratKeteranganDomisiliLembaga::findOrFail($id);
            $pdf = Pdf::loadView('surat.pdf_surat_keterangan_domisili_lembaga', compact('data'))
                ->setPaper('A4', 'portrait');
            $filename = Str::slug($data->nama_lembaga ?? 'domisili_lembaga', '_');
            return $pdf->download('surat_keterangan_domisili_lembaga_' . $filename . '.pdf');
        }













        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoresuratmasukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'keterangan'    => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'file'          => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        // Nama file yang aman
        $original = $request->file('file')->getClientOriginalName();
        $safeName = time() . '_' . Str::slug(pathinfo($original, PATHINFO_FILENAME), '_')
            . '.' . $request->file('file')->getClientOriginalExtension();

        // Pastikan direktori disk siap (opsional, biasanya otomatis)
        if (! Storage::disk('suratdesa')->exists('')) {
            Storage::disk('suratdesa')->makeDirectory('');
        }

        // Simpan file ke disk 'suratdesa'
        // Hasil $path hanya nama file (tanpa folder), contoh: 1758682751_surat_pengantar.pdf
        $path = $request->file('file')->storeAs('', $safeName, 'suratdesa');

        // Simpan data ke MongoDB
        SuratMasuk::create([
            'nama_instansi' => $request->nama_instansi,
            'keterangan'    => $request->keterangan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'file'          => $path, // simpan nama file saja
        ]);

        return redirect()->route('surat.masuk')->with('msg', 'Surat masuk berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suratmasuk  $suratmasuk
     * @return \Illuminate\Http\Response
     */
    public function show(suratmasuk $suratmasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\suratmasuk  $suratmasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(suratmasuk $suratmasuk)
    {
        return view('surat.editsuratmasuk', compact('suratmasuk'));
    }




    // Update the specified Surat Masuk
    public function update(Request $request, SuratMasuk $suratmasuk)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'keterangan'    => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'file'          => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        // Update field non-file
        $suratmasuk->fill($request->only(['nama_instansi', 'keterangan', 'tanggal_masuk']));

        // Jika ada file baru, hapus yang lama lalu simpan yang baru
        if ($request->hasFile('file')) {

            // Hapus file lama jika ada
            if ($suratmasuk->file && Storage::disk('suratdesa')->exists($suratmasuk->file)) {
                Storage::disk('suratdesa')->delete($suratmasuk->file);
            }

            $original = $request->file('file')->getClientOriginalName();
            $safeName = time() . '_' . Str::slug(pathinfo($original, PATHINFO_FILENAME), '_')
                . '.' . $request->file('file')->getClientOriginalExtension();

            if (! Storage::disk('suratdesa')->exists('')) {
                Storage::disk('suratdesa')->makeDirectory('');
            }

            $path = $request->file('file')->storeAs('', $safeName, 'suratdesa');

            $suratmasuk->file = $path; // simpan nama file baru
        }

        $suratmasuk->save();

        return redirect()->route('surat.masuk')->with('msg', 'Surat masuk berhasil diperbarui.');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\suratmasuk  $suratmasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(suratmasuk $suratmasuk)
    {
        //
    }
}
