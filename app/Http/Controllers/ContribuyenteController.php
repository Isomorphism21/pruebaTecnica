<?php

namespace App\Http\Controllers;

use App\Models\Contribuyente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ContribuyenteHelper;

class ContribuyenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contribuyente::query();

        $camposFiltrables = ['tipoDeDocumento', 'documento', 'nombres', 'apellidos', 'telefono'];

        foreach ($camposFiltrables as $campo) {
            if ($request->filled($campo)) {
                $query->where($campo, 'like', '%' . $request->input($campo) . '%');
            }
        }

        $contribuyentes = $query->get();

        foreach ($contribuyentes as $contribuyente) {
            $texto = strtolower(str_replace(' ', '', $contribuyente->nombres . $contribuyente->apellidos));
            $frecuencias = ContribuyenteHelper::contarLetrasRecursivo($texto);
            $contribuyente->frecuencias = $frecuencias;
        }

        return view('contribuyente.index', compact('contribuyentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('contribuyente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $datosContribuyente = request()->except('_token');
        if(!ContribuyenteHelper::validarEmail($datosContribuyente['email'])) {
            return response()->json([
                'error' => 'El email proporcionado no es válido.'
            ], 422);
        }
        if($datosContribuyente['tipoDeDocumento'] === 'NIT'){
            $razonSocial = $datosContribuyente['nombres'];
            $razonSocialSeparada = ContribuyenteHelper::separarRazonSocial($razonSocial);
            $datosContribuyente['nombres'] = $razonSocialSeparada['nombres'];
            $datosContribuyente['apellidos'] = $razonSocialSeparada['apellidos'];
        }else {
            $datosContribuyente['nombres'] = $request->input('nombres');
            $datosContribuyente['apellidos'] = $request->input('apellidos');
        }
        $datosContribuyente['nombreCompleto'] = ContribuyenteHelper::generarNombreCompleto(
            $datosContribuyente['nombres'],
            $datosContribuyente['apellidos']
        );
        Contribuyente::insert($datosContribuyente);
        return response()->json([
            'redirect' => route('contribuyentes.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contribuyente $contribuyente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $contribuyente = Contribuyente::findOrFail($id);
        return view('contribuyente.edit', compact('contribuyente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $datosContribuyente = request()->except(['_token', '_method']);
        if(!ContribuyenteHelper::validarEmail($datosContribuyente['email'])) {
            return response()->json([
                'error' => 'El email proporcionado no es válido.'
            ], 422);
        }
        if($datosContribuyente['tipoDeDocumento'] === 'NIT'){
            $razonSocial = $datosContribuyente['nombres'];
            $razonSocialSeparada = ContribuyenteHelper::separarRazonSocial($razonSocial);
            $datosContribuyente['nombres'] = $razonSocialSeparada['nombres'];
            $datosContribuyente['apellidos'] = $razonSocialSeparada['apellidos'];
        }else {
            $datosContribuyente['nombres'] = $request->input('nombres');
            $datosContribuyente['apellidos'] = $request->input('apellidos');
        }
        $datosContribuyente['nombreCompleto'] = ContribuyenteHelper::generarNombreCompleto(
            $datosContribuyente['nombres'],
            $datosContribuyente['apellidos']
        );
        Contribuyente::where('id', '=', $id)->update($datosContribuyente);

        return response()->json([
            'redirect' => route('contribuyentes.index')
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Contribuyente::destroy($id);
        return redirect('contribuyentes');
    }
}
