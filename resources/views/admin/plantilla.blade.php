<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('dist/assets/images/logo/logo-sm.png') }}" type="image/gif" sizes="16x16">
    <title>Panel Admin - RestaurApp</title>
    <meta name="og:description" content="Unveiling the DataMents Free Bootstrap Admin Dashboard Template, your ultimate solution to a seamless web management experience! This is more than just a template; it's your partner in crafting a digital masterpiece.">
    <meta name="robots" content="index, follow">
    <meta name="og:title" property="og:title" content="DataMents - Free Bootstrap Admin Dashboard Template">
    <meta property="og:image" content="https://www.designtocodes.com/wp-content/uploads/2023/08/DataMents-Free-Bootstrap-Admin-Dashboard-Template.jpg">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{ asset('dist/lib/bootstrap_5/bootstrap.min.css')}}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="{{ asset('dist/lib/fontawesome/css/all.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/responsive.css') }}">

    <!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables responsive CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<!-- DataTables responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/toastr.min.js"></script>
    <link rel="stylesheet" href="css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
</head>

<body>
    <div class="d2c_wrapper">
        <!-- sidebar -->
        <div class="d2c_sidebar d2c_home rounded-4 px-4 py-4 py-md-4 m-4 me-0" id="sidebar">
            <div class="d-flex flex-column h-100">
              <div id="d2c_Sidebar" class="d2c_sidebar_header d-flex align-items-center justify-content-center mb-1 border-bottom">
                <a href="{{ route('admin.index') }}" class="mb-0 brand-icon text-white">
                    <span class="d-none d-md-inline">RestaurApp - Admin</span>
                    <i class="fas fa-utensils d-inline d-md-none"></i>
                </a>
              </div>
                
                <hr class="divider">
                <ul class="navbar-nav flex-grow-1" id="d2c_Sidebar">
                    <!-- Menu Item -->
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.index') }}">
                            <i class="fas fa-home me-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="indexCategoria()">
                            <i class="fas fa-list me-2"></i>
                            <span>Categorias</span>
                        </a>
                    </li>

                    
                     <li class="nav-item">
                        <a class="nav-link" href="#" onclick="indexNivelHigiene()">
                            <i class="fas fa-shield-alt me-2"></i>
                            <span>Niveles de Higiene</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="indexRangoPrecio()">
                            <i class="fas fa-dollar-sign me-2"></i>
                            <span>Rango de Precios</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="indexOpcionNutritiva()">
                            <i class="fas fa-apple-alt me-2"></i>
                            <span>Opciones Nutritivas</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="indexRestaurante()">
                            <i class="fas fa-utensils me-2"></i>
                            <span>Restaurantes</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="indexImagenRestaurante()">
                            <i class="fas fa-image me-2"></i>
                            <span>Imagenes Restaurantes</span>
                        </a>
                    </li>
                    

                </ul>

                <hr class="divider">

                <!-- Sidebar: Profile -->
            
                <!-- Sidebar: Profile -->
            </div>
        </div>

        <!-- main body area -->
        <div class="d2c_main px-lg-4 px-md-4 px-3">
            <!-- Top Nav -->
            <nav
                class="navbar navbar-expand navbar-light sticky-top bg-white shadow py-2 px-3 rounded-4 d2c_top_navbar my-4">
                <!-- Sidebar toggler -->
                <button type="button" id="sidebarCollapse"
                    class="btn btn-transparent text-info d2c_sidebar_collapse me-1">
                    <i class="fas fa-bars"></i>
                </button>
                <!-- Sidebar toggler -->
                <div>
                    <!-- Search Form -->
                    
                    <!-- Search Form: Nav Item -->
                    
                </div>
                <!-- Search Form: Nav Item -->
                 
                 <!--Aca ira el nombre del admin-->
                <ul class="navbar-nav align-items-center mb-lg-0 ms-auto">
                    <div class="sidebar-mini-btn text-light">
                    <div class="dropdown">
                        <a class="dropdown-closer" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span >Bienvenido, {{ Auth::user()->name }}</span>
                             <img class="img-profile rounded-circle object-fit-cover border border-2 border-white me-2"
                                src="{{ asset('dist/assets/images/avatar/man-4.png') }}" alt="avatar" width="30" height="30">
                            
                        </a>
                        <!-- Dropdown -->
                        <div class="dropdown-menu shadow border-0 end-0 start rounded-3">
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('client.index') }}" data-toggle="modal" data-target="#logoutModal">
                              <i class="fas fa-home fa-fw me-2 text-gray-400"></i>Ir a inicio
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">  
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"  style="padding: 0; border: none;">
                                      <i class="fas fa-sign-out-alt fa-fw me-2 text-gray-400"></i>Cerrar sesión</button>
                                </form>
                            </a>
                            
                        </div>
                    </div>
                </div>
                </ul>
            </nav>
            <!-- Top Nav -->

            <!-- Body: Body -->
            <main class="app-main">
                
                <div class="app-content" id="cuerpo">
                    @yield('cuerpo')
                    
                    

                </div>
            </main>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" id="modal-body">
                    ...
                  </div>
                </div>
              </div>
            </div>

        </div><!-- Page Content  -->
    </div>


    <!-- Initial  Javascript -->
    <script src="{{ asset('dist/lib/jQuery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('dist/lib/bootstrap_5/bootstrap.bundle.min.js') }}"></script>

    <!-- custom js -->
    <script src="{{ asset('dist/assets/js/main.js') }}"></script>

    <!-- apex chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- dashboard chart js-->
    <script src="{{ asset('dist/assets/js/dashboard_chart.js') }}"></script>
    <!-- jQuery (requerido por DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>
<script>
    function indexCategoria() {
          axios.get('{{ route('categorias.index') }}')
          .then(function(response) {
            $('#cuerpo').html(response.data);
            console.log(response);
        })
          .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        })
          .finally(function() {
            // cualquier código final
        });
        }

        function indexNivelHigiene() {
          axios.get('{{ route('niveles-higiene.index') }}')
          .then(function(response) {
            $('#cuerpo').html(response.data);
            console.log(response);
        })
          .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        })
          .finally(function() {
            // cualquier código final
        });
        }

        function indexRangoPrecio() {
          axios.get('{{ route('rangos-precio.index') }}')
          .then(function(response) {
            $('#cuerpo').html(response.data);
            console.log(response);
        })
          .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        })
          .finally(function() {
            // cualquier código final
        });
        }

        function indexOpcionNutritiva() {
          axios.get('{{ route('opciones-nutritivas.index') }}')
          .then(function(response) {
            $('#cuerpo').html(response.data);
            console.log(response);
        })
          .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        })
          .finally(function() {
            // cualquier código final
        });
        }

        function indexRestaurante() {
          axios.get('{{ route('restaurantes.index') }}')
          .then(function(response) {
            $('#cuerpo').html(response.data);
            console.log(response);
        })
          .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        })
          .finally(function() {
            // cualquier código final
        });
        }

        function indexImagenRestaurante() {
          axios.get('{{ route('restaurantes-imagenes.index') }}')
          .then(function(response) {
            $('#cuerpo').html(response.data);
            console.log(response);
        })
          .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        })
          .finally(function() {
            // cualquier código final
        });
        }
</script>
<script>
    const ctx = document.getElementById('chartCategorias').getContext('2d');

    const chartCategorias = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($categoriasChart->pluck('nombre')) !!},
            datasets: [{
                label: 'Restaurantes por Categoría',
                data: {!! json_encode($categoriasChart->pluck('total')) !!},
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} restaurante(s)`;
                        }
                    }
                }
            }
        }
    });
</script>
</html>
