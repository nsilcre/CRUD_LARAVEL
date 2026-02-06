@extends('layouts.app')

@section('title', 'Editar Vehículo - Concesionario')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    <i class="bi bi-pencil text-primary me-2"></i>
                    Editar Vehículo: {{ $vehiculo->matricula }}
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('vehiculos.update', $vehiculo->matricula) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-4">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <!-- Matrícula (solo lectura) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Matrícula</label>
                                <input type="text" value="{{ $vehiculo->matricula }}"
                                    class="form-control bg-light" readonly>
                                <input type="hidden" name="matricula" value="{{ $vehiculo->matricula }}">
                                <div class="form-text">La matrícula no se puede modificar</div>
                            </div>

                            <!-- Marca -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Marca *</label>
                                <input type="text" name="marca"
                                    value="{{ old('marca', $vehiculo->marca) }}"
                                    class="form-control {{ $errors->has('marca') ? 'is-invalid' : '' }}"
                                    required>
                                @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Modelo -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Modelo *</label>
                                <input type="text" name="modelo"
                                    value="{{ old('modelo', $vehiculo->modelo) }}"
                                    class="form-control {{ $errors->has('modelo') ? 'is-invalid' : '' }}"
                                    required>
                                @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fecha Fabricación -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Fecha Fabricación *</label>
                                <input type="date" name="fecha_fabricacion"
                                    value="{{ old('fecha_fabricacion', $vehiculo->fecha_fabricacion->format('Y-m-d')) }}"
                                    max="{{ date('Y-m-d') }}"
                                    class="form-control {{ $errors->has('fecha_fabricacion') ? 'is-invalid' : '' }}"
                                    required>
                                @error('fecha_fabricacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <!-- Combustible -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Combustible *</label>
                                <select name="combustible"
                                    class="form-select {{ $errors->has('combustible') ? 'is-invalid' : '' }}"
                                    required>
                                    <option value="">Seleccionar...</option>
                                    <option value="hibrido" {{ (old('combustible', $vehiculo->combustible) == 'hibrido') ? 'selected' : '' }}>
                                        <i class="bi bi-lightning-charge me-1"></i>Híbrido
                                    </option>
                                    <option value="electrico" {{ (old('combustible', $vehiculo->combustible) == 'electrico') ? 'selected' : '' }}>
                                        <i class="bi bi-ev-front me-1"></i>Eléctrico
                                    </option>
                                    <option value="gasolina" {{ (old('combustible', $vehiculo->combustible) == 'gasolina') ? 'selected' : '' }}>
                                        <i class="bi bi-fuel-pump me-1"></i>Gasolina
                                    </option>
                                    <option value="diesel" {{ (old('combustible', $vehiculo->combustible) == 'diesel') ? 'selected' : '' }}>
                                        <i class="bi bi-fuel-pump-diesel me-1"></i>Diésel
                                    </option>
                                </select>
                                @error('combustible')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Disponible -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Disponible *</label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="disponible"
                                            id="disponible_si" value="1"
                                            {{ (old('disponible', $vehiculo->disponible) == 1) ? 'checked' : '' }} required>
                                        <label class="form-check-label text-success" for="disponible_si">
                                            <i class="bi bi-check-circle me-1"></i>Sí
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="disponible"
                                            id="disponible_no" value="0"
                                            {{ (old('disponible', $vehiculo->disponible) == 0) ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger" for="disponible_no">
                                            <i class="bi bi-x-circle me-1"></i>No
                                        </label>
                                    </div>
                                </div>
                                @error('disponible')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Precio -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Precio (€)</label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="precio"
                                        value="{{ old('precio', $vehiculo->precio) }}"
                                        class="form-control {{ $errors->has('precio') ? 'is-invalid' : '' }}"
                                        min="0" max="1000000">
                                    <span class="input-group-text">€</span>
                                </div>
                                @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kilometraje -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kilometraje *</label>
                                <div class="input-group">
                                    <input type="number" name="kilometraje"
                                        value="{{ old('kilometraje', $vehiculo->kilometraje) }}"
                                        class="form-control {{ $errors->has('kilometraje') ? 'is-invalid' : '' }}"
                                        min="0" max="1000000" required>
                                    <span class="input-group-text">km</span>
                                </div>
                                @error('kilometraje')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Observaciones</label>
                        <textarea name="observaciones" rows="3"
                            class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}"
                            placeholder="Notas adicionales sobre el vehículo...">{{ old('observaciones', $vehiculo->observaciones) }}</textarea>
                        @error('observaciones')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between border-top pt-4">
                        <div>
                            <a href="{{ route('vehiculos.show', $vehiculo->matricula) }}"
                                class="btn btn-outline-info me-2">
                                <i class="bi bi-eye me-1"></i>Ver Detalle
                            </a>
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Volver
                            </a>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i>Actualizar Vehículo
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection