<div class="container mt-3">
    <div class="container mt-2">
        <h2 class="mb-0">Opciones Nutritivas</h2>
        <button class="btn btn-primary" onclick="modalOpcionNutritiva()">
            <i class="bi bi-plus-lg"></i> Nueva Opción Nutritiva
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
                @foreach($opciones as $opcion)
                <tr>
                    <td>{{ $opcion->id }}</td>
                    <td>{{ $opcion->nombre }}</td>                
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="mostrarEditOpcionNutritiva({{ $opcion->id }})" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarOpcionNutritiva({{ $opcion->id }})" title="Eliminar">
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

    function modalOpcionNutritiva() {
        axios.get('{{ route('opciones-nutritivas.create') }}')
        .then(function(response) {
            $('#modal-body').html(response.data);
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        });
    }

    function nuevaOpcionNutritiva() {
            const formulario = document.getElementById('modalOpcionNutritiva');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas registrar la Opción Nutritiva?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `No guardar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ route('opciones-nutritivas.store') }}', data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Opción Nutritiva agregada exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexOpcionNutritiva();
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

    function mostrarEditOpcionNutritiva(id) {
            axios.get('{{ url('admin/opciones-nutritivas') }}/' + id + '/edit')
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
    function editOpcionNutritiva(id) {
            const formulario = document.getElementById('editarOpcionNutritiva');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas actualizar esta Opción Nutritiva?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Actualizar",
                denyButtonText: `No actualizar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ url('admin/opciones-nutritivas') }}/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Opción Nutritiva actualizada exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexOpcionNutritiva();
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


    function eliminarOpcionNutritiva(id) {
            Swal.fire({
                title: "¿Deseas eliminar esta Opción Nutritiva?",
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
                    axios.post('admin/opciones-nutritivas/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Opción Nutritiva eliminada exitosamente', 'Success!');
                        console.log(response.data.message);
                        indexOpcionNutritiva();
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