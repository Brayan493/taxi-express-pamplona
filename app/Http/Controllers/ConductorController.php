<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TurnoObligatorio;
use App\Models\Alerta;
use App\Models\Conductor;
use App\Models\MantenimientoGeneral;
use App\Models\SolicitudCambioRuta;
use App\Models\Propietario;
use App\Models\TarifaDestino;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ConductorController extends Controller
{
    /**
     * Obtener el conductor autenticado por EMAIL
     */
    private function getConductorAutenticado()
    {
        $user = Auth::user();
        
        if (!$user) {
            return null;
        }
        
        // Buscar conductor por email (el correo del usuario = email del conductor)
        return Conductor::where('email', $user->correo)->first();
    }

    /**
     * Dashboard principal del conductor
     */
    public function dashboard()
    {
        $conductor = $this->getConductorAutenticado();

        if (!$conductor) {
            return view('conductor.dashboard', [
                'conductor' => null,
                'turnosProximos' => collect([]),
                'solicitudesPendientes' => 0,
                'alertas' => collect([]),
                'error' => 'No se encontró un perfil de conductor asociado a tu cuenta.'
            ]);
        }

        // Obtener turnos próximos
        $turnosProximos = TurnoObligatorio::with('vehiculo')
            ->where('id_conductor', $conductor->id_conductor)
            ->whereDate('fecha_turno', '>=', Carbon::today())
            ->orderBy('fecha_turno', 'asc')
            ->limit(5)
            ->get();

        // Contar solicitudes pendientes
        $solicitudesPendientes = SolicitudCambioRuta::where('id_conductor', $conductor->id_conductor)
            ->whereNull('autorizado_por')
            ->count();

        // Obtener alertas sin resolver
        $alertas = Alerta::where('id_conductor', $conductor->id_conductor)
            ->where('resuelta', false)
            ->orderByRaw("CASE 
                WHEN prioridad = 'critica' THEN 1 
                WHEN prioridad = 'alta' THEN 2 
                WHEN prioridad = 'media' THEN 3 
                ELSE 4 END")
            ->orderBy('fecha_alerta', 'desc')
            ->limit(5)
            ->get();

        return view('conductor.dashboard', compact(
            'conductor',
            'turnosProximos',
            'solicitudesPendientes',
            'alertas'
        ));
    }

    /**
     * Mis Turnos
     */
    public function misTurnos()
    {
        $conductor = $this->getConductorAutenticado();

        if (!$conductor) {
            return redirect()->route('conductor.dashboard')
                ->with('error', 'No se encontró información del conductor');
        }

        $turnos = TurnoObligatorio::with(['vehiculo', 'conductor', 'asignadoPor'])
            ->where('id_conductor', $conductor->id_conductor)
            ->whereDate('fecha_turno', '>=', Carbon::today())
            ->orderBy('fecha_turno', 'asc')
            ->paginate(20);

        return view('conductor.mis-turnos', compact('turnos'));
    }

    /**
     * Alertas del conductor
     */
    public function alertas()
    {
        $conductor = $this->getConductorAutenticado();

        if (!$conductor) {
            return redirect()->route('conductor.dashboard')
                ->with('error', 'No se encontró información del conductor');
        }

        $alertas = Alerta::with(['vehiculo', 'conductor'])
            ->where('id_conductor', $conductor->id_conductor)
            ->orderBy('resuelta', 'asc')
            ->orderByRaw("CASE 
                WHEN prioridad = 'critica' THEN 1 
                WHEN prioridad = 'alta' THEN 2 
                WHEN prioridad = 'media' THEN 3 
                ELSE 4 END")
            ->orderBy('fecha_alerta', 'desc')
            ->paginate(20);

        return view('conductor.alertas', compact('alertas'));
    }

    /**
     * Mantenimiento general
     */
    public function mantenimientoGeneral()
    {
        $mantenimientos = MantenimientoGeneral::where('activo', true)
            ->orderBy('nombre', 'asc')
            ->paginate(20);

        return view('conductor.mantenimiento-general', compact('mantenimientos'));
    }

    /**
     * Solicitudes de cambio de ruta
     */
    public function solicitudesCambioRuta()
    {
        $conductor = $this->getConductorAutenticado();

        if (!$conductor) {
            return redirect()->route('conductor.dashboard')
                ->with('error', 'No se encontró información del conductor');
        }

        $solicitudes = SolicitudCambioRuta::with([
            'conductor',
            'vehiculo',
            'tarifaDestino',
            'autorizadoPor'
        ])
        ->where('id_conductor', $conductor->id_conductor)
        ->orderBy('fecha_solicitud', 'desc')
        ->paginate(20);

        return view('conductor.solicitudes-cambio-ruta', compact('solicitudes'));
    }

    /**
     * Lista de propietarios
     */
    public function propietarios()
    {
        $propietarios = Propietario::where('activo', true)
            ->withCount('vehiculos')
            ->orderBy('razon_social', 'asc')
            ->paginate(20);

        return view('conductor.propietarios', compact('propietarios'));
    }

    /**
     * Tarifas de destino
     */
    public function tarifas()
    {
        $tarifas = TarifaDestino::where('activa', true)
            ->orderBy('nombre_destino', 'asc')
            ->paginate(20);

        return view('conductor.tarifas', compact('tarifas'));
    }
}