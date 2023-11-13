<x-app-layout>
    <x-slot name="title">Berkas Karyawan | E-PERSONAL RSIA Aisyiyah Pekajangan</x-slot>

    <div class="row">
        <div class="col-12">
            <x-card-content title="Pilih Karyawan">
                <x-slot name="action">
                    <x-modal-trigger class="btn btn-sm btn-success" target="">
                        <i class="ti ti-plus"></i>
                    </x-modal-trigger>
                </x-slot>
                
                <table class="table">
                    <thead>
                        <tr>
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
            <x-card-content title="Berkas Karyawan" id="berkas-list">
                <x-slot name='action'>
                    <div class="d-flex flex-column align-items-end">
                        <span id="nm_karyawan" class="fw-bold"></span>
                        <span id="nik_karyawan" class="fw-bold"></span>
                    </div>
                </x-slot>

                <div class="list-group list-group-flush mt-4" id="list-berkas"></div>
            </x-card-content>
        </div>
    </div>

    <x-modal name="modal-view-berkas" title="Preview Berkas" size="xl">
        <div class="embed-responsive">
            <iframe src="" class="embed-responsive-item" style="width: 100%; height: 75vh;"></iframe>
        </div>
    </x-modal>


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
        var dnik = '{{ $dnik }}';
        var dkode = '{{ $dkode ?? '' }}';
        
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
                            return `<div class="form-check" data-nik="${data}">
                                <input class="form-check-input" type="radio" name="radio-nik" id="${data}1">
                                <label class="form-check-label" for="${data}1">
                                    ${data}
                                </label>
                            </div>`;
                        }
                    },
                    { data: 'nama', name: 'nama' },
                    { data: 'dpt.nama', name: 'dpt.nama' }
                ]
            });

            if (dnik) {
                const table = $('.table').DataTable();
                table.search(dnik).draw();
                // add action on table search result
                table.on('draw', function () {
                    const tr = $(`tr:contains(${dnik})`);
                    tr.find('input[type="radio"]').prop('checked', true);
                    
                    // nm_karyawan
                    const nm_karyawan = tr.find('td:nth-child(2)').text();
                    const nik_karyawan = tr.find('div').data('nik');

                    $('#nm_karyawan').text(nm_karyawan);
                    $('#nik_karyawan').text(nik_karyawan);

                    getBerkasPegawai(nik_karyawan);
                });
            }

            // tr on click radio button checked
            $('.table tbody').on('click', 'tr', function () {
                $(this).find('input[type="radio"]').prop('checked', true);
                
                // nm_karyawan
                const nm_karyawan = $(this).find('td:nth-child(2)').text();
                const nik_karyawan = $(this).find('div').data('nik');
                console.log(nm_karyawan, nik_karyawan);

                $('#nm_karyawan').text(nm_karyawan);
                $('#nik_karyawan').text(nik_karyawan);

                $('#list-berkas').html('');
                getBerkasPegawai(nik_karyawan);
            });

            function getBerkasPegawai(nik) {
                $.ajax({
                    url: API_URL + "pegawai/get/berkas?nik=" + nik,
                    method: "POST",
                    headers: headers,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Loading...",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function (result) {
                        const berkas = result.data;
                        
                        if (berkas.length > 0) {
                            const listBerkas = templateListBerkasKaryawan(berkas);
                            $('#list-berkas').html('');
                            $('#list-berkas').html(listBerkas);

                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: result.message,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(() => {
                                $('html, body').animate({
                                    scrollTop: $("#berkas-list").offset().top - 70
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Oops...",
                                text: "Berkas tidak ditemukan atau belum ada berkas",
                            });
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: xhr.responseJSON.message,
                        });
                    },
                });
            }

            function templateListBerkasKaryawan(berkas) {
                let listBerkas = "";
                $.each(berkas, function (index, item) {
                    listBerkas += ` <a href="#modal-view-berkas" data-bs-toggle="modal" role="button" class="list-group-item list-group-item-action py-3" aria-current="true" data-nik="${item.nik}" data-kode="${item.kode_berkas}" data-berkas="${item.berkas}">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${item.master_berkas_pegawai.nama_berkas}</h5>
                            <small>${formatDate(item.tgl_uploud)}</small>
                        </div>
                        <p class="mb-1">${item.nik}</p>
                        <small>${item.master_berkas_pegawai.kategori}</small>
                    </a>
                    `.replace(':kode', item.kode_berkas).replace(':nik', item.nik);
                });

                return listBerkas;
            }

            // on modal-view-berkas show
            $('#modal-view-berkas').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const berkas = button.data('berkas');

                $('iframe').attr('src', API_BERKAS_URL + berkas);
            });

            function getSpesifikBerkasPegawai(nik, kode) {
                $.ajax({
                    url: API_URL + "pegawai/get/berkas?nik=" + nik + "&kode=" + kode,
                    method: "POST",
                    headers: headers,
                    beforeSend: function() {
                        Swal.fire({
                            title: "Loading...",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function (result) {
                        console.log(result);
                        const berkas = result.data;
                        $('iframe').attr('src', API_BERKAS_URL + berkas.berkas);
                        
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: result.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: xhr.responseJSON.message,
                        });
                    },
                });
            }

            // format date
            function formatDate(date) {
                const d = new Date(date);
                const year = d.getFullYear();
                const month = new Intl.DateTimeFormat('en-US', { month: 'long' }).format(d);
                const day = new Intl.DateTimeFormat('en-US', { day: '2-digit' }).format(d);

                return `${day} ${month} ${year}`;
            }
        });
    </script>
    @endpush
</x-app-layout>