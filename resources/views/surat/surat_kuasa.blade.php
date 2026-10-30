@extends(Auth::user() && Auth::user()->role == 'admin' ? 'layout.main2' : 'layout.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Pembuatan Surat Kuasa</h5>
                </div>

                <div class="card-body">

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('surat.kuasa.store') }}" method="POST">
                        @csrf

                        {{-- ================= PIHAK I ================= --}}

                        <h5 class="mt-3">Pihak I - Pemberi Kuasa</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>NIK <span class="text-danger">*</span></label>

                                <input
                                    type="text"
                                    name="nik_pihak1"
                                    id="nik_pihak1"
                                    class="form-control"
                                    inputmode="numeric"
                                    maxlength="16"
                                    autocomplete="off"
                                    value="{{ old('nik_pihak1') }}"
                                    placeholder="Masukkan 16 digit NIK, lalu tekan Enter"
                                    required>

                                <div id="status_nik_pihak1" class="form-text">
                                    Ketik 16 digit NIK, kemudian tekan Enter untuk mengambil data penduduk.
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap <span class="text-danger">*</span></label>

                                <input
                                    type="text"
                                    name="nama_pihak1"
                                    id="nama_pihak1"
                                    class="form-control"
                                    value="{{ old('nama_pihak1') }}"
                                    required>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Jenis Kelamin</label>

                                <select
                                    name="jenis_kelamin_pihak1"
                                    id="jenis_kelamin_pihak1"
                                    class="form-control"
                                    required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Agama</label>

                                <select
                                    name="agama_pihak1"
                                    id="agama_pihak1"
                                    class="form-control"
                                    required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Status</label>

                                <select
                                    name="status_pihak1"
                                    id="status_pihak1"
                                    class="form-control"
                                    required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>

                                <input
                                    type="text"
                                    name="tempat_lahir_pihak1"
                                    id="tempat_lahir_pihak1"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>

                                <input
                                    type="date"
                                    name="tanggal_lahir_pihak1"
                                    id="tanggal_lahir_pihak1"
                                    class="form-control"
                                    required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Pekerjaan</label>

                            <select
                                name="pekerjaan_pihak1"
                                id="pekerjaan_pihak1"
                                class="form-control"
                                required>
                                <option value="">-- Pilih Pekerjaan --</option>

                                @foreach ([
                                'BELUM/TIDAK BEKERJA',
                                'PELAJAR/MAHASISWA',
                                'TIDAK/BELUM SEKOLAH',
                                'KARYAWAN SWASTA',
                                'IBU RUMAH TANGGA',
                                'WIRASWASTA',
                                'TNI',
                                'POLRI',
                                'DOSEN',
                                'GURU',
                                'KEPALA DESA',
                                'PERANGKAT DESA',
                                'PETANI/PEKEBUN PEMILIK LAHAN',
                                'BURUH TANI',
                                'PEDAGANG',
                                'PNS',
                                'BURUH HARIAN LEPAS',
                                'SOPIR',
                                'KARYAWAN BUMN',
                                'Lainnya'
                                ] as $p)
                                <option value="{{ $p }}">{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Alamat Lengkap <span class="text-danger">*</span></label>

                            <textarea
                                name="alamat_pihak1"
                                id="alamat_pihak1"
                                class="form-control"
                                rows="2"
                                required></textarea>
                        </div>

                        <hr>

                        {{-- ================= PIHAK II ================= --}}

                        <h5>Pihak II - Penerima Kuasa</h5>

                        <div class="mb-3">
                            <label>NIK <span class="text-danger">*</span></label>

                            <input
                                type="text"
                                name="nik_pihak2"
                                id="nik_pihak2"
                                class="form-control"
                                inputmode="numeric"
                                maxlength="16"
                                autocomplete="off"
                                value="{{ old('nik_pihak2') }}"
                                placeholder="Masukkan 16 digit NIK, lalu tekan Enter"
                                required>

                            <div id="status_nik_pihak2" class="form-text">
                                Ketik 16 digit NIK, kemudian tekan Enter untuk mengambil data penduduk.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>

                            <input
                                type="text"
                                name="nama_pihak2"
                                id="nama_pihak2"
                                class="form-control"
                                value="{{ old('nama_pihak2') }}"
                                required>
                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Jenis Kelamin</label>

                                <select
                                    name="jenis_kelamin_pihak2"
                                    id="jenis_kelamin_pihak2"
                                    class="form-control"
                                    required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Agama</label>

                                <select
                                    name="agama_pihak2"
                                    id="agama_pihak2"
                                    class="form-control"
                                    required>
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Status</label>

                                <select
                                    name="status_pihak2"
                                    id="status_pihak2"
                                    class="form-control"
                                    required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir</label>

                                <input
                                    type="text"
                                    name="tempat_lahir_pihak2"
                                    id="tempat_lahir_pihak2"
                                    class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>

                                <input
                                    type="date"
                                    name="tanggal_lahir_pihak2"
                                    id="tanggal_lahir_pihak2"
                                    class="form-control"
                                    required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label>Pekerjaan</label>

                            <select
                                name="pekerjaan_pihak2"
                                id="pekerjaan_pihak2"
                                class="form-control"
                                required>
                                <option value="">-- Pilih Pekerjaan --</option>

                                @foreach ([
                                'BELUM/TIDAK BEKERJA',
                                'PELAJAR/MAHASISWA',
                                'TIDAK/BELUM SEKOLAH',
                                'KARYAWAN SWASTA',
                                'IBU RUMAH TANGGA',
                                'WIRASWASTA',
                                'TNI',
                                'POLRI',
                                'DOSEN',
                                'GURU',
                                'KEPALA DESA',
                                'PERANGKAT DESA',
                                'PETANI/PEKEBUN PEMILIK LAHAN',
                                'BURUH TANI',
                                'PEDAGANG',
                                'PNS',
                                'BURUH HARIAN LEPAS',
                                'SOPIR',
                                'KARYAWAN BUMN',
                                'Lainnya'
                                ] as $p)
                                <option value="{{ $p }}">{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Alamat Lengkap <span class="text-danger">*</span></label>

                            <textarea
                                name="alamat_pihak2"
                                id="alamat_pihak2"
                                class="form-control"
                                rows="2"
                                required></textarea>
                        </div>

                        <hr>

                        {{-- ================= KETERANGAN KUASA ================= --}}

                        <div class="mb-3">
                            <label>Keterangan / Maksud Kuasa <span class="text-danger">*</span></label>

                            <textarea
                                name="keterangan_kuasa"
                                class="form-control"
                                rows="4"
                                placeholder="Contoh: pengambilan BPKB Motor dengan nomor register AG6089PAZ atas nama Katimah..."
                                required>{{ old('keterangan_kuasa') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>No WhatsApp <span class="text-danger">*</span></label>

                                <input
                                    type="text"
                                    name="nowa"
                                    class="form-control"
                                    value="{{ old('nowa') }}"
                                    required>
                            </div>
                        </div>

                        {{-- ================= STATUS SURAT ================= --}}

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Status Surat</label>

                                <select name="status_surat" class="form-control" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Di cek">Di cek</option>
                                    <option value="Di terima">Di terima</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Status Verifikasi</label>

                                <select name="status_verif" class="form-control" required>
                                    <option value="Belum Verifikasi">Belum Verifikasi</option>
                                    <option value="Terverifikasi">Terverifikasi</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Simpan Surat Kuasa
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- ================= JAVASCRIPT AUTOFILL ================= --}}

<script>
 
document.addEventListener('DOMContentLoaded', function () {

    setupNikAutofill('pihak1');
    setupNikAutofill('pihak2');

    function setupNikAutofill(prefix) {

        const nikInput = document.getElementById('nik_' + prefix);
        const statusElement = document.getElementById('status_nik_' + prefix);

        if (!nikInput) {
            console.error('Input NIK tidak ditemukan:', prefix);
            return;
        }

        let controller = null;
        let requestId = 0;

        nikInput.addEventListener('input', function () {

            this.value = this.value.replace(/\D/g, '').slice(0, 16);

            // Batalkan pencarian sebelumnya
            if (controller) {
                controller.abort();
                controller = null;
            }

            requestId++;

            if (this.value.length < 16) {
                resetData(prefix);
                setStatus(statusElement, 'Masukkan 16 digit NIK.', 'normal');
            }
        });

        nikInput.addEventListener('keydown', function (event) {

            if (event.key !== 'Enter') return;

            event.preventDefault();

            cariPenduduk(prefix, nikInput, statusElement);
        });

    }


    async function cariPenduduk(prefix, nikInput, statusElement) {

        const nik = nikInput.value.trim();

        if (!/^\d{16}$/.test(nik)) {
            setStatus(statusElement, 'NIK harus 16 digit.', 'error');
            return;
        }

        const requestId = Date.now();

        if (window['lookupController_' + prefix]) {
            window['lookupController_' + prefix].abort();
        }

        const controller = new AbortController();

        window['lookupController_' + prefix] = controller;

        setStatus(statusElement, 'Sedang mencari data penduduk...', 'loading');

        try {

            const response = await fetch(
                '/datapenduduk/lookup/' + encodeURIComponent(nik),
                {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    signal: controller.signal
                }
            );

            const result = await response.json();

            // Pastikan NIK tidak berubah ketika pencarian berlangsung
            if (nikInput.value.trim() !== nik) return;

            if (!response.ok || !result.success || !result.data) {
                throw new Error(result.message || 'Data penduduk tidak ditemukan.');
            }

            const data = result.data;

            // Validasi NIK dari server
            if (String(data.nik).replace(/\D/g, '') !== nik) {
                throw new Error('NIK hasil pencarian tidak sesuai.');
            }

            isiData(prefix, data);

            setStatus(
                statusElement,
                'Data penduduk berhasil ditemukan.',
                'success'
            );

            console.log('Autofill berhasil:', prefix, data);

        } catch (error) {

            if (error.name === 'AbortError') return;

            resetData(prefix);

            setStatus(
                statusElement,
                error.message || 'Gagal mengambil data penduduk.',
                'error'
            );

            console.error(error);

        }
    }


    // ==========================================
    // MENGISI DATA PENDUDUK
    // ==========================================

    function isiData(prefix, data) {

        setInput('nama_' + prefix, data.nama);

        setInput('tempat_lahir_' + prefix, data.tempat_lahir);

        setInput('tanggal_lahir_' + prefix, data.tanggal_lahir);

        setInput('alamat_' + prefix, data.alamat);

        setJenisKelamin(
            'jenis_kelamin_' + prefix,
            data.jenis_kelamin
        );

        setSelect(
            'agama_' + prefix,
            data.agama,
            true
        );

        setSelect(
            'pekerjaan_' + prefix,
            data.pekerjaan,
            true
        );

        setStatusPerkawinan(
            'status_' + prefix,
            data.status_perkawinan || data.status
        );
    }


    // ==========================================
    // INPUT TEXT DAN DATE
    // ==========================================

    function setInput(id, value) {

        const element = document.getElementById(id);

        if (!element || value === null || value === undefined) return;

        element.value = value;

        element.dispatchEvent(new Event('change', { bubbles: true }));
    }


    // ==========================================
    // JENIS KELAMIN
    // ==========================================

    function setJenisKelamin(id, value) {

        const element = document.getElementById(id);

        if (!element || !value) return;

        const gender = String(value)
            .trim()
            .toLowerCase()
            .replace(/[\s_-]/g, '');

        let hasil = '';

        if (['1', 'l', 'lk', 'lakilaki', 'male'].includes(gender)) {
            hasil = 'Laki-laki';
        }

        if (['2', 'p', 'pr', 'perempuan', 'female'].includes(gender)) {
            hasil = 'Perempuan';
        }

        if (!hasil) {
            console.warn('Jenis kelamin tidak dikenali:', value);
            return;
        }

        element.value = hasil;

        element.dispatchEvent(new Event('change', { bubbles: true }));
    }


    // ==========================================
    // AGAMA DAN PEKERJAAN
    // ==========================================

    function normalize(value) {

        return String(value || '')
            .trim()
            .toLowerCase()
            .replace(/[\s_.,()-]/g, '');
    }

    function setSelect(id, value, addIfMissing = false) {

        const element = document.getElementById(id);

        if (!element || !value) return;

        const normalized = normalize(value);

        let option = Array.from(element.options).find(item =>
            normalize(item.value) === normalized ||
            normalize(item.textContent) === normalized
        );

        if (!option && addIfMissing) {

            option = document.createElement('option');
            option.value = String(value).trim();
            option.textContent = String(value).trim();

            element.appendChild(option);
        }

        if (option) {

            element.value = option.value;

            element.dispatchEvent(
                new Event('change', { bubbles: true })
            );

        } else {

            console.warn('Pilihan tidak ditemukan:', id, value);
        }
    }


    // ==========================================
    // STATUS PERKAWINAN
    // ==========================================

    function setStatusPerkawinan(id, value) {

        if (!value) return;

        const normalized = normalize(value);

        const aliases = {
            'belummenikah': 'Belum Kawin',
            'belumkawin': 'Belum Kawin',
            'menikah': 'Kawin',
            'kawin': 'Kawin',
            'ceraihidup': 'Cerai Hidup',
            'ceraimati': 'Cerai Mati'
        };

        const hasil = aliases[normalized] || value;

        setSelect(id, hasil, false);
    }


    // ==========================================
    // KOSONGKAN DATA
    // ==========================================

    function resetData(prefix) {

        [
            'nama_',
            'tempat_lahir_',
            'tanggal_lahir_',
            'alamat_'
        ].forEach(field => {

            const element = document.getElementById(field + prefix);

            if (element) element.value = '';
        });

        [
            'jenis_kelamin_',
            'agama_',
            'pekerjaan_',
            'status_'
        ].forEach(field => {

            const element = document.getElementById(field + prefix);

            if (element) element.value = '';
        });
    }


    // ==========================================
    // STATUS PENCARIAN
    // ==========================================

    function setStatus(element, message, type) {

        if (!element) return;

        element.textContent = message;

        element.classList.remove(
            'text-muted',
            'text-primary',
            'text-success',
            'text-danger'
        );

        const classes = {
            normal: 'text-muted',
            loading: 'text-primary',
            success: 'text-success',
            error: 'text-danger'
        };

        element.classList.add(classes[type] || 'text-muted');
    }

});

</script>

@endsection