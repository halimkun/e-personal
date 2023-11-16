<x-app-layout>
    <div class="row">
        <div class="col-12">
            <x-card-content title="Data Surat Internal">
                <table class="table table-hover table-striped" id="table-surat-internal">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Perihal</th>
                            <th>Details</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </x-card-content>
        </div>
    </div>


    <x-modal name="modal-detail-surat" title="Detail Surat" size="lg">
        
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
        $(document).ready(function () {
            console.log(headers);
            $("#table-surat-internal").DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                responsive: true,
                paginationType: "simple",
                ajax: {
                    url: API_URL + "surat/get/by?select=no_surat,perihal,tempat,pj,tanggal,status&datatables=0",
                    type: "GET",
                    dataType: "json",
                    headers: headers,
                },
                createdRow: function (row, data, dataIndex) {
                    $(row).attr("data-surat", JSON.stringify(data));
                },
                columns: [
                    {
                        name: 'no_surat',
                        data: 'no_surat',
                        render: function (data, type, row, meta) {
                            return `<div class="badge bg-dark text-nowrap">${row.no_surat}</div>`;
                        }
                    },
                    {
                        data: "perihal",
                        name: "perihal",
                    },
                    {
                        data: "tanggal",
                        render: function (data, type, row, meta) {
                            return `<table class="table table-sm text-nowrap">
                                <tr>
                                    <th class="p-1 m-1">Tanggal</th>    
                                    <td class="p-1 m-1">${row.tanggal}</td>    
                                </tr>
                                <tr>
                                    <th class="p-1 m-1">Tempat</th>    
                                    <td class="p-1 m-1">${row.tempat}</td>    
                                </tr>
                                <tr>
                                    <th class="p-1 m-1">PJ</th>    
                                    <td class="p-1 m-1">${row.pj_detail.nama}</td>    
                                </tr>
                            </table>`;
                        }
                    },
                    {
                        data: "status",
                        name: "status",
                        render: function (data, type, row, meta) {
                            return `<div class="badge bg-${row.status == 'disetujui' ? 'success' : (row.status == 'ditolak' ? 'danger' : 'warning')} text-nowrap rounded-pill">${row.status}</div>`;
                        }
                    }
                ],
            });

            // columns 0-3 clicked open modal 
            $("#table-surat-internal tbody").on("click", "tr", function () {
                let data = JSON.parse($(this).data("surat"));
                $("#modal-detail-surat").modal("show");
            });
        });
    </script>
    @endpush
</x-app-layout>