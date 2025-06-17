<div class="container mt-3">
    <div class="container mt-2">
        <h2 class="mb-0">Rango de Precios</h2>
        <button class="btn btn-primary" onclick="modalRangoPrecio()">
            <i class="bi bi-plus-lg"></i> Nuevo Rango de Precio
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
                @foreach($rangos as $rango)
                <tr>
                    <td>{{ $rango->id }}</td>
                    <td>{{ $rango->nombre }}</td>                
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="mostrarEditRangoPrecio({{ $rango->id }})" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarRangoPrecio({{ $rango->id }})" title="Eliminar">
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

    function modalRangoPrecio() {
        axios.get('{{ route('rangos-precio.create') }}')
        .then(function(response) {
            $('#modal-body').html(response.data);
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        });
    }

    function nuevoRangoPrecio() {
            const formulario = document.getElementById('modalRangoPrecio');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas registrar el Rango de Precios?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `No guardar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ route('rangos-precio.store') }}', data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Rango de Precio agregado exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexRangoPrecio();
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

    function mostrarEditRangoPrecio(id) {
            axios.get('{{ url('admin/rangos-precio') }}/' + id + '/edit')
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
    function editRangoPrecio(id) {
            const formulario = document.getElementById('editarRangoPrecio');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas actualizar el Rango de Precio?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Actualizar",
                denyButtonText: `No actualizar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ url('admin/rangos-precio') }}/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Rango de Precio actualizado exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexRangoPrecio();
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


    function eliminarRangoPrecio(id) {
            Swal.fire({
                title: "¿Deseas eliminar el Rango de Precio?",
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
                    axios.post('admin/rangos-precio/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Rango de precio eliminado exitosamente', 'Success!');
                        console.log(response.data.message);
                        indexRangoPrecio();
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