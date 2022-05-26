<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Proposal UKM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="icon" type="image/x-icon" href="{{ asset('') }}" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    </head>
    <body>
        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="{{ asset('assets/mp4/bg.mp4') }}" type="video/mp4" /></video>

        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <h1 class="fst-italic lh-1 mb-4">Fakultas Teknik Universitas Suryakancana</h1>
                    <p>Sistem Unit Kegiatan Mahasiswa</p>
                    <button class="btn btn-success ">
                        <a href="{{ route('login') }}" class="text-white note-style">LOGIN</a></button>
                </div>
            </div>
        </div>

        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <div class="rounded-circle bg-black"><a class="btn btn-dark m-3" href="#!"><img src="{{ asset('img/ethnicLogo.png')}}" class="img-fluid" alt="" srcset=""></a></div>
                <div class="rounded-circle bg-black"><a class="btn btn-dark m-3" href="#!"><img src="{{ asset('img/sinergiLogo.png')}}" class="img-fluid" alt="" srcset=""></a></div>
                <div class="rounded-circle bg-black"><a class="btn btn-dark m-3" href="#!"><img src="{{ asset('img/greatLogo.png')}}" class="img-fluid" alt="" srcset=""></a></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
