# 🚗 CRUD Concesionario Laravel

## 📋 Descripción
CRUD para gestionar vehículos de un concesionario. Desarrollado con Laravel 12 y Bootstrap 5.

## ✨ Características
✅ Registro y login con Laravel Breeze

✅ CRUD completo de vehículos

✅ Diseño con Bootstrap 5

✅ Validación de datos

✅ Paginación

✅ Autenticación protegida

## 🛠️ Instalación

### 1. Requisitos
- PHP 8.2+
- Composer 2.x
- MySQL 8.0+
- XAMPP (recomendado)

### 2. Configuración rápida
```bash
# Clonar proyecto (si tienes repositorio)
# O crear nuevo proyecto Laravel
composer create-project laravel/laravel concesionario

# Instalar Breeze
composer require laravel/breeze
php artisan breeze:install blade
npm install && npm run build

# Configurar .env con MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=concesionario
DB_USERNAME=root
DB_PASSWORD=

# Crear base de datos en phpMyAdmin
# Nombre: concesionario

# Ejecutar migraciones
php artisan migrate
```

## 🚀 Uso

### 1. Acceder a la aplicación
```bash
php artisan serve
```
Ir a: http://localhost:8000

### 2. Registrarse
- Ir a /register
- Crear cuenta de usuario

### 3. Gestionar vehículos
- Ir a /vehiculos
- Usar botones: Nuevo, Ver, Editar, Eliminar

## 📁 Estructura principal
```
app/
├── Models/Vehiculo.php              # Modelo
├── Http/Controllers/VehiculoController.php  # Controlador
resources/views/
├── layouts/app.blade.php            # Layout
└── vehiculos/                       # Vistas del CRUD
    ├── index.blade.php              # Listado
    ├── create.blade.php             # Crear
    ├── edit.blade.php               # Editar
    └── show.blade.php               # Detalle
routes/web.php                       # Rutas
```

## 🔧 Campos del vehículo

| Campo | Tipo | Ejemplo |
|-------|------|---------|
| matricula | String (PK) | 1234ABC |
| marca | String | Toyota |
| modelo | String | Prius |
| fecha_fabricacion | Date | 2023-05-15 |
| combustible | Enum | hibrido/electrico/gasolina/diesel |
| disponible | Boolean | Sí/No |
| precio | Decimal | 25000.00 |
| kilometraje | Integer | 15000 |
| observaciones | Text | Opcional |

## 🎨 Diseño
- Bootstrap 5 para estilos
- Iconos de Bootstrap Icons
- Tablas responsivas
- Formularios con validación
- Navbar con menú

## 🖼️ Capturas de la aplicación

### 🏠 Página de inicio
![Página de inicio](inicio.png)

### ➕ Añadir vehículo
![Añadir vehículo](add.png)

### 👁️ Vista del vehículo
![Vista del vehículo](vista.png)

### 🗑️ Eliminar vehículo
![Eliminar vehículo](delete.png)

## 📞 Soporte
- Estudiante: Nicolás Silva Cremona
- Asignatura: DVES
- Año: 2026
