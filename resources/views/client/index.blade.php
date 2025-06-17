<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Directorio de Restaurantes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/tooplate-gotto-job.css') }}" rel="stylesheet">
</head>

<body class="job-listings-page" id="top">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('client.index') }}">
                <img src="{{ asset('dist/images/logo.png') }}" class="img-fluid logo-image">
                <div class="d-flex flex-column">
                    <strong class="logo-text">RestaurApp</strong>
                    <small class="logo-slogan">Directorio en línea</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-center ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.index') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.sobreNosotros') }}">Sobre Nosotros</a>
                        </li>

                        @guest
                            {{-- Usuario no autenticado --}}
                            <li class="nav-item ms-lg-auto">
                                <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link custom-btn btn" href="{{ route('login') }}">Iniciar Sesión</a>
                            </li>
                        @else
                            {{-- Usuario autenticado --}}
                            <li class="nav-item ms-lg-auto">
                                <span class="nav-link">Bienvenido, {{ Auth::user()->name }}</span>
                            </li>

                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.index') }}">Panel Admin</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('client.miCuenta') }}">Mi cuenta</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link" style="padding: 0; border: none;">Cerrar sesión</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
        </div>
    </nav>

    <main>
        

        {{-- Breadcrumbs --}}
        {{-- Header --}}
        <header class="site-header">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center">
                        <h1 class="text-white">Directorio de Cevicherías y Restaurantes</h1>
                        <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('client.sobreNosotros') }}">Sobre Nosotros</a></li>
                                </ol>
                        </nav>
                    </div>
                </div>
            </div>
            
        </header>

        {{-- Filtros --}}
        <section class="section-padding pb-0 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <form class="custom-form hero-form" method="GET" action="{{ route('client.index') }}">
                            <h3 class="text-white mb-3 text-center">Filtra tu restaurante favorito</h3>
                            

                            <div class="row">
                                {{-- Categoría --}}
                                {{-- <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-globe custom-icon"> </i></span>
                                        <select class="form-select form-control" name="categoria">
                                            <option value="">Categoria</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- Nombre --}}
                                {{-- <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-search custom-icon"></i></span>
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del restaurante" value="{{ request('nombre') }}">
                                    </div>
                                </div> --}}

                                {{-- Precio --}}
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-cash custom-icon"></i></span>
                                        <select class="form-select form-control" name="precio" aria-label="Default select example">
                                            <option selected>Rango de Precios</option>
                                            @foreach($rangosPrecio as $rango)
                                                <option value="{{ $rango->id }}" {{ request('precio') == $rango->id ? 'selected' : '' }}>
                                                    {{ $rango->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Higiene --}}
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-shield-check custom-icon"></i></span>
                                        <select class="form-select form-control" name="higiene">
                                            <option value="">Nivel de Higiene</option>
                                            @foreach($nivelHigiene as $nivel)
                                                <option value="{{ $nivel->id }}" {{ request('higiene') == $nivel->id ? 'selected' : '' }}>
                                                    {{ $nivel->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Nutrición --}}
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-heart-pulse custom-icon"></i></span>
                                        <select class="form-select form-control" name="nutricion">
                                            <option value="">Opciones Nutritivas</option>
                                            @foreach($opcionesNutritivas as $nutricion)
                                                <option value="{{ $nutricion->id }}" {{ request('nutricion') == $nutricion->id ? 'selected' : '' }}>
                                                    {{ $nutricion->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <button type="submit" class="form-control">Aplicar Filtros</button>
                                    <a href="{{ route('client.index') }}" class="btn btn-secondary w-100 mt-1 quitar-filtros-btn " style="border-radius: 2rem;">
                                        Quitar Filtros
                                    </a>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </section>

        {{-- Resultados --}}
        <section class="job-section section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12 mb-lg-4">
                            <h3>Mostrando {{ $filtrados }} de {{ $totalRestaurantes }} restaurantes</h3>
                    </div>
   
                    </div>

                    @forelse($restaurantes as $restaurante)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="job-thumb job-thumb-box">
                                <div class="job-image-box-wrap">
                                    <a href="">
                                        @if($restaurante->imagenDestacada)
                                            <img src="{{ asset('storage/' . $restaurante->imagenDestacada->url) }}" class="job-image img-fluid" alt="{{ $restaurante->nombre }}">
                                        @else
                                            <img src="{{ asset('images/no-image.jpg') }}" class="job-image img-fluid" alt="Sin imagen">
                                        @endif
                                    </a>
                                </div>
                                <div class="job-body">
                                    <h4 class="job-title">
                                        <a href="" class="job-title-link">{{ $restaurante->nombre }}</a>
                                    </h4>

                                    <p class="mb-0"><i class="custom-icon bi bi-geo-alt me-1"></i> {{ $restaurante->direccion }}</p>
                                    <p class="mb-0"><i class="custom-icon bi bi-tag me-1"> </i>{{ $restaurante->categoria->nombre ?? 'Sin categoría' }}</p>
                                    {{-- descripcion del restaurante --}}
                                    <p class="mb-0"><i class="custom-icon bi bi-info-circle me-1"></i> {{ $restaurante->descripcion ?? 'No disponible' }}</p>
                                    <p class="mb-0"><i class="custom-icon bi bi-cash me-1"></i> {{ $restaurante->rangoPrecio->nombre ?? 'Sin dato' }}</p>
                                    <p class="mb-0"><i class="custom-icon bi bi-shield-check me-1"></i> Higiene: {{ $restaurante->nivelHigiene->nombre ?? 'No especificado' }}</p>
                                    <p class="mb-0">
                                        <i class="custom-icon bi bi-heart-pulse me-1"></i>
                                        Nutrición:
                                        @if($restaurante->opcionesNutritivas->isNotEmpty())
                                            @foreach($restaurante->opcionesNutritivas as $nutricion)
                                                <span>{{ $nutricion->nombre }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No especificado</span>
                                        @endif
                                    </p>
                                    <a href="" class="btn btn-outline-primary mt-2 w-100">Ir a sitio web</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No se encontraron resultados con los filtros seleccionados.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="site-footer-bottom text-center py-3 bg-dark text-white">
            <p class="mb-0">© {{ now()->year }} Directorio de Restaurantes</p>
            <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>
        </div>
        
    </footer>

    {{-- JS --}}
    
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dist/js/counter.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
</body>
</html>
