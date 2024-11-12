@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Form Tambah Data</p>
                        <form method="POST" action="{{ route('product.update', $product->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama Produk</label>
                                        <input class="form-control" type="text" name="nama_produk"
                                            value="{{ old('nama_produk', $product->nama_produk) }}"
                                            placeholder="Masukan Nama Produk">
                                    </div>
                                </div>
                                @error('nama_produk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Merk</label>
                                        <input class="form-control" type="text" value="{{ old('merk', $product->merk) }}"
                                            name="merk" placeholder="Masukan Merk">
                                    </div>
                                </div>
                                @error('merk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Kategori</label>
                                        <select class="form-control" name="kategori">
                                            <option value=""
                                                class="text-secondary text-xxs font-weight-bolder opacity-7">Pilih Kategori
                                            </option>
                                            <option value="Topi"
                                                class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                {{ old('kategori', $product->kategori) == 'Topi' ? 'selected' : '' }}>Topi
                                            </option>
                                            <option value="Aksesoris"
                                                class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                {{ old('kategori', $product->kategori) == 'Aksesoris' ? 'selected' : '' }}>
                                                Aksesoris</option>
                                            <option value="Outerwear"
                                                class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                {{ old('kategori', $product->kategori) == 'Outerwear' ? 'selected' : '' }}>
                                                Outerwear</option>
                                            <option value="Tas"
                                                class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                {{ old('kategori', $product->kategori) == 'Tas' ? 'selected' : '' }}>Tas
                                            </option>
                                            <option value="Baju"
                                                class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                {{ old('kategori', $product->kategori) == 'Baju' ? 'selected' : '' }}>Baju
                                            </option>
                                            <option value="Celana"
                                                class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                {{ old('kategori', $product->kategori) == 'Celana' ? 'selected' : '' }}>
                                                Celana</option>
                                            <option value="Sepatu"
                                                class="text-secondary text-xxs font-weight-bolder opacity-7"
                                                {{ old('kategori', $product->kategori) == 'Sepatu' ? 'selected' : '' }}>
                                                Sepatu</option>

                                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                        </select>
                                        @error('kategori')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Harga</label>
                                        <input class="form-control" type="number" name="harga"
                                            value="{{ old('harga', $product->harga) }}" placeholder="Masukan Harga">
                                    </div>
                                </div>
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Stok</label>
                                        <input class="form-control" type="number" name="stok"
                                            value="{{ old('stok', $product->stok) }}" placeholder="Masukan Stok">
                                    </div>
                                </div>
                                @error('stok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" onclick="window.location='{{ route('product.cancel') }}'"
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
