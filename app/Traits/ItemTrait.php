<?php


namespace App\Traits;


use App\Http\Requests\UpdateItemRequest;
use App\Models\Finanzas\Cuenta;
use App\Models\Finanzas\Transaccion;
use App\Models\Item;
use App\Models\Kardex;
use App\Models\Stock;
use Illuminate\Http\Request;

trait ItemTrait
{


    public function procesarStore(Request $request)
    {

        $categorias = $request->categorias ?? [];

        $request->merge([
            'categoria_id' => $categorias[0] ?? null,
            'precio_compra' => $request->precio_compra ?? 0,
            'precio_promedio' => $request->precio_compra ?? 0,
        ]);

        /**
         * @var Item $item
         */
        $item = Item::create($request->all());

        if ($request->hasFile('imagen')){
            $item->addMediaFromRequest('imagen')->toMediaCollection('items');
        }

        $item->categorias()->sync($categorias);

        $item->actualizaOregistraStcokInicial($request->stock);

        $item->load('marca','unimed','stocks');

        return $item;
    }

    public function processUpdate(UpdateItemRequest $request,Item $item)
    {

        //Categorías multiples para el item
        $categorias = $request->categorias ?? [];
        //Categoría principal (si se selecciona al menos una categoría; la categoría principal es la primera del array)
        $request->merge(['categoria_id' => $categorias[0] ?? null]);

//        if ($item->puedeEditarPrecioPromedio()){
//
//            $request->merge(['precio_promedio' => $request->precio_compra ?? 0]);
//
//        }

        if ($request->hasFile('imagen')){
            $item->addMediaFromRequest('imagen')->toMediaCollection('items');
        }

        /**
         * @var Item $item
         */
        $item->fill($request->all());
        $item->save();


        //Sincroniza las categorías
        $item->categorias()->sync($categorias);

//        if ($item->puedeEditarStock() ){
//
//            $item->actualizaOregistraStcokInicial($request->stock ?? 0);
//
//        }
    }
}
