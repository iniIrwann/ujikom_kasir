@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="d-flex justify-content-start mt-3">
                                <h6>Detail Transaksi </h6>
                                <a href="{{ route('laporan') }}" target="_blank" class="btn btn-secondary btn-sm ms-11 me-0">Back</a>
                                      <!-- Tombol Cetak Detail -->
                                @if($transaksi->isNotEmpty())
                                <a href="{{ route('cetak.detail', $transaksi->first()->transaksi_id) }}" target="_blank" class="btn btn-success btn-sm ms-auto">Cetak Detail Laporan</a>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Produk</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            invoice</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Sub Total</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $index => $item)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $item->product->nama_produk ?? 'Tidak ada data'}}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $item->transaksi->kode ?? 'Tidak ada data'}}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->sub_total_per_item }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->jumlah }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <p class="text-xs font-weight-bold mb-0"><a href="{{ route('cetak.detail', $item->transaksi_id) }}" target="_blank" class="btn btn-success btn-sm ms-auto">Cetak Detail Laporan</a>
                                                </p> --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-2">
                                <!-- Pagination control -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Judul Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Konten Modal -->
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
                                    {{-- @foreach ($semuaProduk as $item) --}}
                                        {{-- <tr>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ $loop->iteration }}
                                                </p>
                                            </td> --}}
                                            {{-- <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ $item->product->nama_produk }}</p> --}}
                                            {{-- </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ $item->product->merk }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ $item->product->kategori }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ number_format($item->product->harga, 2, '.', ',') }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ $item->jumlah }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{-- {{ number_format($item->product->harga * $item->jumlah, 2, '.', ',') }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <button class="btn btn-danger"
                                                    {{-- wire:click='hapusProduk({{ $item->id }})'>Action</button>
                                            </td> --}}
                                        {{-- </tr> --}}
                                    {{-- @endforeach --}}
                            {{-- </table> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <div class="modal-footer"> --}}
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                        {{-- <button type="button" class="btn btn-primary" onclick="submitData()">Simpan</button> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}

    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    "paging": false // Menonaktifkan pagination default DataTables
                });
            });
        </script>
    @endpush

@endsection
