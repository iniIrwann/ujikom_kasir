@extends('layout.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="d-flex justify-content-start mt-3">
                                <h6>Tabel Pelanggan</h6>
                                <a href="{{ route('pelanggan.create') }}" class="btn btn-success btn-sm ms-auto">+ Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="example" class="table align-items-center mb-4">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kode Pelanggan</th>
                                        <th
                                            class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Pelanggan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Alamat</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Telepon</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($Pelanggan as $pelanggans)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $pelanggans->KodePelanggan}}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $pelanggans->NamaPelanggan}}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $pelanggans->Alamat}}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $pelanggans->NomorTelepon}}</p>
                                            </td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3">
                                                        {{-- <a href="{{ route('product.edit', $product->id) }}"
                                                            class="btn btn-sm btn-info mb-0 me-3 text-white font-weight-bold text-xs"
                                                            data-toggle="tooltip" data-original-title="Edit user">Edit</a> --}}
                                                        <a class="btn btn-link text-dark px-3 mb-0"
                                                            href="{{ route('pelanggan.edit', $pelanggans->id) }}"><i
                                                                class="fas fa-pencil-alt text-dark me-2"
                                                                aria-hidden="true"></i>Edit</a>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <form
                                                            onsubmit="return confirm('Apakah Yakin Data ini Akan Dihapus?')"
                                                            action="{{ route('pelanggan.destroy', $pelanggans->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                                <i class="far fa-trash-alt me-2"></i> Hapus
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div class="alert alert-danger">Data pelanggan belum Tersedia.</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-2">
                                {{ $Pelanggan->links() }} <!-- Pagination control -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            table.dataTable tr{
                border-bottom: 1px solid #eee;
                border-top: 1px solid #eee;
            }
            table.dataTable td{
                border-bottom: 1px solid #eee;
                border-top: 1px solid #eee;
            }
            table.dataTable {
                border-bottom: 1px solid #eee;
                /* border-top: 1px solid #eee; */
            }
            .dataTables_filter{
                padding-right: 10px;
            }
        </style>
    @endpush
@endsection
