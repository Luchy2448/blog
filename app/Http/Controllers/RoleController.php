<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only('create', 'store');
        $this->middleware('can:roles.edit')->only('edit', 'update');
        $this->middleware('can:roles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::simplePaginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Al establecer un rol le vamos a indicar los permisos que va a tener ese rol
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //realizar la validación
    //     $request->validate([
    //         'name' => 'required',
    //     ]);
    //     $role = Role::create([
    //         'name' => $request->name
    //     ]);
    //     //Al establecer un rol le vamos a indicar los permisos que va a tener ese rol
    //     $role->permissions()->sync($request->permissions);
    //     //$role->syncPermissions($request->permissions);

    //     return redirect()->action([RoleController::class, 'index'])
    //                      ->with('success-create', 'Rol creado con éxito');
    // }
    public function store(Request $request)
{
    // Realizar la validación
    $request->validate([
        'name' => 'required',
    ]);

    // Verificar si el rol ya existe
    $existingRole = Role::where('name', $request->name)->first();

    if ($existingRole) {
        // El rol ya existe, puedes manejarlo de la manera que prefieras
        return redirect()->action([RoleController::class, 'index'])
            ->with('error', 'El rol ya existe');
    }

    // El rol no existe, así que puedes crearlo
    $role = Role::create([
        'name' => $request->name
    ]);

    // Al establecer un rol, le vamos a indicar los permisos que va a tener ese rol
    $role->permissions()->sync($request->permissions);

    return redirect()->action([RoleController::class, 'index'])
                     ->with('success-create', 'Rol creado con éxito');
}
   
    public function edit(Role $role)
    {
        //Traer todos los permisos
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //realizar una validación
        $request->validate([
            'name' => 'required',
        ]);
        $role->update([
            'name' => $request->name
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->action([RoleController::class, 'index'])
                         ->with('success-update', 'Rol modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();
        return redirect()->action([RoleController::class, 'index'])
                         ->with('success-delete', 'Rol eliminado con exito');
    }
}
