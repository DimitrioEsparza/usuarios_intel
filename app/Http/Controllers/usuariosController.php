<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class usuariosController extends Controller
{
    

    public function index() {
        $usuarios = DB::select("SELECT * FROM catusuarios");
        return view('welcome',['usuarios' => $usuarios]);
    }
    
    /**
     * Crea el registro del usuario por metodo post
     */
    public function add(Request $request) {
        $nombre = $request->input('inputNombre');
        $apellido = $request->input('inputApellido');
        $telefono = $request->input('inputTelefono');
        $edad = $request->input('inputEdad');
        $fechaIngreso = $request->input('inputFIngreso');

        
        $fileName = time().'.'.$request->inputImg->extension();  
        $request->inputImg->move(public_path('images'), $fileName);

        DB::insert("INSERT INTO catusuarios(nombre,apellido,telefono,edad,fechaIngreso,urlImage) VALUES(?,?,?,?,?,?)",
        [$nombre,$apellido,$telefono,$edad,$fechaIngreso,$fileName]);
        $usuarios = DB::select("SELECT * FROM catusuarios");
        return redirect('/');
    }

    /**
     * Elimina los datos de los usuarios por metodo delete
     */
    public function delete(Request $request) {
        DB::delete("DELETE FROM catusuarios WHERE id = ?", [$request->input("id")]);
        return response()->json(["mensaje"=>"Eliminacion correcta del usuario"]);
    }

    /**
     * Obtiene los datos del usuario
     */
    public function getUsuario(Request $request) {
        $usuario = DB::select("SELECT * FROM catusuarios WHERE id = ?", [$request->input("id")]);
        return response()->json($usuario[0]);
    }
    
    /**
     * Actualiza los datos del usuario
     */
    public function usuariosvista($id) {
        $usuario = DB::select("SELECT * FROM catusuarios WHERE id = ?",[$id]);
        return view('updateUsr',['usuario' => $usuario[0]]);
    }
    public function putUsuario(Request $request) {
        DB::update("UPDATE catusuarios set nombre=?, apellido=?, telefono=?, edad=?, fechaIngreso=?
        WHERE id = ?"
        ,[$request->input('nombre'),
        $request->input('apellido'),
        $request->input('telefono'),
        $request->input('edad'),
        $request->input('fechaIngreso'),
        $request->input('id')]);
        return response()->json(["mensaje"=>"Se actualizo el registro correctamente"]);
    }


    /**
     * Para las cargas masivas
     */
    public function cargaMasiva()
    {
        return view("cargaMasiva");
    }

    
    /**
     * Para las cargas masivas
     */
    public function cargaMasivaDatos(Request $request)
    {
        $datos = $request->all();
        $valores = json_decode($datos["datos"]);
        foreach ($valores as $usuario => $key) {
            DB::insert("INSERT INTO catusuarios(nombre,apellido,telefono,edad,fechaIngreso,urlImage)
             VALUES(?,?,?,?,CONVERT(?,DATE),?)",
             [$key->nombre,$key->apellido,$key->telefono,$key->edad,$key->fechaIngreso,""]);
        }
        return response()->json(["mensaje"=>"Se actualizo el registro correctamente"]);
    }









}
 