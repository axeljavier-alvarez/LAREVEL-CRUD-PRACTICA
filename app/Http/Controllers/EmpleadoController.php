<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(1);
        return view('empleado.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validaciones
        $campos = [
          'nombre' => 'required|string|max:100',
          'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' =>'required|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);
        /* $datosEmpleado = request()->all();
        return response()->json($datosEmpleado);*/
        $datosEmpleado = request()->except("_token");

        // insertarlo en uploads y public la foto
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }
        Empleado::insert($datosEmpleado);

        return redirect('empleado')->with('mensaje', 'Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $empleado = Empleado::findOrFail($id);
    return view('empleado.edit', compact('empleado'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // validaciones
         $campos = [
          'nombre' => 'required|string|max:100',
          'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
        ];

                if($request->hasFile('Foto')){
                    $campos = [
            'Foto' =>'required|mimes:jpeg,png,jpg,gif,svg|max:10000',

                    ];
                    $mensaje = [
            'Foto.required' => 'La foto es requerida'
        ];

                };

        $this->validate($request, $campos, $mensaje);




        // quitar token y metodo
        $datosEmpleado = request()->except(["_token", "_method"]);

        // PARTE DE FOTOGRAFIA EDITARLA
        if($request->hasFile('Foto')){

            // recuperar info empleado
            $empleado = Empleado::findOrFail($id);
            // concatenar y eliminar
            // Storage::delete('public/'. $empleado->Foto);
            Storage::disk('public')->delete($empleado->Foto);

            // actualizar
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads', 'public');
        }

        // buscar registro con id
        Empleado::where('id', '=', $id)->update($datosEmpleado);

// recuperar al id y regresar al form
         $empleado = Empleado::findOrFail($id);
         // return view('empleado.edit', compact('empleado'));

    return redirect('empleado')->with('mensaje', 'Empleado Modificado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $empleado = Empleado::findOrFail($id);

    // borrar archivo si existe en el disco "public"
    if (!empty($empleado->Foto) && Storage::disk('public')->exists($empleado->Foto)) {
        Storage::disk('public')->delete($empleado->Foto);
    }

    // eliminar registro (siempre)
    $empleado->delete();

    return redirect('empleado')->with('mensaje', 'Empleado eliminado correctamente');


}

}
