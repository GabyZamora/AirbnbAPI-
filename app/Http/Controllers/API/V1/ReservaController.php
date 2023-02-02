<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Reserva\StoreReservaRequest;
use App\Http\Requests\API\V1\Reserva\UpdateReservaRequest;
use App\Http\Resources\API\V1\Reserva\ReservaCollection;
use App\Http\Resources\API\V1\Reserva\ReservaResource;
use App\Models\API\V1\Reserva;
use App\Models\API\V1\User;
use Illuminate\Support\Facades\DB;
use Auth;

class ReservaController extends Controller
{
    public function index()
    {
        return new ReservaCollection(Reserva::all());
    }

    public function Reservauser()
    {
        return new ReservaCollection(Reserva::where('user_id', auth()->user()->id)->paginate(20));
    }

    public function store(StoreReservaRequest $request)
    {
        $Reserva = new Reserva($request->all());

        //$Reserva->user_id = Auth::user()->id;

        $Reserva->save();

        return response()->json([
            'res' => true, 
            'data' => $Reserva, 
            'msg' => 'Guardado correctamente' 
        ],201);
    }

    /*public function confirmar(StoreReservaRequest $request){
        //Recibiré 3 datos de la tabla checkin, checkout, lugar_id para el cual se hará consulta a la bd con select
        //SELECT COUNT (*) FROM reservas WHERE checkin='2023-01-15' AND checkout='2023-01-18' AND lugar_id='2'
    }*/
    public function show(Reserva $ReservaId)
    {
        
        return response()->json([
            'data' => new ReservaResource($ReservaId),
        ],200);
    }


    public function update(UpdateReservaRequest $request, $ReservaId)
    {
        $Reserva = Reserva::findOrFail($ReservaId);
        $Reserva->update([
            'checkin' =>$request->checkin,
            'checkout' =>$request->checkout,
            'lugar_id' =>$request->lugar_id,
            'user_id' => $request->user_id,
            'numhuesped' =>$request->numhuesped,
            'preciototal' =>$request->preciototal
        ]);
        
        return (new ReservaResource($Reserva))
        ->additional(['msg' => 'Actualizado correctamente'])
        ->response()
        ->setStatusCode(202);
    }

    public function destroy(Reserva $request, $ReservaId)
    {
        $Reserva = Reserva::findOrFail($ReservaId);

        $Reserva->delete();
        
        return response()->json([
            'res' => true, 
            'data' => $Reserva, 
            'message' => 'Eliminado correctamente'
        ],200);
    }
}
