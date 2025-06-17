<h2>
    Editar Nivel de Higiene
</h2>
<div class="container mt-2">
    <form id="editarNivelHigiene">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $niveles->nombre }}">
            <input type="hidden" name="id" value="{{ $niveles->id }}">
        </div>
    
        <div class="d-flex gap-2">
            <button type="submit"  class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>


<script>
    document.getElementById('editarNivelHigiene').addEventListener('submit', function(event) {
        event.preventDefault();
        editNivelHigiene({{ $niveles->id }});
    });
    

</script>
