<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>IT-Center | ЧТОТиБ</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src={{asset("js/sweetalert.min.js")}}></script>
    <script src={{asset('js/webfont.min.js')}}></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">

            <a href="{{ route('home') }}" class="logo">
                <img src="{{asset("img/logo.svg")}}" alt="navbar brand" class="navbar-brand">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>

        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

            <div class="container-fluid">
                <div class="collapse" id="search-nav">
                    <form class="navbar-left navbar-form nav-search mr-md-3">

                    </form>
                </div>
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                </ul>
            </div>
        </nav>
    </div>



    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">

                <ul class="nav nav-primary">

                    <li class="nav-item">
                        <a href="{{ route('newrequest.new') }}">
                            <i class="fas fa-plus"></i>
                            <p>Новая заявка</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="main-panel">
        <div class="content">

            <div class="panel-header bg-primary-gradient">
                <div class="page-inner py-5">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                        <div>
                            <h2 class="text-white pb-2 fw-bold">@yield('page-header')</h2>

                            <h5 class="text-white op-7 mb-2">@yield('page-header-desc')</h5>
                        </div>
                        <div class="ml-md-auto py-2 py-md-0">
                            {{--                            <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>--}}
                            {{--                            <a href="#" class="btn btn-secondary btn-round">Add Customer</a>--}}
                            @yield('page-header-buttons')
                        </div>
                    </div>
                </div>

            </div>


            <div class="page-inner">
                @if(session()->has('success'))
                    <div class="card card-dark bg-success-gradient">
                        <div class="card-body bubble-shadow">
                            <h5 class="mb-0">{!! session('success') !!}</h5>
                        </div>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="card card-dark bg-danger-gradient">
                        <div class="card-body bubble-shadow">
                            <h5 class="mb-0">{{session('error')}}</h5>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

</div>

<script src={{asset("js/main.min.js")}}></script>
<script>
    let selector = '.sidebar ul.nav .nav-item';
    let url = window.location.href;
    let target = url.split('/');
    if (!target[target.length-1]) url = url.substr(0, url.length - 1);
    else url = target[0] + '/' + target[1] + '/' + target[2] + '/' + target[3];
    $(selector).each(function(){
        if ($(this).find('a').attr('href') === url){
            $(selector).removeClass('active');
            $(this).removeClass('active').addClass('active');
        }
    });
</script>
</body>
</html>


