<div class="container mt-2 ms-3">
    <div class="container mt-2 ">
        <div class="container text-center mb-3">
            <h2 class="mb-0 ">Restaurantes</h2>
        </div>
        <button class="btn btn-primary" onclick="modalRestaurante()">
            <i class="bi bi-plus-lg"></i> Nuevo Restaurante
        </button>
        
    </div>
    <div class="container-fluid px-4 mt-3">
        <div class="table-responsive">
        <table id="myTable" class="table table-bordered table-hover table-striped w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Sitio Web</th>
                    <th>Categoría</th>
                    <th>Nivel Higiene</th>
                    <th>Rango Precio</th>
                    <th>Opciones Nutritivas</th>
                    <th>Destacado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restaurantes as $restaurante)
                <tr>
                    <td>{{ $restaurante->id }}</td>
                    <td>{{ $restaurante->nombre }}</td>
                    <td>{{ $restaurante->descripcion }}</td>
                    <td>{{ $restaurante->direccion }}</td>
                    <td>{{ $restaurante->telefono }}</td>
                    <td>{{ $restaurante->email }}</td>
                    <td>{{ $restaurante->sitio_web }}</td>
                    <td>{{ $restaurante->categoria->nombre ?? '-' }}</td>
                    <td>{{ $restaurante->nivelHigiene->nombre ?? '-' }}</td>
                    <td>{{ $restaurante->rangoPrecio->nombre ?? '-' }}</td>
                    <td>
                        @if($restaurante->opcionesNutritivas->isNotEmpty())
                            @foreach($restaurante->opcionesNutritivas as $op)
                                <span >{{ $op->nombre }}</span>
                            @endforeach
                        @else
                            <span >Ninguna</span>
                        @endif
                    </td>
                    <td>
                        @if($restaurante->destacado)
                            <span >Sí</span>
                        @else
                            <span >No</span>
                        @endif
                    </td>
                    <td >
                        <button class="btn btn-sm btn-warning" onclick="mostrarEditRestaurante({{ $restaurante->id }})" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarRestaurante({{ $restaurante->id }})" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </button>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    
</div>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
        responsive: true
    });

    function modalRestaurante() {
        axios.get('{{ route('restaurantes.create') }}')
        .then(function(response) {
            $('#modal-body').html(response.data);
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        });
    }

    function nuevaRestaurante() {
    const formulario = document.getElementById('modalRestaurante');
    const data = new FormData(formulario);
    Swal.fire({
        title: "¿Deseas registrar el restaurante?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Guardar",
        denyButtonText: `No guardar`,
        cancelButtonText: "Cancelar",               
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('restaurantes', data)
            .then(function (response) {
                toastr.success('Restaurante agregado exitosamente', 'Success!');
                $('#exampleModal').modal('hide');
                indexRestaurante();
            })
            .catch(function (error) {
                if(error.response){
                    toastr.error(error.response.data.message, 'Inconceivable!');
                }
                console.log(error);
            });
        } else if (result.isDenied) {
            toastr.error('Registro no se guardó', 'Cancelado por el usuario');
        }
    });   
}


    function mostrarEditRestaurante(id) {
        axios.get('{{ url('admin/restaurantes') }}/' + id + '/edit')
        .then(function(response) {
            $('#modal-body').html(response.data);
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        });
    }
    function editRestaurante(id) {
    const formulario = document.getElementById('editarRestaurante');
    const data = new FormData(formulario);
    Swal.fire({
        title: "¿Deseas actualizar el restaurante?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Actualizar",
        denyButtonText: `No actualizar`,
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('admin/restaurantes/' + id, data)
            .then(function (response) {
                toastr.success('Restaurante actualizado exitosamente', 'Success!');
                $('#exampleModal').modal('hide');
                indexRestaurante();
            })
            .catch(function (error) {
                let msg = 'Error de validación';
                if (error.response && error.response.data && error.response.data.errors) {
                    // Muestra todos los mensajes de error concatenados
                    msg = Object.values(error.response.data.errors).join('<br>');
                }
                toastr.error(msg, 'Ups...');
                console.log(error);
            });
        } else if (result.isDenied) {
            toastr.error('Actualización no se realizó', 'Cancelado por el usuario');
        }
    });
}


    function eliminarRestaurante(id) {
        Swal.fire({
            title: "¿Deseas eliminar el restaurante?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Eliminar",
            denyButtonText: `No eliminar`,
            cancelButtonText: "Cancelar",               
        }).then((result) => {
            if (result.isConfirmed) {
                const data = new FormData();
                data.append('_method', 'DELETE');
                axios.post('/admin/restaurantes/' + id, data)
                .then(function (response) {
                    toastr.success('Restaurante eliminado exitosamente', 'Success!');
                    indexRestaurante();
                })
                .catch(function (error) {
                    toastr.error('No se pudo eliminar el restaurante', 'Ups...');
                    console.log(error);
                });
            } else if (result.isDenied) {
                toastr.error('Eliminación no se realizó', 'Cancelado por el usuario');
            }
        });
    }
    
</script>
