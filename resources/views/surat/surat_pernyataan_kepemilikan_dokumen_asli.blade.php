@extends(Auth::user() && Auth::user()->role == 'admin' ? 'layout.main2' : 'layout.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-heade">
                    <h5 class="mb-0">Form Pembuatan Surat Pernyataan Kepemilikan Dokumen Asli</h5>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('surat.pernyataan_kepemilikan_dokumen.store') }}" method="POST">
                        @csrf

                        <!-- Data Utama -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    onkeyup="autofillPernyataanAdmin()" placeholder="Masukkan NIK" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pekerjaan <span class="text-danger">*</span></label>
                                <select name="pekerjaan" id="pekerjaan" class="form-control" required>
                                    <option value="">-- Pilih pekerjaan --</option>
                                    @php
                                    $jobs = ['BELUM/TIDAK BEKERJA','PELAJAR/MAHASISWA','TIDAK/BELUM SEKOLAH','KARYAWAN SWASTA','IBU RUMAH TANGGA','WIRASWASTA','TENTARA NASIONAL INDONESIA (TNI)','KEPOLISIAN RI (POLRI)','DOSEN','GURU','KEPALA DESA','PERANGKAT DESA','BIDAN','DOKTER','PERAWAT','PETANI/PEKEBUN PEMILIK LAHAN','BURUH TANI/PERKEBUNAN','PEDAGANG','PEGAWAI NEGERI SIPIL (PNS)','BURUH HARIAN LEPAS','SOPIR','KARYAWAN BUMN','PENSIUNAN','PEMBANTU RUMAH TANGGA','BURUH PETERNAKAN','KONSTRUKSI','PELAUT','NELAYAN/PERIKANAN','KARYAWAN HONORER','PETERNAK','MEKANIK','PENATA RIAS','TUKANG LAS/PANDAI BESI','INDUSTRI','USTADZ/MUBALIGH','TABIB','BURUH NELAYAN/PERIKANAN','JURU MASAK','SENIMAN','AKUNTAN','Petani/Pekebun penyewa','TKI','Lainnya'];
                                    @endphp
                                    @foreach ($jobs as $job)
                                    <option value="{{ $job }}" {{ old('pekerjaan') == $job ? 'selected' : '' }}>{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>No HP / WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="nowa" id="nowa" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="2" required></textarea>
                            </div>
                        </div>

                        <!-- Data Dokumen -->
                        <h6 class="mt-4 mb-3">Data Dokumen yang Dimiliki</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Dokumen / Surat <span class="text-danger">*</span></label>
                                <input type="text" name="nama_dokumen" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nomor Dokumen / Surat <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_dokumen" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Pemilik Dokumen</label>
                                <input type="text" name="nama_pemilik_dokumen" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir Pemilik</label>
                                <input type="date" name="tanggal_lahir_pemilik" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat yang Tertera di Dokumen</label>
                            <textarea name="alamat_dokumen" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Keterangan Tambahan</label>
                            <textarea name="keterangan_tambahan" class="form-control" rows="2"></textarea>
                        </div>

                        <!-- Status (WAJIB) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Status Surat <span class="text-danger">*</span></label>
                                <select name="status_surat" class="form-control" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Di cek">Di cek</option>
                                    <option value="Di terima">Di terima</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status Verifikasi <span class="text-danger">*</span></label>
                                <select name="status_verif" class="form-control" required>
                                    <option value="Belum Verifikasi">Belum Verifikasi</option>
                                    <option value="Terverifikasi">Terverifikasi</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const nikInput = document.getElementById('nik');

    let debounceTimer = null;
    let activeController = null;

    function setValue(id, value) {
        const element = document.getElementById(id);

        if (!element) return;

        element.value = value ?? '';
    }

    function resetDataPenduduk() {
        setValue('nama', '');
        setValue('jenis_kelamin', '');
        setValue('tempat_lahir', '');
        setValue('tanggal_lahir', '');
        setValue('pekerjaan', '');
        setValue('alamat', '');
    }

    async function autofillPernyataanAdmin() {

        const nik = nikInput.value.replace(/\D/g, '');

        // Batalkan pencarian sebelumnya
        if (activeController) {
            activeController.abort();
            activeController = null;
        }

        // NIK belum lengkap
        if (nik.length !== 16) {
            resetDataPenduduk();
            return;
        }

        activeController = new AbortController();

        try {

            const response = await fetch(
                `/datapenduduk/lookup/${encodeURIComponent(nik)}`,
                {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    signal: activeController.signal
                }
            );

            const result = await response.json();

            // Pastikan NIK masih sama dengan yang sedang diketik
            const nikSekarang = nikInput.value.replace(/\D/g, '');

            if (nikSekarang !== nik) {
                return;
            }

            if (!response.ok || !result.success || !result.data) {
                resetDataPenduduk();

                console.warn('Data penduduk tidak ditemukan:', result.message);

                alert(result.message || 'Data penduduk tidak ditemukan.');
                return;
            }

            const d = result.data;

            // Pastikan respons benar-benar milik NIK yang diminta
            if (String(d.nik).replace(/\D/g, '') !== nik) {
                resetDataPenduduk();

                console.error('NIK respons tidak sesuai dengan NIK input.');
                alert('NIK data yang diterima tidak sesuai.');
                return;
            }

            // Isi data penduduk
            setValue('nama', d.nama);
            setValue('jenis_kelamin', d.jenis_kelamin);
            setValue('tempat_lahir', d.tempat_lahir);
            setValue('tanggal_lahir', d.tanggal_lahir);
            setValue('alamat', d.alamat);

            // Pilih pekerjaan sesuai data database
            const pekerjaan = document.getElementById('pekerjaan');

            if (pekerjaan) {

                const pekerjaanDB = String(d.pekerjaan || '')
                    .trim()
                    .toUpperCase();

                const option = Array.from(pekerjaan.options).find(
                    item => item.value.trim().toUpperCase() === pekerjaanDB
                );

                if (option) {
                    pekerjaan.value = option.value;
                } else if (pekerjaanDB !== '') {
                    console.warn(
                        'Pekerjaan tidak ditemukan pada pilihan:',
                        d.pekerjaan
                    );

                    pekerjaan.value = '';
                }
            }

            console.log('Autofill berhasil:', {
                nik: d.nik,
                nama: d.nama,
                pekerjaan: d.pekerjaan
            });

        } catch (error) {

            if (error.name === 'AbortError') {
                return;
            }

            console.error('Autofill error:', error);
            resetDataPenduduk();

        }
    }

    nikInput.addEventListener('input', function () {

        clearTimeout(debounceTimer);

        const nik = this.value.replace(/\D/g, '');

        this.value = nik;

        if (activeController) {
            activeController.abort();
            activeController = null;
        }

        if (nik.length !== 16) {
            resetDataPenduduk();
            return;
        }

        debounceTimer = setTimeout(function () {
            autofillPernyataanAdmin();
        }, 400);

    });

});
</script>

@endsection