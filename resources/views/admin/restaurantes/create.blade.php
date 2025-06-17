<h2>Nuevo Restaurante</h2>
<div class="container mt-2">
    <form id="modalRestaurante" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nombre" required maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" maxlength="255">
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="direccion" required maxlength="150">
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" maxlength="30">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" maxlength="60">
        </div>
        <div class="mb-3">
            <label class="form-label">Sitio Web</label>
            <input type="url" class="form-control" name="sitio_web" maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Categoría <span class="text-danger">*</span></label>
            <select class="form-select" name="categoria_id" required>
                <option value="">Seleccione...</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nivel de Higiene <span class="text-danger">*</span></label>
            <select class="form-select" name="nivel_higiene_id" required>
                <option value="">Seleccione...</option>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Rango de Precio <span class="text-danger">*</span></label>
            <select class="form-select" name="rangos_precio_id" >
                <option value="">Seleccione...</option>
                @foreach($rangos as $rango)
                    <option value="{{ $rango->id }}">{{ $rango->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Opciones Nutritivas</label>
            <div class="row">
                @foreach($opciones as $opc)
                <div class="col-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="opciones_nutritivas[]" value="{{ $opc->id }}" id="opcion-{{ $opc->id }}">
                        <label class="form-check-label" for="opcion-{{ $opc->id }}">{{ $opc->nombre }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="destacado" value="1" id="destacado">
            <label class="form-check-label" for="destacado">¿Destacado?</label>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>
<script>
document.getElementById('modalRestaurante').addEventListener('submit', function(e) {
    e.preventDefault();
    nuevaRestaurante();
});
</script>
