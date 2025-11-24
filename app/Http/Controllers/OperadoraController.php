<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ControlTurno;
use App\Models\TurnoObligatorio;
use App\Models\Vehiculo;
use Carbon\Carbon;

class OperadoraController extends Controller
{
    public function dashboard()
    {
        return view('operadora.dashboard');
    }

    public function controlTurnos()
    {
        $controles = ControlTurno::with([
            'turno.vehiculo',
            'turno.conductor'
        ])
        ->whereHas('turno', function($query) {
            $query->whereDate('fecha_turno', '>=', Carbon::today());
        })
        ->orderBy('id_control', 'desc')
        ->paginate(20);

        return view('operadora.control-turnos', compact('controles'));
    }

    public function turnosObligatorios()
    {
        $turnos = TurnoObligatorio::with([
            'vehiculo',
            'conductor',
            'asignadoPor'
        ])
        ->whereDate('fecha_turno', '>=', Carbon::today())
        ->orderBy('fecha_turno', 'asc')
        ->paginate(20);

        return view('operadora.turnos-obligatorios', compact('turnos'));
    }

    public function vehiculos()
    {
        $vehiculos = Vehiculo::with('propietario')
            ->where('estado', 'activo')
            ->orderBy('numero_interno', 'asc')
            ->paginate(20);

        return view('operadora.vehiculos', compact('vehiculos'));
    }

  
}