<h2>
    Editar Categoría
</h2>
<div class="container mt-2">
    <form id="editarCategoria">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categoria->nombre }}">
            <input type="hidden" name="id" value="{{ $categoria->id }}">
        </div>
    
        <div class="d-flex gap-2">
            <button type="submit"  class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>


<script>
    document.getElementById('editarCategoria').addEventListener('submit', function(event) {
        event.preventDefault();
        editCategoria({{ $categoria->id }});
    });
    

</script>
