<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Formulario de Contribuyente</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($contribuyente) ? url('/contribuyentes/'.$contribuyente->id) : url('/contribuyentes') }}">
                @csrf
                @if(isset($contribuyente))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="tipoDeDocumento" class="form-label">Tipo de Documento:</label>
                        <select class="form-select" id="tipoDeDocumento" name="tipoDeDocumento" required>
                            <option value="">Seleccione</option>
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="NIT">NIT</option>
                            <option value="TI">Tarjeta de Identidad</option>
                            <option value="CE">Cédula de Extranjería</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="documento" class="form-label">Documento:</label>
                        <input type="number" class="form-control" id="documento" name="documento" value="{{ $contribuyente->documento ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="nombres" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $contribuyente->nombres ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $contribuyente->apellidos ?? '' }}" >
                    </div>

                    <div class="col-md-4">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $contribuyente->direccion ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $contribuyente->telefono ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="celular" class="form-label">Celular:</label>
                        <input type="text" class="form-control" id="celular" name="celular" value="{{ $contribuyente->celular ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="email" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $contribuyente->email ?? '' }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="{{ $contribuyente->usuario ?? '' }}" required>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($contribuyente) ? 'Actualizar Contribuyente' : 'Crear Contribuyente' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var tipoDocumento = @json($contribuyente->tipoDeDocumento ?? '');
        $('#tipoDeDocumento').val(tipoDocumento);
    });
</script>
