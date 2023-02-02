<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Servicio\StoreServicioRequest;
use App\Http\Requests\API\V1\Servicio\UpdateServicioRequest;
use App\Http\Resources\API\V1\Servicio\ServicioCollection;
use App\Http\Resources\API\V1\Servicio\ServicioResource;
use App\Models\API\V1\Servicio;
use Illuminate\Support\Facades\File;

class ServicioController extends Controller
{
    public function index()
    {
        return new ServicioCollection(Servicio::all());
    }

    public function store(StoreServicioRequest $request)
    {
        $Servicio = new Servicio($request->all());

        if ($request->hasFile('icono')) {
            $image = $request->file('icono');
            $ext = $image->extension();
            $file = time().'.'.$ext;
            $image->storeAs('public/Servicio', $file);
            $Servicio->icono = $file;
        }

        $Servicio->save();

        return response()->json([
            'res' => true, //Retorna una respuesta
            'data' => $Servicio, //retorna toda la data
            'msg' => 'Guardado correctamente' //Retorna un mensaje
        ],201);
    }

    public function show(Servicio $ServicioId)
    {
        return response()->json(new ServicioResource($ServicioId),200);
    }

    public function update(UpdateServicioRequest $request, $ServicioId)
    {
        $Servicio = Servicio::findOrFail($ServicioId);
        if ($request->hasFile('icono')){
            if (File::exists("storage/Servicio/".$Servicio->icono)) {
                File::delete("storage/Servicio/".$Servicio->icono);
            }
            $image = $request->file('icono');
            $ext = $image->extension();
            $file = time().'.'.$ext;
            $image->storeAs('public/Servicio', $file);
            $Servicio->icono = $file;

            $request['icono'] = $Servicio->icono;
        }
        
        $Servicio->update([$request->all(),
        "icono"=>$Servicio->icono,]);
        
        return response()->json([
            'res' => true,
            'data' => $Servicio, 
            'msg' => 'Actualizado correctamente'
        ],200);
    }

    public function destroy(Servicio $request, $ServicioId)
    {
        $Servicio = Servicio::findOrFail($ServicioId);
        
        if (File::exists("storage/Servicio/".$Servicio->icono)) {
            File::delete("storage/Servicio/".$Servicio->icono);
        }

        $Servicio->delete();
        
        return response()->json([
            'res' => true, //Retorna una respuesta
            'data' => $Servicio, //retorna toda la data
            'message' => 'Eliminado correctamente'
        ],200);
        //204 No Content
    }
}
