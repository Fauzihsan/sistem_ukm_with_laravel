<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Proposal UKM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        {{-- <link rel="icon" type="image/x-icon" href="{{ asset('img/ftLogo.png') }}" /> --}}
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <body>
        <div class="hero">
            <div class="masthead">
                <div class="masthead-content text-white">
                    <div class="container-fluid px-4 px-lg-0">
                        <img class="rounded mx-auto d-block" src="{{ asset('/img/ftLogo.png') }}" alt="" data-aos="fade-in" data-aos-duration="2000" data-aos-delay="200">
                        <h5 class="fst-italic text-center lh-1" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="2000" data-aos-delay="500">Fakultas Teknik Universitas Suryakancana</h5>
                        <p class="text-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="2000" data-aos-delay="800">Sistem Unit Kegiatan Mahasiswa</p>
                        <div data-aos="zoom-out-up" data-aos-duration="2000" data-aos-delay="1000">
                            <button class="btn btn-success rounded mx-auto d-block">
                                <a href="{{ route('login') }}" class="text-white note-style">LOGIN</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <div class="social-icons bg-blue">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0" style="gap: 5px">
                <div class="rounded-circle bg-black"><a class="btn btn-dark m-3" href="#!"><img src="{{ asset('img/ethnicLogo.png')}}" class="img-fluid" alt="" srcset=""></a></div>
                <div class="rounded-circle bg-black"><a class="btn btn-dark m-3" href="#!"><img src="{{ asset('img/sinergiLogo.png')}}" class="img-fluid" alt="" srcset=""></a></div>
                <div class="rounded-circle bg-black"><a class="btn btn-dark m-3" href="#!"><img src="{{ asset('img/greatLogo.png')}}" class="img-fluid" alt="" srcset=""></a></div>
            </div>
        </div>

    </div>
            <div class="container mt-sm-5" style="box-shadow:  20px 20px 60px #d9d9d9,-20px -20px 60px #ffffff; border-radius: 50px"  data-aos="fade-in" data-aos-duration="2000" data-aos-delay="300">
                <div class="row p-5">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 text-center">
                            <div class="features-icons-icon w-50 h-50 rounded-circle overflow-hidden d-block mb-3 mx-auto"><img src="{{ asset('img/greatLogo.png') }}" class="img-fluid" alt=""></div>
                            <h3 style="color: #4a4a4a">UKM Great</h3>
                            <p class="lead mb-0" style="color: #4a4a4a">Great merupakan Unit Kegiatan Mahasiswa Fakultas Teknik Universitas Suryakancana yang bergerak di bidang keaagamaan</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 text-center">
                            <div class="features-icons-icon w-50 h-50 rounded-circle overflow-hidden d-block mb-3 mx-auto"><img src="{{ asset('img/sinergiLogo.jfif') }}" class="img-fluid" alt=""></div>
                            <h3 style="color: #4a4a4a">UKM Sinergi</h3>
                            <p class="lead mb-0" style="color: #4a4a4a">Sinergi merupakan Unit Kegiatan Mahasiswa Fakultas Teknik Universitas Suryakancana yang bergerak di bidang kesenian</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 text-center">
                            <div class="features-icons-icon w-50 h-75 d-block mb-3 mx-auto"><img src="{{ asset('img/ethnicLogo.png') }}" class="img-fluid" alt=""></div>
                            <h3 style="color: #4a4a4a">UKM Ethnic</h3>
                            <p class="lead mb-0" style="color: #4a4a4a">Ethnic merupakan Unit Kegiatan Mahasiswa Fakultas Teknik Universitas Suryakancana yang bergerak di bidang olahraga</p>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-center mt-5" style="color: #4a4a4a">EVENT YANG AKAN DATANG</h1>
        <div class="containerActivity" style="padding: 20px 10px;">
        @foreach ($activities as $activity )
        <div class="card-portfolio col-5 py-10 my-4 mx-auto" data-aos="fade-in" data-aos-duration="2000" data-aos-delay="300">
            <div class="justify-center">
              <div class="p-5 gap-y-4 d-flex flex-column">
                <div style="height: 50; width: 50 ; overflow: hidden;" class="d-lg-flex d-block mb-3 mx-auto align-items-center"><img src={{ asset('storage/poster_activity/'.$activity->poster) }} alt="" class="mx-auto max-w-full max-h-full img-fluid" /></div>
                <div class="d-flex flex-column px-4 w-100">
                    <p class="aboutmeTitle text-center text-2xl">{{$activity->title}}</p>
                    <p class="aboutmeDescription text-center bold">{{$activity->user->name}}</p>
                    <p class="aboutmeDescription text-center">{{$activity->description}}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach

    </div>
        <script>
            AOS.init();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
