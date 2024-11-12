@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="d-flex justify-content-start mt-3">
                                <h6>Tabel Penjualan (<span class="opacity-7">Transaksi</span>)</h6>
                                <a href="{{ url('/cetak') }}" target="_blank" class="btn btn-success btn-sm ms-auto">Cetak
                                    Laporan</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="example" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tanggal</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Pembeli</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No Invoice</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Harga</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Uang Bayar</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kembalian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($semuaTransaksi as $transaksi)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $transaksi->created_at }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $transaksi->pelanggan->NamaPelanggan }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $transaksi->kode }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">Rp.
                                                    {{ number_format($transaksi->total_harga, 2, '.', ',') }}<span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Rp.
                                                    {{ number_format($transaksi->bayar, 2, '.', ',') }}</span>
                                            </td>
                                            <td class="align-middle text-center align-item-center">
                                                <a href="{{ route('laporan.detail', $transaksi->id) }}"
                                                    class="btn btn-sm btn-info mb-0 me-3 text-white font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">detail</a>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div class="alert alert-danger" style="color: #eee;">Data Laporan belum
                                                    Tersedia.</div>
                                            </td>
                                        </tr>
                                    @endforelse
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

    @push('styles')
        <style>
            .pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                list-style: none;
                padding-left: 0;
                margin: 20px 0;
            }

            .pagination li {
                margin: 0 5px;
            }

            .pagination li a,
            .pagination li span {
                color: #007bff;
                padding: 8px 12px;
                text-decoration: none;
                border: 1px solid #ddd;
                border-radius: 4px;
                transition: background-color 0.3s ease;
            }

            .pagination li a:hover {
                background-color: #f0f0f0;
            }

            .pagination li.active span {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
            }

            .pagination li.disabled span {
                color: #999;
                cursor: not-allowed;
            }

            table.dataTable tbody tr:hover {
                background-color: #e0e0e0;
            }

            .dataTables_info {
                display: none;
            }
        </style>
    @endpush
@endsection
