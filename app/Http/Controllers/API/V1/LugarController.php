<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Lugar\StoreLugarRequest;
use App\Http\Requests\API\V1\Lugar\UpdateLugarRequest;
use App\Http\Resources\API\V1\Lugar\LugarCollection;
use App\Http\Resources\API\V1\Lugar\LugarResource;
use App\Models\API\V1\Lugar;
use App\Models\API\V1\FotosLugar;
use App\Models\API\V1\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Auth;

class LugarController extends Controller
{
    public function index()
    {
        return new LugarCollection(Lugar::all());
    }

    public function Lugaruser()
    {
        return new LugarCollection(Lugar::where('user_id', auth()->user()->id)->paginate(20));
    }

    public function casas()
    {
        return new LugarCollection(Lugar::where('categoria_id','4')->paginate(20));
    }
    
    public function cabanias()
    {
        return new LugarCollection(Lugar::where('categoria_id','5')->paginate(20));
    }


    public function hotel()
    {
        return new LugarCollection(Lugar::where('categoria_id','6')->paginate(20));
    }


    public function store(StoreLugarRequest $request)
    {
        $Lugar = new Lugar($request->all());

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $ext = $image->extension();
            $file = time().'.'.$ext;
            $image->storeAs('public/Imagen', $file);
            $Lugar->imagen = $file;
        }

        $Lugar->user_id = Auth::user()->id;
        $Lugar->save();

        /*if($request->hasFile("fotos_lugar")){
            $path=$request->file("fotos_lugar");
            foreach($path as $path){
                $imageName=time().'_'.$path->getClientOriginalName();
                $request['lugar_id']=$Lugar->id;
                $request['fotos_lugar']=$imageName;
                $path->move(\public_path("storage/fotos_lugar"),$imageName);
                LugarImage::create($request->all());

            }
        }*/

        return response()->json([
            'res' => true, 
            'data' => $Lugar, 
            'msg' => 'Guardado correctamente' 
        ],201);
    }

    public function show(Lugar $LugarId)
    {
        /*$imagenes = DB::select('SELECT fotos_lugar.id, fotos_lugar.imagen	
        FROM lugars
        INNER JOIN fotos_lugar ON lugars.id = fotos_lugar.lugar_id
        WHERE lugars.id = $LugarId->id');
        */
       return response()->json(new LugarResource($LugarId),200);
    }

    /*public function images()
    {
        $imagenes = DB::select('SELECT fotos_lugar.imagen	
        FROM lugars
        INNER JOIN fotos_lugar ON lugars.id = fotos_lugar.lugar_id
        
        WHERE lugars.id = fotos_lugar.lugar_id');
        
        return response()->json([
            'res' => true, 
            'data' => $imagenes, 
        ],200);
    }*/

    /*public function updaterole(Request $request, User $LugarId)
    {
        $Lugar = DB::update("UPDATE users
        SET role = 'Host'
        WHERE users.id = $LugarId->id");
        
        return response()->json([
            'res' => true, 
            'data' => $Lugar, 
        ],200);
    }*/

    public function update(UpdateLugarRequest $request, $LugarId)
    {
        $Lugar=Lugar::findOrFail($LugarId);
        if ($request->hasFile('imagen')){
            if (File::exists("storage/Imagen/".$Lugar->imagen)) 
            {
                File::delete("storage/Imagen/".$Lugar->imagen);
            }
            $imagen = $request->file('imagen');
            $ext = $imagen->extension();
            $file = time().'.'.$ext;
            $imagen->storeAs('public/Imagen', $file);
            $Lugar->imagen = $file;

            $request['imagen'] = $Lugar->imagen;
        }

        $Lugar->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'direccion' => $request->direccion,
            'numhuesped' => $request->numhuesped,
            'precio' => $request->precio,
            //'imagen' => $Lugar->imagen,
        ]);
        return (new LugarResource($Lugar))->additional(['msg' => 'Actualizado correctamente'])->response()->setStatusCode(202);
        /*FotosLugar::where('lugar_id', $LugarId)->delete();

            if($request->hasFile("fotos_lugar")){
                $path=$request->file("fotos_lugar");
                foreach($path as $path){
                    $imageName=time().'_'.$path->getClientOriginalName();
                    $request['lugar_id']=$Lugar->id;
                    $request['fotos_lugar']=$imageName;
                    $path->move(\public_path("storage/fotos_lugar"),$imageName);
                    LugarImage::create($request->all());
    
                }
            }*/   
    }

    public function destroy(Lugar $request, $LugarId)
    {
         $Lugar = Lugar::findOrFail($ServicioId);
        
        if (File::exists("storage/Lugar/".$Lugar->icono)) {
            File::delete("storage/Lugar/".$Lugar->icono);
        }

        $Lugar->delete();
        
        return response()->json([
            'res' => true, //Retorna una respuesta
            'data' => $Lugar, //retorna toda la data
            'message' => 'Eliminado correctamente'
        ],200);
    }

}
