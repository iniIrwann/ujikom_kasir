@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Form Tambah Data</p>
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nama User</label>
                                    <input name="name" type="text" class="form-control" placeholder="Name" aria-label="Name" value="{{ old('name') }}">
                                </div>
                            </div>
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Kategori</label>
                                    <select class="form-control" type="text" name="role" value="{{ old('role') }}">
                                        <option value="" class=" text-secondary text-xxs font-weight-bolder opacity-7">Pilih Role</option>
                                        <option value="administator" class=" text-secondary text-xxs font-weight-bolder opacity-7">administator</option>
                                        <option value="petugas" class=" text-secondary text-xxs font-weight-bolder opacity-7">petugas </option>
                                    </select>
                                </div>
                            </div>
                            @error('role')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Masukan Email" required>
                                </div>
                            </div>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Password</label>
                                    <input class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="Masukan Password" required>
                                </div>
                            </div>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('user.index') }}" class="text-white"><button type="button" class="btn btn-secondary btn-sm me-2">Cancel</button></a>
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
