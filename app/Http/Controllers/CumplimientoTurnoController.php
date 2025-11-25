<?php
// app/Http/Controllers/CumplimientoTurnoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CumplimientoTurnoController extends Controller
{
    // Mostrar lista de turnos con su cumplimiento
    public function index(Request $request)
    {
        $fecha = $request->input('fecha', date('Y-m-d'));
        
        $turnos = DB::table('turnos_obligatorios as t')
            ->join('vehiculos as v', 't.id_vehiculo', '=', 'v.id_vehiculo')
            ->join('conductores as c', 't.id_conductor', '=', 'c.id_conductor')
            ->leftJoin('control_turnos as ct', function($join) {
                $join->on('t.id_turno', '=', 'ct.id_turno');
            })
            ->select(
                't.id_turno',
                't.fecha_turno',
                't.estado',
                'v.placa',
                'v.numero_interno',
                'c.primer_nombre',
                'c.primer_apellido',
                DB::raw('COUNT(ct.id_control) as total_llamados'),
                DB::raw('SUM(CASE WHEN ct.respondio = true THEN 1 ELSE 0 END) as llamados_respondidos'),
                DB::raw('SUM(CASE WHEN ct.en_servicio = true THEN 1 ELSE 0 END) as veces_en_servicio')
            )
            ->where('t.fecha_turno', $fecha)
            ->groupBy('t.id_turno', 't.fecha_turno', 't.estado', 'v.placa', 'v.numero_interno', 'c.primer_nombre', 'c.primer_apellido')
            ->orderBy('v.numero_interno')
            ->get();
        
        return view('operadora.cumplimiento-turnos.index', compact('turnos', 'fecha'));
    }
    
    // Formulario para crear registro de cumplimiento
    public function create()
    {
        $turnos = DB::table('turnos_obligatorios as t')
            ->join('vehiculos as v', 't.id_vehiculo', '=', 'v.id_vehiculo')
            ->join('conductores as c', 't.id_conductor', '=', 'c.id_conductor')
            ->select(
                't.id_turno',
                't.fecha_turno',
                'v.placa',
                'v.numero_interno',
                'c.primer_nombre',
                'c.primer_apellido'
            )
            ->where('t.fecha_turno', '>=', date('Y-m-d'))
            ->orderBy('t.fecha_turno')
            ->orderBy('v.numero_interno')
            ->get();
        
        $franjas = [
            ['nombre' => 'Turno mañana', 'hora_inicio' => '05:00', 'hora_fin' => '07:00', 'cruza_medianoche' => false],
            ['nombre' => 'Turno noche', 'hora_inicio' => '20:00', 'hora_fin' => '01:00', 'cruza_medianoche' => true],
        ];
        
        return view('operadora.cumplimiento-turnos.crear', compact('turnos', 'franjas'));
    }
    
    // Guardar registro de cumplimiento
    public function store(Request $request)
    {
        $request->validate([
            'id_turno' => 'required|exists:turnos_obligatorios,id_turno',
            'nombre_franja' => 'required|string|max:100',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'cruza_medianoche' => 'required|boolean',
            'hora_llamado' => 'required',
            'respondio' => 'required|boolean',
            'en_servicio' => 'required|boolean',
        ]);
        
        try {
            DB::table('control_turnos')->insert([
                'id_turno' => $request->id_turno,
                'id_operadora' => Auth::id(),
                'nombre_franja' => $request->nombre_franja,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
                'cruza_medianoche' => $request->cruza_medianoche,
                'hora_llamado' => $request->hora_llamado,
                'respondio' => $request->respondio,
                'en_servicio' => $request->en_servicio,
            ]);
            
            // Actualizar estado del turno si es necesario
            $this->actualizarEstadoTurno($request->id_turno);
            
            return redirect()->route('operadora.cumplimiento-turnos')
                ->with('success', 'Registro de cumplimiento creado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear el registro: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    // Formulario para editar registro
    public function edit($id)
    {
        $control = DB::table('control_turnos as ct')
            ->join('turnos_obligatorios as t', 'ct.id_turno', '=', 't.id_turno')
            ->join('vehiculos as v', 't.id_vehiculo', '=', 'v.id_vehiculo')
            ->join('conductores as c', 't.id_conductor', '=', 'c.id_conductor')
            ->select('ct.*', 'v.placa', 'v.numero_interno', 'c.primer_nombre', 'c.primer_apellido', 't.fecha_turno')
            ->where('ct.id_control', $id)
            ->first();
        
        if (!$control) {
            return redirect()->route('operadora.cumplimiento-turnos')
                ->with('error', 'Registro no encontrado');
        }
        
        return view('operadora.cumplimiento-turnos.editar', compact('control'));
    }
    
    // Actualizar registro
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_franja' => 'required|string|max:100',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'cruza_medianoche' => 'required|boolean',
            'hora_llamado' => 'required',
            'respondio' => 'required|boolean',
            'en_servicio' => 'required|boolean',
        ]);
        
        try {
            $control = DB::table('control_turnos')->where('id_control', $id)->first();
            
            if (!$control) {
                return back()->with('error', 'Registro no encontrado');
            }
            
            DB::table('control_turnos')
                ->where('id_control', $id)
                ->update([
                    'nombre_franja' => $request->nombre_franja,
                    'hora_inicio' => $request->hora_inicio,
                    'hora_fin' => $request->hora_fin,
                    'cruza_medianoche' => $request->cruza_medianoche,
                    'hora_llamado' => $request->hora_llamado,
                    'respondio' => $request->respondio,
                    'en_servicio' => $request->en_servicio,
                ]);
            
            // Actualizar estado del turno
            $this->actualizarEstadoTurno($control->id_turno);
            
            return redirect()->route('operadora.cumplimiento-turnos')
                ->with('success', 'Registro actualizado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    // Eliminar registro
    public function destroy($id)
    {
        try {
            $control = DB::table('control_turnos')->where('id_control', $id)->first();
            
            if (!$control) {
                return back()->with('error', 'Registro no encontrado');
            }
            
            DB::table('control_turnos')->where('id_control', $id)->delete();
            
            // Actualizar estado del turno
            $this->actualizarEstadoTurno($control->id_turno);
            
            return redirect()->route('operadora.cumplimiento-turnos')
                ->with('success', 'Registro eliminado exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
    
    // Toggle rápido de estado
    public function toggleEstado($id)
    {
        try {
            DB::table('turnos_obligatorios')
                ->where('id_turno', $id)
                ->update([
                    'estado' => DB::raw("CASE 
                        WHEN estado = 'cumplido' THEN 'incumplido' 
                        WHEN estado = 'incumplido' THEN 'cumplido' 
                        ELSE 'cumplido' 
                    END")
                ]);
            
            return back()->with('success', 'Estado actualizado');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar estado');
        }
    }
    
    // Método privado para actualizar estado del turno basado en controles
    private function actualizarEstadoTurno($idTurno)
    {
        $controles = DB::table('control_turnos')
            ->where('id_turno', $idTurno)
            ->get();
        
        if ($controles->isEmpty()) {
            DB::table('turnos_obligatorios')
                ->where('id_turno', $idTurno)
                ->update(['estado' => 'programado']);
            return;
        }
        
        $totalControles = $controles->count();
        $controlesRespondidos = $controles->where('respondio', true)->count();
        $controlesEnServicio = $controles->where('en_servicio', true)->count();
        
        // Lógica para determinar el estado
        if ($controlesRespondidos == $totalControles && $controlesEnServicio == $totalControles) {
            $estado = 'cumplido';
        } elseif ($controlesRespondidos == 0) {
            $estado = 'incumplido';
        } else {
            $estado = 'cumplido'; // Parcialmente cumplido
        }
        
        DB::table('turnos_obligatorios')
            ->where('id_turno', $idTurno)
            ->update(['estado' => $estado]);
    }
}