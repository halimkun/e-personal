<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'e-personal | RSIA Aisyiyah Pekajangan' }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/icons/tabler-icons/tabler-icons.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.36.0/tabler-icons.min.css"> --}}

    @stack('styles')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <x-sidebar />

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <x-header-nav />

            <div class="container-fluid">

                <x-flash-message />

                {{ $slot }}

                <x-footer />

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script>
        const API_URL = "{{ env('API_URL') }}";
        const API_IMAGE_URL = "{{ env('API_IMAGE_URL') }}";
        // const API_BERKAS_URL = "{{ env('API_BERKAS_URL')  }}";

        let host = window.location.host;
        if (window.location.host == "192.168.100.31") {
            host = "192.168.100.33";
        }


        const API_BERKAS_URL = window.location.protocol + "//" + host + "/webapps/penggajian";
        
        const headers =  {
            "Authorization": "Bearer {{ session('token')  }}",
            "Accept": "application/json",
            "Content-Type": "application/json",
        };
    </script>

    @stack('scripts')
</body>

</html>