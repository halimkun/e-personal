<x-app-layout>
    <x-slot name="title">Berkas Karyawan | E-PERSONAL RSIA Aisyiyah Pekajangan</x-slot>

    <div class="row">
        <div class="col-12">
            <x-card-content title="Pilih Karyawan">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>DEPARTEMEN</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </x-card-content>
        </div>

        <div class="col-12">
            <x-card-content title="Berkas Karyawan">
                <x-slot name='action'>
                    <span id="nm_karyawan" class="fw-bold"></span>
                </x-slot>
            </x-card-content>
        </div>
    </div>


    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.3.0/css/scroller.bootstrap5.min.css">

    <style>
        tbody tr {
            cursor: pointer;
        }
    </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/scroller/2.3.0/js/dataTables.scroller.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ordering: false,

                    pagingType: "simple",
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],

                    scrollCollapse: true,
                    scroller: true,
                    scrollY: 250,
                    
                    ajax: {
                        url: API_URL + "pegawai?datatables=1&select=nik,nama",
                        headers: headers,
                    },
                    
                    columns: [
                        {
                            data: 'nik',
                            render: function (data, type, row) {
                                return `<input type="radio" name="nik" value="${data}">`;
                            }
                        },
                        { data: 'nik', name: 'nik' },
                        { data: 'nama', name: 'nama' },
                        { data: 'dpt.nama', name: 'dpt.nama' }
                    ]
                });

                // tr on click radio button checked
                $('.table tbody').on('click', 'tr', function () {
                    $(this).find('input[type="radio"]').prop('checked', true);
                    
                    // nm_karyawan
                    var nm_karyawan = $(this).find('td:nth-child(3)').text();
                    $('#nm_karyawan').text(nm_karyawan);
                });
            });
        </script>
    @endpush
</x-app-layout>