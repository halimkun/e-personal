<x-app-layout>
    <x-slot name="title">Berkas Karyawan | E-PERSONAL RSIA Aisyiyah Pekajangan</x-slot>

    <div class="row">
        <div class="col-12">
            <x-card-content title="Pilih Karyawan">
                <x-slot name="action">
                    <x-modal-trigger class="btn btn-sm btn-success" id="upload-berkas" target="modal-upload-berkas">
                        <i class="ti ti-plus"></i>
                    </x-modal-trigger>
                </x-slot>
                
                <table class="table" id="main-table">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>BIDANG</th>
                            <th>JABATAN</th>
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


    <x-modal name="modal-upload-berkas" title="Upload Berkas" size="xl">
        <table class="table" id="table-on-upload">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>BIDANG</th>
                    <th>JABATAN</th>
                    <th>DEPARTEMEN</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <form action="{{ env('API_URL') . 'pegawai/upload/berkas' }}" id="form-upload-berkas" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="nik" required>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kategori-berkas" class="form-label">Kategori Berkas</label>
                        <select name="kategori-berkas" id="kategori-berkas" class="form-select" required></select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="berkas" class="form-label">Berkas</label>
                        <select name="berkas" id="berkas" class="form-select" required></select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="file_berkas" class="form-label">Pilih Berkas</label>
                        <input type="file" name="file_berkas" class="form-control" id="file_berkas" required>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end" style="gap: 10px;">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary">Upload</button>
            </div>
        </form>
    </x-modal>

    <x-modal name="modal-delete-berkas" title="Hapus Berkas">
        <form action="{{ env('API_URL') . 'pegawai/delete/berkas' }}" method="post" id="form-delete-berkas">
            <p>Apakah anda yakin akan menghapus berkas dengan detail sebagai berikut  ? </p>
            <table class="table table-hover table-compact">
                <tr>
                    <th class="text-nowrap">NIK</th>
                    <td><span id="nik_karyawan"></span></td>
                </tr>
                <tr>
                    <th class="text-nowrap">NAMA KARYAWAN</th>
                    <td><span id="nm_karyawan"></span></td>
                </tr>
                <tr>
                    <th class="text-nowrap">NAMA BERKAS</th>
                    <td><span id="nm_berkas"></span></td>
                </tr>
            </table>

            <input type="hidden" name="nik" id="nik"> <input type="hidden" name="kode" id="kode"> <input type="hidden" name="berkas" id="berkas">

            <div class="d-flex justify-content-end" style="gap: 10px;">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </div>
        </form>
    </x-modal>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.3.0/css/scroller.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    <style>
        tbody tr {
            cursor: pointer;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.3.0/js/dataTables.scroller.min.js"></script>
    <script>
        // get nik from url
        var dnik = new URLSearchParams(window.location.search).get('nik');
        let dname = '';
        
        $(document).ready(function () {
            $("select").select2({
                theme: "bootstrap-5",
            });

            $('#main-table').DataTable({
                processing: true,
                serverSide: true,
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
                    url: API_URL + "pegawai?datatables=1&select=nik,nama,bidang,jbtn",
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
                    { data: 'bidang', name: 'bidang' },
                    { data: 'jbtn', name: 'jbtn' },
                    { data: 'dpt.nama', name: 'dpt.nama' }
                ]
            });

            // main table on search remove params on url
            $('#main-table_filter input[type="search"]').on('keyup', function () {
                const params = new URLSearchParams(window.location.search);
                params.delete('nik');
                window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
            });

            if (dnik) {
                const table = $('#main-table').DataTable();
                table.search(dnik).draw();
            }
            
            // tr on click radio button checked
            $('#main-table tbody').on('click', 'tr', function () {
                $(this).find('input[type="radio"]').prop('checked', true);
                
                // nm_karyawan
                const nm_karyawan = $(this).find('td:nth-child(2)').text();
                const nik_karyawan = $(this).find('div').data('nik');

                $('#nm_karyawan').text(nm_karyawan);
                $('#nik_karyawan').text(nik_karyawan);

                dname = nm_karyawan;

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
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: xhr.responseJSON.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                });
            }

            function templateListBerkasKaryawan(berkas) {
                let listBerkas = "";
                $.each(berkas, function (index, item) {
                    listBerkas += ` <a href="#modal-view-berkas" data-bs-toggle="modal" role="button" class="list-group-item list-group-item-action py-3" aria-current="true" data-nik="${item.nik}" data-kode="${item.kode_berkas}" data-berkas="${item.berkas}" data-nm-berkas="${item.master_berkas_pegawai.nama_berkas}">
                        <div class="d-flex flex-column-reverse flex-md-row w-100 justify-content-between align-items-start align-items-md-center" style="gap: 10px;">
                            <h5 class="mb-1">${item.master_berkas_pegawai.nama_berkas}</h5>
                            <small>${formatDate(item.tgl_uploud)}</small>
                        </div>
                        <div class="d-flex flex-row w-100 justify-content-between align-items-end mt-3" style="gap: 10px;">
                            <div>
                                <p class="m-0 p-0">${item.nik}</p>
                                <small>${item.master_berkas_pegawai.kategori}</small>    
                            </div>
                            <x-modal-trigger class="btn btn-sm btn-danger" id="btn-delete-berkas" target="modal-delete-berkas" data-nik="${item.nik}" data-kode="${item.kode_berkas}" data-berkas="${item.berkas}" data-nm-berkas="${item.master_berkas_pegawai.nama_berkas}">
                                <x-t-icon icon="trash" />
                            </x-modal-trigger>
                        </div>
                    </a>
                    `.replace(':kode', item.kode_berkas).replace(':nik', item.nik);
                });

                return listBerkas;
            }

            // on modal-view-berkas show
            $('#modal-view-berkas').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const berkas = button.data('berkas');
                console.log(berkas);
                console.log(API_BERKAS_URL + berkas);

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
                            showConfirmButton: false,
                            timer: 1500,
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
            
            // upload-berkas on click check dnik and dnama, if not set or '' then alert
            $('#upload-berkas').on('click', function () {
                $('#modal-upload-berkas #table-on-upload').DataTable({
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
                    scrollY: 150,
                    
                    ajax: {
                        url: API_URL + "pegawai?datatables=1&select=nik,nama,bidang,jbtn",
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
                        { data: 'bidang', name: 'bidang' },
                        { data: 'jbtn', name: 'jbtn' },
                        { data: 'dpt.nama', name: 'dpt.nama' }
                    ]
                });
            });

            // modal-upload-berkas on hide destroy datatable
            $('#modal-upload-berkas').on('hide.bs.modal', function () {
                $('#modal-upload-berkas #table-on-upload').DataTable().destroy();
                $('#modal-upload-berkas form')[0].reset();
            });

            $('#modal-upload-berkas #table-on-upload').on('click', 'tr', function () {
                $(this).find('input[type="radio"]').prop('checked', true);
                
                const nik = $(this).find('div').data('nik');
                $('#modal-upload-berkas input[name="nik"]').val(nik); 
            });

            $.ajax({
                url: API_URL + "pegawai/berkas/kategori",
                method: "GET",
                headers: headers,
                success: function (result) {
                    const kategori = result.data;
                    let optionKategori = `<option value="">Pilih Kategori</option>`;
                    $.each(kategori, function (index, item) {
                        optionKategori += `<option value="${item.kategori}">${item.kategori}</option>`;
                    });

                    $('#kategori-berkas').html(optionKategori);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: xhr.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
            });

            // kategori-berkas on change ajax get berkas/nama-berkas
            $('#kategori-berkas').on('change', function () {
                const kategori = $(this).val();
                $.ajax({
                    url: API_URL + "pegawai/berkas/nama-berkas?kategori=" + kategori,
                    method: "GET",
                    headers: headers,
                    success: function (result) {
                        const berkas = result.data;
                        let optionBerkas = `<option value="">Pilih Berkas</option>`;
                        $.each(berkas, function (index, item) {
                            optionBerkas += `<option value="${item.kode}">${item.nama}</option>`;
                        });

                        $('#berkas').html(optionBerkas);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: xhr.responseJSON.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                });
            });

            $('#form-upload-berkas').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                const lh =  {
                    "Authorization": "Bearer {{ session('token')  }}",
                };

                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    headers: lh,
                    contentType: false,
                    processData: false,
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
                    success: function(result) {
                        if (result.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: result.message,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                                window.location.href = "{{ route('berkas_karyawan.index', ['nik' => ':nik']) }}".replace('%3Anik', result.data.nik);
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: result.message,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                                window.location.href = "{{ route('berkas_karyawan.index', ['nik' => ':nik']) }}".replace('%3Anik', result.data.nik);
                            });
                        }
                    },

                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: xhr.responseJSON.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        console.log(xhr);
                    }
                });
            });

            // modal-delete-berkas on show
            $('#modal-delete-berkas').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                
                let nik = button.data('nik');
                let kode = button.data('kode');
                let berkas = button.data('berkas');
                let nm_berkas = button.data('nm-berkas');
                let nm_karyawan = dname;

                $('#modal-delete-berkas #nik_karyawan').text(nik);
                $('#modal-delete-berkas #nm_karyawan').text(nm_karyawan);
                $('#modal-delete-berkas #nm_berkas').text(nm_berkas);

                // set input hidden
                $('#modal-delete-berkas input[name="nik"]').val(nik);
                $('#modal-delete-berkas input[name="kode"]').val(kode);
                $('#modal-delete-berkas input[name="berkas"]').val(berkas);
            });

            // modal-delete-berkas on close
            $('#modal-delete-berkas').on('hide.bs.modal', function () {
                $('#modal-delete-berkas input[name="nik"]').val('');
                $('#modal-delete-berkas input[name="kode"]').val('');
                $('#modal-delete-berkas input[name="berkas"]').val('');

                // reset form
                $('#modal-delete-berkas form')[0].reset();
            });

            // modal-delete-berkas form on submit
            $("#form-delete-berkas").on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                const lh =  {
                    "Authorization": "Bearer {{ session('token')  }}",
                };

                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    headers: lh,
                    contentType: false,
                    processData: false,
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
                    success: function(result) {
                        if (result.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: result.message,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                                window.location.href = "{{ route('berkas_karyawan.index', ['nik' => ':nik']) }}".replace('%3Anik', result.data.nik);
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: result.message,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                                window.location.href = "{{ route('berkas_karyawan.index', ['nik' => ':nik']) }}".replace('%3Anik', result.data.nik);
                            });
                        }
                    },

                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: xhr.responseJSON.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        console.log(xhr);
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>