<x-app-layout>
    <x-slot name="title">Preview Berkas Karyawan | E-PERSONAL RSIA Aisyiyah Pekajangan</x-slot>

    {{-- iframe --}}
    <div class="embed-responsive">
        <iframe src="" class="embed-responsive-item" style="width: 100%; height: 80vh;"></iframe>
    </div>


    @push('scripts')
    <script>
        $(document).ready(function () {
            getBerkasPegawai('{{ $nik }}', '{{ $kode }}');
        });

        function getBerkasPegawai(nik, kode) {
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
    </script>
    @endpush
</x-app-layout>