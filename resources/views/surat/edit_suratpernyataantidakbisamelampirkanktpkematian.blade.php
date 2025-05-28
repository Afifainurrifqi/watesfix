@extends(Auth::user() && Auth::user()->role == 'admin' ? 'layout.main2' : 'layout.main')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">Edit Surat Pernyataan Tidak Bisa Melampirkan KTP Kematian</h4>

            <form action="{{ route('suratpernyataantidakbisamelampirkanktpkematian.update', $surat->_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Pelapor -->
                <div class="mb-3">
                    <label for="nama_pelapor" class="form-label">Nama Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pelapor" id="nama_pelapor" class="form-control" value="{{ old('nama_pelapor', $surat->nama_pelapor) }}" required>
                </div>

                <!-- NIK Pelapor -->
                <div class="mb-3">
                    <label for="nik_pelapor" class="form-label">NIK Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="nik_pelapor" id="nik_pelapor" class="form-control" value="{{ old('nik_pelapor', $surat->nik_pelapor) }}" required>
                </div>

                <!-- Tempat Lahir Pelapor -->
                <div class="mb-3">
                    <label for="tempat_lahir_pelapor" class="form-label">Tempat Lahir Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir_pelapor" id="tempat_lahir_pelapor" class="form-control" value="{{ old('tempat_lahir_pelapor', $surat->tempat_lahir_pelapor) }}" required>
                </div>

                <!-- Tanggal Lahir Pelapor -->
                <div class="mb-3">
                    <label for="tanggal_lahir_pelapor" class="form-label">Tanggal Lahir Pelapor <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir_pelapor" id="tanggal_lahir_pelapor" class="form-control" value="{{ old('tanggal_lahir_pelapor', $surat->tanggal_lahir_pelapor) }}" required>
                </div>

                <!-- Agama Pelapor -->
                <div class="mb-3">
                    <label for="agama_pelapor" class="form-label">Agama <span class="text-danger">*</span></label>
                    <select name="agama_pelapor" id="agama_pelapor" class="form-control" required>
                        <option value="">-- Pilih Agama --</option>
                        @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'] as $agama_pelapor)
                            <option value="{{ $agama_pelapor }}"
                                {{ old('agama_pelapor', $surat->agama_pelapor) == $agama_pelapor ? 'selected' : '' }}>
                                {{ $agama_pelapor }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jenis Kelamin Pelapor -->
                <div class="mb-3">
                    <label for="jenis_kelamin_pelapor" class="form-label">Jenis Kelamin Pelapor <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin_pelapor" id="jenis_kelamin_pelapor" class="form-control" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin_pelapor', $surat->jenis_kelamin_pelapor) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin_pelapor', $surat->jenis_kelamin_pelapor) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Pekerjaan Pelapor -->
                <div class="mb-3">
                    <label for="pekerjaan_pelapor" class="form-label">Pekerjaan Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="pekerjaan_pelapor" id="pekerjaan_pelapor" class="form-control" value="{{ old('pekerjaan_pelapor', $surat->pekerjaan_pelapor) }}" required>
                </div>

                <!-- Alamat Pelapor -->
                <div class="mb-3">
                    <label for="alamat_pelapor" class="form-label">Alamat Pelapor <span class="text-danger">*</span></label>
                    <input type="text" name="alamat_pelapor" id="alamat_pelapor" class="form-control" value="{{ old('alamat_pelapor', $surat->alamat_pelapor) }}" required>
                </div>

                <!-- Alasan Tidak Bisa Melampirkan KTP -->
                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan Tidak Bisa Melampirkan KTP <span class="text-danger">*</span></label>
                    <input type="text" name="alasan" id="alasan" class="form-control" value="{{ old('alasan', $surat->alasan) }}" required>
                </div>

                <!-- NIK Jenazah -->
                <div class="mb-3">
                    <label for="nik_jenazah" class="form-label">NIK Jenazah <span class="text-danger">*</span></label>
                    <input type="text" name="nik_jenazah" id="nik_jenazah" class="form-control" value="{{ old('nik_jenazah', $surat->nik_jenazah) }}" required>
                </div>

                <!-- Nama Jenazah -->
                <div class="mb-3">
                    <label for="nama_jenazah" class="form-label">Nama Jenazah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_jenazah" id="nama_jenazah" class="form-control" value="{{ old('nama_jenazah', $surat->nama_jenazah) }}" required>
                </div>

                <!-- Tanggal Lahir Jenazah -->
                <div class="mb-3">
                    <label for="tanggal_lahir_jenazah" class="form-label">Tanggal Lahir Jenazah <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_lahir_jenazah" id="tanggal_lahir_jenazah" class="form-control" value="{{ old('tanggal_lahir_jenazah', $surat->tanggal_lahir_jenazah) }}" required>
                </div>

                <!-- Jenis Kelamin Jenazah -->
                <div class="mb-3">
                    <label for="jenis_kelamin_jenazah" class="form-label">Jenis Kelamin Jenazah <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin_jenazah" id="jenis_kelamin_jenazah" class="form-control" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin_jenazah', $surat->jenis_kelamin_jenazah) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin_jenazah', $surat->jenis_kelamin_jenazah) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Alamat Jenazah -->
                <div class="mb-3">
                    <label for="alamat_jenazah" class="form-label">Alamat Jenazah <span class="text-danger">*</span></label>
                    <input type="text" name="alamat_jenazah" id="alamat_jenazah" class="form-control" value="{{ old('alamat_jenazah', $surat->alamat_jenazah) }}" required>
                </div>

                <!-- No WhatsApp -->
                <div class="mb-3">
                    <label for="nowa" class="form-label">No WhatsApp <span class="text-danger">*</span></label>
                    <input type="text" name="nowa" id="nowa" class="form-control" value="{{ old('nowa', $surat->nowa) }}" required>
                </div>

                <!-- Status Surat -->
                <div class="mb-3">
                    <label for="status_surat" class="form-label">Status Surat</label>
                    <select name="status_surat" id="status_surat" class="form-control" required>
                        <option value="Pending" {{ old('status_surat', $surat->status_surat) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Di cek" {{ old('status_surat', $surat->status_surat) == 'Di cek' ? 'selected' : '' }}>Di cek</option>
                        <option value="Di terima" {{ old('status_surat', $surat->status_surat) == 'Di terima' ? 'selected' : '' }}>Di terima</option>
                        <option value="Ditolak" {{ old('status_surat', $surat->status_surat) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <!-- Status Verifikasi -->
                <div class="mb-3">
                    <label for="status_verif" class="form-label">Status Verifikasi</label>
                    <select name="status_verif" id="status_verif" class="form-control" required>
                        <option value="Belum Verifikasi" {{ old('status_verif', $surat->status_verif) == 'Belum Verifikasi' ? 'selected' : '' }}>Belum Verifikasi</option>
                        <option value="Terverifikasi" {{ old('status_verif', $surat->status_verif) == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('surat/suratmasuk') }}" class="btn btn-danger">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
