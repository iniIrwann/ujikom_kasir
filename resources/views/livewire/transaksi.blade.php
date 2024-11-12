<div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 mb-lg-0 mb-4">
                        <div class="card mt-4">
                            @if ($transaksiAktif)
                                <div>
                                    <input class="form-control" type="text" wire:model.live='nama_produk'
                                        placeholder="Cari Produk...">
                                    <ul class="list-group mt-0">
                                        @if ($produkTerdaftar)
                                            @if (count($produkTerdaftar) === 0)
                                                <!-- Menggunakan count() -->
                                                <li class="list-group-item">Tidak ada produk ditemukan.</li>
                                            @else
                                            @endif
                                            @foreach ($produkTerdaftar as $produk)
                                                <li class="list-group-item h-50">
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $produk->nama_produk }} - Harga: {{ $produk->harga }}
                                                    </p>
                                                    <button class="btn btn-sm btn-primary float-end"
                                                        wire:click="selectProduct({{ $produk->id }})">Tambah</button>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>



                                <div class="table-responsive p-0">
                                    <table id="example" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                    No</th>
                                                <th
                                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nama Produk</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Merk</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Kategori</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Harga</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Qty</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Subtotal</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($semuaProduk as $item)
                                                <tr>
                                                    <td class="align-middle text-center">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $item->product->nama_produk }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $item->product->merk }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $item->product->kategori }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ number_format($item->product->harga, 2, '.', ',') }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $item->jumlah }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ number_format($item->product->harga * $item->jumlah, 2, '.', ',') }}
                                                        </p>
                                                    </td>
                                                    <td class="align-middle text-center"><button class="btn btn-danger"
                                                            wire:click='hapusProduk({{ $item->id }})'>Action</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($transaksiAktif)
                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card mt-4">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="font-weight-bolder mb-0">Invoice : </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-md-0 mb-0">
                                            <div
                                                class="card card-body border mb-0 card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <h7>No Invoice : <span
                                                        class="font-weight-bolder">{{ $transaksiAktif->kode }} </span>
                                                </h7>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <h7>Total Harga : <span
                                                        class="font-weight-bolder">{{ number_format($totalbelanja, 2, '.', ',') }}</span>
                                                </h7>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card mt-4">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="font-weight-bolder mb-0">Invoice : <span
                                                    style="font-weight: 100;">Create New Transaction</span> </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-md-0 mb-0">
                                            <div
                                                class="card card-body border mb-0 card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <h7>No Invoice : <span class="font-weight-bolder"> XXXXXXXXXX </span>
                                                </h7>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <h7>Total Harga : <span class="font-weight-bolder">RP. XXXXXXXX</span>
                                                </h7>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-3 mt-3">
                        <button class="btn {{ !$transaksiAktif ? 'btn-success' : 'btn-danger' }} mt-2 w-100"
                            wire:click="{{ !$transaksiAktif ? 'transaksiBaru' : 'batalTransaksi' }}">
                            {{ !$transaksiAktif ? 'New Transaksi' : 'Cancel Transaksi' }}
                        </button>
                    </div>
                    <div class="col-md-3 mt-3">
                        <button class="btn btn-warning mt-2 w-100" wire:loading>Loading...</button>
                    </div>
                </div>
            </div>
            @if ($transaksiAktif)
                <div class="col-lg-4">
                    <div class="card mt-3">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col d-flex align-items-center">
                                    <h6 class="mb-0">Nama Pembeli <small class="text-danger"> *required</small></h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <div class="d-flex flex-column">
                                <input class="form-control mb-3" type="text" wire:model.live='NamaPelanggan'
                                    placeholder="Cari Pelanggan..." style="width: 100%; max-width: 400px;" required>
                                <ul class="list-group mt-0 mb-3">
                                    @if ($pelangganTerdaftar)
                                        @if (count($pelangganTerdaftar) === 0)
                                            <li class="list-group-item mb-3">Tidak ada pelanggan ditemukan.</li>
                                        @else
                                            @foreach ($pelangganTerdaftar as $pelanggan)
                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                style="padding: 0.5rem 1rem;">
                                                <span class="text-xs font-weight-bold">
                                                    {{ $pelanggan->KodePelanggan }} | {{ $pelanggan->NamaPelanggan }}
                                                </span>
                                                <button class="btn btn-sm btn-primary mb-0"
                                                        wire:click="selectPelanggan({{ $pelanggan->id }})">Pilih</button>
                                            </li>
                                            @endforeach
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body pb-0 pt-3">
                            <div class="row">
                                <div class="col justify-content-between pb-3 d-flex align-items-center">
                                    <h6 class="mb-0">Sub Total</h6>
                                    <div class="d-flex">
                                        <span>Rp.</span>
                                        <span>{{ number_format($subtotalbelanja, 2, '.', ',') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col justify-content-between pb-3 d-flex align-items-center">
                                <h6 class="mb-0">Biaya Admin</h6>
                                <div class="d-flex">
                                    <span>Rp.</span>
                                    <span>{{ number_format($biaya_admin, 2, '.', ',') }}</span>
                                </div>
                            </div>
                            <div class="col justify-content-between pb-3 d-flex align-items-center">
                                <h6 class="mb-0">Discount Member</h6>
                                <div class="d-flex">
                                    <span>Rp.</span>
                                    <span>{{ number_format($discount, 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Bayar</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-3 pt-2">
                            <input type="number" class="form-control" min="0" placeholder="Bayar"
                                wire:model.live='bayar'>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Kembalian</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <div class="d-flex justify-content-between card-text pb-3">
                                <span>Rp.</span>
                                <span>{{ number_format($kembalian, 2, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>
                    @if ($bayar && $subtotalbelanja >= 1 )

                        @if ($kembalian >= 0)
                            <button class="btn btn-success mt-2 w-100" wire:click='selesaiTransaksi'>Payment</button>
                        @else
                            <div class="alert alert-danger mt-2" role="alert">
                                Uang Kurang
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
    <script>
        const notyf = new Notyf();

        @if(session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    </script> --}}
</div>
