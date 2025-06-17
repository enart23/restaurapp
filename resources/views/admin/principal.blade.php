@extends('admin.plantilla')

@section('cuerpo')
<div class="container-fluid mt-4">
    <!-- Bienvenida -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Bienvenido al panel Administrativo de <span class="text-primary">RestaurApp</span></h2>
            <p class="lead">Administra cevicherías, restaurantes, precios, higiene y opciones saludables desde un solo lugar.</p>
        </div>
    </div>

    <!-- Tarjetas resumen -->
    <div class="row g-4 justify-content-center">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-utensils fa-2x mb-2"></i>
                    <a href="#" onclick="indexRestaurante()"><h5 class="card-title">Restaurantes</h5></a>
                    <h3>{{ $totalRestaurantes ?? '0' }}</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success shadow h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-list fa-2x mb-2"></i>
                    <a href="#" onclick="indexCategoria()"><h5 class="card-title">Categorías</h5></a>
                    <h3>{{ $totalCategorias ?? '0' }}</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning shadow h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-shield-alt fa-2x mb-2"></i>
                    <a href="#" onclick="indexNivelHigiene()"><h5 class="card-title">Niveles Higiene</h5></a>
                    <h3>{{ $totalHigiene ?? '0' }}</h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-danger shadow h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-apple-alt fa-2x mb-2"></i>
                    <a href="#" onclick="indexOpcionNutritiva()"><h5 class="card-title">Opc. Nutritivas</h5></a>
                    <h3>{{ $totalNutricion ?? '0' }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Placeholder de gráfica futura -->
    <div class="row mt-5">
      <div class="col-md-8 offset-md-2">
          <div class="card shadow">
              <div class="card-header bg-white text-center">
                  <strong>Distribución de Restaurantes por Categoría</strong>
              </div>
              <div class="card-body">
                  <canvas id="chartCategorias" style="max-width: 500px; height: 200px; margin: 0 auto;"></canvas>
              </div>
          </div>
      </div>
    </div>

</div>
@endsection
