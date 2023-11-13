<x-app-layout>
    <x-slot name="title">Edit Karyawan | E-PERSONAL RSIA Aisyiyah Pekajangan</x-slot>


    <form action="{{ route($action) }}" method="POST" data-act="{{ $action }}">
        @csrf

        <input type="hidden" name="data" id="lsdt" class="form-control">

        <x-card-content title="Data Pribadi">
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <label for="nik" class="form-label">NIP</label>
                    <input type="text" name="nik" id="nik" class="form-control">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-select">
                        <option value="-">-</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control">
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select name="agama" id="agama" class="form-select">
                        <option value="-">-</option>
                        <option value="ISLAM">ISLAM</option>
                        <option value="KRISTEN">KRISTEN</option>
                        <option value="KATHOLIK">KATHOLIK</option>
                        <option value="HINDU">HINDU</option>
                        <option value="BUDHA">BUDHA</option>
                        <option value="KONGHUCU">KONGHUCU</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label for="pendidikan" class="form-label">Pendidikan</label>
                    <select name="pendidikan" id="pendidikan" class="form-select"></select>
                </div>
                <div class="col-md-3 col-12 mb-3">
                    <label for="stts_nikah" class="form-label">Status Menikah</label>
                    <select name="stts_nikah" id="stts_nikah" class="form-select">
                        <option value="-">-</option>
                        <option value="SINGLE">Single</option>
                        <option value="MENIKAH">Menikah</option>
                        <option value="JANDA">Janda</option>
                        <option value="DUDHA">Duda</option>
                    </select>
                </div>
                <div class="col-md-2 col-12 mb-3">
                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                    <select name="gol_darah" id="gol_darah" class="form-select">
                        <option value="-">-</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
                <div class="col-md-8 col-12 mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control">
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" name="kota" id="kota" class="form-control">
                </div>

                <div class="col-md-4 col-12 mb-3">
                    <label for="no_telp" class="form-label">No. Telp</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control">
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label for="no_ktp" class="form-label">No. KTP</label>
                    <input type="text" name="no_ktp" id="no_ktp" class="form-control">
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label for="npwp" class="form-label">NPWP</label>
                    <input type="text" name="npwp" id="npwp" class="form-control">
                </div>
            </div>
        </x-card-content>

        <div class="row">
            @if ($action =="karyawan.update")
            <div class="col-12 col-md-3">
                <x-card-content title="Foto" class="position-sticky" style="top: 85px;">
                    <input type="hidden" id="photo" name="photo" class="photo">
                    <img alt="default" class="img-fluid foto-now">
                    
                    <div class="mt-4">
                        <x-modal-trigger target="modal-photo" class="w-100">
                            <i class="fas fa-camera"></i> Upload Foto
                        </x-modal-trigger>
                    </div>
                </x-card-content>
            </div>
            @endif
            <div class="col-12 @if ($action == "karyawan.update") col-md-9 @endif">
                <x-card-content title="Data Departement">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <label for="jbtn" class="form-label">Jabatan</label>
                            <input type="text" name="jbtn" id="jbtn" class="form-control">
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="departemen" class="form-label">Departemen</label>
                            <select name="departemen" id="departemen" class="form-select">
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="dep_id" class="form-label">Departemen JM</label>
                            <select name="dep_id" id="dep_id" class="form-select">
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <select name="bidang" id="bidang" class="form-select">
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="mulai_kerja" class="form-label">Mulai Kerja</label>
                            <input type="date" name="mulai_kerja" id="mulai_kerja" class="form-control">
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="ms_kerja" class="form-label">Masa Kerja</label>
                            <select name="ms_kerja" id="ms_kerja" class="form-select">
                                <option value="<1">&lt;1</option>
                                <option value="PT">PT</option>
                                <option value="FT>1">FT>1</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="mulai_kontrak" class="form-label">Mulai Kontrak</label>
                            <input type="date" name="mulai_kontrak" id="mulai_kontrak" class="form-control">
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="kd_jbtn" class="form-label">Jabatan</label>
                            <select name="kd_jbtn" id="kd_jbtn" class="form-select">
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label for="stts_aktif" class="form-label">Status Karyawan</label>
                            <select name="stts_aktif" id="stts_aktif" class="form-select">
                                <option value="AKTIF">AKTIF</option>
                                <option value="CUTI">CUTI</option>
                                <option value="KELUAR">KELUAR</option>
                                <option value="TENAGA LUAR">TENAGA LUAR</option>
                            </select>
                        </div>
                    </div>
                </x-card-content>

                <x-card-content title="Data Index Pegawai">
                    <div class="row">
                        <div class="col-md-4 col-12 mb-3">
                            <label for="jnj_jabatan" class="form-label">Tanggung Jawab</label>
                            <select name="jnj_jabatan" id="jnj_jabatan" class="form-select">
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="stts_kerja" class="form-label">Status Kerja</label>
                            <select name="stts_kerja" id="stts_kerja" class="form-select">
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="kode_resiko" class="form-label">Resiko Kerja</label>
                            <select name="kode_resiko" id="kode_resiko" class="form-select">
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="indexins" class="form-label">Kode Index</label>
                            <select name="indexins" id="indexins" class="form-select">
                            </select>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="bpd" class="form-label">Bank</label>
                            <select name="bpd" id="bpd" class="form-select">
                            </select>
                        </div>
                        <div class="col-md-4 col-12 mb-3">
                            <label for="rekening" class="form-label">Rekening</label>
                            <input type="text" name="rekening" id="rekening" class="form-control">
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label for="status" class="form-label">Status Data Aktif</label>
                            <select name="status" id="status" class="form-select">
                                <option value="1">AKTIF</option>
                                <option value="0">TIDAK</option>
                            </select>
                        </div>
                    </div>
                </x-card-content>
            </div>
        </div>

        <x-card-content>
            <div class="d-flex justify-content-end" style="gap: 7px;">
                <a href="{{ route('karyawan.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </x-card-content>
    </form>

    <x-modal name="modal-photo" title="Upload Foto Karyawan"> 
        <form action="{{ env('API_URL') . 'pegawai/profile/upload' }}" id="form-upload-profile-karyawan" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($action == "karyawan.update")
            <input type="hidden" name="nik" id="nik-photo" value="{{ $nik }}" />
            @endif
            
            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </x-modal>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("select").select2({
                theme: "bootstrap-5",
            });

            const lh =  {
                "Authorization": "Bearer {{ session('token')  }}",
            };

            // form-upload-profile-karyawan on submit 
            $("#form-upload-profile-karyawan").on("submit", function(e) {
                e.preventDefault();

                var formData = new FormData(this);
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
                                window.location.reload();
                            });
                        } else {
                            // show swal error
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: result.message,
                                showConfirmButton: false,
                                timer: 1500,
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    },

                    error: function(xhr, status, error) {
                        console.log(xhr);
                    }
                });
            });

            @if ($action == "karyawan.update")
            $.ajax({
                url: API_URL + "pegawai/get/" + "{{ $nik }}",
                type: "GET",
                dataType: "json",
                headers: headers,
                success: function(result) {
                    setInputValue(result.data);
                },

                error: function(xhr, status, error) {
                    console.log(xhr);
                }
            });
            @endif
        });

        // set select option with ajax
        function setSelectOption(selector, url, text, value, method = "GET") {
            $.ajax({
                url: API_URL + url,
                type: method,
                dataType: "json",
                headers: headers,
                success: function(result) {
                    // console.log(result);
                    let html = "";
                    result.data.forEach(function(item) {
                        if (Array.isArray(text)) {
                            let textValue = "";
                            text.forEach(function(t) {
                                textValue += item[t] + " ";
                            });
                            html += `<option value="${item[value]}">${textValue}</option>`;
                        } else {
                            html += `<option value="${item[value]}">${item[text]}</option>`;
                        }
                    });
                    $(selector).html(html);
                },

                error: function(xhr, status, error) {
                    console.log(xhr);
                }
            });
        }
        
        @if ($action == "karyawan.update")
        function setInputValue(data) {
            var rsia_departemen_jm = data.rsia_departemen_jm;
            var petugas = data.petugas;

            delete data.rsia_departemen_jm;
            delete data.petugas;

            var pegawai = data;

            // petugas loop
            $.each(petugas, function(key, value) {
                $('#' + key).val(value).trigger('change');
            });

            // pegawai loop
            $.each(pegawai, function(key, value) {
                $('#' + key).val(value).trigger('change');
            });


            $("#lsdt").val(pegawai.id);
            
            if (pegawai.photo && pegawai.photo != "-") {
                $('.foto-now').attr('src', API_IMAGE_URL + pegawai.photo);
            } else {
                $('.foto-now').attr('src', 'https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg');
            }

            if (rsia_departemen_jm && rsia_departemen_jm.dep_id) {
                $("#dep_id").val(rsia_departemen_jm.dep_id).trigger('change');
            }
        }
        @endif
        
        function setLdValue(selector, url, value, method = "GET") {
            $.ajax({
                url: API_URL + url,
                type: method,
                dataType: "json",
                headers: headers,
                success: function (result) {
                    if (!result.success) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: result.message,
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(function () {
                            window.location.reload();
                        });
                    }

                    if ($('form').data("act") != "karyawan.update") {
                        $(selector).val(result.data[value]);
                        return;
                    }
                },

                error: function (xhr, status, error) {
                    console.log(xhr);
                }
            });
        }

        setLdValue("#lsdt", "pegawai/get_lsdt", "data");
        setSelectOption("#pendidikan", "pendidikan", "tingkat", "tingkat");
        setSelectOption("#departemen", "departemen", "nama", "dep_id");
        setSelectOption("#dep_id", "departemen", "nama", "dep_id");
        setSelectOption("#bidang", "bidang", "nama", "nama");
        setSelectOption("#kd_jbtn", "jabatan", "nm_jbtn", "kd_jbtn");
        setSelectOption("#jnj_jabatan", "jabatan/jenjang", "nama", "kode");
        setSelectOption("#stts_kerja", "status/kerja", "ktg", "stts");
        setSelectOption("#kode_resiko", "resiko/kerja", "nama_resiko", "kode_resiko");
        setSelectOption("#bpd", "bank/get", "namabank", "namabank");
        setSelectOption("#indexins", "index/get", ["dep_id", "persen"], "dep_id");
    </script>
    @endpush
</x-app-layout>