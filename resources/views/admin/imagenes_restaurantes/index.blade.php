<div class="container mt-3">
    <h2 class="mb-4">Imágenes de Restaurantes</h2>
    <button class="btn btn-primary" onclick="modalImagenRestaurante()">
            <i class="bi bi-plus-lg"></i> Nueva Imagen de Restaurante
        </button>
        
    <div class="table-responsive mt-3">
        <table id="tablaImagenesRestaurantes" class="display">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Restaurante</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($imagenes as $img)
                <tr>
                    <td>{{ $img->id }}</td>
                    <td>{{ $img->restaurante->nombre ?? '-' }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$img->url) }}" alt="Imagen" style="width: 200px; height: 150px; object-fit: cover;">
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="eliminarImagen({{ $img->restaurante_id }}, {{ $img->id }})">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#tablaImagenesRestaurantes').DataTable();
});

function modalImagenRestaurante() {
    axios.get('{{ route('restaurantes-imagenes.create') }}')
        .then(function(response) {
            $('#modal-body').html(response.data);
            $('#exampleModal').modal('show');
        })
        .catch(function(error) {
            toastr.error('Error de servidor', 'Inconceivable!');
            console.log(error);
        });
}
function eliminarImagen(restaurante_id, imagen_id) {
    Swal.fire({
        title: "¿Eliminar esta imagen?",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`admin/restaurantes/${restaurante_id}/imagenes/${imagen_id}`)
            .then(function(response) {
                toastr.success('Imagen eliminada');
                location.reload(); // Recarga la tabla
            })
            .catch(function(error) {
                toastr.error('Error al eliminar');
            });
        }
    });
}
function nuevaImagenRestaurante() {
    const formulario = document.getElementById('modalImagenRestaurante');
    const data = new FormData(formulario);
    Swal.fire({
        title: "¿Deseas subir la imagen?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Subir",
        denyButtonText: `No subir`,
        cancelButtonText: "Cancelar",               
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('admin/restaurantes-imagenes', data)
            .then(function (response) {
                toastr.success('Imagen subida exitosamente', 'Success!');
                $('#exampleModal').modal('hide');
                indexImagenesRestaurante();
            })
            .catch(function (error) {
                let msg = 'Error de validación';
                if (error.response && error.response.data && error.response.data.errors) {
                    msg = Object.values(error.response.data.errors).join('<br>');
                }
                toastr.error(msg, 'Ups...');
            });
        } else if (result.isDenied) {
            toastr.error('Subida no realizada', 'Cancelado por el usuario');
        }
    });   
}

</script>
