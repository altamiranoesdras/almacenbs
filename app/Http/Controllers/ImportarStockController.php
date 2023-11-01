<?php

namespace App\Http\Controllers;

use App\Imports\StockImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportarStockController extends Controller
{


    public function index()
    {

        return view('stocks.import');
    }

    public function importar(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ],[
            'file.required' => 'Debe seleccionar un archivo',
            'file.mimes' => 'El archivo debe ser de tipo xls o xlsx'
        ]);

        try {

            DB::beginTransaction();


            $import = new StockImport();


            $import->import($request->file('file'));


        }
        catch (ValidationException $e) {
            DB::rollBack();

            $erros = array();
            foreach ($e->failures() as $failure) {
                $erros[] = "Error en fila ".$failure->row().": ".implode($failure->errors());
            }

            flash('error', 'Error al intentar importar los datos!')->error();

            return redirect()->back()->withErrors([$erros]);
        }
        catch (Exception $e){

            DB::rollBack();

            $msj = manejarException($e);

            flash('error', 'Error al intentar importar los datos!')->error();

        }

        DB::commit();



        flash('Datos Importados con éxito!')->success();

        return redirect(route('stocks.importar'));
    }
}
