<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Concesionario') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        .badge-combustible {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 500;
        }

        .badge-hibrido {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-electrico {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-gasolina {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-diesel {
            background-color: #e5e7eb;
            color: #374151;
        }

        .badge-disponible {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-nodisponible {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .btn-action {
            padding: 4px 8px;
            margin: 0 2px;
            font-size: 0.85rem;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-vh-100 bg-light">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
                    <i class="bi bi-car-front-fill me-2"></i>Concesionario
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('vehiculos.*') ? 'active fw-bold' : '' }}"
                                href="{{ route('vehiculos.index') }}">
                                <i class="bi bi-car-front me-1"></i>Vehículos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vehiculos.create') }}">
                                <i class="bi bi-plus-circle me-1"></i>Nuevo
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-4">
            <div class="container">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Confirmación para eliminar -->
    <script>
        function confirmarEliminacion(matricula) {
            if (confirm('¿Está seguro de eliminar el vehículo ' + matricula + '?')) {
                return true;
            }
            return false;
        }
    </script>
</body>

</html>