<h4>Nueva Imagen de Restaurante</h4>
<div class="container mt-2">
    <form id="modalImagenRestaurante" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="restaurante_id" class="form-label">Restaurante <span class="text-danger">*</span></label>
            <select class="form-select" name="restaurante_id" id="restaurante_id" required>
                <option value="">Seleccione restaurante...</option>
                @foreach($restaurantes as $r)
                    <option value="{{ $r->id }}">{{ $r->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>

<script>
document.getElementById('modalImagenRestaurante').addEventListener('submit', function(event) {
    event.preventDefault();
    nuevaImagenRestaurante();
});
</script>
