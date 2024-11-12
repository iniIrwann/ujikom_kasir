@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Form Tambah Data</p>
                        <form method="POST" action="{{ route('pelanggan.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kode Pelanggan
                                            <span class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                disarankan diawali KDP... </span>
                                        </label>
                                        <input class="form-control" type="text" name="KodePelanggan"
                                            value="{{ old('KodePelanggan') }}" placeholder="Masukan Kode Pelanggan">
                                            @if (session('error'))
                                        <small class="text-danger">{{ session('error') }}</small>
                                        @endif
                                    </div>
                                </div>
                                @error('KodePelanggan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Pelanggan</label>
                                        <input class="form-control" type="text" name="NamaPelanggan"
                                            value="{{ old('NamaPelanggan') }}" placeholder="Masukan Nama Pelanggan">
                                    </div>
                                </div>
                                @error('NamaPelanggan')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Alamat</label>
                                        <input class="form-control" type="text" name="Alamat"
                                            value="{{ old('Alamat') }}" placeholder="Masukan Alamat">
                                    </div>
                                </div>
                                @error('Alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                                        <input class="form-control" type="text" name="NomorTelepon"
                                            value="{{ old('NomorTelepon') }}" placeholder="Masukan Nomor Telepon">
                                    </div>
                                </div>
                                @error('NomorTelepon')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('pelanggan.index') }}" class="text-white"><button type="button"
                                                class="btn btn-secondary btn-sm me-2">Cancel</button></a>
                                        <button type="submit" class="btn btn-success btn-sm ">Submit</button>
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
