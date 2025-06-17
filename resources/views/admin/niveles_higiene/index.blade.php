<div class="container mt-3">
    <div class="container mt-2">
        <h2 class="mb-0">Niveles de Higiene</h2>
        <button class="btn btn-primary" onclick="modalNivelHigiene()">
            <i class="bi bi-plus-lg"></i> Nuevo Nivel de Higiene
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
                @foreach($niveles as $nivel)
                <tr>
                    <td>{{ $nivel->id }}</td>
                    <td>{{ $nivel->nombre }}</td>                
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="mostrarEditNivelHigiene({{ $nivel->id }})" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarNivelHigiene({{ $nivel->id }})" title="Eliminar">
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

    function modalNivelHigiene() {
        axios.get('{{ route('niveles-higiene.create') }}')
        .then(function(response) {
            $('#modal-body').html(response.data);
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        });
    }

    function nuevoNivelHigiene() {
            const formulario = document.getElementById('modalNivelHigiene');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas registrar el Nivel de Higiene?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `No guardar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ route('niveles-higiene.store') }}', data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('NivelHigiene agregado exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexNivelHigiene();
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

    function mostrarEditNivelHigiene(id) {
            axios.get('{{ url('admin/niveles-higiene') }}/' + id + '/edit')
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
    function editNivelHigiene(id) {
            const formulario = document.getElementById('editarNivelHigiene');
            const data = new FormData(formulario);
            Swal.fire({
                title: "¿Deseas actualizar el nivel de Higiene?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Actualizar",
                denyButtonText: `No actualizar`,
                cancelButtonText: "Cancelar",               
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('{{ url('admin/niveles-higiene') }}/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Nivel de Higiene actualizado exitosamente', 'Success!');
                        console.log(response.data.message);
                        $('#exampleModal').modal('hide');
                        indexNivelHigiene();
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


    function eliminarNivelHigiene(id) {
            Swal.fire({
                title: "¿Deseas eliminar este nivel de higiene?",
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
                    axios.post('admin/niveles-higiene/' + id, data)
                    .then(function (response) {
                        // manejar respuesta exitosa
                        toastr.success('Nivel de higiene eliminado exitosamente', 'Success!');
                        console.log(response.data.message);
                        indexNivelHigiene();
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