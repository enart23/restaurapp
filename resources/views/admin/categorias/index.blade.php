<div class="container mt-3">
    <div class="container mt-2">
        <h2 class="mb-0">Categorías</h2>
        <button class="btn btn-primary" onclick="modalCategoria()">
            <i class="bi bi-plus-lg"></i> Nueva Categoría
        </button>
    </div>


    <div class="container mt-2">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>                
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="mostrarEditCategoria({{ $categoria->id }})" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarCategoria({{ $categoria->id }})" title="Eliminar">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready( function () {
            $('#myTable').DataTable();
        } );

    function modalCategoria() {
        axios.get('{{ route('categorias.create') }}')
        .then(function(response) {
            $('#modal-body').html(response.data);
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        });
    }

    function nuevaCategoria() {
            const formulario = document.getElementById('modalCategoria');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas registrar la categoría?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `No guardar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ route('categorias.store') }}', data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Categoría agregada exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexCategoria();
                    })
                    .catch(function (error) {
                        if(error.response){
                            toastr.error(error.response.data.message, 'Inconceivable!');
                        }
                        // manejar error con Toastr
                        console.log(error);
                    });
                } else if (result.isDenied) {
                    toastr.error('Registro no se guardo', 'Cancelado por el usuario');
                }
            });   
    }

    function mostrarEditCategoria(id) {
            axios.get('{{ url('admin/categorias') }}/' + id + '/edit')
            .then(function (response) {
                // manejar respuesta exitosa
                const texto_html = response.data;
                $('#modal-body').html(texto_html);
                $('#exampleModal').modal('show');
                console.log(response);
            })
            .catch(function (error) {
                // manejar error con Toastr
                toastr.error('Error de servidor', 'Inconceivable!');
                console.log(error);
            });
    }
    function editCategoria(id) {
            const formulario = document.getElementById('editarCategoria');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas actualizar la categoría?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Actualizar",
                denyButtonText: `No actualizar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ url('admin/categorias') }}/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Categoria actualizada exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexCategoria();
                    })
                    .catch(function (error) {
                        if(error.response){
                            toastr.error(error.response.data.message, 'Inconceivable!');
                        }
                        // manejar error con Toastr
                        console.log(error);
                    });
                } else if (result.isDenied) {
                    toastr.error('Actualización no se realizo', 'Cancelado por el usuario');
                }
            });
        }


    function eliminarCategoria(id) {
            Swal.fire({
                title: "¿Deseas eliminar la categoría?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Eliminar",
                denyButtonText: `No eliminar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const data = new FormData();
                    data.append('_method', 'DELETE');
                    axios.post('admin/categorias/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Categoria eliminada exitosamente', 'Success!');
                        console.log(response.data.message);
                        indexCategoria();
                    })
                    .catch(function (error) {
                        if(error.response){
                            toastr.error(error.response.data.message, 'Inconceivable!');
                        }
                        // manejar error con Toastr
                        console.log(error);
                    });
                } else if (result.isDenied) {
                    toastr.error('Eliminación no se realizo', 'Cancelado por el usuario');
                }
            });
    }
</script>