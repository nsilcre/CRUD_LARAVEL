<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::orderBy('marca')->orderBy('modelo')->paginate(10);
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $combustibles = ['hibrido', 'electrico', 'gasolina', 'diesel'];
        return view('vehiculos.create', compact('combustibles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|string|max:10|unique:vehiculos',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'fecha_fabricacion' => 'required|date|before_or_equal:today',
            'disponible' => 'required|boolean',
            'combustible' => 'required|in:hibrido,electrico,gasolina,diesel',
            'precio' => 'nullable|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'observaciones' => 'nullable|string|max:500'
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        return view('vehiculos.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        $combustibles = ['hibrido', 'electrico', 'gasolina', 'diesel'];
        return view('vehiculos.edit', compact('vehiculo', 'combustibles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'fecha_fabricacion' => 'required|date|before_or_equal:today',
            'disponible' => 'required|boolean',
            'combustible' => 'required|in:hibrido,electrico,gasolina,diesel',
            'precio' => 'nullable|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'observaciones' => 'nullable|string|max:500'
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado correctamente.');
    }
}
