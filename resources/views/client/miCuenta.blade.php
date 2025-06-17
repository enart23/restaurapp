<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Cuenta - Directorio de Restaurantes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/tooplate-gotto-job.css') }}" rel="stylesheet">
</head>

<body>
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
                                    <a class="nav-link" href="">Mi cuenta</a>
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

    <header class="site-header">
        <div class="section-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="text-white">Mi Cuenta</h1>
                    <p class="text-white lead">Detalles de tu perfil y actividad</p>
                </div>
            </div>
        </div>
    </header>

    <main class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            Información del Usuario
                        </div>
                        <div class="card-body">
                            <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Correo:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Rol:</strong> {{ Auth::user()->role }}</p>

                            <hr>

                            <h5 class="mt-4">Acciones</h5>
                            <a href="#" class="btn btn-outline-primary w-100 mb-2">Editar Perfil (próximamente)</a>
                            <a href="#" class="btn btn-outline-secondary w-100">Cambiar Contraseña (próximamente)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="site-footer-bottom text-center py-3 bg-dark text-white">
            <p class="mb-0">© {{ now()->year }} Directorio de Restaurantes</p>
            <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>
        </div>
        
    </footer>

    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
</body>
</html>