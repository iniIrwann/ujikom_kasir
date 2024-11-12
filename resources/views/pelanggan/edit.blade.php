@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Form Edit Data</p>
                        <form method="POST" action="{{ route('pelanggan.update', $pelanggan->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kode Pelanggan</label>
                                        <input class="form-control" type="text" name="KodePelanggan"
                                            value="{{ old('KodePelanggan', $pelanggan->KodePelanggan) }}"
                                            placeholder="Masukan Nama ">
                                    </div>
                                </div>
                                @error('KodePelanggan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Pelanggan</label>
                                        <input class="form-control" type="text" name="NamaPelanggan"
                                            value="{{ old('NamaPelanggan', $pelanggan->NamaPelanggan) }}"
                                            placeholder="Masukan Nama ">
                                    </div>
                                </div>
                                @error('NamaPelanggan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Alamat</label>
                                        <input class="form-control" type="text" value="{{ old('Alamat', $pelanggan->Alamat) }}"
                                            name="Alamat" placeholder="Masukan Alamat">
                                    </div>
                                </div>
                                @error('Alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                                        <input class="form-control" type="text" value="{{ old('NomorTelepon', $pelanggan->NomorTelepon) }}"
                                            name="NomorTelepon" placeholder="Masukan Nomor Telepon">
                                    </div>
                                </div>
                                @error('NomorTelepon')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" onclick="window.location='{{ route('pelanggan.cancel') }}'"
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
    @if ($message = Session::get('failed'))
        {
        <script>
            notyf.error('{{ $message }}');
        </script>
        }
    @endif
    @if ($message = Session::get('success'))
        <script>
            notyf.success('{{ $message }}');
        </script>
    @endif
@endsection
