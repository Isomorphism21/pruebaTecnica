<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Contribuyentes</h2>
        <a href="{{ url('contribuyentes/create') }}" class="btn btn-success">Registrar contribuyente</a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Filtros</strong>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ url('contribuyentes') }}" class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="tipoDeDocumento" class="form-control" placeholder="Tipo de documento" value="{{ request('tipoDeDocumento') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="documento" class="form-control" placeholder="Documento" value="{{ request('documento') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="nombres" class="form-control" placeholder="Nombres" value="{{ request('nombres') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="{{ request('apellidos') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ request('telefono') }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Tipo de Documento</th>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contribuyentes as $contribuyente)
            <tr>
                <td>{{ $contribuyente->tipoDeDocumento }}</td>
                <td>{{ $contribuyente->documento }}</td>
                <td>{{ $contribuyente->nombres }}</td>
                <td>{{ $contribuyente->apellidos }}</td>
                <td>{{ $contribuyente->telefono }}</td>
                <td class="text-nowrap">
                    <a href="{{ url('/contribuyentes/'.$contribuyente->id.'/edit') }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ url('/contribuyentes/'.$contribuyente->id) }}" method="POST" class="d-inline">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>

                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetalles{{ $contribuyente->id }}">
                        Ver información
                    </button>
                </td>
            </tr>

            <div class="modal fade" id="modalDetalles{{ $contribuyente->id }}" tabindex="-1" aria-labelledby="detallesLabel{{ $contribuyente->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detallesLabel{{ $contribuyente->id }}">Detalles del Contribuyente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Tipo de Documento:</strong> {{ $contribuyente->tipoDeDocumento }}</p>
                            <p><strong>Documento:</strong> {{ $contribuyente->documento }}</p>
                            <p><strong>Nombres:</strong> {{ $contribuyente->nombres }}</p>
                            <p><strong>Apellidos:</strong> {{ $contribuyente->apellidos }}</p>
                            <p><strong>Dirección:</strong> {{ $contribuyente->direccion }}</p>
                            <p><strong>Teléfono:</strong> {{ $contribuyente->telefono }}</p>
                            <p><strong>Celular:</strong> {{ $contribuyente->celular }}</p>
                            <p><strong>Email:</strong> {{ $contribuyente->email }}</p>
                            <p><strong>Usuario:</strong> {{ $contribuyente->usuario }}</p>
                            <p><strong>Fecha:</strong> {{ $contribuyente->fechaSistema }}</p>
                            <p><strong>Frecuencia de Letras (Nombres + Apellidos):</strong></p>
                            <ul>
                                @foreach($contribuyente->frecuencias as $letra => $cantidad)
                                    <li><strong>{{ $letra }}</strong>: {{ $cantidad }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
