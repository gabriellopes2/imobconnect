<!DOCTYPE html>
<html data-bs-theme="light" lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ImobConnect</title>
    <link rel="stylesheet" href="/css/swiper-icons.css">
    <link rel="stylesheet" href="/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="/css/Simple-Slider-swiper-bundle.min.css">
    <link rel="stylesheet" href="/css/Simple-Slider.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.reflowhq.com/v2/toolkit.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link href="{{ asset('css/baguetteBox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vanilla-zoom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personalizado.css') }}" rel="stylesheet">
</head>

<body style="background-color: rgb(250,250,250);">
    <nav class="navbar navbar-expand-lg fixed-top bg-body clean-navbar navbar-light">
        <div class="container"><a class="navbar-brand logo" href="/">ImobConnect</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">início</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('anuncio.anuncios') }}">Anúncios</a></li>
                    @if ($userType === 'proprietario')
                    <li class="nav-item"><a class="nav-link" href="{{ route('anuncio.anunciar') }}">Anunciar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('anuncio.meusimoveis') }}">meus imóveis</a></li>                        
                    @endif
                    
                    @if($isAdmin === true)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.home') }}">Painel Administrativo</a></li>
                    @endif
                    @if ($userType !== 'visitante')
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.logout') }}">Sair ({{ $userName }})</a></li>    
                    @else
                    <li class="nav-item"><a class="nav-link" href="login">Entrar</a></li>   
                    @endif                
                </ul>
            </div>
        </div>
    </nav>
    
    {{ $slot }}
</body>
</html>