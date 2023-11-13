<x-app-layout>
    <x-slot name="title">List Karyawan | E-PERSONAL RSIA Aisyiyah Pekajangan</x-slot>

    <div class="row">
        <div class="col-12">
            <x-card-content title="List Karyawan">
                <x-slot name="action">
                    <a href="{{ route('karyawan.new') }}" class="btn btn-sm btn-success">
                        <i class="ti ti-plus"></i>
                    </a>
                </x-slot>
                <table class="table table-compact table-hover" id="tblKaryawan">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Unit Kerja</th>
                            <th><x-t-icon icon="ti-user-cog" /></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </x-card>
        </div>
    </div>
    
    <x-modal name="modalDelete" title="Hapus Karyawan">
        <div class="mb-3">
            <p class="mb-1">Apakah anda yakin akan menghapus data karwayan atas </p>
            <table class="table">
                <tr>
                    <td width="50">Nama</td>
                    <td width="10">:</td>
                    <td><span id="namaKaryawan"></span></td>
                </tr>
                <tr>
                    <td width="50">NIK</td>
                    <td width="10">:</td>
                    <td><span id="nikKaryawan"></span></td>
                </tr>
            </table>
        </div>

        <x-alert type="danger" :dismissable="false">
            <small>mohon untuk berhati-hati dalam menghapus data karyawan, karena data yang telah dihapus tidak dapat dikembalikan lagi.</small>
        </x-alert>
        <form action="{{ route('karyawan.delete') }}" method="post" id="formDelete" class="mt-4 d-flex justify-content-end">
            @csrf
            @method("DELETE")
            <input type="hidden" name="nik" id="nik" />
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </x-modal>



    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#tblKaryawan").DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    responsive: true,
                    paginationType: "simple",
                    ajax: {
                        url: API_URL + "pegawai?datatables=1",
                        type: "GET",
                        dataType: "json",
                        headers: headers,
                    },
                    columns: [
                        { 
                            data: "nama",
                            name: "nama"
                        },
                        { 
                            data: "nik",
                            name: "nik"
                        },
                        { 
                            data: "jk",
                            name: "jk"
                        },
                        { 
                            data: "dpt.nama",
                            name: "dpt.nama" 
                        },
                        {
                            data: 'nik',
                            render: function(data, type, row) {
                                return `
                                    <a href="{{ route('karyawan.edit', ':id') }}" class="btn btn-sm btn-warning">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <x-modal-trigger class="btn btn-sm btn-danger" target="modalDelete" data-id="${row.nik}" onclick="$('#namaKaryawan').text('${row.nama}'); $('#nikKaryawan').text('${row.nik}'); $('#nik').val('${row.nik}');">
                                        <i class="ti ti-trash"></i>
                                    </x-modal-trigger>
                                `.replace(/:id/g, row.nik);
                            }
                        }
                    ],
                });
            });
        </script>
    @endpush
</x-app-layout>