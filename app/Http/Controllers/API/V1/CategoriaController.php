<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Categoria\StoreCategoriaRequest;
use App\Http\Requests\API\V1\Categoria\UpdateCategoriaRequest;
use App\Http\Resources\API\V1\Categoria\CategoriaCollection;
use App\Http\Resources\API\V1\Categoria\CategoriaResource;
use App\Models\API\V1\Categoria;
use Illuminate\Support\Facades\File;

class CategoriaController extends Controller
{
    public function index()
    {
        return new CategoriaCollection(Categoria::where('estado','1')->paginate(20));
    }

    public function store(StoreCategoriaRequest $request)
    {
        $Categoria = new Categoria($request->all());

        if($request->hasFile('icono')){
            $imagen = $request->file('icono');
            $ext = $imagen->extension();
            $file = time().'.'.$ext;
            $imagen->storeAs('public/Categoria', $file);
            $Categoria->icono = $file;
        }
        $Categoria->save();

        return response()->json([
            'res' => true,
            'data' => $Categoria,
            'msg' => 'Guardado correctamente'
        ],201);
    }

    public function show(Categoria $CategoriaId)
    {
        return response()->json(new CategoriaResource($CategoriaId),200);
    }

    public function update(UpdateCategoriaRequest $request, $CategoriaId)
    {
        $Categoria = Categoria::findOrFail($CategoriaId);
        if ($request->hasFile('icono')){
            if(File::exists("public/Categoria".$Categoria->icono)) {
                File::delete("public/Categoria".$Categoria->icono);
            }
            $imagen  = $request->file('icono');
            $ext = $imagen->extension();
            $file = time().'.'.$ext;
            $imagen->storeAs('public/Categoria',$file);
            $Categoria->icono = $file;

            $request['icono'] = $Categoria->icono;
        }

        $Categoria->update([
            "nombre" =>$request->nombre,
            "descripcion" =>$request->descripcion,
            "icono"=>$Categoria->icono
        ]);

        return (new CategoriaResource($Categoria))->additional(['msg'=>'Dato actualizado correctamente'])
        ->response()->setStatusCode(202);
    }

    public function destroy(Categoria $request, $CategoriaId)
    {
        $Categoria = Categoria::findOrFail($CategoriaId);

        if(File::exists("storage/Categoria/".$Categoria->icono))
        {
            File::delete("storage/Categoria/".$Categoria->icono);
        }

        $Categoria->delete();

        return response()->json([
            'res' => true,
            'data' => $Categoria,
            'message' => 'Eliminado correctamente'
        ],200);
    }
}
