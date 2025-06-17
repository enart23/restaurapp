<h2>Editar Restaurante</h2>
<div class="container mt-2">
    <form id="editarRestaurante">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nombre" value="{{ $restaurante->nombre }}" required maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <input type="text" class="form-control" name="descripcion" value="{{ $restaurante->descripcion }}" maxlength="255">
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="direccion" value="{{ $restaurante->direccion }}" required maxlength="150">
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" value="{{ $restaurante->telefono }}" maxlength="30">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $restaurante->email }}" maxlength="60">
        </div>
        <div class="mb-3">
            <label class="form-label">Sitio Web</label>
            <input type="url" class="form-control" name="sitio_web" value="{{ $restaurante->sitio_web }}" maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Categoría <span class="text-danger">*</span></label>
            <select class="form-select" name="categoria_id" required>
                <option value="">Seleccione...</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" @if($restaurante->categoria_id == $cat->id) selected @endif>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nivel de Higiene <span class="text-danger">*</span></label>
            <select class="form-select" name="nivel_higiene_id" required>
                <option value="">Seleccione...</option>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id }}" @if($restaurante->nivel_higiene_id == $nivel->id) selected @endif>
                        {{ $nivel->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Rango de Precio <span class="text-danger">*</span></label>
            <select class="form-select" name="rangos_precio_id" required>
                <option value="">Seleccione...</option>
                @foreach($rangos as $rango)
                    <option value="{{ $rango->id }}" @if($restaurante->rangos_precio_id == $rango->id) selected @endif>
                        {{ $rango->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Opciones Nutritivas</label>
            <div class="row">
                @php
                    $nutri_seleccionadas = $restaurante->opcionesNutritivas->pluck('id')->toArray();
                @endphp
                @foreach($opciones as $opc)
                <div class="col-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"
                            name="opciones_nutritivas[]" value="{{ $opc->id }}"
                            id="opcion-{{ $opc->id }}"
                            {{ in_array($opc->id, $nutri_seleccionadas) ? 'checked' : '' }}>
                        <label class="form-check-label" for="opcion-{{ $opc->id }}">{{ $opc->nombre }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="destacado" value="1" id="destacado"
            @if($restaurante->destacado) checked @endif>
            <label class="form-check-label" for="destacado">¿Destacado?</label>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>

<script>
document.getElementById('editarRestaurante').addEventListener('submit', function(event) {
    event.preventDefault();
    editRestaurante({{ $restaurante->id }});
});
</script>
