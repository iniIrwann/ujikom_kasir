@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Form Tambah Data</p>
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Pengguna</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ old('name', $user->name) }}"
                                            placeholder="Masukan Nama ">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control" type="email" value="{{ old('email', $user->email) }}"
                                            name="email" placeholder="Masukan Email">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Role</label>
                                        <select class="form-control" name="role">
                                            <option value="" class="text-secondary text-xxs font-weight-bolder opacity-7">Pilih Kategori</option>
                                            <option value="administator"
                                                    class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                    {{ old('role', $user->role) == 'administator' ? 'selected' : '' }}>
                                                Administrator
                                            </option>
                                            <option value="petugas"
                                                    class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                    {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                                                Petugas
                                            </option>
                                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                        </select>
                                        @error('role')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                                        <input class="form-control" type="password" name="password" placeholder="Masukkan Password Baru">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" onclick="window.location='{{ route('user.cancel') }}'"
                                        class="btn btn-secondary btn-sm me-2">Cancel</button>
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
    <script>
        var notyf = new Notyf(); // Inisialisasi Notyf

        @if ($message = Session::get('failed'))
            notyf.error('{{ $message }}');
        @endif

        @if ($message = Session::get('success'))
            notyf.success('{{ $message }}');
        @endif
    </script>
@endsection

