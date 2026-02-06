@extends('layouts.app')

@section('title', 'Detalle Vehículo - Concesionario')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-car-front text-primary me-2"></i>
                        Detalle del Vehículo: {{ $vehiculo->matricula }}
                    </h5>
                    <div>
                        <a href="{{ route('vehiculos.edit', $vehiculo->matricula) }}"
                            class="btn btn-outline-primary me-2">
                            <i class="bi bi-pencil me-1"></i>Editar
                        </a>
                        <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Volver
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Información Principal -->
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Información Básica
                                </h6>

                                <dl class="row">
                                    <dt class="col-sm-4">Matrícula:</dt>
                                    <dd class="col-sm-8">
                                        <span class="badge bg-dark fs-6">{{ $vehiculo->matricula }}</span>
                                    </dd>

                                    <dt class="col-sm-4">Marca:</dt>
                                    <dd class="col-sm-8 fw-semibold">{{ $vehiculo->marca }}</dd>

                                    <dt class="col-sm-4">Modelo:</dt>
                                    <dd class="col-sm-8 fw-semibold">{{ $vehiculo->modelo }}</dd>

                                    <dt class="col-sm-4">Año:</dt>
                                    <dd class="col-sm-8">
                                        <span class="badge bg-secondary">
                                            {{ $vehiculo->fecha_fabricacion->format('Y') }}
                                        </span>
                                    </dd>

                                    <dt class="col-sm-4">Registrado:</dt>
                                    <dd class="col-sm-8">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $vehiculo->created_at->format('d/m/Y H:i') }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Especificaciones -->
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h6 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-gear me-2"></i>Especificaciones
                                </h6>

                                <dl class="row">
                                    <dt class="col-sm-4">Combustible:</dt>
                                    <dd class="col-sm-8">
                                        @php
                                        $badgeClass = [
                                        'hibrido' => 'badge-hibrido',
                                        'electrico' => 'badge-electrico',
                                        'gasolina' => 'badge-gasolina',
                                        'diesel' => 'badge-diesel'
                                        ][$vehiculo->combustible] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge-combustible {{ $badgeClass }}">
                                            <i class="bi bi-fuel-pump me-1"></i>
                                            {{ ucfirst($vehiculo->combustible) }}
                                        </span>
                                    </dd>

                                    <dt class="col-sm-4">Disponible:</dt>
                                    <dd class="col-sm-8">
                                        @if($vehiculo->disponible)
                                        <span class="badge-disponible badge-combustible">
                                            <i class="bi bi-check-circle me-1"></i>Sí
                                        </span>
                                        @else
                                        <span class="badge-nodisponible badge-combustible">
                                            <i class="bi bi-x-circle me-1"></i>No
                                        </span>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Precio:</dt>
                                    <dd class="col-sm-8">
                                        @if($vehiculo->precio)
                                        <span class="fw-bold text-success fs-5">
                                            {{ number_format($vehiculo->precio, 2) }} €
                                        </span>
                                        @else
                                        <span class="text-muted">No especificado</span>
                                        @endif
                                    </dd>

                                    <dt class="col-sm-4">Kilometraje:</dt>
                                    <dd class="col-sm-8">
                                        <span class="fw-semibold">
                                            {{ number_format($vehiculo->kilometraje, 0) }} km
                                        </span>
                                    </dd>

                                    <dt class="col-sm-4">Actualizado:</dt>
                                    <dd class="col-sm-8">
                                        <i class="bi bi-clock-history me-1"></i>
                                        {{ $vehiculo->updated_at->format('d/m/Y H:i') }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                @if($vehiculo->observaciones)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-warning">
                            <div class="card-header bg-warning bg-opacity-10">
                                <h6 class="mb-0">
                                    <i class="bi bi-chat-text me-2"></i>Observaciones
                                </h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">{{ $vehiculo->observaciones }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Acciones -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between border-top pt-3">
                            <div>
                                <form action="{{ route('vehiculos.destroy', $vehiculo->matricula) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Eliminar vehículo {{ $vehiculo->matricula }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i>Eliminar Vehículo
                                    </button>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('vehiculos.create') }}" class="btn btn-outline-success me-2">
                                    <i class="bi bi-plus-circle me-1"></i>Nuevo Vehículo
                                </a>
                                <a href="{{ route('vehiculos.index') }}" class="btn btn-primary">
                                    <i class="bi bi-list-ul me-1"></i>Ver Todos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection