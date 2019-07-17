<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitud::all();
        return json_encode($solicitudes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $solicitud = new Solicitud();
        $solicitud->fecha = $request->fecha;
        $solicitud->solicitante = $request->solicitante;
        $solicitud->ubicacion = $request->ubicacion;
        $solicitud->hora = $request->hora;
        $solicitud->observaciones = $request->observaciones;
        $solicitud->departamento = auth()->user()->name;

        $registros = DB::table('solicitudes')
            ->select('fecha', 'hora')
            ->where('fecha', '=', $solicitud->fecha)
            ->where('hora', '=', $solicitud->hora)
            ->get();

        if ( sizeof( $registros ) > 0 ) {
            if ( $registros[0]->fecha == $solicitud->fecha && $registros[0]->hora == $solicitud->hora) {
                return json_encode('timeError');
            } else {
                $status = $solicitud->save();
                if ( $status ) {
                    return json_encode('Saved');
                } else {
                    return json_encode('Error');
                }
            }
        } else {
            $status = $solicitud->save();
                if ( $status ) {
                    return json_encode('Saved');
                } else {
                    return json_encode('Error');
                }
        }

            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Solicitud::find($id)->delete();

        if ( $status ) {
            return 'Deleted';
        }
    }
}
