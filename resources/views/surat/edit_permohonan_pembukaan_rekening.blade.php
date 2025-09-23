@extends(Auth::user() && Auth::user()->role == 'admin' ? 'layout.main2' : 'layout.main')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">Edit Permohonan Pembukaan Rekening</h4>

            <form action="{{ route('surat.bukaanrekening.update', $surat->_id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- KEPADA --}}
                <h5 class="mb-3">Kepada</h5>
                <div class="mb-3">
                    <label class="form-label" for="kepada_nama_instansi">Nama Instansi</label>
                    <input type="text" id="kepada_nama_instansi" name="kepada_nama_instansi" class="form-control" required
                           value="{{ old('kepada_nama_instansi', $surat->kepada_nama_instansi) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="kepada_alamat">Alamat Instansi</label>
                    <textarea id="kepada_alamat" name="kepada_alamat" rows="2" class="form-control" required>{{ old('kepada_alamat', $surat->kepada_alamat) }}</textarea>
                </div>

                <hr class="my-4">

                {{-- YANG BERTANDA TANGAN --}}
                <h5 class="mb-3">Yang Bertanda Tangan</h5>
                <div class="mb-3">
                    <label class="form-label" for="ybt_nama">Nama</label>
                    <input type="text" id="ybt_nama" name="ybt_nama" class="form-control" required
                           value="{{ old('ybt_nama', $surat->ybt_nama) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="ybt_jabatan">Jabatan</label>
                    <input type="text" id="ybt_jabatan" name="ybt_jabatan" class="form-control" required
                           value="{{ old('ybt_jabatan', $surat->ybt_jabatan) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="ybt_alamat">Alamat</label>
                    <textarea id="ybt_alamat" name="ybt_alamat" rows="2" class="form-control" required>{{ old('ybt_alamat', $surat->ybt_alamat) }}</textarea>
                </div>

                <hr class="my-4">

                {{-- KETENTUAN --}}
                <h5 class="mb-3">Ketentuan</h5>
                <div class="mb-3">
                    <label class="form-label" for="rekening_atas_nama">Rekening Atas Nama</label>
                    <input type="text" id="rekening_atas_nama" name="rekening_atas_nama" class="form-control" required
                           value="{{ old('rekening_atas_nama', $surat->rekening_atas_nama) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="rekening_alamat">Alamat</label>
                    <textarea id="rekening_alamat" name="rekening_alamat" rows="2" class="form-control" required>{{ old('rekening_alamat', $surat->rekening_alamat) }}</textarea>
                </div>

                <hr class="my-4">

                {{-- YANG BERWENANG --}}
                <h5 class="mb-3">Yang Berwenang</h5>
                @php
                    $nama    = old('berwenang_nama', $surat->berwenang_nama ?? []);
                    $jabatan = old('berwenang_jabatan', $surat->berwenang_jabatan ?? []);
                    $jumlahAwal = old('berwenang_jumlah', max(count($nama), count($jabatan)));
                @endphp

                <div class="row g-2 align-items-end mb-2">
                    <div class="col-md-3">
                        <label class="form-label" for="berwenang_jumlah">Jumlah Baris</label>
                        <input type="number" min="0" id="berwenang_jumlah" name="berwenang_jumlah" class="form-control"
                               value="{{ $jumlahAwal }}">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:55%">Nama</th>
                                <th style="width:35%">Jabatan</th>
                            </tr>
                        </thead>
                        <tbody id="berwenang-wrapper"></tbody>
                    </table>
                </div>

                <input type="hidden" name="status_surat" value="{{ old('status_surat', $surat->status_surat ?? 'Pending') }}">
                <input type="hidden" name="status_verif" value="{{ old('status_verif', $surat->status_verif ?? 'Belum Verifikasi') }}">

                <div class="mb-3 mt-3">
                    <label class="form-label" for="nowa">No WhatsApp</label>
                    <input type="text" id="nowa" name="nowa" class="form-control" required
                           value="{{ old('nowa', $surat->nowa) }}">
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function(){
    const tbody   = document.getElementById('berwenang-wrapper');
    const jumlah  = document.getElementById('berwenang_jumlah');

    const oldNama    = @json(old('berwenang_nama', $surat->berwenang_nama ?? []));
    const oldJabatan = @json(old('berwenang_jabatan', $surat->berwenang_jabatan ?? []));

    function rowHTML(i, nama, jabatan){
        return `
            <tr>
                <td><input type="text" name="berwenang_nama[]" class="form-control"
                           value="${nama ? String(nama).replace(/"/g,'&quot;'):''}" placeholder="Nama ${i+1}"></td>
                <td><input type="text" name="berwenang_jabatan[]" class="form-control"
                           value="${jabatan ? String(jabatan).replace(/"/g,'&quot;'):''}" placeholder="Jabatan ${i+1}"></td>
            </tr>
        `;
    }

    function render(n){
        tbody.innerHTML = '';
        const total = parseInt(n || 0, 10);
        for (let i=0; i<total; i++){
            tbody.insertAdjacentHTML('beforeend', rowHTML(i, oldNama[i] || '', oldJabatan[i] || ''));
        }
    }

    render(jumlah.value);
    jumlah.addEventListener('input', () => render(jumlah.value));
})();
</script>
@endsection
