<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CvController extends Controller {

    public function index(Request $request) {
        //Obtiene la busqueda
        $searchTerm = $request->input('search');

        //Hace la consulta
        $query = Alumno::query();

        //Busqueda en la base de datos
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                ->orWhere('apellidos', 'LIKE', "%{$searchTerm}%")
                ->orWhere('correo', 'LIKE', "%{$searchTerm}%")
                ->orWhere('habilidades', 'LIKE', "%{$searchTerm}%");
            });
        }

        //Se ordena en la base de datos
        $alumnos = $query->orderBy('created_at', 'desc')->get();

        //Se devuelve la vista
        return view('cvs.index', [
            'alumnos' => $alumnos
        ]);
    }

    //Muestra el formulario de la ruta resources/views/cvs/create
    function create() : View {
        return view('cvs.create');
    }

    //Recibe los datos y los guarda en la base de datos
    public function store(Request $request): RedirectResponse {
        $result = false;
        $message = '';
        $path = null;
        try {
            $request->validate([
                'fotografia' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', //tipos de imagenes permitidas
            ]);

            //Guarda las fotos en store/public/fotos_cvs
            if ($request->hasFile('fotografia')) {
                $path = $request->file('fotografia')->store('fotos_cvs', 'public');
            }
            
            //Validación de datos
            $datosAlumno = $request->except('_token', 'fotografia');
            $datosAlumno['fotografia'] = $path;

            $alumno = Alumno::create($datosAlumno);

            $result = true;
            $message = '¡Currículum guardado con éxito!';

            
        } 

        //Errores
        catch (ValidationException $e) {
            $message = 'Error con la fotografía: El archivo no es válido, es demasiado grande (max 2MB) o no se subió.';
        
        }
        
        catch (UniqueConstraintViolationException $e) {
            $message = 'El correo electrónico introducido ya está en uso.';
            
        }
        
        catch (QueryException $e) {
            $message = 'Faltan datos obligatorios o tienen un formato incorrecto.';
            
        }
        
        catch (\Exception $e) {
            $message = 'Se ha producido un error inesperado. Consulte al administrador.';
        }

        if (!$result && $path) {
            Storage::disk('public')->delete($path);
        }

        $messageArray = [
            'general' => $message
        ];

        if ($result) {
            return redirect()->route('cvs.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }

    //Para mostrar
    function show(string $id) {
        $alumno = Alumno::findOrFail($id);
        return view('cvs.show', ['alumno' => $alumno]);
    }

    //Para editar
    function edit(string $id) {
        $alumno = Alumno::findOrFail($id);
        return view('cvs.edit', ['alumno' => $alumno]);
    }

    //Para actualizar
    function update(Request $request, string $id): RedirectResponse { 
        $result = false;
        $message = '';
        $newPath = null;

        try {
            //Si no hay alumno saldra error
            $alumno = Alumno::findOrFail($id);
            $oldPath = $alumno->fotografia; //Guardamos la ruta de la foto antigua

            //Validación de una nueva fotografía
            if ($request->hasFile('fotografia')) {
                $request->validate([
                    'fotografia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
                $newPath = $request->file('fotografia')->store('fotos_cvs', 'public');
            }

            //Validamos los datos
            $request->validate([
                'correo' => [
                    'required',
                    'email',
                     //Correo unico
                    Rule::unique('alumnos')->ignore($alumno->id), 
                ],
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
            ]);


            //Actualizamos datos
            $datosActualizar = $request->except('_token', '_method', 'fotografia');

            //Si hay nueva foto se actualiza
            if ($newPath) {
                $datosActualizar['fotografia'] = $newPath;
            }

            //Actualización en la base de datos
            $result = $alumno->update($datosActualizar);
            $message = '¡Currículum actualizado con éxito!';

            //Se borra la antigua foto si se sube una nueva
            if ($result && $newPath) {
                Storage::disk('public')->delete($oldPath);
            }

        } 
        //Errores
        catch (ValidationException $e) {
            $message = 'Error en la validación: ' . $e->validator->errors()->first();

        }
        catch (UniqueConstraintViolationException $e) {

            $message = 'El correo electrónico introducido ya está en uso.';

        }
        catch (QueryException $e) {
            $message = 'Faltan datos obligatorios o tienen un formato incorrecto.';

        }
        catch (\Exception $e) {
            $message = 'Se ha producido un error inesperado. Consulte al administrador.';
        }

        //Si ha fallado pero se sube una nueva foto se actualiza
        if (!$result && $newPath) {
            Storage::disk('public')->delete($newPath);
        }

        $messageArray = [
            'general' => $message
        ];

        if ($result) {
            return redirect()->route('cvs.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }

    //Se borran los datos
    function destroy(string $id) {

        $alumno = Alumno::findOrFail($id);

        Storage::disk('public')->delete($alumno->fotografia);

        $alumno->delete();

        return redirect()->route('cvs.index')->with('success', 'Currículum borrado con éxito.');
        
    }
}