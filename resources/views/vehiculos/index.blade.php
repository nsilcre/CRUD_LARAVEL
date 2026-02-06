@extends('layouts.app')

@section('title', 'Vehículos - Concesionario')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="bi bi-car-front text-primary me-2"></i>Gestión de Vehículos
            </h4>
            <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Nuevo Vehículo
            </a>
        </div>
    </div>

    <div class="card-body">
        @if($vehiculos->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Matrícula</th>
                        <th>Marca/Modelo</th>
                        <th>Año</th>
                        <th>Combustible</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiculos as $vehiculo)
                    <tr>
                        <td>
                            <span class="fw-bold font-monospace">{{ $vehiculo->matricula }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $vehiculo->marca }}</div>
                            <small class="text-muted">{{ $vehiculo->modelo }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">
                                {{ $vehiculo->fecha_fabricacion->format('Y') }}
                            </span>
                        </td>
                        <td>
                            @php
                            $badgeClass = [
                            'hibrido' => 'badge-hibrido',
                            'electrico' => 'badge-electrico',
                            'gasolina' => 'badge-gasolina',
                            'diesel' => 'badge-diesel'
                            ][$vehiculo->combustible] ?? 'bg-secondary';
                            @endphp
                            <span class="badge-combustible {{ $badgeClass }}">
                                <i class="bi bi-fuel-pump me-1"></i>{{ ucfirst($vehiculo->combustible) }}
                            </span>
                        </td>
                        <td>
                            @if($vehiculo->precio)
                            <span class="fw-bold text-success">
                                {{ number_format($vehiculo->precio, 2) }} €
                            </span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($vehiculo->disponible)
                            <span class="badge-disponible badge-combustible">
                                <i class="bi bi-check-circle me-1"></i>Sí
                            </span>
                            @else
                            <span class="badge-nodisponible badge-combustible">
                                <i class="bi bi-x-circle me-1"></i>No
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Ver -->
                                <a href="{{ route('vehiculos.show', $vehiculo->matricula) }}"
                                    class="btn btn-outline-info btn-action"
                                    title="Ver detalle">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('vehiculos.edit', $vehiculo->matricula) }}"
                                    class="btn btn-outline-primary btn-action"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <!-- Eliminar -->
                                <form action="{{ route('vehiculos.destroy', $vehiculo->matricula) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirmarEliminacion('{{ $vehiculo->matricula }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-action"
                                        title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $vehiculos->links('pagination::bootstrap-5') }}
        </div>
        @else
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-car-front text-muted" style="font-size: 3rem;"></i>
            </div>
            <h5 class="text-muted mb-3">No hay vehículos registrados</h5>
            <p class="text-muted mb-4">Comienza agregando tu primer vehículo</p>
            <a href="{{ route('vehiculos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Agregar Primer Vehículo
            </a>
        </div>
        @endif
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h3 class="text-primary">{{ $vehiculos->count() }}</h3>
                <p class="text-muted mb-0">Vehículos totales</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h3 class="text-success">{{ $vehiculos->where('disponible', true)->count() }}</h3>
                <p class="text-muted mb-0">Disponibles</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h3 class="text-danger">{{ $vehiculos->where('disponible', false)->count() }}</h3>
                <p class="text-muted mb-0">No disponibles</p>
            </div>
        </div>
    </div>
</div>
@endsection