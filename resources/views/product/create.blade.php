@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Form Tambah Data</p>
                        <form method="POST" action="{{ route('product.store') }}">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nama Produk</label>
                                    <input class="form-control" type="text" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Masukan Nama Produk">
                                </div>
                            </div>
                            @error('nama_produk')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Merk</label>
                                    <input class="form-control" type="text" value="{{ old('merk') }}" name="merk" placeholder="Masukan Merk">
                                </div>
                            </div>
                            @error('merk')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Kategori</label>
                                    <select class="form-control" type="text" name="kategori" value="{{ old('kategori') }}">
                                        <option value="" class=" text-secondary text-xxs font-weight-bolder opacity-7">Pilih Kategori</option>
                                        <option value="Topi" class=" text-secondary text-xxs font-weight-bolder opacity-7">Topi</option>
                                        <option value="Aksesoris" class=" text-secondary text-xxs font-weight-bolder opacity-7">Aksesoris </option>
                                        <option value="Outerwear" class=" text-secondary text-xxs font-weight-bolder opacity-7">Outerwear</option>
                                        <option value="Tas" class=" text-secondary text-xxs font-weight-bolder opacity-7">Tas</option>
                                        <option value="Baju" class=" text-secondary text-xxs font-weight-bolder opacity-7">Baju</option>
                                        <option value="Celana" class=" text-secondary text-xxs font-weight-bolder opacity-7">Celana</option>
                                        <option value="Sepatu" class=" text-secondary text-xxs font-weight-bolder opacity-7">Sepatu</option>
                                    </select>
                                </div>
                            </div>
                            @error('kategori')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Harga</label>
                                    <input class="form-control" type="number" name="harga" value="{{ old('harga') }}" placeholder="Masukan Harga"min="0" step="0.1" required>
                                </div>
                            </div>
                            @error('harga')
                            <small class="text-danger">Kemahalan bouz</small>
                            @enderror
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Stok</label>
                                    <input class="form-control" type="number" name="stok" value="{{ old('stok') }}" placeholder="Masukan Stok"min="0" required>
                                </div>
                            </div>
                            @error('stok')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('product.index') }}" class="text-white"><button type="button" class="btn btn-secondary btn-sm me-2">Cancel</button></a>
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
