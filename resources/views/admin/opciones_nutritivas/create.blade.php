<h2>
    Nueva Opción Nutritiva
</h2>
<div class="container mt-2">
    <form id="modalOpcionNutritiva" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="60">
        </div>
    
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>


<script>
    document.getElementById('modalOpcionNutritiva').addEventListener('submit', function(event) {
        event.preventDefault();
        nuevaOpcionNutritiva();
    });
    

</script>
